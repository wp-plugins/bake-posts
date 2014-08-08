=== Bake Posts ===
Contributors: wpnaga
Donate link: 
Tags: recent post, category post,tag post,slug,id,post limit,content,excerpt
Requires at least: 3.0.1
Tested up to: 3.9
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Bake Post can be used to display recent posts and posts from particular category and tags.

== Description ==

Bake post is developed in order to display posts in pages or in widget areas just by pasting the respective shortcodes. Individual shortcodes are available for displaying recent posts, posts on categories and tags. 

Shortcodes for displaying Recent Posts are

1.[bake-post-recent limit=5 excerpt="no"]

2.[bake-post-recent limit=5 excerpt="yes"]

These two short codes can be used to display recent posts. Excerpt option can be used to display description as excerpt or full content.

Shortcodes for displaying Posts on category are

3.[bake-post-category term='slug' category='all' limit=5 excerpt="no"]

4.[bake-post-category term='slug' category='all,stories' limit=5 excerpt="yes"]

5.[bake-post-category term='id' category='1' limit=5 excerpt="yes"]

6.[bake-post-category term='id' category='1,2,3' limit=5 excerpt="no"]

Term values differs from "id" or "slug". If Slug is used, category value should be category slug values. For example, if your category name is short stories, Slug will be short-stories. We can use multiple slug values seperated by commas. If id is used, category value should be category id values. For example, We can use multiple id values seperated by commas.

Shortcodes for displaying Posts on Tags are

7.[bake-post-tags term='slug' tag='tag1' limit=5 excerpt="yes"]

8.[bake-post-tags term='id' tag_id='1,2,3' limit=5 excerpt="no"]


== Installation ==

1.Upload the bake-post directory to the /wp-content/plugins/ Directory (if not exists please create) or install using wordpress plugin installer

2.Activate the plugin through the 'Plugins' menu in WordPress


== Frequently Asked Questions ==

= Is it possible to use two shortcodes in a single page? =

Yes. You can use any number of shortcodes.

= Where can I use these shortcodes? =

You can use in your page,post and widget areas.

== Screenshots ==

No Screen shots.

== Changelog ==

= 1.0 =
* This is the first version.
* Recent posts and posts from category and tags are displayed.
