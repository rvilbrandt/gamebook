<?php
/**
 * @author Ronald Vilbrandt <info@rvi-media.de>
 * @copyright 2016 RVI-Media, www.rvi-media.de
 * @since 2016-05-02 
 */

namespace rvilbrandt\gamebook\Saver;

class SerializeSession {
    
    /**
     * Constructor
     */
    public function __construct() {
    }
    
    /**
     * Save data
     * 
     * @param string $strIdentifier Identifier
     * @param mixed $mixedData Data
     */
    public function write($strIdentifier, $mixedData) {
        $_SESSION[$strIdentifier] = serialize($mixedData);
    }
    
}