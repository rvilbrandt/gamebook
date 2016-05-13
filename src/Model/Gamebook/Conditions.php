<?php
/**
 * @author Ronald Vilbrandt <info@rvi-media.de>
 * @copyright 2016 RVI-Media, www.rvi-media.de
 * @since 2016-04-26 
 */

namespace rvilbrandt\gamebook\Model\Gamebook;

class Conditions extends \rvilbrandt\gamebook\Model\Object {
    
    public $states = null;
    public $inventory = null;
    
    public function __construct($object = null) {
        
        $this->states = new Condition\States();
        $this->inventory = new Condition\Inventory();
        
        parent::__construct($object);
    }
    
    public function setFromObject($object) {
        
        $this->validate($object);
        
        foreach ($object as $strName => $mixedValue) {
            
            switch ($strName) {
                
                case "states":
                    $this->states = new Condition\States($mixedValue);
                    break;    
                
                case "inventory":
                    $this->inventory = new Condition\Inventory($mixedValue);
                    break;             
                
            }
            
            
        }
        
    }
    
}