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
					'more_link' => 'https://github.com/GCX/acf-address-field',
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
					'more_link' => 'https://github.com/GCX/acf-taxonomy-field',
					'description' => __('Select one or more taxonomy terms and assign them to the post.','acf-addons'),
					'author' => 'Omicron7'
					),
				'acf-gravity-forms' => array(
					'ID' => 'acf-gravity-forms',
					'repo' => 'https://github.com/stormuk/Gravity-Forms-ACF-Field/zipball/master',
					'version' => '',
					'folder' => 'stormuk-Gravity-Forms-ACF-Field-fa3a0e9',
					'force_folder' => false,
					'file' => 'gravity_forms.php',
					'init' => 'Gravity_Forms_field',
					'title' => __('Gravity Forms','acf-addons'),
					'more_link' => 'https://github.com/stormuk/Gravity-Forms-ACF-Field',
					'description' => __('Select one or many Gravity Forms. Returns an object or an array of objects.','acf-addons'),
					'author' => 'Adam Pope',
					'more_author' => 'http://www.stormconsultancy.co.uk/'
					),
				'acf-time-picker' => array(
					'ID' => 'acf-time-picker',
					'repo' => 'http://soderlind.no/download/acf_time_picker.zip',
					'version' => '1.2.0',
					'folder' => 'acf_time_picker',
					'force_folder' => false,
					'file' => 'acf_time_picker.php',
					'init' => 'acf_time_picker',
					'title' => __('Date and Time Picker','acf-addons'),
					'more_link' => 'http://soderlind.no/archives/2012/03/09/time-picker-field-for-advanced-custom-fields/',
					'description' => __('Add a Date and Time Picker field type.','acf-addons'),
					'author' => 'Per Søderlind',
					'more_author' => 'http://soderlind.no/about-me/'
					),
				'acf-advanced-numfield' => array(
					'ID' => 'acf-advanced-numfield',
					'repo' => 'https://github.com/ounziw/numfield-advanced-custom-fields/zipball/master',
					'version' => '',
					'folder' => 'ounziw-numfield-advanced-custom-fields-c4b2f7d',
					'force_folder' => false,
					'file' => 'numfield/numclass.php',
					'init' => 'Num_field',
					'title' => __('Advanced Number Field','acf-addons'),
					'more_link' => 'https://github.com/ounziw/numfield-advanced-custom-fields',
					'description' => __('Set the minimum, maximum, and the step in addtion to the default value. Also, you can use a slider bar to set the number, if your browser supports html5.','acf-addons'),
					'author' => 'Fumito MIZUNO',
					'more_author' => 'http://wp.php-web.net/'
					),
				'acf-qrcode' => array(
					'ID' => 'acf-qrcode',
					'repo' => 'https://github.com/ounziw/qrcode_acf/zipball/master',
					'version' => '',
					'folder' => 'ounziw-qrcode_acf-5f3ece5',
					'force_folder' => false,
					'file' => 'qrcode-acf/qrcode_field.php',
					'init' => 'QRCode_field',
					'title' => __('QR Code','acf-addons'),
					'more_link' => 'https://github.com/ounziw/qrcode_acf',
					'description' => __('This addon creates a QR code, utilizing http://qrserver.com','acf-addons'),
					'author' => 'Fumito MIZUNO',
					'more_author' => 'http://wp.php-web.net/'
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