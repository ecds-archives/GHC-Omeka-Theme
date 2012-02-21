<?php 
/*
 * collections/show.php
 * 
 * Used to show details about a specific collection.  It also shows a list of
 * item types with one or more items assigned to them.
 */
head(array('title'=>collection('Name').' Collection', 'navbarTitle'=>'The '.collection('Name').' Chronicle'));
?>
<div id="sidebar">
    <div id="featureContentType" class="<?php echo preg_replace( '/\s+/', '', strtolower(collection('Name'))); ?>">
    <?php $item_type_id_list = get_collection_item_typeids(collection('Id')); ?>

    <?php foreach ($item_type_id_list as $result): ?>
        <?php
            $queryParams = array('type'=>$result['item_type_id'], 'collection'=>collection('Id'));
            $typeClass = preg_replace( '/\s+/', '', strtolower($result['name']));
        ?>
            <a href="<?php echo uri('items/browse', $queryParams=$queryParams)?>" class="typelink">
                <div class="typelinkblock <?php echo preg_replace( '/\s+/', '', strtolower($result['name'])); ?>">
                  &nbsp;
                </div><?php echo $result['name']; ?>
            </a>
    <?php endforeach; ?>
    </div>
</div>

<h1><?php echo collection('Name'); ?> Chronicle</h1>

<?php echo html_entity_decode(collection('Description')); ?>


<?php foot(); ?>
