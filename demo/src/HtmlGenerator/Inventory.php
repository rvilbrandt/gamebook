<?php
/**
 * @author Ronald Vilbrandt <info@rvi-media.de>
 * @copyright 2016 RVI-Media, www.rvi-media.de
 * @since 2016-05-13
 */

namespace rvilbrandt\gamebookdemo\HtmlGenerator;

class Inventory extends \rvilbrandt\gamebookdemo\HtmlGenerator {
    
    /**
     * Generate HTML
     * 
     * @return string
     */
    public function run() {
                
        $inventory = $this->gameState->inventory;
        
        $strHtml = "";
        
        if (false === $inventory->isEmpty()) {
        
            $strHtml .= "<ul>\n";

            foreach ($inventory as $item) {

                $strHtml .= "<li>" . $item->name . " <small>(" . $item->description . ")</small></li>\n";

            }

            $strHtml .= "</ul>\n";
            
        } else {            
            $strHtml .= "<p>No items in your pocket.</p>\n";
        }
        
        return $strHtml;
    }
    
}