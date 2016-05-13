<?php
/**
 * @author Ronald Vilbrandt <info@rvi-media.de>
 * @copyright 2016 RVI-Media, www.rvi-media.de
 * @since 2016-04-26 
 */

namespace rvilbrandt\gamebook\Model\Gamebook\Scene;

use rvilbrandt\gamebook\Model\Gamebook\Conditions;

class Content extends \rvilbrandt\gamebook\Model\Object {
    
    public $text = null;
    
    /** @var Conditions */
    public $conditions = null;
    
    protected $arrRequiredAttributes = [
        "text",
    ];
    
    public function __construct($arrData = null) {
        
        $this->conditions = new Conditions();
        
        parent::__construct($arrData);
    }
    
    public function setFromObject($object) {
        
        $this->validate($object);
        
        foreach ($object as $strName => $mixedValue) {
            
            switch ($strName) {
                
                case "conditions":
                    $this->conditions = new Conditions($mixedValue);
                    break;                
                
                default:
                    $this->$strName = $mixedValue;
                
            }
            
            
        }
        
    }
    
}