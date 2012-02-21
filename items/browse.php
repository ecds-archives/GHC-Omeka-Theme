<?php
    /*
     * items/browse.php
     *
     * Used for displaying lists of individual items.
     */

    # Santize collection and type get variables if present for use later.
    $collID = filter_input(INPUT_GET, 'collection', FILTER_SANITIZE_NUMBER_INT);
    $typeID = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_NUMBER_INT);

    $styles = array('listicons'); # Set additional stylesheets to use for this page.

    # Bring in additional collection and type information since GHC item
    # displays are based on that.
    if (isset($collID)) {
        set_current_collection(get_collection_by_id($collID));
    }
    if (isset($typeID)) {
        $table = get_db()->getTable('ItemType');
        $itemType = $table->find($id=$typeID);
        if ($typeID == 6) { # If photographs add thumbnail gallery styles.
            array_push($styles, 'photobrowse'); 
        }
    }
   
    # Set the navbarTitle for the display
    $navbarTitle = 'The Global Health Chronicles';

    # Create Collection breadcrumb if collection specified.
    $breadCrumbs = array();
    if (isset($collID)) {
        $breadCrumbs[] = array('text'=>collection('Name').' Chronicles',
            'link'=>uri('collections/show/'.collection('Id')));
        $navbarTitle = 'The '.collection('Name').' Chronicle';
    }


    head(array('title'=>'Browse Items','breadCrumbs'=>$breadCrumbs, 'navbarTitle'=>$navbarTitle,'styles'=>$styles));
?>
<div id="browsetype">
<div class="pagination">
    <h1>You are browsing:
    <?php
        # Try to determine collection requested and create user feedback.
        if (isset($collID)) {
            echo ' '.collection('Name').' ';
        } else {
            echo ' All ';
        }

        $typeLabel = 'Items'; # By default use the generic Items as a type label.

        # Get the type information if specified.
        if (isset($typeID)) {
            $typeLabel = $itemType->name;
        }
        echo $typeLabel;

     ?></h1>

    <?php echo total_results(); ?> records found
    <?php echo pagination_links(array('scrolling_style'=>'Sliding')); ?>
</div>

<?php if ($typeID == 6): ?>
    <div class="gallery">
    <?php while (loop_items()): ?>

            <div class='thumbnail-wrapper'>
                <a href="<?php echo item_uri(); ?>">
                  <?php if (item_has_thumbnail()) {
                            echo item_square_thumbnail(array('alt'=>item('Dublin Core', 'Title')));
                        } ?>
                <div class='thumbnail-description'>
                    <p class='thumbnail-description_content'><?php echo item('Dublin Core', 'Title'); ?></p>
                </div>
                </a>
            </div>

    <?php endwhile; ?>
    </div>

<?php else: ?>
    <table class="record_list">
        <tbody>
            <tr>
                <th class="thumbnail"></th>
                <th class="title">ITEM</th>
                <th class="date">DATE</th>
            </tr>

    <?php while (loop_items()): ?>
            <tr valign="top">
                <td>
                    <div class="thumbnail <?php echo mimetype_classnames(get_current_item()); ?>">
                        <?php if (item_has_thumbnail()) {
                            echo link_to_item(item_thumbnail(array('alt'=>item('Dublin Core', 'Title'))));
                        } ?>
                     </div>
                </td>
                <td class="title">
                    <?php echo link_to_item(item('Dublin Core', 'Title')); ?>
                    <div class="description"><?php echo item('Dublin Core', 'Description', array('snippet'=>140)); ?></div>
                </td>
                <td>
                        <?php echo item('Dublin Core', 'Date'); ?>
                </td>
            </tr>
    <?php endwhile; ?>
        </tbody>
    </table>
<?php endif; ?>
    <?php echo pagination_links(); ?>
</div>
<?php foot(); ?>