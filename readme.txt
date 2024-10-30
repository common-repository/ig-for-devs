=== Instagram for Devs ===
Contributors: ryuheixys
Donate link: http://y-designs.com/
Tags: instagram, pictures, images, feed
Requires at least: 4.2.1
Tested up to: 4.2.2
Stable tag: 4.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Shortcode based plugin for Instagram. Let's you write your views (if you want). Caches instagram responses too.

== Description ==

There are tons of Instagram Plugins.  The issue is that we haven't really found one that lets the developer change the view/html directly.

Many of these plugins will do fine if you're a normal user, but if you want full control, then this is the plugin for you.  Its stupid simple and the idea is that it has no wizardary/magic/bloat built in.

In your current theme, create a directory called "/insta_view/" and put in a file called "view.php".  That's your view item.  You can do whatever you want with it.  A $pic array has the entire Instaham data set so you can display any relevant information about each picture.  If you want, you should just var_dump the $pic array to find out what's going on.

The plugin also does have object caching using transients so it doesn't slow you down much(its an option).

Much cred goes to: [Christian Metz](https://github.com/cosenary/Instagram-PHP-API) who made the actual PHP api behind this plugin.  Made things easy for me.!
More cred goes to: [Florian Beer](https://github.com/florianbeer/Instagram-PHP-API) who updated Christian's library for Insta's new API.

Check us out too: [Y-Designs, Inc](http://y-designs.com)

== Installation ==

1. Install from the plugin search.
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Go to the Instagram Settings Tab at the bottom of your menu
1. Get all the Instagram Keys and Secrets from [them](https://instagram.com/developer/register/)
1. Place `[yd_insta]` in your templates

== Frequently Asked Questions ==

= Why is it not working? =

I give no guarantees ;)

= Can you make it do X, Y and Z so its easy for me? =

No. You should be able to do it.  This plugin is really meant for developers who are actually making websites for their clients.  Obviously, if there are issues with the code or if you want file based caching instead of transients or something like that, I can do that.  I'm not going to make options for image width, etc.  This is for DEVS/DESIGNERS.


== Screenshots ==

It'll look different on everyone's screen ;)

== Changelog ==

= 0.2 =
* updated for the new api.

= 0.1 =
* initial release

== Upgrade Notice ==

= 0.1 =
* initial release