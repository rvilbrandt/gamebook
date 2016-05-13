<?php
/**
 * @author Ronald Vilbrandt <info@rvi-media.de>
 * @copyright 2016 RVI-Media, www.rvi-media.de
 * @since 2016-04-26 
 */

namespace rvilbrandt\gamebook\Model\Gamebook\Condition;

class States extends Condition {
    
    public $eq = [];
    public $gt = [];
    public $lt = [];
    public $ne = [];
    
    public function setFromObject($object) {
        
        $this->validate($object);
        
        foreach ($object as $strName => $mixedValue) {
            
            switch ($strName) {
                
                case "eq":
                    
                    foreach ($mixedValue as $strStateName => $mixedStateValue) {
                        $this->eq[$strStateName] = $mixedStateValue;
                    }
                    break;    
                
                case "gt":
                    
                    foreach ($mixedValue as $strStateName => $mixedStateValue) {
                        $this->gt[$strStateName] = $mixedStateValue;
                    }
                    break; 
                
                case "lt":
                    
                    foreach ($mixedValue as $strStateName => $mixedStateValue) {
                        $this->lt[$strStateName] = $mixedStateValue;
                    }
                    break; 
                
                case "ne":
                    
                    foreach ($mixedValue as $strStateName => $mixedStateValue) {
                        $this->ne[$strStateName] = $mixedStateValue;
                    }
                    break;
                    
                default:
                    $this->$strName = $mixedValue;
                
            }
            
            
        }
        
    }
    
}