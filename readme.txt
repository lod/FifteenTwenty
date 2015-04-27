=== Twenty Fifteen ===
Contributors: the WordPress team & David Tulloh
Tags: black, blue, gray, pink, purple, white, yellow, dark, light, two-columns, left-sidebar, fixed-layout, responsive-layout, accessibility-ready, custom-background, custom-colors, custom-header, custom-menu, editor-style, featured-images, microformats, post-formats, rtl-language-support, sticky-post, threaded-comments, translation-ready
Requires at least: 4.1
Tested up to: 4.1
Stable tag: 4.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==
This is a technical demonstration of inverting the logic of the standard template strategy. The appearance, styling and generated html is the same as the WordPress default style Twenty Fifteen. This theme is designed as an example for theme authors. If you just want a theme to use, use Twenty Fifteen, it has considerably more support and testing.

WordPress themes consist of a collection of php template files. WordPress chooses a template based on the type of content being requested, this allows a different template to be used for search results or an audio attachment. The decision is made using the template hierarchy depicted below. WordPress proceeds from left to right until it finds a file which matches the desired pattern, on the far right index.php acts as a catch all for any file types not specially handled.

The advantage of this structure is that it allows for a huge degree of flexibility in the styling. Any content can have a complete different set of styling provided to it and the hierarchy allows for very specific specialty pages to be created.

The disadvantage is that every template requires a duplication of the site structure. Changes such as reordering the HTML structure require the reworking of every single template file, this was exactly the problem I faced when working on this blog's template Piano Black.

In practice I feel the theme hierarchy structure is a poor design choice as you want to retain the same look a feel across the entire site. This means that the layout is consistent and the variations are typically isolated to the central content pane. Theme authors attempt to reduce the amount of duplication by using a header and footer file which is pulled into each template, this helps to reduce work for minor changes but doesn’t aid in more structural alterations.

The alternative structure is to have a single template file which sets the structure of the website. This file then pulls in partial templates based on the content being requested. The partial templates provide a reduced level of flexibility to the full template model but are simpler as they do not need to include as much of the site’s structure. The Twenty Fifteen theme actually uses both full and partial templates, the partial templates are used for different categories of posts.

I do not mean this as an attack or criticism of the WordPress team, the choice was a trade off and they chose the more flexible approach leading to a product far more successful than any I have ever produced. This choice was also made for the initial release in 2003, a different online environment with alternative aesthetic (MySpace) and less use of javascript. They have made a fantastic product and the flexibility built through it allows for novel uses, like mine.

By removing all the custom template files WordPress will always use index.php as a template. As the template is a full php file it can examine the requested content type and pull in the required partial template. This technique uses the WordPress partial include function to retain the ability for sub-themes to customize specific partials.

To demonstrate this technique I chose to rework the Twenty Fifteen theme as it is designed as a basis for theme authors to work from, which is also my goal. I took each of the template files and pushed the common elements up to index.php converting them into a partial. The includes designed to reduce duplication such as header.php, footer.php and sidebar.php were also pushed into index.php. I then set up a demo site using the wptest.io test data and used wget –mirror, HTML tidy, a tiny bit of sed and diff to beat the last bugs out and ensure that the final result was unchanged from the initial Twenty Fifteen model.

* [Demo site](http://fifteentwenty.tulloh.id.au/)
* [Source code](https://github.com/lod/FifteenTwenty)
* [Release announcement](http://david.tulloh.id.au/fifteen-twenty/)

== Installation ==

1. In your admin panel, go to Appearance -> Themes and click the Add New button.
2. Click Upload and Choose File, then select the theme's ZIP file. Click Install Now.
3. Click Activate to use your new theme right away.

== Frequently Asked Questions ==

= How do I do user theme things? =

This theme is very very strongly based off WordPress's official Twenty Fifteen theme. If you want a theme to use on your blog, I strongly recommend you use Twenty Fifteen in preference to this theme.

That said, all the functionality of Twenty Fifteen should work and be present. Feel free to read the Twenty Fifteen documentation for assistance.

= How did you perform testing? =

Significant effort was taken to ensure that this theme faithfully represented the Twenty Fifteen base. This ensured that the theme was a good basis for further work but more importantly highlighted bugs and regressions in the work.

This documents the test process used:

1. WordPress test instance was created on http://fifteentwenty.tulloh.id.au/.

2. Server was patched to fix https://core.trac.wordpress.org/ticket/23408

3. Theme test data from http://wptest.io was installed.

4. Post 1031 (Tiled Gallery) to changed random gallery order to ID order.

5. TwentyFifteen (svn head, r32247, 2015-04-24) theme was installed on server.

6. Golden webpage set created using `wget --mirror`

7. 404 page added using curl on index.html?p=666

8. Golden set converted to control set as comparison basis. HTML tidy was run to hide trivial layout and whitespace issues, sed was also applied sparsely to updated strings which are expected to change.

    find . -maxdepth 1 -type f -print0 | xargs -0 -I'{}' sh -c "tidy --new-blocklevel-tags header,section,aside,article,footer,time,figure,main,figcaption,nav,rss,channel,description,language,item,comments,pubdate,dc:creator,category,lastbuilddate,sy:updateperiod,sy:updatefrequency,atom:link,generator,guid,content:encoded,wfw:commentrss,slash:comments,guid,content:encoded,enclosure,rsd,service,enginename,enginelink,homepagelink,apis,api --show-warnings no -indent '{}' | sed 's/twentyfifteen/fifteentwenty/g;s/section/div/' > ../control/'{}'" ^| grep errors | grep -v " 0 errors"

9. FifteenTwenty theme was installed on the server and enabled.

10. Full webpage set was retrieved, including 404 page using wget and curl.

11. Comparison set was created, similar to the process used in step 8.

    find . -maxdepth 1 -type f -print0 | xargs -0 -I'{}' sh -c "tidy --new-blocklevel-tags header,section,aside,article,footer,time,figure,main,figcaption,nav,rss,channel,description,language,item,comments,pubdate,dc:creator,category,lastbuilddate,sy:updateperiod,sy:updatefrequency,atom:link,generator,guid,content:encoded,wfw:commentrss,slash:comments,guid,content:encoded,enclosure,rsd,service,enginename,enginelink,homepagelink,apis,api --show-warnings no -indent '{}'  > ../victim/'{}'" ^| grep errors | grep -v " 0 errors"

12. Comparison performed using `diff -q -r victim/ control/`.
Variations are inspected further by hand. There are some allowed changes such as the comments in style.css vary. A good comparison has non-functional changes to index.html?p=666 and style.css.
