<?php 
// error_reporting(0);
include("DB.class.php"); 

$posted=false;
if(isset($_POST['email'])){// to know either form posted or not.
    
    $posted=true;

    $fullname=$_POST['fullname'];
    $email=$_POST['email'];
    $password=$_POST['password'];

    $lastId=$db->insert('users', [
        'fullname' => $fullname,
        'email' => $email,
        'password' => md5($password),
        'role' => 1,
    ]);

    if( ((int)$lastId)>0 ){
        header("location: login.php?do=success");
        exit();
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
<div class="signup-container">
        <h1 class="signup-title">Sign Up</h1>
        <?php
        if($posted){
        ?>
            <div class="msg red"><span>Email already exist</span></div>
        <?php
        }else{
        ?>
            <div class="msg red"><span></span></div>
        <?php
        }
        ?>
        <form method="post" onsubmit="return validateMe();">
            <div class="form-group">
                <label for="fullname" class="form-label">Full Name</label>
                <input 
                    type="text" 
                    id="fullname" 
                    name="fullname" 
                    class="form-input" 
                    placeholder="Enter your full name"
                 
                >
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="form-input" 
                    placeholder="Enter your email"
                 
                >
            </div>
            
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="form-input" 
                    placeholder="Create a password"
                 
                >
            </div>

            <div class="form-group">
                <label for="confirm-password" class="form-label">Confirm Password</label>
                <input 
                    type="password" 
                    id="confirm-password" 
                    name="confirm" 
                    class="form-input" 
                    placeholder="Confirm your password"
                
                >
            </div>
            
            <button type="submit" class="signup-button">Create Account</button>
        </form>

   
    </div>        
        
    </div>
    
    <?php include("footer.php") ?>
    
    
     
    <script src="main.js"></script>
    <script>
    function validateMe(){
        var fullname=$(`input[name="fullname"]`).val();
        var email=$(`input[name="email"]`).val();
        var password=$(`input[name="password"]`).val();
        var confirm=$(`input[name="confirm"]`).val();
        //var phone=$(`input[name="phone"]`).val();


        if(password!=confirm){
          $(".msg span").removeClass("red").addClass("red");
          $(".msg").show();
          $(".msg span").html("Password doesn't match");
          return false;
        }
        // if( !(phone.length==11 && isNaN(parseInt(phone))==false) ){
        //   $(".msg span").removeClass("red").addClass("red")
        //   $(".msg").show();
        //   $(".msg span").html("Phone number should have 11 digits only");
        //   return false;
        // }
        
        
        
    }

    </script>
</body>
</html>