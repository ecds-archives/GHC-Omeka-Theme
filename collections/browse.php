<?php head(array('title' => 'Browse Chronicles', 'bodyid' => 'collections', 'bodyclass' => 'browse')); ?>
    <h1>Chronicles</h1>
    <p>
    <div class="pagination"><?php echo pagination_links(); ?></div>
    <?php while (loop_collections ()): ?>
        <div class="collection">
            <div class="title"><?php echo link_to_collection(); ?></div>
            <div class="description">
            <?php echo strip_tags(collection('Description', array('snippet' => 250))); ?>
        </div>

        <?php if (collection_has_collectors ()): ?>
                <strong>Collector(s)</strong>
                <p><?php echo collection('Collectors', array('delimiter' => ', ')); ?></p>
        <?php endif; ?>

        <?php echo plugin_append_to_collections_browse_each(); ?>

            </div><!-- end class="collection" -->
    <?php endwhile; ?>
    </p>
    <?php echo plugin_append_to_collections_browse(); ?>
    
<?php foot(); ?>