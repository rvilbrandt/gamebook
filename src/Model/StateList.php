<?php
/**
 * @author Ronald Vilbrandt <info@rvi-media.de>
 * @copyright 2016 RVI-Media, www.rvi-media.de
 * @since 2016-04-26 
 */

namespace rvilbrandt\gamebook\Model;

class StateList implements \Iterator {
    
    protected $arrStates = [];
    
    /**
     * Constructor 
     */
    public function __construct() {
    }
    
    /**
     * Add a state
     * 
     * @param string $strName Name
     * @param mixed $mixedState Value
     */
    public function setState($strName, $mixedState) {
        $this->arrStates[$strName] = $mixedState;
    }
    
    /**
     * Return whether a state exists or not
     * 
     * @param string $strName Name
     * @return boolean Status
     */
    public function hasState($strName) {
        return isset($this->arrStates[$strName]);
    }   
    
    /**
     * Return a state
     * 
     * @param string $strName Name
     * @return mixed Value
     */
    public function getState($strName) {
        return true === isset($this->arrStates[$strName]) ? $this->arrStates[$strName] : null;
    }    
    
    /**
     * Remove state
     * @param string $strName Name
     */
    public function removeState($strName) {
        unset($this->arrStates[$strName]);
    }
    
    /**
     * Rewind container
     */
    public function rewind() {
        return reset($this->arrStates);
    }

    /**
     * Returns current element
     * 
     * @return mixed Element
     */
    public function current() {
        return current($this->arrStates);
    }

    /**
     * Returns current key
     * 
     * @return mixed Key
     */
    public function key() {
        return key($this->arrStates);
    }

    /**
     *Returns next element
     * 
     * @return mixed Element 
     */
    public function next() {
        return next($this->arrStates);
    }

    /**
     * Returns whether an element is valid or not
     * 
     * @return boolean true
     */
    public function valid() {
        return null !== key($this->arrStates);
    }
    
}