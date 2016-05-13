<?php
/**
 * @author Ronald Vilbrandt <info@rvi-media.de>
 * @copyright 2016 RVI-Media, www.rvi-media.de
 * @since 2016-05-02 
 */

namespace rvilbrandt\gamebook\Model;

class GameState {
    
    /** @var Model\Inventory */
    public $inventory = null;
    
    /** @var Model\StateList */
    public $stateList = null;
    
    /** @var Model\Gamebook\Scene */
    public $scene = null;
    
}