<?php
/**
 * @author Ronald Vilbrandt <info@rvi-media.de>
 * @copyright 2016 RVI-Media, www.rvi-media.de
 * @since 2016-04-26 
 */

namespace rvilbrandt\gamebook;

use rvilbrandt\gamebook\Model\Gamebook;
use rvilbrandt\gamebook\Model\Inventory;
use rvilbrandt\gamebook\Model\StateList;

class Parser {
    
    /** @var Loader\JsonFile */
    protected $loader = null;
    
    /** @var Model\Gamebook */
    protected $gamebook = null;
    
    /** @var Inventory */
    protected $inventory = null;
    
    /** @var StateList */
    protected $stateList = null;
    
    protected $strCurrentSceneId = null;
    
    /**
     * Constructor 
     * 
     * @param \rvilbrandt\gamebook\Loader\JsonFile $loader JSON-Loader
     * @param string $strCurrentSceneId Current scene
     */
    public function __construct(\rvilbrandt\gamebook\Loader\JsonFile $loader, $strCurrentSceneId = null) {
        
        $this->loader = $loader;
        
        if (true === isset($strCurrentSceneId)) {
            $this->setCurrentSceneId($strCurrentSceneId);
        }
        
        $this->inventory = new Inventory();
        $this->stateList = new StateList();
    }
    
    /**
     * Sets state-list
     * 
     * @param StateList $stateList
     */
    public function setStateList(StateList $stateList) {
        $this->stateList = $stateList;        
    }
    
    /**
     * Sets inventory
     * 
     * @param Inventory $inventory
     */
    public function setInventory(Inventory $inventory) {
        $this->inventory = $inventory;        
    }
    
    /**
     * Sets current Scene-ID
     * 
     * @param string $strCurrentSceneId Scene-ID
     */
    public function setCurrentSceneId($strCurrentSceneId) {
        
        if (true === isset($strCurrentSceneId)) {
            $strCurrentSceneId = (string)$strCurrentSceneId;
        }
        
        $this->strCurrentSceneId = $strCurrentSceneId;        
    }
    
    /**
     * Start
     * 
     * @return \rvilbrandt\gamebook\Model\GameState Game state
     * 
     * @throws Parser\SceneNotFoundException
     */
    public function run() {
        
        $gamebook = new Gamebook($this->loader->load());
        
        $currentScene = $gamebook->fetchScene(true === isset($this->strCurrentSceneId) ? $this->strCurrentSceneId : $gamebook->startScene);
        
        if (false === isset($currentScene)) {
            throw new Parser\SceneNotFoundException("Scene-ID is not valid: " . $this->strCurrentSceneId);
        }
        
        foreach ($currentScene->inventory->add as $strItemId) {
            $this->inventory->addItem($strItemId, $gamebook->fetchItem($strItemId));
        }
        
        foreach ($currentScene->inventory->remove as $strItemId) {
            $this->inventory->removeItem($strItemId);
        }
        
        foreach ($currentScene->states as $strStateName => $mixedValue) {
            $this->stateList->setState($strStateName, $mixedValue);
        }
        
        $gameState = new Model\GameState();
        
        $gameState->inventory = $this->inventory;
        $gameState->stateList = $this->stateList;
        $gameState->scene = $currentScene;
        
        return $gameState;
    }
    
}