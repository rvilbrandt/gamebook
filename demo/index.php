<?php
/**
 * @author Ronald Vilbrandt <info@rvi-media.de>
 * @copyright 2016 RVI-Media, www.rvi-media.de
 * @since 2016-04-26 
 */

use rvilbrandt\gamebook\Loader\JsonFile;
use rvilbrandt\gamebook\Loader\SerializeSession as SerializeSessionLoader;
use rvilbrandt\gamebook\Saver\SerializeSession as SerializeSessionSaver;
use rvilbrandt\gamebook\Model\StateList;
use rvilbrandt\gamebook\Model\Inventory;
use rvilbrandt\gamebook\Parser;

require_once("./bootstrap.php");

$strJumpTo = true === isset($_GET['jump_to']) ? $_GET['jump_to'] : null;

// Initialize
$loader = new JsonFile("./../data/gamebook/sample.json");
$sessionLoader = new SerializeSessionLoader();
$sessionSaver = new SerializeSessionSaver();

// Load existing states from session
if (null === $stateList = $sessionLoader->load("state_list")) {
    $stateList = new StateList();
}

// Load existing inventory from session
if (null === $inventory = $sessionLoader->load("inventory")) {
    $inventory = new Inventory();
}

// Let the parser work
$engine = new Parser($loader, $strJumpTo);
$engine->setStateList($stateList);
$engine->setInventory($inventory);

$gameState = $engine->run();

// Write the new states and inventory to the session
$sessionSaver->write("state_list", $gameState->stateList);
$sessionSaver->write("inventory", $gameState->inventory);

// Generating the HTML
$sceneHtmlGenerator = new \rvilbrandt\gamebookdemo\HtmlGenerator\Scene($gameState);
$inventoryHtmlGenerator = new \rvilbrandt\gamebookdemo\HtmlGenerator\Inventory($gameState);

echo $sceneHtmlGenerator->run();

echo "<h2>Inventory</h2>\n";
echo $inventoryHtmlGenerator->run();