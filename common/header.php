<?php
/*
 * Default header file to be used on all pages by the front.
 */
if (!isset($headerClass)) {
    $headerClass = 'second'; # A default class needed for the CSS. Artifact of migration.
}
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
$styleList = array('styles');
if (isset($styles)) { # Allow extending styles from the header call.
    $styleList = array_merge($styleList, $styles);
}
queue_css($styleList);
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
                <div id="logo" class="<?php echo $headerClass; ?>">
                     <a href="<?php echo uri(''); ?>">
                        <img alt="The Global Health Chronicles" src="<?php echo img('logo_main.gif'); ?>">
                    </a>
                </div>
                <span class="links">
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
        <table class="navBar" cellspacing="0" cellpadding="0" border="0" width="948">
            <tbody>
                <tr valign="middle">
                    <td class="chronicle">
                        <?php echo $navbarTitle; ?>
                    </td>

                    <td class="link "><a href="<?php echo uri('about'); ?>">About This Site</a></td>
                    <td class="divider">|</td>
                    <td class="link "><a href="<?php echo uri('links'); ?>">Related Resources</a></td>
                    <td class="divider">|</td>
                    <td class="link "><?php echo link_to_advanced_search(); ?></td>

                </tr>
            </tbody>
        </table>
        <div class="breadcrumb">
            :: <a href="<?php echo uri(''); ?>">Home</a>
            <?php if (isset($breadCrumbs)): ?>
                <?php foreach ($breadCrumbs as $item): ?>
            &raquo; <a href="<?php echo $item['link']; ?>"><?php echo $item['text']; ?></a>
                <?php endforeach ?>
            <?php endif ?>

        </div>
    <div class="mainContent"> <!-- Closed in footer File -->