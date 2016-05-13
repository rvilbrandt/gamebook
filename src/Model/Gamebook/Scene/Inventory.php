<?php
/**
 * @author Ronald Vilbrandt <info@rvi-media.de>
 * @copyright 2016 RVI-Media, www.rvi-media.de
 * @since 2016-04-29 
 */

namespace rvilbrandt\gamebook\Model\Gamebook\Scene;

class Inventory extends \rvilbrandt\gamebook\Model\Object {
    
    public $add = [];
    public $remove = [];
    
    public function setFromObject($object) {
        
        $this->validate($object);
        
        foreach ($object as $strName => $mixedValue) {
            
            switch ($strName) {
                
                case "add":
                    
                    foreach ($mixedValue as $strItemName) {
                        $this->add[] = $strItemName;
                    }
                    break;    
                
                case "remove":
                    
                    foreach ($mixedValue as $strItemName) {
                        $this->remove[] = $strItemName;
                    }
                    break;             
                
            }
            
            
        }
        
    }
    
}