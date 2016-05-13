<?php
/**
 * @author Ronald Vilbrandt <info@rvi-media.de>
 * @copyright 2016 RVI-Media, www.rvi-media.de
 * @since 2016-05-02 
 */

namespace rvilbrandt\gamebookdemo;

use \rvilbrandt\gamebook\Model\GameState;

abstract class HtmlGenerator {
    
    /** @var Model\GameState */
    protected $gameState = null;
    
    /**
     * Constructor
     * 
     * @param GameState $gameState Game state
     */
    public function __construct(GameState $gameState) {
        $this->gameState = $gameState;
    }
    
    /**
     * Generate HTML
     * 
     * @return string HTML
     */
    abstract public function run();  
    
}

