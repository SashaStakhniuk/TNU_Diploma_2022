<?php
 if (isset($_COOKIE["User"])){

    echo "<h3 style='color:lightgray'>".$_COOKIE["User"]." in system<br></h3>";    

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
    
}
else{
    echo "<script>document.location.href='index.php';</script>";
}
function writeIntoFile($value){
    $myfile = fopen("action.txt", "w") or die("Unable to open file!");
    $value.="\n";
    fwrite($myfile, $value);
    fclose($myfile);
}  
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
	<link type="text/css" rel="stylesheet" href="styles/index.css" />
    <title>Telegram bot</title>
			<link rel="icon" type="image/x-icon" href="images/TG.png"/>
</head>
<body>
  <form action="mainPage.php" method="POST">
      <input type = "hidden" name ="animation1" value="a1"/>
      <button type = "submit" class="btn from-center">Анімація 1</button>
  </form>
  <form action="mainPage.php" method="POST">
      <input type = "hidden" name ="animation2" value="a2"/>
      <button type = "submit" class="btn from-center">Анімація 2</button>
  </form>
  <form action="mainPage.php" method="POST">
      <input type = "hidden" name ="animation3" value="a3"/>
      <button type = "submit" class="btn from-center">Анімація 3</button>
  </form>
  <form action="mainPage.php" method="POST">
      <input type = "hidden" name ="time" value="t"/>
      <button type = "submit" class="btn from-center">Годинник</button>
  </form>
  <form action="mainPage.php" method="POST">
      <input type = "hidden" name ="date" value="d"/>
      <button type = "submit" class="btn from-center">Дата</button>
  </form>
  <form  action="mainPage.php" method="POST">
      <input type = "hidden" name ="off" value="off"/>
      <button type = "submit" class="btn from-center">Вимкнути куб</button>
  </form>
</body>
</html>