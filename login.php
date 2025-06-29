<?php 
session_start();
include("DB.class.php"); 

$msg='';
$class=' red';
if(isset($_GET['do']) && $_GET['do']=="success" ){
    $msg='You are registered!';
    $class='';
}

if(isset($_POST['email']) && isset($_POST['password']) ){

    $rows=$db->select("select * from users where role=1 and email='".$_POST['email']."' and password='".md5($_POST['password'])."'");
    if(count($rows)>0){
        $_SESSION['userid']=$rows[0]['id'];
        $_SESSION['fullname']=$rows[0]['fullname'];
        $_SESSION['email']=$rows[0]['email'];
        header("location: index.php");
        exit();
    }else{
        $class=' red';
        $msg='Invalid username or password';        
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VideoStream - Watch Videos Online</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" type="application/javascript"></script>
    <link rel="stylesheet" href="style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

   <?php include("header.php") ?>
 

    <div class="container">
        <div class="login-container">
                <h1 class="login-title">Login</h1>                
                <div class="msg <?=$class?>"><?=$msg?></div>
                <form method="post">
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            class="form-input" 
                            placeholder="Enter your email"
                            required
                        >
                    </div>
                    
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="form-input" 
                            placeholder="Enter your password"
                            required
                        >
                    </div>
                    
                    <button type="submit" class="login-button">Log In</button>
                </form>
            </div>        
        
    </div>
    <?php include("footer.php") ?>
    
    
     
    <script src="main.js"></script>
    <script>
        
    </script>
</body>
</html>