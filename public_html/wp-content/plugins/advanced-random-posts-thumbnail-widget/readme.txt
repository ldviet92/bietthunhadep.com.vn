=== Advanced Random Post Thumbnails Widget ===
Contributors: diondeville and yakuphan
Tags: Random, Posts, Random Thumbs, Category, Category Thumbs,Random Thumbnails, Thumbnail Widget
Donate link: http://wpservicemasters.com/plugins/advanced-random-post-thumbnails-widget/
Requires at least: 2.8
Tested up to: 3.3
Stable tag: 1.4

Widget displays thumbnails from random posts. Thumbnails can be grabbed from all posts, from posts from selected categories or selected from categories assigned to a post a visitor is viewing.

== Description ==

Advanced Random Post Thumbnails Widget displays thumbnails grabbed randomly from posts. Each thumbnail is hyperlinked to the post it is taken from or optionally hyperlinked to its post's category. The widget is easy to configure. Visit `Appearance > Widgets` and drag the Advanced Random Post Thumb widget to a widget area.

Widget options include:

1. Images are automatically grabbed from random posts.
1. Can be set to grab a post's first attached image or first displayed image.
1. A custom post field can be used to set the image to grab.
1. Each thumbnail hyperlinks to the post it represents.
1. Each thumbnail can be made to link to its post's category.
1. Thumbnail sizes can be easily specified.
1. Margins between images can be set.
1. Image positioning/centering is a cinch using left and right buffer columns.
1. Easily set a thumbnail to display for posts that lack images.
1. Will display up to 20 random images.
1. Can be configured to select images from all categories, specific categories or just one specific category.
1. When a single category is used, optionally displays the category of the posts the thumbs are selected from. Title displays above the thumb gallery.
1. Title text typography is configured from a drop down box.
1. Title text can be set to link to the category it represents.


This plugin is based on the Advanced Random Post Widget by Yakup GÖVLER. The original widget was designed to show thumbnails, titles and excerpts. This new and enhanced widget is designed to show thumbnails without excerpts and without individual titles.

== Installation ==

1. Make sure you are running WordPress version 2.8 or higher.
1. Use the WordPress Add New Plugins menu otherwise...
1. Download the zip file and extract the contents.
1. Upload the 'advanced-random-post-thumbnails-widget' file to `/wp-content/plugins/`.
1, Extract the zip file.
1. Activate the plugin through the WordPress 'plugins' page.
1. See `Appearance > Widgets` to place the `Random Thumbnails Widget` within your theme.
1. Set the settings in `Appearance > Widgets`.

== Frequently Asked Questions ==

= How can I set it to take posts from the same category as the post being viewed by a site visitor? =

Select the checkbox in the widget's settings called 'Get posts from current category?'.

= How can I get the widget to select posts from specific multiple categories? =

Write a comma separated list of category IDs in the `Categories` textbox.

= What's the order of precedence when setting to select thumbs from `category`, `category of viewed posts`, `Comma separated list of categories`? =

The order of precedence is:

Category (if selected from the drop down box),
Category of viewed posts (if ticked with the checkbox),
Categories (as set with a comma separated list of categories).

For example:

If you have options set for all three values then thumbs will be grabbed from the category set by the `Category` dropdown box.

If you have options set for `Get posts with the same category as the viewed post?` and a comma separated list of `Categories`, then thumbs will be selected from the category if the post being viewed by the visitor.

= Can I style the layout of the images using CSS? =

Certainly. There are plenty of elements to style!

Working outwards from the image...

The img element uses the class `img.dv-advanced-random-posts-thumb`.

The image wrapper div uses the class `div.dv-advanced-random-image-image`.

The container wrapper for all the images uses the class `div.dv-advanced-random-image-block`.

There is a 3 column, single row table between the image wrapper and the container wrapper. The table make sit easier to position the images relative to the container wrapper's left and right sides.

The left column is an empty buffer space with the class `tr.dv-buffer-left`.

The middle column holds the images and has the class `tr.dv-image-holder`.

The right column is an empty buffer space with the class `tr.dv-buffer-right`.

The table has the class `table.dv-advanced-random-image-table`.

The Category title placed below the widget title and above the block of thumbnails has the class `.dv-advanced-random-image-title`.

= Can I translate the plugin to other languages? =

Sure, go ahead. The plugin has a language folder. Put your translation into it. Don't ask me how to create the .po file because I don't know. Let me know when you've translated the plugin language and I'll add your work to the plugin repository.

= Can I make a feature request? =

Yes you can. I don't monitor the WordPress forums often enough to catch requests posted there. Please visit me at [the plugin's homepage](http://wpservicemasters.com/plugins/advanced-random-post-thumbnails-widget/) to make your request. I will do what I can.

= When I select to link to the category a thumb's post belongs to, why do some of my posts link to a different category? =

The thumb will always link to the category the post belongs to. If the category you've set the widget to display contains child categories then a post that displays from that child category will link to that child category rather than the parent category. I might add an option to change this behaviour at a later date.

= Can I donate to you? =

Definitely! :D

WordPress and web development is my livelihood. I do accept donations but I prefer good ol' backlinks and word-of-mouth recommendations to potential clients. Visit me at [WP ServiceMasters](http://wpservicemasters.com/) to learn more about what I do.

== Screenshots ==

1. Widget's screenshot in Dashboard Theme Appearance

== Options ==

The Widget's options allow you to change the way images display within the widget.

= Title: =

Set the widget's title.

= Number of posts to show: =

How many posts to display. The maximum is 20. This can be raised by editing the php file but showing too many thumbs could slow your page loads down.

= Thumbnail Custom Field Name =

Do you use a custom post field to denote images? Use this option to set the custom field as the source of displayed images.
This option stops both the first image of a post and the first attached post image from being used as thumbnails.

= Thumbnail Dimensions =

Set the width and height of the thumbnails. You do not need to specify both a height and a width but doing so prevents over-sized thumbnails.

= Display Thumbnails in Rows and Columns? =

Choose whether to show thumbnails in a single-file column or in multiple columns that might form multiple rows depending on how many thumbnails are displayed. Tick the box to display thumbnails in rows.

= Thumbnail Margins =

Set the pixel distance between each thumbnail and its neighbour.

= Left and Right Side Buffer Space =

The images are laid out in a 3-column, 1-row table. The middle column holds the images. The left and right columns have zero-size by default. The left-most column (Left Buffer Space) may be used to push the images rightward from the widget's left-hand-side. The right-most column (Right Buffer Space) may be used to push the images leftward from the widget's right-hand-side.

By default, all images are centrally aligned relative to the widget's left and right sides. Some themes are awkwardly designed and can make it difficult to make the images display left, right or centrally justified. These left and right buffers make it easy to horizontally position the images in all themes.

= Get the first image of each post =

Uses the first image found in a post as the post's thumbnail.
This option is only active when a custom field is not specified.
This option stops the first image of a post from being used as the thumbnail.

= Get first attached image of post =

Uses the first image attached to a post as the post's thumbnail.
This option is only active when a custom field is not specified.

= Link each thumbnail to its category? =

By default, thumbs link to the posts they represent. Put a check in this box to make thumbnails link to the category their post belongs to.

= Default image =

Set a thumbnail to display when a post lacks images. Specify the full URL or a location relative to the WordPress root directory. For example, `http://journalxtra.com/image.jpg` or `/wp-content/uploads/image.jpg`, respectively.

= Category =

Displays a drop down box of all categories that have been used to tag posts. If there are no posts assigned to a category, the category will not show in the dropdown box.

Use the dropdown box to select to grab posts from either `All Categories` or from a single parent category or a single child/grandchild category.

This option overrules the comma separated category list and the "category of viewed posts" option.

Set to "All Categories" to re-enable the comma separated list and the "category of viewed posts" option.

= Get posts from current category: =

Each post is assigned one or more categories. When a visitor views a post you can select to display thumbnails that are assigned to the same category/categories as the post being viewed. When this option is selected, the home page still displays thumbnails from all categories.

This option overrides any comma separated category list settings specified in `Categories`.

= Categories =

Optionally specify a comma separated list of post category IDs that images should be selected from.

A future version of this plugin will display a list of category titles and their ID's or maybe it'll feature a multiple selection box. I'll keep you guessing.

= Show Category Title =

Check this option to display the category title that assigned to the posts the thumbs have been taken from.

The title shows above the thumb gallery in the widget i.e not above each thumbnail.

The title shows under the following circumstances:

1. When a single category is selected with the dropdwn box.
2. When `Get posts with the same category as the viewed post?` is selected.
3. When a single category ID is listed in the `Categories` text box.

The title does not show when thumbs are selected from all categories or from multiple categories.

The Title does not show when thumbs are selected randomly yet all thumbs are randomly selected from the same category.

= Link category title to category page? =

Put a tick in this box when you want the optional title above the thumb gallery to link to the category it represents.

= Select Category Title Style =

Choose the typography of the title font. Use either h1, h2, h3, h4, h5, h6, p or strong.

The title can be further styled with CSS using the `.dv-advanced-random-image-title`class.

== Contact ==

[Support](http://wpservicemasters.com/plugins/advanced-random-post-thumbnails-widget/)

== Supported Languages ==

* English

== Changelog ==

= 1.4 =

* Added option to link the category title to the category it represents.

* Added option to link each thumb to its post's category instead of to the post to which it belongs.

= 1.3 =

* Added category drop-down menu for selecting either All Categories or a single parent category or a single child/grandchild category.

* Added option to display the category title atop of the block of thumbs when the displayed thumbs all belong to the same category.

* Added a drop-down box for font typography selection for the category title - header (h1-h6), paragraph and strong.

= 1.2 =

* Fixed error with WordPress repository upload (hopefully)

= 1.1 =

* Added the option to set the images to display as either rows or columns (in HTML speak, inline or block)
* Added a 3-column, 1 row tabled image layout (can display up to 20 images at a time).
* Added left and right side buffer spaces.

= 1.0 =

* First release.
* Based on the Advanced Random Post Widget by Yakup GÖVLER. Thank you Yakup for writing the original script.
* Changes to the original script include:
* Removed the ability to display the title and excerpt from the post a thumbnail is generated from,
* Changed post display type from an unordered list (ul) to regular divs (div),
* Added the option to specify thumbnail margins,
* Added class names to generated thumbnails and their container div. See FAQ for class details,
* Modified various class and function names to permit both this widget and the Advanced Random Posts Widget to  be installed into the same site simultaneously without conflict,
* Made minor changes to the widget's language,
* Made various other changes that I can't recall.

== Upgrade Notice ==

= 1.4 =

New hyperlinking options: thumb to category instead of post; and gallery title to category (had no precedent).

= 1.3 =

* New configuration options added. Added support for displaying category title above the thumb gallery.