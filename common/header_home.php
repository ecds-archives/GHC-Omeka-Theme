<?php
/*
 * Header file to use for the front page.  Supports the layout for the summary
 * and header variations.
 */
if (!isset($headerClass)) {
    $headerClass = 'second'; # Some stuff needed to port the theme
}
?>

<!doctype html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title><?php echo settings('site_title');
echo $title ? ' | ' . $title : ''; ?></title>

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

            <div id="featured">
<?php $items = random_featured_items(2); ?>
                <?php foreach ($items as $item): ?>
                <?php set_current_item($item); ?>
                    <div class="featured-item">

<?php
                    if (item_has_thumbnail($item = $item)) {
                        echo link_to_item(item_square_thumbnail(array('alt' => item('Dublin Core', 'Title'), 'align'=>'left')));
                    }
?>
                        <div class="caption">
                            <h2><?php echo link_to_item(item('Dublin Core', 'Title')); ?></h2>
                            <p><?php echo item('Dublin Core', 'Description', array('snippet'=>150)); ?></p>
                            <p class="fromcollection">from: <?php echo link_to_collection_for_item(); ?></p>
                        </div>
                </div>
<?php endforeach; ?>
            </div>
        </div>
        <div> <!-- Closed in footer File -->