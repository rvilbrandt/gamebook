<?php
/**
 * @author Ronald Vilbrandt <info@rvi-media.de>
 * @copyright 2016 RVI-Media, www.rvi-media.de
 * @since 2016-04-26 
 */

namespace rvilbrandt\gamebook\Model\Gamebook;

class Scene extends \rvilbrandt\gamebook\Model\Object {
    
    public $id = null;
    public $contents = [];
    public $options = [];
    
    /** @var Scene\Inventory */
    public $inventory = null;
    
    /** @var Scene\States */
    public $states = null;
    
    protected $arrRequiredAttributes = [
        "id",
        "contents"
    ];
    
    public function __construct($object = null) {
        
        $this->inventory = new Scene\Inventory();
        $this->states = new Scene\States();
        
        parent::__construct($object);
    }
    
    public function setFromObject($object) {
        
        $this->validate($object);
        
        foreach ($object as $strName => $mixedValue) {
            
            switch ($strName) {
                
                case "contents":
                    
                    foreach ($mixedValue as $content) {
                        $this->contents[] = new Scene\Content($content);
                    }
                    
                    break;     
                
                case "options":
                    
                    foreach ($mixedValue as $option) {
                        $this->options[] = new Scene\Option($option);
                    }
                    
                    break;   
                
                case "inventory":
                    $this->inventory = new Scene\Inventory($mixedValue);
                    break;  
                
                case "states":
                    $this->states = new Scene\States($mixedValue);
                    break;          
                
                default:
                    $this->$strName = $mixedValue;
                
            }
            
            
        }
        
    }
    
}