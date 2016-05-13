<?php
/**
 * @author Ronald Vilbrandt <info@rvi-media.de>
 * @copyright 2016 RVI-Media, www.rvi-media.de
 * @since 2016-04-26 
 */

namespace rvilbrandt\gamebook\Model;

class Inventory implements \Iterator {
    
    protected $arrItems = [];
    
    /**
     * Constructor 
     */
    public function __construct() {
    }
    
    /**
     * Returns whether inventory is empty or not
     * 
     * @return boolean Status
     */
    public function isEmpty() {
        return empty($this->arrItems);
    }
    
    /**
     * Add an item to inventory
     * 
     * @param string $strId Item-ID
     * @param \rvilbrandt\gamebook\Model\Gamebook\Inventory\Item $item Item
     */
    public function addItem($strId, Inventory\Item $item) {
        $this->arrItems[$strId] = $item;
    }
    
    /**
     * Return whether an item exists or not
     * 
     * @param string $strId Item-ID
     * @return boolean Status
     */
    public function hasItem($strId) {
        return isset($this->arrItems[$strId]);
    }   
    
    /**
     * Return an item
     * 
     * @param string $strId Item-ID
     * @return \rvilbrandt\gamebook\Model\Gamebook\Inventory\Item Item
     */
    public function getItem($strId) {
        return true === isset($this->arrItems[$strId]) ? $this->arrItems[$strId] : null;
    }    
    
    /**
     * Remove item from inventory
     * @param string $strId Item-ID
     */
    public function removeItem($strId) {
        unset($this->arrItems[$strId]);
    }
    
    /**
     * Rewind container
     */
    public function rewind() {
        return reset($this->arrItems);
    }

    /**
     * Returns current element
     * 
     * @return mixed Element
     */
    public function current() {
        return current($this->arrItems);
    }

    /**
     * Returns current key
     * 
     * @return mixed Key
     */
    public function key() {
        return key($this->arrItems);
    }

    /**
     *Returns next element
     * 
     * @return mixed Element 
     */
    public function next() {
        return next($this->arrItems);
    }

    /**
     * Returns whether an element is valid or not
     * 
     * @return boolean true
     */
    public function valid() {
        return null !== key($this->arrItems);
    }
    
}