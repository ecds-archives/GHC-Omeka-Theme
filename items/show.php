<?php
/*
 * Shows details about individual items.
 */

$Collection = get_collection_for_item(); # Get collection for breadcrumbs and nav bar title..
$breadCrumbs = array(); # Init breadcrumbs as empty by default.
$navbarTitle = 'The Global Health Chronicles'; # Default navbartitle
$Type = get_item_type_by_name(item('item type name')); # Custom function to get type info.

# Build collection breadcrumb and navbar title information.
if (isset($Collection)) {
    $breadCrumbs[] = array('text' => $Collection->name . ' Chronicles',
        'link' => uri('collections/show/' . $Collection->id));
    $navbarTitle = 'The ' . $Collection->name . ' Chronicles';
}

# Build type breadcrumb information.
if (isset($Type)) { 
    $typeLinkParams = array('type' => $Type->id);
    if (isset($Collection)) {
        $typeLinkParams['collection'] = $Collection->id;
    }
    $typeLink = uri('items/browse', $queryParams = $typeLinkParams);
    $breadCrumbs[] = array('text' => $Type->name,
        'link' => $typeLink);
}

# Atrributes to set for the file link display below.
$file_link_options = array();

# Pass attributes to be rendered in the header.
head(array('title' => item('Dublin Core', 'Title'), 'breadCrumbs' => $breadCrumbs, 'navbarTitle' => $navbarTitle));
?>

<div id="primary" xmlns:dc="http://purl.org/dc/elements/1.1/">

    <h1 property="dc:title"><?php echo item('Dublin Core', 'Title'); ?></h1>


    <!-- The following returns all of the files associated with an item. -->
    <div id="filesidebar">
        <div id="itemfiles" class="element">
            <h3>Files</h3>
            <div class="element-text"><?php echo display_files_for_item($options=$file_link_options); ?></div>
        </div>
    </div>

    <?php $date = item('Dublin Core', 'Date'); ?>
    <?php if (isset($date)): ?>
        <div id="date" class="element">
            <div class="element-text" property="dc:date"><?php echo $date; ?></div>
        </div>
    <?php endif ?>

    <?php $creators = item('Dublin Core', 'Creator', 'all'); ?>
    <?php if (isset($creators)): ?>
            <div id="creators" class="element">
        <?php foreach ($creators as $creator): ?>
                <div class="element-text" property="dc:creator"><?php echo $creator; ?></div>
        <?php endforeach ?>
            </div>
    <?php endif ?>

    <?php $description = item('Dublin Core', 'Description'); ?>
    <?php if (isset($description)): ?>
                    <div id="description" class="element">
                        <div class="element-text" property="dc:description"><?php echo $description; ?></div>
                    </div>
    <?php endif ?>
        <div id="item-rights" class="element">
          <h3>Rights & Use Statement</h3>
              <div class="element-text" property="dc:rights">
                  Information regarding the reproduction and use of this resource may be obtained by contacting the Centers for Disease Control and Prevention, Office of the General Counsel, 1600 Clifton Road N.E., Mailstop D-53, Atlanta, GA 30329, USA. Phone: 404-639-7200. Fax: 404-639-7351 
              </div>
        </div>

                    <div id="item-citation" class="element">
                        <h3>Citation</h3>
                        <div class="element-text"><?php echo item_citation(); ?></div>
                    </div>

    <?php $xscript = item('Item Type Metadata', 'Transcription'); ?>
    <?php if (isset($xscript)): ?>
                            <br class="clearfloat" />
                            <div id="transcription" class="element">
                                <div class="element-text"><?php echo $xscript; ?></div>
                            </div>
    <?php endif ?>


    <?php echo plugin_append_to_items_show(); ?>

                            <ul class="item-pagination navigation">
                                <li id="previous-item" class="previous"><?php echo link_to_previous_item('Previous Item'); ?></li>
                                <li id="next-item" class="next"><?php echo link_to_next_item('Next Item'); ?></li>
                            </ul>

                        </div><!-- end primary -->

<?php foot(); ?>