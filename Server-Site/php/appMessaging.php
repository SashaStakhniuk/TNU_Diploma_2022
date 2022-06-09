<?php

    if(isset($_POST['animation1'])){
         echo "<h1>Animation №1</h1>";
         writeIntoFile($_POST['animation1']);
    }
    else if(isset($_POST['animation2'])){
        echo "<h1>Animation №2</h1>";    
        writeIntoFile($_POST['animation2']);  
    }
    else if(isset($_POST['animation3'])){
        echo "<h1>Animation №3</h1>";    
        writeIntoFile($_POST['animation3']);  
    }
    else if(isset($_POST['time'])){
        echo "<h1>Time</h1>";    
        writeIntoFile($_POST['time']);  
    }
    else if(isset($_POST['date'])){
        echo "<h1>Date</h1>";    
        writeIntoFile($_POST['date']);  
    }
    else if(isset($_POST['off'])){
        echo "<h1>Switched off</h1>";    
        writeIntoFile($_POST['off']);  
    }
    else {
        echo "<h1>Make your choice</h1>";    
    }

function writeIntoFile($value){
    $myfile = fopen("../action.txt", "w") or die("Unable to open file!");
    $value.="\n";
    fwrite($myfile, $value);
    fclose($myfile);
}  
?> 