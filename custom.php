<?php
/*
 * Contains all custom functions used in the theme.
 */

function get_collection_item_typeids($collectionID) {
    # Returns an array of unique item type ids from items in a specific collection.
    $itemTableName = get_db()->getTable('Item')->getTableName();
    $typeTableName = get_db()->getTable('ItemType')->getTableName();
    $select= get_db()->select()
                     ->distinct()
                     ->from(array('i'=>$itemTableName), array('i.item_type_id'))
                     ->where('i.collection_id = ?', $collectionID)
                     ->join(array('t'=>$typeTableName), 'i.item_type_id = t.id', array('t.name'));
                     
    $result = get_db()->query($select)->fetchAll();
    return $result;
}

function get_item_type($itemTypeID) {
        $itemType = get_db()->getTable('ItemType')->find($id =$itemTypeID);
        return $itemType;
}

function get_item_type_by_name($typeName) {
    try {
        $itemType = get_db()->getTable('ItemType')->findByName($typeName);
        return $itemType;
    } catch (Exception $e) {
        return NULL;
    }
}

function get_dc_element($item, $name) {
    return $item('Dublin Core', $name, 'all');
}

function slugify($text, $nl_rpl='-', $uw_rpl='') {
    # Can be use to slugify any text.  I'm using it to create css class names
    # for mediatype list thumbnails.
    
    // replace non letter or digits by -
    $text = preg_replace('~[^\\pL\d]+~u', $nl_rpl, $text);

    // trim
    $text = trim($text, '-');

    // transliterate
    if (function_exists('iconv'))
    {
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    }

    // lowercase
    $text = strtolower($text);

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', $uw_rpl, $text);

    if (empty($text))
    {
        return '';
    }

    return $text;
}

function mimetype_classnames($item) {
    # Returns a list of slugified mimetypes as class names for styling.
    $styles = array();
    while (loop_files_for_item($item)) {
        $styles[] = slugify(item_file('MIME Type'));
    }

    if (count($styles)){
        return implode(" .", array_reverse($styles)); # first file should override style.
    }
    return ''; # Return a blank string by default.
}

function featured_image() {
    # Returns information use for the featured image on the front page.
    $featuredItem = random_featured_item();
    $result = array( # Sets a default return if no featured images found.
        'uri'=>img('JimLewisVaxTeam.jpg', $dir='images/homepage_random'),
        'Collection'=>'Smallpox Eradication',
        'Description'=>'Local vaccinator demonstrating on CDC Operations officer',
        );
    if ($featuredItem) {
        set_current_item($featuredItem);
        $result['Description'] = item('Dublin Core', 'Title');
        if ($Collection = get_collection_for_item()) {
            $result['Collection'] = $Collection->name;
        }
        $imageFile = get_db()->getTable('File')->findWithImages(item('ID'), 0);
        $result['uri'] = uri('archive/files/'. $imageFile->getDerivativeFilename());
    }
    return $result;
}
?>
