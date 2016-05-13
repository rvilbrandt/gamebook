<?php
/**
 * @author Ronald Vilbrandt <info@rvi-media.de>
 * @copyright 2016 RVI-Media, www.rvi-media.de
 * @since 2016-05-02 
 */

namespace rvilbrandt\gamebook\Loader;

class SerializeSession {
    
    /**
     * Constructor
     */
    public function __construct() {
    }
    
    /**
     * Load data
     * 
     * @param string $strIdentifier Identifier
     * @return mixed Data
     * 
     * @throws InvalidFormatException
     */
    public function load($strIdentifier) {
        
        $strSerialized = null;
        
        if (true === isset($_SESSION[$strIdentifier]) && false === $strSerialized = unserialize($_SESSION[$strIdentifier])) {
            throw new InvalidFormatException("Session data could not unserialized");
        }
        
        return $strSerialized;        
    }
    
}