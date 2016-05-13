<?php
/**
 * @author Ronald Vilbrandt <info@rvi-media.de>
 * @copyright 2016 RVI-Media, www.rvi-media.de
 * @since 2016-04-26 
 */

namespace rvilbrandt\gamebook\Model\Inventory;

class Item extends \rvilbrandt\gamebook\Model\Object {
    
    public $id = null;
    public $name = null;
    public $description = null;
    
    protected $arrRequiredAttributes = [
        "id", 
        "name",
        "description"
    ];
    
}