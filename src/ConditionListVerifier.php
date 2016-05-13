<?php
/**
 * @author Ronald Vilbrandt <info@rvi-media.de>
 * @copyright 2016 RVI-Media, www.rvi-media.de
 * @since 2016-04-26 
 */

namespace rvilbrandt\gamebook;

use rvilbrandt\gamebook\Model\Gamebook\Conditions;
use rvilbrandt\gamebook\Model\Inventory;
use rvilbrandt\gamebook\Model\StateList;

class ConditionListVerifier {
    
    /** @var Conditions */
    protected $conditions = null;
    
    /** @var Inventory */
    protected $inventory = [];
    
    /** @var StateList */
    protected $stateList = [];
    
    public function __construct(Conditions $conditions = null) {
        
        if (true === isset($conditions)) {
            $this->setConditions($conditions);
        }
        
        $this->inventory = new Inventory();
        $this->stateList = new StateList();
        
    }
    
    public function setConditions(Conditions $conditions) {
        $this->conditions = $conditions;        
    }
    
    public function setInventory(Inventory $inventory) {
        $this->inventory = $inventory;
    }
    
    public function setStateList(StateList $stateList) {
        $this->stateList = $stateList;
    }
    
    public function run() {
        
        $boolStatus = true;
        
        foreach ($this->conditions->states->eq as $strStateName => $mixedValue) {
            
            if (false === $this->stateList->hasState($strStateName) || $mixedValue !== $this->stateList->getState($strStateName)) {
                $boolStatus = false;
                break;
            }
            
        }
        
        foreach ($this->conditions->states->gt as $strStateName => $mixedValue) {
            
            if (false === $this->stateList->hasState($strStateName) || $mixedValue >= $this->stateList->getState($strStateName)) {
                $boolStatus = false;
                break;
            }
            
        }
        
        foreach ($this->conditions->states->lt as $strStateName => $mixedValue) {
            
            if (false === $this->stateList->hasState($strStateName) || $mixedValue <= $this->stateList->getState($strStateName)) {
                $boolStatus = false;
                break;
            }
            
        }
        
        foreach ($this->conditions->states->ne as $strStateName => $mixedValue) {
            
            if (false === $this->stateList->hasState($strStateName) || $mixedValue === $this->stateList->getState($strStateName)) {
                $boolStatus = false;
                break;
            }
            
        }
        
        foreach ($this->conditions->inventory->has as $strItemId) {
            
            if (false === $this->inventory->hasItem($strItemId)) {
                $boolStatus = false;
                break;
            }
            
        }
        
        foreach ($this->conditions->inventory->hasNot as $strItemId) {
            
            if (true === $this->inventory->hasItem($strItemId)) {
                $boolStatus = false;
                break;
            }
            
        }
        
        return $boolStatus;        
    }
    
}