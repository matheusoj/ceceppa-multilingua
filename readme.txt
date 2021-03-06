=== Ceceppa Multilingua ===
Contributors: ceceppa
Tags: multilingual, language, admin, tinymce, bilingual, widget, switcher, i18n, l10n, multilanguage, professional, translation, service, human, qtranslate, wpml, ztranslate, xtranslate, international, .mo file, .po file, localization, widget, post
Requires at least: 3.4.1
Tested up to: 3.8
Stable tag: 1.3.46
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html
Donate Link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=G22CM5RA4G4KG

Adds userfriendly multilingual content management and translation support into Wordpress.

== Description ==

I create Ceceppa Multilingua to let Wordpress have an easy to use interface for managing a fully multilingual web site.
With "Ceceppa Multilingua" you can write your posts and pages in multiple language. Here are some features:

= Features =

- Separated posts and pages for each languages, so you can use different SEO and url for each languages.
- Translate your theme ( Plugin let you translate strings and will generate the .mo file for wordpress )
- URLs pretty and SEO-friendly. ?lang=en, /en/foo/ or en.yoursite.com
- Different menu for each language.
- Translate widget's title.
- Translate Site Title / Tagline
- One-Click-Switching between the languages
- One-Click-Switching between the translations
- Category link translation
- Add flags to menu
- Group/Ungroup comments for each post's languages.
- Show notice when the post/page/category that user is viewing is available, based on the information provided by the browser, in their its language
- Redirects the browser depending on the user's language. Append the suffix &lang= to the home url-
- Least Read Posts, Most Commented, Most Read Posts can show only the posts in user selected language
- Filter search in accordingly to current language
- Change wordpress locale according to current language, useful for localized themes
- Show the list flag of available languages on top or bottom of page/post
- Hide translations of posts of the current language
- Show only posts of the current language
- Plugin works also with custom post types :)

= Widgets =

- "CML: Language Chooser" - Show the list of available languages
- "CML: Recent Posts" - The most recent posts on your site
- "CML: Text" - You can write arbitrary text or HTML separately for each language

Ceceppa Multilingua supports infinite language, which can be easily added/modified/deleted via the comfortable Configuration Page.
All you need to do is activate the plugin, configure categories and start writing the content!

= About =
For more Information visit the [Plugin Homepage](http://www.alessandrosenese.eu/it/interessi/progetti/wp-progetti/ceceppa-multilingua-per-wordpress/)

= Demo =
[Plugin demo](http://www.youtube.com/watch?v=fAPIQonud-E).

= Flags =
Flags directory are downloaded from [Flags](http://blog.worldofemotions.com/danilka/)

= Icons =
Some icons from [Icons](http://www.iconfinder.com/)
Directions icon from [Deviantart](http://emey87.deviantart.com/)

= jQuery plugins =
Tooltip plugin for Jquery [Tipsy](http://onehackoranother.com/projects/jquery/tipsy/)
jQuery image dropdown [DD](http://www.marghoobsuleman.com/jquery-image-dropdown)

= Php gettext =
Php-gettext by Danilo Shegan [php-gettext] https://launchpad.net/php-gettext/
Pgettext by Ruben Nijveld 

== Installation ==

For more detailed instructions, take a look at the [Installation Guide](http://www.alessandrosenese.eu/it/pillole/wp-guide/ceceppa-multilingua-configurare-e-utilizzare-il-plugin/)

Installation of this plugin is fairly easy:

1. Download the plugin from wordpress. 
1. Extract all the files. 
1. Upload everything (keeping the directory structure) to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Manage desidered languages

== Frequently Asked Questions ==

= Is it possible to not have a slug for the main language? =
Yes, it is :).
In "Ceceppa Multilingua" -> "Settings" set the option "Detect browser language:" to "Do Nothing".

= Where can I find full shortcode list =
After installing the plugin you can find full shortcode list in "Ceceppa Multilingua" -> "Shortcode" page.

= Can I translate also the Widget Text =

Yes, you can translate text in the widget, page or post using the shortcode cml_text.
The syntax is:

[cml_text lang1="text..." lang2="text..." ....]

Replace lang1 and lang2 with your languages slug, for example:

[cml_text it="Ciao" en="Hello" epo="Saluton"]

For complete shortcode list visit: [Shortcode] (http://www.alessandrosenese.eu/it/pillole/wp-guide/ceceppa-multilingua-configurare-e-utilizzare-il-plugin/4/)

= How can I show flags for switch between languages =

  1) editing your theme file and use the function:
  
     <?php cml_show_flags() ?>
     
  2) using the widget "CML Widget: Language Chooser"

  3) enabling option in "Ceceppa Multilingua" -> "Settings" page

= What is the function to get current language =

  The function is:
 
     cml_get_current_language();
  
  This function return an object and Its fields are:
  
    *) id           - id of language
    *) cml_default  - 1 if it is the default language
    *) cml_flag     - name of flag
    *) cml_language - name of the language
    *) cml_language_slug - slug of the language
    *) cml_locale        - wordpress locale

= Can I show flags on my website without using widget? =

Yes, you can:

  1) Add float div to website and customize look via css
  2) Append flag to html element
  3) Add flags to menu

= Can I translate the "Site Title" and/or "Tagline" =

Yes, you can translate them in "Ceceppa Multilingua" -> "Site Title/Tagline" page.

= Can I customize the flags? =

Yes, you can but don't store your own flags in the plugin directory, or you lose them when update the plugin.
Store your own flags in:
*) "wp-content/upload/ceceppaml/tiny" - tiny size
*) "wp-content/upload/ceceppaml/small" - small size

If the directory "ceceppaml" doesn't exists, create it

= How to configure the plugin, and support page =

The FAQ is available at the [Plugin Homepage](http://www.alessandrosenese.eu/it/pillole/wp-guide/ceceppa-multilingua-configurare-e-utilizzare-il-plugin/)

For Problems visits the [Support page](http://www.alessandrosenese.eu/it/pillole/wp-guide/ceceppa-multilingua-configurare-e-utilizzare-il-plugin/)

== Screenshots ==

1. Language configuration
2. List of all posts with their translations
3. Translate widget's title
4. Plugin configuration
5. Link to the article
6. Menus configuration
7. Wordpress in your language
8. Translate your theme

== Changelog ==

= 1.3.46 =
* Fixed image path when add flags in submenu

= 1.3.45 =
* Fixed "500 Internal error" when no default language choosed

= 1.3.43 =
* Fixed "Filter posts by language"

= 1.3.40 =
* Fixed warning

= 1.3.35 =
* Added support for different date format for each language

= 1.3.33 =
* Fixed warning filter_get_pages

= 1.3.31 =
* Fixed flags in_the_loop

= 1.3.28 =
* Added new filter method: "Hide empty translations of posts and show in default language"

= 1.3.26 =
* Added support for right to left languages.

= 1.3.23 =
* Fixed bug with page links

= 1.3.22 =
* Fixed body class "home" when use static page

= 1.3.21 =
* Fixed activation hook

= 1.3.19 =
* Fixed bug for children pages
* Added "All language exclued current" to menu meta box
* Added new redirect mode: "Automatically redirects the default language."

= 1.3.17 =
* Fixed bug whit cml_show_available_langs

= 1.3.16 =
* Now you can add flags to menu directly in the page "Aspect" -> "Menu"
* You can show flags also in the loop
* Fixed bug with category and url mode: ?lang=##
* Also the link of the custon post will be "translated"...

= 1.3.15 =
* Fixed warning in widget "chooser"

= 1.3.13 =
* Fixed bug "show posts only in current language"

= 1.3.12 =
* Revert to 1.3.10

= 1.3.11 =
* Fixed problem with duplicated "menus"
* Fixed various bugs

= 1.3.10 =
* Remove print_r :O ( sorry )

= 1.3.9 =
* Fixed change menu when switch between languages

= 1.3.8 =
* Improved "Translate your theme"
* Fixed problem with duplicated "menus"

= 1.3.7 =
* Improved "Translate your theme"
* Added the option for display flags only if translation exists
* Added shortcode/function cml_other_langs_available

= 1.3.6 =
* Fixed widget "CML Language Chooser"

= 1.3.5 =
* Fixed warning

= 1.3.4 =
* Fixed problem with shortcode [cml_text]

= 1.3.3 =
* Added Farsi flag
* Now you can add custom language and flag

= 1.3.2 =
* Improved translation of the themes
* Fixed error in "My translations" if Php < 5.3.0
* Added warning in "Translate your theme if Php < 5.3.0"

= 1.3.1 =
* Improved translation of the themes

= 1.3.0 =
* Now you can translate your theme with Ceceppa Multilingua
* Fixed minor bugs
* Improved help
* Moved tips in help tab

= 1.2.22 =
* Added Url Modification mode: NONE

= 1.2.21 =
* Fixed "redirect loop"

= 1.2.20 =
* Now you can disable the translations of menu items

= 1.2.19 =
* CML: Text Widget now support also shortcodes

= 1.2.18 =
* Translate post link in menu

= 1.2.16 =
* Translate Site Title / Tagline

= 1.2.11 =
* Added border to the active language on the "all posts" page 
* Added checkbox for show also posts withouth translations in "all posts"

= 1.2.8 =
* Fixed pagination link
* Fixed same warnings

= 1.2.5 =
* Fixed PRE_PATH mode.
* Code optimization
* Fixed problem with next and previous post

= 1.2.4 =
* Fixed fatal error "wp_rewrite_rules()"

= 1.2.1 =
* Fixed setlocale

= 1.2.0 =
* Plugin automatically try to download language file when you add new language.
* Locale is detected correctly
* Plugin use wordpress localization for widget titles.
* Improved documetation: Added "Functions" tab in "Shortcode & Functions" page.
* Now title of category will also be translate in "/category/" page
* Fixed comments count when choose to group them
* Improved ui: Now the plugin use wordpress style for tables
* Now you can download language file for wordpress directly from "Ceceppa Multilingua" page.

= 1.1.2 =
* Fixed duplicated items in "edit taxonomies form"

= 1.1.1 =
* Now you can choose the order of the flags :)

= 1.1.0 =
* Plugin works also custom post types :)
* Added "Language data" box for custom post type, now you can choose language, and link translations
* Added extra fields to custom taxonomies
* Now you can show flags also on custom post types
* Added flags for filter the list custom post types (doesn't appears with all plugins)

= 1.0.17 =
* Fixed fatal error on new install :(

= 1.0.14 =
* Now you can change language in "Quick edit" box
* Fixed minor bugs

= 1.0.13 =
* Fixed warning on tags

= 1.0.12 =
* Fixed home redirect with static page
* Fixed switch between categories
* Fixed Archives link

= 1.0.10 =
* Fixed Warning: implode() 

= 1.0.8 =
* Fixed error "Wrong datatype for second argument"

= 1.0.7 =
* Fixed "not found" when try to preview post

= 1.0.6 =
* Fixed browser redirect
* Fixed language detection for categories

= 1.0.5 =
* Fixed issue with filter "Filter posts"
* Now you can choose the size of all flags :)

= 1.0.4 =
* Fixed layout in "Ceceppa Multilingua"
* Fixed minor bugs with category translation

= 1.0.3 =
* Fixed language detection

= 1.0.2 =
* Fixed issue with pages

= 1.0.1 =
* Fixed fatal error in "CML Widget" Recent posts

= 1.0.0 =
* Code optimization
* Fixed "Url Modification mode", now Pre-path and Pre-domain works correctly.
* If you choose pre-path mode add language slug also for category link istead of "?lang=##"
* Fixed "Translate the url for categories", now work correctly. This option is disabled by default, enable it on settings page.
* Fixed Catalan and Spanish flag
* Can show flag in your website withouth edit your template and without use widget. The options are available in "Settings" page

= 0.9.21 =
* Replaced hex2bin with UNHEX, now plugin is compatible also with Php < 5.4

= 0.9.20 =
* Now you can choose to translate link also for categories. The option is available in "Settings" page and support is experimental.

= 0.9.19 =
* Fixed filter in "All posts"

= 0.9.16 =
* Minor bug fixed

= 0.9.15 =
* Plugin is now compatible with Wordpress 3.5.2

= 0.9.14 =
* Fixed bug. Now you can show flags on bottom of the page

= 0.9.13 =
* Plugin now work correctly with php < 5.4

= 0.9.11 =
* Fixed sort in widget "CML: Recent Posts" 

= 0.9.9 =
* Now you can use any symbol in "Widget titles" and "My translation page".
* Added documentation about shortcode in "Ceceppa Multilingua" -> "Shortcode"

= 0.9.4 = 
* Fixed translation of widget titles.

= 0.9.1 =
* Fixed various bug

= 0.9.0 =
* You don't need to assign different menu to each language, because now all items of menu will be automatically translated.
* In the widget "CML: Language Chooser" add field "CSS ClassName"

= 0.8.7 =
* Fixed the translation of widget titles
* Added new widget: "CML: Text"

= 0.8.4 = 
* Now you can translate also tag

= 0.8.1 =
* Fixed bug in "CML: Recent Posts"
* Added "Hide translations" in "Post" -> "All posts"

= 0.8.0 =
* Added "CML: Recent Posts" that show only recent posts of current language.
  In the widget "Categories", the categories will translated correctly

= 0.7.8 =
* Now page will be linked correctly

= 0.7.7 =
* Now translate post link correctly

= 0.7.5 = 
* Now post link is translated correctly

= 0.7.4 =
* Fixed code

= 0.7.1 =
* Fixed translations

= 0.7.0 =
* Now you can translate a category in other languages, or use different categories for each language.
  Added Url Modification mode:
    Use Pre-Path Mode (Default, puts /%slug%/ in front of URL) (www.example.com/en/) (default)
    Use Pre-Domain Mode (en.example.com)
  It is enabled by default, you can change or disable in settings page
    
= 0.6.3 =
* If you use "static page" as homepage, the plugin add ?lang=[]&sp=1 to url

= 0.6.2 =
* Now "hide translations" work correctly

= 0.6 =
* Now you can hide translations of posts of the current language in the_loop()

= 0.5.4 =
* Menu will be changed correctly if you choose default permalink structure (?p=#)

= 0.5.3 =
* Fixed various bug.

= 0.5.1 =
* Set new language "enabled"

= 0.5.0 =
* Removed field "Main page" and "Main category" in "Languages settings" page. 
  Assign language to each categories (it's not necessary for subcategories).

= 0.4.8 =
* Fixed msDropDown issue when 2 select has same id

= 0.4.6 =
* Autorefresh list "Link to the categories" withouth reload page.

= 0.4.4 =
* Fixed warnings

= 0.4.3 =
* Updates all files

= 0.4.1 =
* In edit post it's possible to see and switch to all linked posts, or you can add translation to it.

= 0.4 =
* Now you can have different menu for each language withouth edit your theme code.

= 0.3.7 =
* Fixed: Plugin doesn't work when table prefix wasn't "wp_"

= 0.3.6 =
* Fix error in options page.

= 0.3.5 =
* Get language info correctly during installation

= 0.3.4 =
* Fixed setlocale. Now locale will be changed correctly.
  Fixed linked categories. Now categories will be linked correctly, so filter post in homepage work correctly.
                           If you upgade from 0.3.3 or above, you must edit all linked categories by choosing
                           "Edit" from category page and save it.
= 0.3.3 =
* Fixed: setlocale. It was changed only in admin page

= 0.3.2 =
* Fixed same Notice in debug mode

= 0.3.1 =
* Added flags near title in "All posts" and "All pages
* Added checkbox for disable language

= 0.3 =
* Different post/page for each language
* Different menu for each language. (need to edit header.php)	 	
* Translate widget�s titles	 	
* Group/Ungroup comments for this post/page/category that are available in each language	 	
* Show notice when the post/page/category is available in the visitor�s language	 	
* Automatically redirects the browser depending on the user�s language	 	
* Widget for language chooser		
* Filter some wordpress widgets, as �Least and Reads Posts�, �Most read post�, �Most commented�		
* Filter search in accordingly to current language		
* Change wordpress locale according to current language, useful for localized themes		
* Show the list flag of available languages on top or bottom of page/post		
* Show list of all articles with their translatios, if exists