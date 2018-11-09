<?php
require_once('../includes/class.game.php');
require_once('../includes/xolib.php');
session_start();
echo doAction();
function doAction()
{
    $spot = isset($_GET['spot']) ? $_GET['spot'] : null;
    $value = isset($_GET['value']) ? $_GET['value'] : null;
    
    if (isset($_GET['type'])) {
        switch ($_GET['type'])
        {
            case "playGame":
                    return playGame($spot, $value);
            default:
                return "خطا";
        }
    }
}

function playGame($spot, $value)
{	
	if (!isset($_SESSION['game']['tictactoe'])) {
		$_SESSION['game']['tictactoe'] = new tictactoe();
    }
	
	echo "<h2 align='center' style='color:green'>بازی نوبتی XO</h2>";
	$_SESSION['game']['tictactoe']->playGame($spot, $value);
}
