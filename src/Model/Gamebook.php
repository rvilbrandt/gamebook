<?php
/**
 * @author Ronald Vilbrandt <info@rvi-media.de>
 * @copyright 2016 RVI-Media, www.rvi-media.de
 * @since 2016-04-26 
 */

namespace rvilbrandt\gamebook\Model;

class Gamebook extends \rvilbrandt\gamebook\Model\Object {
    
    public $title = null;
    public $author = null;
    public $version = null;
    public $scenes = [];
    public $items = [];
    
    protected $arrSceneList = [];
    protected $arrItemList = [];
    
    protected $arrRequiredAttributes = [
        "title",
        "author",
        "scenes",
        "startScene",
    ];
    
    /**
     * Fetch scene by ID
     * 
     * @param string $strSceneId Scene-ID
     * @return Scene Scene;
     */
    public function fetchScene($strSceneId) {
        return true === isset($this->arrSceneList[$strSceneId]) ? $this->arrSceneList[$strSceneId] : null;
    }
    
    /**
     * Fetch item by ID
     * 
     * @param string $strItemId Item-ID
     * @return Inventory\Item Item;
     */
    public function fetchItem($strItemId) {
        return true === isset($this->arrItemList[$strItemId]) ? $this->arrItemList[$strItemId] : null;
    }
    
    public function setFromObject($object) {
        
        $this->validate($object);
        
        foreach ($object as $strName => $mixedValue) {
            
            switch ($strName) {
                
                case "scenes":
                    
                    foreach ($mixedValue as $sceneJson) {
                        $scene = new Gamebook\Scene($sceneJson);
                        $this->scenes[] = $scene;
                        $this->arrSceneList[$sceneJson->id] = $scene;
                    }
                    
                    break;   
                
                case "items":
                    
                    foreach ($mixedValue as $itemJson) {
                        $item = new Inventory\Item($itemJson);
                        $this->items[] = $item;
                        $this->arrItemList[$itemJson->id] = $item;
                    }
                    
                    break;              
                
                default:
                    $this->$strName = $mixedValue;
                
            }
            
            
        }
        
    }
    
}