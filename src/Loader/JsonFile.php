<?php
/**
 * @author Ronald Vilbrandt <info@rvi-media.de>
 * @copyright 2016 RVI-Media, www.rvi-media.de
 * @since 2016-04-26 
 */

namespace rvilbrandt\gamebook\Loader;

class JsonFile {
    
    private $strFilePath = null;
    
    public function __construct($strFilePath = null) {
        
        if (true === isset($strFilePath)) {
            $this->setFilePath($strFilePath);
        }
        
    }
    
    public function setFilePath($strFilePath) {
        
        if (false === is_readable($strFilePath)) {
            throw new FileNotFoundException("File not found or not readable: " . $strFilePath);
        }
        
        $this->strFilePath = $strFilePath;
        
    }
    
    public function load() {
        
        if (false === isset($this->strFilePath)) {
            throw new \BadMethodCallException("File path has to be set");
        }
        
        if (null === $strJson = json_decode(file_get_contents($this->strFilePath))) {
            throw new InvalidFormatException("File could not be parsed as JSON: " . json_last_error_msg());
        }
        
        return $strJson;        
    }
    
}