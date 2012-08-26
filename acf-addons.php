<?php

/*
Plugin Name: Advanced Custom Fields Addons
Plugin URI: 
Description: Extend '<a href="http://www.advancedcustomfields.com">Advanced Custom Fields</a>' with addon integration through your site's admin
Version: 1.0
Author: Timothy Wood (@codearachnid)
Author URI: http://www.codearachnid.com	
Author Email: tim@imaginesimplicity.com
Text Domain: acf-addons
License: GPLv2 or later

Notes:

License:

  Copyright 2011 Imagine Simplicity (tim@imaginesimplicity.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as 
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
  
*/

if ( !defined('ABSPATH') )
  die('-1');

if( ! class_exists('ACF_Addons') ) {
  class ACF_Addons {

    protected static $instance;

    public $base_url;
    public $base_path;
    public $base_name;
    public $acf;
    public $library;
    public $per_page = 20;

    const DOMAIN = 'acf_addons';
    const VERSION = 1.0;
    const MIN_PHP_VERSION = '5.3';
    const MIN_WP_VERSION = '3.3';
    const ACF_MIN_VERSION = '3.3.9';

    function __construct(){
      global $acf;
      // grab parent class because I can't extend it
      $this->acf = $acf;

      // Setup common access properties
      $this->base_path = plugin_dir_path( __FILE__ );
      $this->base_url = plugin_dir_url( __FILE__ );
      $this->base_name = plugin_basename( __FILE__ );

      $this->init_library();

      do_action(self::DOMAIN);

      add_action('admin_menu', array($this,'admin_menu'), 12);
      add_action('wp_ajax_' . self::DOMAIN, array($this,'ajax_actions'));
    }

    function admin_menu(){
      add_submenu_page('edit.php?post_type=acf', __('Addons','acf-field-loader'), __('Addons','acf-field-loader'), 'manage_options','acf-addons',array($this,'dashboard'));
    }

    function dashboard(){
      wp_enqueue_style('acf-field-loader-global', $this->acf->dir . '/css/global.css');
      wp_enqueue_style('acf-field-loader-acf', $this->acf->dir . '/css/acf.css');
      wp_enqueue_style('acf-field-loader', $this->base_url . '/assets/style.css');
      wp_enqueue_script('acf-field-loader', $this->base_url . '/assets/actions.js', array('jquery'));

      $available_list = new ACF_Addons_List_Table();
      $available_list->prepare_items( $this->library );

      include 'views/dashboard.php';
    }

    public function ajax_actions(){
      if( ! in_array($_REQUEST['addon'], array_keys($this->library))) {
        _e('Please try again, this request is not authorized.','acf-addons');
        exit;
      }
      $key = $_REQUEST['addon'];
      switch($_REQUEST['status']) {
        case 'install':
          if( $this->addon_status($key, TRUE) ) {
            printf( __('%s was successfully activated.','acf-addons'), $this->library[$key]['title']);
          } else {
            printf( __('There was a problem activating %s.','acf-addons'), $this->library[$key]['title']);
          }
          break;
        case 'uninstall':
          if( $this->addon_status($key, FALSE) ) {
            printf( __('%s was successfully deactivated.','acf-addons'), $this->library[$key]['title']);
          } else {
            printf( __('There was a problem deactivating %s.','acf-addons'), $this->library[$key]['title']);
          }
          break;
        default: 
          _e('Nothing has changed because the request was not setup properly.','acf-addons');
          break;
      }
      exit;
    }

    public function requirements( $acf_version = null){
      if( is_null($acf_version) ) {
        global $acf;
        $acf_version = $acf->version;
      }
      $pass = TRUE;
      $pass = $pass && function_exists( 'register_field' );
      $pass = $pass && version_compare( $acf_version, self::ACF_MIN_VERSION, '>=');
      $pass = $pass && version_compare( phpversion(), self::MIN_PHP_VERSION, '>=');
      $pass = $pass && version_compare( get_bloginfo('version'), self::MIN_WP_VERSION, '>=');
      return $pass;
    }

    public function init_library(){
      $this->library = ACF_Addons_Library::instance()->addons;
      $active_fields = (array) maybe_unserialize(get_option(self::DOMAIN . '_active'));
      foreach( array_keys($this->library) as $key ) {
        $init_file = $this->base_path . 'field/' . $this->library[$key]['folder'] . '/' . $this->library[$key]['file'];
        if( in_array($key, (array) $active_fields) && file_exists($init_file)) {
          $this->library[$key]['status'] =  true;
          if( $this->library[$key]['init'] === false ) {
            include $init_file;
          } else {
            // sanity check for ACF
            if( function_exists( 'register_field' ) ) {
              register_field($this->library[$key]['init'], $init_file);
            }            
          }
        } else {
          // ensure if the folder is deleted that we don't init
          if( ! file_exists($init_file) && in_array($key, (array) $active_fields) ) {
            unset( $active_fields[array_search( $key, $active_fields )] );
            $active_fields = maybe_serialize($active_fields);
            update_option( self::DOMAIN . '_active', $active_fields );
          }
          $this->library[$key]['status'] =  false;
        }
      }
    }

    public function addon_status($key=null,$status=false){
      if( is_null($key) || empty($key) || is_null($status))
        return false;
      $active_fields = (array)maybe_unserialize(get_option(self::DOMAIN . '_active'));
      $field_folder = $this->base_path.'field/'.$this->library[$key]['folder'].'/';

      if($status) {
        if( ! is_dir($field_folder) ) {
          $download = wp_remote_get( $this->library[$key]['repo'] );

          $file = $this->base_path.'tmp/' . $key . date('YmdHis'). '.zip';
          $fp = fopen($file, "w");
          
          switch($download['headers']['content-type']) {
            case 'application/zip': // catch if it's just a plain zip file
              fwrite($fp, $download['body']);
              break;
            case 'application/octet-stream': // catch if it's gzip (like github)
              $remote = gzopen($this->library[$key]['repo'], "rb");
              while ($string = gzread($remote, 4096)) {
                fwrite($fp, $string, strlen($string));
              }
              gzclose($remote);
              break;
          }
          fclose($fp);

          // lets open this archive up
          WP_Filesystem();
          add_filter('unzip_file_use_ziparchive', create_function('', 'return false;')); 
          $force_folder = $this->library[$key]['force_folder'] ? '/' . $this->library[$key]['folder'] . '/' : '/';
          if ( unzip_file( $file, $this->base_path.'field' . $force_folder ) ) {
            // Now that the zip file has been used, destroy it
            unlink($file);
          }
          add_filter('unzip_file_use_ziparchive', create_function('', 'return true;')); 
        }
        array_push($active_fields,$key);
        $update_status = true;       
      } else {
        unset( $active_fields[array_search( $key, $active_fields )] );
        // add settings to cleanup addon files
        // $this->delete_addon_files($field_folder);
        $update_status = false;
      }
      
      $active_fields = maybe_serialize($active_fields);
      if( update_option( self::DOMAIN . '_active', $active_fields ) )
        $this->library[$key]['status'] = $update_status;
      return true;
    }

    public function delete_addon_files($dirname) {
      // Sanity check
      if (!file_exists($dirname))
        return false;

      // Simple delete for a file
      if (is_file($dirname))
        return unlink($dirname);

      // Loop through the folder
      $dir = dir($dirname);
      while (false !== $entry = $dir->read()) {
        // Skip pointers
        if ($entry == '.' || $entry == '..')
          continue;
        // Recurse
        self::delete_addon_files("$dirname/$entry");
      }

      // Clean up
      $dir->close();
      return rmdir($dirname);
    }

    public function requirements_fail() {
      global $acf;
      ACF_Addons_Deactivate();
      if( ! function_exists( 'register_field' ) )
        echo '<div class="error"><p>' . __('This plugin requires Advanced Custom Fields to be installed and active.','acf-addons') . '</p></div>';
      if( ! version_compare( $acf->version, self::ACF_MIN_VERSION, '>=') )
        echo '<div class="error"><p>' . __('Your version of Advanced Custom Fields does not meet the minimum requirements to run this plugin.','acf-addons') . '</p></div>';
      if( ! version_compare( phpversion(), self::MIN_PHP_VERSION, '>=') )
        echo '<div class="error"><p>' . __('PHP on your server does not meet the minimum requirements to run this plugin.','acf-addons') . '</p></div>';
      if( ! version_compare( get_bloginfo('version'), self::MIN_WP_VERSION, '>=') )
        echo '<div class="error"><p>' . __('Your install of WordPress does not meet the minimum requirements to run this plugin.','acf-addons') . '</p></div>';
    }

    /* Static Singleton Factory Method */
    public static function instance() {
      if ( !isset( self::$instance ) ) {
        $className = __CLASS__;
        self::$instance = new $className;
      }
      return self::$instance;
    }
  }
  /**
   * Instantiate class and set up WordPress actions.
   *
   * @return void
   */
  function Load_ACF_Addons() {
    global $acf;
   	if( class_exists('Acf') ) {
   		// $acf = new Acf; 
      if ( apply_filters( 'acf_field_loader_pre_check', class_exists( 'ACF_Addons' ) && ACF_Addons::requirements( $acf->version ) ) ) {
        // Load all supporting files and hook into WordPress
        include 'lib/addons.php';
        include 'lib/list_table.php';
        add_action('init', array('ACF_Addons', 'instance'), -100, 0);
      } else {
        add_action( 'admin_notices', array('ACF_Addons', 'requirements_fail') );
      }
  	} else {
  		add_action( 'admin_notices', 'Notice_ACF_Addons');
  	}
  }
  add_action( 'plugins_loaded', 'Load_ACF_Addons', 1); // high priority so that it's not too late for addon overrides

  function Notice_ACF_Addons(){
  	echo '<div class="error"><p>' . sprintf(__('%s requires Advanced Custom Fields to be installed and active.','acf-field-loader'),$plugin_data['Name']) . '</p></div>';
    ACF_Addons_Deactivate();
  }
  function ACF_Addons_Deactivate(){
    $plugin = plugin_basename( __FILE__ );
    $plugin_data = get_plugin_data( __FILE__, false );
    if( is_plugin_active( $plugin) )
      deactivate_plugins( $plugin );

  }
}



