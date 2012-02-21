<?php
/*
 * Header file formatted for single item display similar to the original site.
 * header_home.php was created and used instead to support use of dynamic
 * featured items.
 * 
 */
if (!isset($headerClass)) {
    $headerClass = 'second'; # Some stuff needed to port the theme
}

$featuredItem = featured_image();
?>

<!doctype html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title><?php echo settings('site_title'); echo $title ? ' | ' . $title : ''; ?></title>

  <meta name="viewport" content="width=device-width,initial-scale=1">

  <meta name="description" content="<?php echo settings('description'); ?>" />
  <meta name="author" content="<?php echo settings('author'); ?>" />

<?php echo auto_discovery_link_tag(); ?>

<!-- Plugin Stuff -->
<?php plugin_header(); ?>

<!-- Stylesheets -->
<?php
queue_css(array('styles'));
display_css();
?>

<!-- JavaScripts -->
<?php display_js(); ?>
<script type="text/javascript">
    //<![CDATA[
function clearText(f){if (f.defaultValue==f.value) f.value = ""}    //]]>
</script>

</head>

<body class="twoColFixRt">
    <div id="container">
        <div id="header" class="<?php echo $headerClass; ?>">
            <div id="top" class="<?php echo $headerClass; ?>">
                <span class="links">
                <a href="<?php echo uri('about'); ?>">About This Site</a>
                |
                <a href="<?php uri('links'); ?>">Related Resources</a>
                </span>
            </div>
  
         
            <div id="logo" class="<?php echo $headerClass; ?>">
                <img alt="The Global Health Chronicles" src="<?php echo img('logo_home.gif'); ?>">
                <div id="nav-home">
                    <form action="<?php echo uri('items/browse'); ?>" method="get" name="search">
                    <select onchange="window.location.href=this.options[this.selectedIndex].value">
                        <option selected="selected" value="#">Choose a Chronicle</option>
                        <option value="<?php echo uri('collections/show/1'); ?>"> Smallpox Eradication</option>
                        <option value="<?php echo uri('collections/show/2'); ?>"> Guinea Worm</option>
                        <option value="<?php echo uri('collections/show/3'); ?>"> Malaria</option>
                    </select>
                   <input id="search" class="search" type="text" onfocus="clearText(this);clearStyle(this);" value="Search All Chronicles" name="search">
                    </form>
                </div>
            </div>

            <?php if ($headerClass == 'home'): ?>
                <table cellspacing="0" cellpadding="0" border="0" width="567" height="403" style="background-image: url(<?php echo $featuredItem['uri']; ?>);">
                    <tbody>
                        <tr class="row-top">
                            <td class="clearspace">
                           </td>
                        </tr>
                        <tr>
                            <td class="caption">
                            <b><?php echo $featuredItem['Collection'] ?>:</b>
                            <?php echo $featuredItem['Description'] ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            <?php endif ?>
        </div>
        <div> <!-- Closed in footer File -->