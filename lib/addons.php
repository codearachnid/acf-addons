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
					'file' => 'acf-tax.php',
					'init' => 'Tax_field',
					'icon' => 'https://a248.e.akamai.net/camo.github.com/f7a4edef10d466d2affe40d3a83044022833967c/687474703a2f2f6675747572656d656469612e67722f696d616765732f6769742f7461782d69636f6e2e706e67',
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
					'file' => 'paypal_item.php',
					'init' => 'PayPalItem_field',
					'icon' => 'http://www.advancedcustomfields.com/wp-content/uploads/2012/04/field-tumb.png',
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
					'file' => 'flickr.php',
					'init' => 'Flickr_field',
					'icon' => 'http://www.advancedcustomfields.com/wp-content/uploads/2012/04/ACF_Flickr.png',
					'title' => __('Flickr Field','acf-addons'),
					'more_link' => 'http://www.advancedcustomfields.com/add-ons/flickr-field/',
					'description' => __('Creates a dropdown of all Flickr sets or galleries ','acf-addons'),
					'author' => 'Paul Huisman',
					'more_author' => 'http://paulhuisman-online.nl/'
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