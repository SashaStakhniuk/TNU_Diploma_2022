<?php
if(isset($_GET['action'])){
    $cubePhrase = $_GET['action'];
    if($cubePhrase==="1"){
		$myFile = "../action.txt";
		$lines = file($myFile);//file in to an array
		// echo $lines[0];
        return $lines[0];
    }
    else{
        return "*";
    }
}
// http://localhost/TGBOT/php/cubeMessaging.php?action=1
?>
