=== Plugin Name ===
Contributors: codearachnid
Donate link: http://www.imaginesimplicity.com/
Tags: acf, custom fields, autoloader, custom, field, custom field, advanced, simple fields, magic fields, more fields, repeater, matrix, post, type, text, textarea, file, image, edit, admin
Requires at least: 3.4
Tested up to: 3.4
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin bolts on addon fields for Elliot Condon's Advanced Custom Fields

== Description ==

* ~Current Version:1.0~
* Requires: **Advance Custom Fields v. 3.3.9**

This plugin bolts on addon fields for Elliot Condon's [Advanced Custom Fields](http://www.advancedcustomfields.com). It uses a defined libarary of tested and functional fields to activate on your site, future release will include ability to upload or create your own fields. 

This plugin does not store any of the addon code within the repo release. Rather this is just an installer that pulls from the supplied source by the **addon field author** (listed below). If the remote soure is moved or deleted then installing a field will fail in the interim until you update the plugin with the latest library of repo sources.

#### Currently the following fields are included in the library:

* Address by [Omicron7](https://github.com/GCX/acf-address-field)
* Advanced Number by [Fumito MIZUNO](https://github.com/ounziw/numfield-advanced-custom-fields)
* Categories by [Nontas Ravazoulas, Cubeweb](https://github.com/cubeweb/acf-addons)
* Date and Time Picker by [Per Søderlind](http://soderlind.no/archives/2012/03/09/time-picker-field-for-advanced-custom-fields/)
* Flickr by [Paul Huisman](http://paulhuisman-online.nl/)
* Google Maps by [Zvonko, Codeforest](http://www.codeforest.net/)
* Gravity Forms by [Adam Pope](https://github.com/stormuk/Gravity-Forms-ACF-Field)
* PayPal Item by Mike Rodriguez
* QR Code Generator by [Fumito MIZUNO](https://github.com/ounziw/qrcode_acf)
* Taxonomy by [Omicron7](https://github.com/GCX/acf-taxonomy-field)
* Taxonomy Checkboxes Field by [Future Media](http://futuremedia.gr/)
* Unique Key by [Nontas Ravazoulas, Cubeweb](https://github.com/cubeweb/acf-addons)
* User Select by [lewismcarey](http://twitter.com/lewismcarey)

Have an addon you would like to be included - let me know by email tim (at) imaginesimplicity.com or message me on Twitter @[codearachnid](http://www.twitter.com/codearachnid).

### Please note: This library references remote repos, if the source field files are removed or replaced this plugin must be updated with the new source repos. Upon updating you may need to update and refresh your active fields if a repo is failing to activate

== Frequently Asked Questions ==

Have an addon you would like to be included - let me know by email tim (at) imaginesimplicity.com or message me on Twitter @[codearachnid](http://www.twitter.com/codearachnid).

== Upgrade Notice ==

Please note: This library references remote repos, if the source field files are removed or replaced this plugin must be updated with the new source repos. Upon updating you may need to update and refresh your active fields if a repo is failing to activate

== Installation ==

Required <a href="http://wordpress.org/extend/plugins/advanced-custom-fields/">Advanced Custom Fields</a> to be installed and active prior to activation.

1. Upload this plugin folder (acf-addons) to your plugin directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to Custom Fields > Addons in your admin menu

== Screenshots ==

1. Listing of addons
2. Menu Position

== Changelog ==

= 1.0 =
* Initial plugin release (prior commits available https://github.com/codearachnid/acf-addons)
