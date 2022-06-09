<?php
if(isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["email"]) && isset($_POST["password"])) 
{
    

    $status= '';

    $servername = "142.11.202.198";
    $username = "norbktxg_sstahnuk";
    $password = "z4TT?5sb*L!+";
    $dbname = "norbktxg_cubeDB";

    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $userpassword = $_POST["password"];
    
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    $userpassword = md5($userpassword);
    $sql = "INSERT INTO Users (firstname, lastname, email, passw)
    VALUES ('$firstname', '$lastname', '$email', '$userpassword')";
    
    if (mysqli_query($conn, $sql)) {
        $status= '<div style="text-align:center">
                    <div style ="color:green">New user created successfully</div>
                  </div>';
        
        setcookie("User", $email, time()+600);// 10 хв 

        echo "<script>document.location.href='mainPage.php';</script>";

    } else {
        $status= '<div style="text-align:center">
                    <div style ="color:red"><h6>'.mysqli_error($conn).'</h6></div>
                  </div>';

        setcookie("User","");
    }
    
    mysqli_close($conn);



    
    // $emailExist = false;

    // $email = $_POST["email"];
    // $password = $_POST["password"];

    // if( strpos(file_get_contents("db/login.txt"),$_POST["email"]) !== false) {
    //     $emailExist = true;
    //     $status= '<div style="text-align:center">
    //                 <div style ="color:red">Login already exist<div>
    //               </div>';
    // }
    // if(!$emailExist){
    //     $myfile = fopen("db/login.txt", "a") or die("Unable to open file!");
    //     $email.="\n";
    //     fwrite($myfile, $email);
    //     fclose($myfile);
    
    //     $myfile = fopen("db/password.txt", "a") or die("Unable to open file!");
    //     $password.="\n";
    //     fwrite($myfile, $password);
    //     fclose($myfile);
    //    
    //     echo "<script>document.location.href='mainPage.php';</script>";

    // }
    
}

/// зчитати з файлу, перевірити чи існує
//echo "<script>document.location.href='../Index.html';</script>";
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
                <div class="centerDiv1">
                    <div class="border">
                    <div class="text-center" style="font-weight:bolder">Sign-Up</div>
                        <form action = "signup.php" method="POST">
                                    <div class="row m-1">
                                    <div class="form__group field">
                                            <input type="firstname" class="form__field" placeholder="Firstname" name="firstname" required/>
                                            <label htmlFor="firstname" class="form__label">Firstname</label>
                                        </div>
                                    </div>
                                    <div class="row m-1">
                                    <div class="form__group field">
                                            <input type="lastname" class="form__field" placeholder="Lastname" name="lastname" required/>
                                            <label htmlFor="lastname" class="form__label">Lastname</label>
                                        </div>
                                    </div>
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
                                    <button class="btn btn-success m-2" style="min-width:60%">Sign-Up</button>
                                </div>                
                            </form>
                                                
                            <hr/>
                            <!-- <div class="text-center"> -->
                                        <!-- <a href="/passwordreset"> -->
                                            <!-- <button class="btn btn-warning">Forgot password</button> -->
                                        <!-- </a> -->
                                    <!-- </div> -->
                            <div class="text-center">
                                    <a class="btn btn-secondary" href="index.php">I have an account</a>
                            </div>
                       
                        </div>

                    </div>
</body>
</html>