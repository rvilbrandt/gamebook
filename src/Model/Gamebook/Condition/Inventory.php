<?php
/**
 * @author Ronald Vilbrandt <info@rvi-media.de>
 * @copyright 2016 RVI-Media, www.rvi-media.de
 * @since 2016-04-26 
 */

namespace rvilbrandt\gamebook\Model\Gamebook\Condition;

class Inventory extends Condition {
    
    public $has = [];
    public $hasNot = [];
    
    public function setFromObject($object) {
        
        $this->validate($object);
        
        foreach ($object as $strName => $mixedValue) {
            
            switch ($strName) {
                
                case "has":
                    
                    foreach ($mixedValue as $strItemName => $mixedItemValue) {
                        $this->has[$strItemName] = $mixedItemValue;
                    }
                    break;    
                
                case "hasNot":
                    
                    foreach ($mixedValue as $strItemName => $mixedItemValue) {
                        $this->hasNot[$strItemName] = $mixedItemValue;
                    }
                    break; 
                    
                default:
                    $this->$strName = $mixedValue;
                
            }
            
            
        }
        
    }
    
}