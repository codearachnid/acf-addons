<?php

if ( !defined('ABSPATH') )
  die('-1');

if( ! class_exists('ACF_Addons_Library')) {
	class ACF_Addons_Library {

		protected static $instance;
		public $addons;

		function __construct(){
			$this->addons = array(
				'acf-tax' => array(
					'ID' => 'acf-tax',
					'repo' => 'https://github.com/FutureMedia/acf-tax/zipball/master',
					'version' => '1.7',
					'folder' => 'FutureMedia-acf-tax-e5fa820',
					'force_folder' => false,
					'file' => 'acf-tax.php',
					'init' => 'Tax_field',
					'title' => __('Taxonomy Checkboxes Field','acf-addons'),
					'description' => __('Use taxonomies in a custom metabox.','acf-addons'),
					'more_link' => 'https://github.com/FutureMedia/acf-tax',
					'author' => 'Future Media',
					'more_author' => 'http://futuremedia.gr/'
					),
				'acf-paypal' => array(
					'ID' => 'acf-paypal',
					'repo' => 'http://www.greaterthanmedia.me/paypal_item_field.zip',
					'version' => '',
					'folder' => 'paypal_item_field',
					'force_folder' => false,
					'file' => 'paypal_item.php',
					'init' => 'PayPalItem_field',
					'title' => __('Paypal Item Field','acf-addons'),
					'more_link' => 'http://www.advancedcustomfields.com/add-ons/paypal-item-field/',
					'description' => __('Easily add Paypal forms to your site!','acf-addons'),
					'author' => 'Mike Rodriguez'
					),
				'acf-flickr' => array(
					'ID' => 'acf-flickr',
					'repo' => 'http://paulhuisman-online.nl/fresh-look/flickr-field/flickr_field.zip',
					'version' => '',
					'folder' => 'flickr',
					'force_folder' => false,
					'file' => 'flickr.php',
					'init' => 'Flickr_field',
					'title' => __('Flickr Field','acf-addons'),
					'more_link' => 'http://www.advancedcustomfields.com/add-ons/flickr-field/',
					'description' => __('Creates a dropdown of all Flickr sets or galleries.','acf-addons'),
					'author' => 'Paul Huisman',
					'more_author' => 'http://paulhuisman-online.nl/'
					),
				'acf-google-maps' => array(
					'ID' => 'acf-google-maps',
					'repo' => 'http://www.codeforest.net/demo/location.zip',
					'version' => '',
					'folder' => 'acf-google-maps',
					'force_folder' => true,
					'file' => 'location.php',
					'init' => 'Location_field',
					'title' => __('Google Maps','acf-addons'),
					'more_link' => 'http://www.advancedcustomfields.com/add-ons/google-maps/',
					'description' => __('Add locations to your posts or pages just by clicking a Google Map.','acf-addons'),
					'author' => 'Zvonko, Codeforest',
					'more_author' => 'http://www.codeforest.net/'
					),
				'acf-user-select' => array(
					'ID' => 'acf-user-select',
					'repo' => 'https://github.com/lewismcarey/User-Field-ACF-Add-on/zipball/master',
					'version' => '',
					'folder' => 'lewismcarey-User-Field-ACF-Add-on-4569e6c',
					'force_folder' => false,
					'file' => 'users_field.php',
					'init' => 'Users_field',
					'title' => __('Users Select Field','acf-addons'),
					'more_link' => 'https://github.com/lewismcarey/User-Field-ACF-Add-on/',
					'description' => __('Add locations to your posts or pages just by clicking a Google Map.','acf-addons'),
					'author' => 'lewismcarey',
					'more_author' => 'http://twitter.com/lewismcarey'
					),
				'acf-categories' => array(
					'ID' => 'acf-categories',
					'repo' => 'https://github.com/cubeweb/acf-addons/zipball/master',
					'version' => '',
					'folder' => 'cubeweb-acf-addons-7090d12',
					'force_folder' => false,
					'file' => 'categories.php',
					'init' => 'Categories_field',
					'title' => __('Categories Field','acf-addons'),
					'more_link' => 'https://github.com/cubeweb/acf-addons',
					'description' => __('Generate a drop down field with all the categories from your site.','acf-addons'),
					'author' => 'Nontas Ravazoulas, Cubeweb',
					'more_author' => 'https://twitter.com/#!/cubeweb'
					),
				'acf-unique-key' => array(
					'ID' => 'acf-unique-key',
					'repo' => 'https://github.com/cubeweb/acf-addons/zipball/master',
					'version' => '',
					'folder' => 'cubeweb-acf-addons-7090d12',
					'force_folder' => false,
					'file' => 'unique_key.php',
					'init' => 'Unique_key_field',
					'title' => __('Unique Key Field','acf-addons'),
					'more_link' => 'https://github.com/cubeweb/acf-addons',
					'description' => __('Generate a unique key in your repeater row or field group.','acf-addons'),
					'author' => 'Nontas Ravazoulas, Cubeweb',
					'more_author' => 'https://twitter.com/#!/cubeweb'
					),
				'acf-address' => array(
					'ID' => 'acf-address',
					'repo' => 'https://github.com/GCX/acf-address-field/zipball/master',
					'version' => '',
					'folder' => 'GCX-acf-address-field-cae2647',
					'force_folder' => false,
					'file' => 'address-field.php',
					'init' => false,
					'title' => __('Address Field','acf-addons'),
					'more_link' => 'http://www.advancedcustomfields.com/add-ons/address-field/',
					'description' => __('Enter an address by component, change layouts etc.','acf-addons'),
					'author' => 'Omicron7'
					),
				'acf-taxonomy' => array(
					'ID' => 'acf-taxonomy',
					'repo' => 'https://github.com/GCX/acf-taxonomy-field/zipball/master',
					'version' => '',
					'folder' => 'GCX-acf-taxonomy-field-6337e5d',
					'force_folder' => false,
					'file' => 'taxonomy-field.php',
					'init' => false,
					'title' => __('Taxonomy Field','acf-addons'),
					'more_link' => 'http://www.advancedcustomfields.com/add-ons/taxonomy-field/',
					'description' => __('Select one or more taxonomy terms and assign them to the post.','acf-addons'),
					'author' => 'Omicron7'
					)
				);
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
}