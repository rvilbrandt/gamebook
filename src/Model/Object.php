<?php
/**
 * @author Ronald Vilbrandt <info@rvi-media.de>
 * @copyright 2016 RVI-Media, www.rvi-media.de
 * @since 2016-04-26 
 */

namespace rvilbrandt\gamebook\Model;

abstract class Object {
    
    protected $arrRequiredAttributes = [];
    
    public function __construct($object = null) {
        
        if (true === isset($object)) {
            $this->setFromObject($object);
        }
        
    }
    
    public function setFromObject($object) {
        
        $this->validate($object);
        
        foreach ($object as $strName => $mixedValue) {
            $this->$strName = $mixedValue;
        }
        
    }
    
    protected function validate($object) {
        
        foreach ($this->arrRequiredAttributes as $strRequiredAttribute) {
            
            if (false === isset($object->$strRequiredAttribute)) {
                throw new MissingAttributeException($strRequiredAttribute . " is missing");
            }
            
        }
        
    }
    
}