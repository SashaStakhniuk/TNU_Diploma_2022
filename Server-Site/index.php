<?php
if(isset($_POST["email"]) && isset($_POST["password"])) 
{
    $servername = "142.11.202.198";
    $username = "norbktxg_sstahnuk";
    $password = "z4TT?5sb*L!+";
    $dbname = "norbktxg_cubeDB";

    $email = $_POST["email"];
    $userpassword = $_POST["password"];

    
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $userpassword = md5($userpassword);
    $sql = "SELECT * FROM Users WHERE email='$email' AND passw = '$userpassword'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $status= '<div style="text-align:center">
                     <div style ="color:green">User signed in successfully</div>
                  </div>';
        while($row = $result->fetch_assoc()) {
            setcookie("User", $row["email"], time()+600); // 10 хв 
        }
         echo "<script>document.location.href='mainPage.php';</script>";
      
    } else {
        $status= '<div style="text-align:center">
                     <div style ="color:red">Can\'t find such user</div>
                  </div>';
        setcookie("User","");
    }
    $conn->close();
  
    // $status= '';

    // $emailExist = false;
    // $passwordExist=false;
    // $email = $_POST["email"];
    // $password = $_POST["password"];
    // if( strpos(file_get_contents("db/login.txt"),$_POST["email"]) !== false) {
    //     $emailExist = true;
    // }
    // if( strpos(file_get_contents("db/password.txt"),$_POST["password"]) !== false) {
    //     $passwordExist = true;
    // }
    // if(!$passwordExist || !$emailExist){
        
    //     $status= '<div style="text-align:center">
    //                  <div style ="color:red">Wrong login or password<div>
    //               </div>';
    // }
    // else
    // {
    //     echo "<script>document.location.href='mainPage.php';</script>";
    // }
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
    <script src="https://telegram.org/js/telegram-web-app.js"></script>
	<link type="text/css" rel="stylesheet" href="styles/backgroundLogin.css" />
		<link type="text/css" rel="stylesheet" href="styles/buttonStyle.css" />
		<link rel="icon" type="image/x-icon" href="images/TG.png"/>
    <title>Telegram bot</title>
</head>
<body>
                <div class="centerDiv">
                    <div class="border">
                    <div class="text-center" style="font-weight:bolder">Sign-In</div>
                        <form action = "index.php" method="POST">
                                    <div class="row m-1">
                                    <div class="form__group field">
                                            <input type="email" class="form__field" placeholder="Email" name="email" required/>
                                            <label htmlFor="email" class="form__label">Email</label>
                                        </div>
                                    </div>

                                    <div class="row m-1">
                                    <div class="form__group field">
                                            <input type="password" class="form__field" placeholder="Password" name="password" required/>
                                            <label htmlFor="password" class="form__label">Password</label>
                                        </div>
                                    </div>
                                    
                                <?php echo $status;?>
                                <div class="text-center">
                                    <button class="btn btn-success m-2" style="min-width:60%">Sign-In</button>
                                </div>                
                            </form>
                                                
                            <hr/>
                            <!-- <div class="text-center"> -->
                                        <!-- <a href="/passwordreset"> -->
                                            <!-- <button class="btn btn-warning">Forgot password</button> -->
                                        <!-- </a> -->
                                    <!-- </div> -->
                            <div class="text-center">
                                    <a class="btn btn-secondary" href="signup.php">I don't have an account</a>
                            </div>
                       
                        </div>

                    </div>
</body>
</html>