<?php
// $Id: page.tpl.php,v 1.11.2.2 2010/08/06 11:13:42 goba Exp $

/**
 * @file
 * Displays a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $css: An array of CSS files for the current page.
 * - $directory: The directory the theme is located in, e.g. themes/garland or
 *   themes/garland/minelli.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Page metadata:
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or
 *   'rtl'.
 * - $head_title: A modified version of the page title, for use in the TITLE
 *   element.
 * - $head: Markup for the HEAD element (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $body_classes: A set of CSS classes for the BODY tag. This contains flags
 *   indicating the current layout (multiple columns, single column), the
 *   current path, whether the user is logged in, and so on.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled in
 *   theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 * - $mission: The text of the site mission, empty when display has been
 *   disabled in theme settings.
 *
 * Navigation:
 * - $search_box: HTML to display the search box, empty if search has been
 *   disabled.
 * - $primary_links (array): An array containing primary navigation links for
 *   the site, if they have been configured.
 * - $secondary_links (array): An array containing secondary navigation links
 *   for the site, if they have been configured.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $left: The HTML for the left sidebar.
 * - $breadcrumb: The breadcrumb trail for the current page.
 * - $title: The page title, for use in the actual HTML content.
 * - $help: Dynamic help text, mostly for admin pages.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs: Tabs linking to any sub-pages beneath the current page (e.g., the
 *   view and edit tabs when displaying a node).
 * - $content: The main content of the current Drupal page.
 * - $right: The HTML for the right sidebar.
 * - $node: The node object, if there is an automatically-loaded node associated
 *   with the page, and the node ID is the second argument in the page's path
 *   (e.g. node/12345 and node/12345/revisions, but not comment/reply/12345).
 *
 * Footer/closing data:
 * - $feed_icons: A string of all feed icons for the current page.
 * - $footer_message: The footer message as defined in the admin settings.
 * - $footer : The footer region.
 * - $closure: Final closing markup from any modules that have altered the page.
 *   This variable should always be output last, after all other dynamic
 *   content.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 */
 global $base_url;
 global $user;
 include_once drupal_get_path('module', 'node').'/node.pages.inc';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">

<head>
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <?php print $styles; ?>
  <?php print $scripts; ?>
  <script type="text/javascript"><?php /* Needed to avoid Flash of Unstyled Content in IE */ ?> </script>
  	
  <!--[if lt IE 7]>
    <?php print phptemplate_get_ie_styles(); ?>
  <![endif]--> 
</head>

<body class="<?php print $body_classes; ?>">
  <div id="wrapper">
    <div id="page">
      <div id="header-wrapper">
        <div id="header">
          <div id="logo-title">

            <?php if (!empty($logo)): ?>
              <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
                <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
              </a>
            <?php endif; ?>

            <div id="name-and-slogan">
              <?php if (!empty($site_name)): ?>
                <h1 id="site-name">
                  <a href="<?php print $front_page ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
                </h1>
              <?php endif; ?>

              <?php if (!empty($site_slogan)): ?>
                <div id="site-slogan"><?php print $site_slogan; ?></div>
              <?php endif; ?>
            </div> <!-- /name-and-slogan -->
          </div> <!-- /logo-title -->

          <?php if (!empty($search_box)): ?>
            <div id="search-box"><?php print $search_box; ?></div>
          <?php endif; ?>

          <?php if (!empty($header)): ?>
            <div id="header-region">
              <?php print $header; ?>
            </div>
          <?php endif; ?>
          
          <div id="navigation" class="menu <?php if (!empty($primary_links)) { print "withprimary"; } if (!empty($secondary_links)) { print " withsecondary"; } ?> ">
            <?php if (!empty($secondary_links) && $logged_in): ?>
              <div id="secondary">
                <?php print theme('links', $secondary_links, array('class' => 'links secondary-links')); ?>
              </div>
            <?php endif; ?>
            <?php if (!empty($primary_links)): ?>
              <div id="primary" class="clear-block">
                <?php print theme('links', $primary_links, array('class' => 'links primary-links')); ?>
              </div>
            <?php endif; ?>
          </div> <!-- /navigation -->
        </div> <!-- /header-center -->
      </div> <!-- /header -->

      <div id="container-wrapper">
        <div id="container" class="clear-block">
          <div id="content-region">
            <?php if (!empty($left)): ?>
              <div id="sidebar-left" class="column sidebar">
                <?php print $left; ?>
              </div> <!-- /sidebar-left -->
            <?php endif; ?>

            <div id="center"><div id="squeeze">
                <?php //print $breadcrumb; ?>
                <?php if ($mission): print '<div id="mission">'. $mission .'</div>'; endif; ?>
                <?php if ($tabs): print '<div id="tabs-wrapper" class="clear-block">'; endif; ?>
                
                <?php if ($tabs): print '<ul class="tabs primary">'. $tabs .'</ul></div>'; endif; ?>
                <?php if ($tabs2): print '<ul class="tabs secondary">'. $tabs2 .'</ul>'; endif; ?>
                <?php if ($show_messages && $messages): print $messages; endif; ?>
                <?php print $help; ?>
                <div id="upload-design">
                <?php if($user->uid == arg(1)):                	 
                	//print node_add('design'); 
                endif; ?>
                </div>
                <div class="clear-block">
                  <?php print $content ?>
                </div>          
            </div></div> <!-- /#squeeze, /#center -->

            <?php if (!empty($right)): ?>
              <div id="sidebar-right" class="column sidebar">
                <?php print $right; ?>
              </div> <!-- /sidebar-right -->
            <?php endif; ?>
          </div>
        </div> <!-- /container -->
      </div> <!-- /container-wrapper -->

      <div id="footer-wrapper">
        <div id="footer">
          <?php print $footer_message; ?>
          <?php if (!empty($footer)): print $footer; endif; ?>
        </div> <!-- /footer -->
      </div> <!-- /footer-wrapper -->

      <?php print $closure; ?>

    </div> <!-- /page -->
  </div> <!-- /wrapper -->
</body>
</html>
