<?php
/**
 * @author Ronald Vilbrandt <info@rvi-media.de>
 * @copyright 2016 RVI-Media, www.rvi-media.de
 * @since 2016-05-13
 */

namespace rvilbrandt\gamebookdemo\HtmlGenerator;

class Scene extends \rvilbrandt\gamebookdemo\HtmlGenerator {
    
    /**
     * Generate HTML
     * 
     * @return string
     */
    public function run() {
                
        $inventory = $this->gameState->inventory;
        $stateList = $this->gameState->stateList;
        $scene = $this->gameState->scene;
        
        $conditionListVerifier = new \rvilbrandt\gamebook\ConditionListVerifier();

        $conditionListVerifier->setInventory($inventory);
        $conditionListVerifier->setStateList($stateList);
        
        $strHtml = "";
        
        foreach ($scene->contents as $content) {
            
            $conditionListVerifier->setConditions($content->conditions);
                
            if (true === $conditionListVerifier->run()) {                
                $strHtml .= $content->text;
            }
            
        }
        
        if (false === empty($scene->options)) {
            
            $strHtml .= "<ul>\n";
            
            /* @var $option Gamebook\Scene\Option */
            foreach ($scene->options as $option) {
                
                $conditionListVerifier->setConditions($option->conditions);
                
                if (true === $conditionListVerifier->run()) {                
                    $strHtml .= "<li><a href=\"?jump_to=" . $option->jumpTo . "\">" . $option->text . "</a></li>\n";
                }
                
            }
            
            $strHtml .= "</ul>\n";
                
        }
        
        return $strHtml;
    }  
    
}