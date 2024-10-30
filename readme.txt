=== Plugin Name ===
Contributors: lslominski
Plugin Name: MediaHawk Call Tracking Integration
Plugin URI: http://mediahawk.co.uk/
Description: Plugin adds Media Hawk number changing software
Version: 2.0
Author: Lukasz Slominski
License: GPLv2
Tags: calltracking, mediahawk
Tested up to: 4.8.1
== Description ==

Plugin adds Mediahawk call tracking software to website.
To make numbers changing you have to add class to number wrap element. You will find it in your setup email.
You can do it manually or using shortcode in posts and pages:
[mediahawk_number number="Your default number" class="Mediahawk number class"]
If you want to show number as a link add 'mhMobile' to class parameter. 

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/mediahawk-call-tracking` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Use the Settings->Mediahawk call tracking screen to configure the plugin
1. Wrap numbers with <span> tag and add mediahawk class or use shortcode.


== Frequently Asked Questions ==
= How to use shortcode =
Example:

[mediahawk_number number="Your default number" class="MediahawkNumberClass"]

= Number doesn't change =

Check your Tracking ID and number class with your setup email.
Check for any JAVASCRIPT errors.

== Changelog ==

= 1.0 =
* Initial release
= 1.0.1 =
* Minor changes in description
= 2.0 =
New JavaScript tracking code added
