=== CategoryTinymce ===
Contributors: ypraise
Donate link: http://wp.ypraise.com/shop/wordpress-plugins/category-tinymce/
Tags: category description, wp_editor, tag description
Requires at least: 3.3
Tested up to: 4.8.2
Stable tag: 3.6.5
Version: 3.6.5

Provides the ability to add a fully functional tinymce editor to the category and tag editor to style up the introductory information for category archives.

== Description ==

Because the bottom description no longer works with Wordpress 4.0 - the new Category Tinymce 4.0 version available at < a href="http://wp.ypraise.com/2014/boost-your-categories-with-categorytinymce-4-0/">wp.ypraise.com does work </a> - I've taken this plugin back to it's basics.

The default Wordpress category and tag desciption still works with this plugin in wordpress 4.0 so I have removed  bottom desciption. I've also removed the filter that removed the description from the category listing and tag listing screens. You can remove them using your own dashboard screen options by unticking the description box.

I've changed the hiding of the old boxes for tags and categories from jquery to css to reduce chances of conflict with other plugins and themes.

Do not upgrade to this version if you are still using Wordpress 3.9 and using bottom descriptions - you will lose those.

<strong>There is no support for this version of Category Tinymce</stong>. I've updated it because I know some people are using it  as the top description works. It seems pointless have you category edit screen contain forms that you can not use.


== Installation ==

1. Upload CategoryTinymce folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to your category edit pages and start to style them up.


== Frequently Asked Questions ==

= What exactly does this plugin do to my Wordpress installation =

1. The plugin removes the default category description field.
2. It then adds in a new field that is fully tinymce enabled. I did try and just add an editor to the default field but I could not get it to function correctly. The new field saves to the same database section as the default field so no new database tables or fields are added.
3. The plugin runs a filter on the category edit admin pages to remove the default description field as this broke up the admin table and made it unweildly.


= The plugin does not work =

The plugin in was tested on a clean install of wordpress 3.3 and a child theme of 2010. If the plugin does not work then raise a topic for this plugin and tell me: what version of wordpress you are using, what theme are you using, do you have problems with any other tinymce call in your theme.

= What does the future hold for CategoryTinymce =

There's a bit of tweaking needs doing but the main feature next is to only display the category description on the first page of the archives so it is not repeated when you go to the next page in the archive. In the mean time you can use the following code to deal with the issue.

In category.php of your theme folder add:
`
					if (is_category() && $paged < 2) {
		echo '
		<p>'.category_description().'</p>';
	} 
	`
	just before the get template part.
	
In tag.php of your theme folder add:

`
if (is_tag() && $paged < 2) {
		echo '
		<p>'.tag_description().'</p>';
	} 
`
just before the get template part.


== Screenshots ==

1. A new tinymce enabled category description box is added to the category edit screen.
2. The category description box and column are removed form the admin page to keep it looking nice.


== Changelog ==

= 3.6.5 =
* Updated to deal with changes to div id's in latest versiuon of Wordpress to hide the old description box and also to deal with new get screen calls.

= 3.6.4 =
* added support for Wordpress translate function

= 3.6.3 =
* added css fix provided by hafman to prevent unwanted hiding of editor boxes.

= 3.6.2 =
* security enhancement
* notification of CategoryTinymce 5.0 at http://wp.ypraise.com/2014/boost-your-categories-with-categorytinymce-4-0/

=3.6.1=
* the css for removing the old description field was removing all fields in edit screens called description (eg user profile edit) I've added a page check to ensure the css is only called for category edit pages.

= 3.6 =
* Removed bottom description from plugin as these do not work with Wordpress 4.0 and later. The default Wordpress categroy and tag descriptions still work though. 
* Remvoed filter that hide the description in category and tag listing pages - use your own screen display options on the page.
* Hide the old description boxes with css from jquery.

= 3.5.1 =
* Notification of CategoryTinymce 4.0 at http://wp.ypraise.com/

= 3.5 = 
* Notification of ending of support for this plugin due to latest update of Wordpress to 3.9

= 3.4 =
* Change readme file to up date FAQ for woocommerce - I'd been calling the wrong id.

= 3.3 =
* Change read me to show how to add bottom description to a woocommerce product category.

= 3.2 = 
* Added settings page so people who do not want SEO can switch it off.

= 3.1 =
* Combined tag and category hooks to stop conflict on title re-writes

= 3.0 =
* Tags now have bottom description, taq image and SEO meta abilities.

= 2.4 =
* Fixed issue of losing titles on single pages

= 2.3 =
* added seo meta options for categories

= 2.2 =
* added wp stripslashes_deep function call to deal with some reports of auto escaping slashes causing problems with shortcode use

= 2.1 =
* Removed BOM from php file
* Removed some rogue code I forget to take out after testing
* Set wpautop to false to try and stop paragraphs and linebreaks being removed
* Adapted call to second description code to allow for shortcodes

= 2.0 =
* add ability to add a description to the bottom of the category listing. Evidently this is useful in ecommerce sites but I guess it can also help to add extra category specific information or advertising.
* add ability to set a category image
* to use both of the above you will need to add code to your template to display the output

= 1.8 =
* Better fix for loss of data which also allows for the saving of multiple paragraphs. I'd miss typed a fix provided by BugTracker earlier.

= 1.7 =
* Added fix to stop description from deleting when saving with multiple empty paragraphs. Multiple empty paragraphs will be deleted on saving still but all the data will not be lost. If you want to increase spacing between paragraphs use css not empty paragraphs. 


= 1.6 =
* added shortcode abilities - thanks to nikosnikos for suggested and code.
* fixed issue with quote marks causing problems with rendering saved descriptions in some cases - thanks to BugTracker for fix.

= 1.5 =
* tackled the parent category option bug and cleaned up some css code - thanks to Brightweb for fixes.

= 1.4 =
* support for custom taxonomies - thanks to Jaime Martinez for adapting the taxonomy call line.

= 1.3 =
* forced a button style css width to correct the one button per row bug in html quicktags.

= 1.2 =
* dealt with the issue that prevented setting parent categories..

= 1.1 =
* extened the plugin to include tags as there's been no issues raised with the basic category description plugin.

= 1.0 =
* The first flavour launched.


== Upgrade Notice ==

= 3.6.4 =
* added support for Wordpress translate function

= 3.6.3
* added css fix provided by hafman to prevent unwanted hiding of editor boxes.

= 3.6.2 =
* security enhancement
* notification of CategoryTinymce 5.0 at http://wp.ypraise.com/2014/boost-your-categories-with-categorytinymce-4-0/

=3.6.1=
* the css for removing the old description field was removing all fields in edit screens called description (eg user profile edit) I've added a page check to ensure the css is only called for category edit pages.

= 3.6 =
* Removed bottom description and SEO as these are not working in Wordpress 4.0 with the free version of CategoryTinymce.

= 3.5.1 =
* Notification of CategoryTinymce 4.0 at http://wp.ypraise.com/

= 3.5 = 
* Notification of ending of support for this plugin due to latest update of Wordpress to 3.9

= 3.4 =
* Change readme file to up date FAQ for woocommerce - I'd been calling the wrong id.

= 3.3 =
* Change read me to show how to add bottom description to a woocommerce product category.

= 3.2 =
* Added settings page so people who do ot want SEO can switch it off.

= 3.1 =
* Combined tag and category hooks to stop conflict on title re-writes

= 3.0 =
* Tags now have bottom description, taq image and SEO meta abilities.

= 2.4 =
* Fixed issue of losing titles on single pages

= 2.3 =
* added seo meta options for categories

= 2.2 =
* added wp stripslashes_deep function call to deal with some reports of auto escaping slashes causing problems with shortcode use

= 2.1 =
* Removed BOM from php file
* Removed some rogue code I forget to take out after testing
* Set wpautop to false to try and stop paragraphs and linebreaks being removed
* Adapted call to second description code to allow for shortcodes

= 2.0 =
* add ability to add a description to the bottom of the category listing. Evidently this is useful in ecommerce sites but I guess it can also help to add extra category specific information or advertising.
* add ability to set a category image
* to use both of the above you will need to add code to your template to display the output

= 1.8 =
* Better fix for loss of data which also allows for the saving of multiple paragraphs. I'd miss typed a fix provided by BugTracker earlier.

= 1.7 =
* Added fix to stop description from deleting when saving with multiple empty paragraphs. Multiple empty paragraphs will be deleted on saving still but all the data will not be lost. If you want to increase spacing between paragraphs use css not empty paragraphs. 

= 1.6 =
* added shortcode abilities - thanks to nikosnikos for suggested and code.
* fixed issue with quote marks causing problems with rendering saved descriptions in some cases - thanks to BugTracker for fix.

= 1.5 =
tackled the parent category option bug and cleaned up some css code - thanks to Brightweb for fixes.

= 1.4 =
Support for custom taxonomies.

= 1.3 = 
Corrected a missing css stlye for buttons in html quicktags.

= 1.2 =
Upgrade if you need to be able to set parent categories on the category admin pages.

= 1.1 =
Upgrade if you want to use the plugin on tag descriptions and pages.

= 1.0 =
None