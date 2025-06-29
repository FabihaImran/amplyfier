<?php session_start(); ?>
<?php include("../DB.class.php"); ?>

<?php
$posted=false;
$msg='';
$class=' red';

if(isset($_POST['email']) && isset($_POST['password']) ){

    $rows=$db->select("select * from users where role=2 and email='".$_POST['email']."' and password='".md5($_POST['password'])."'");
    if(count($rows)>0){
        $_SESSION['adminid']=$rows[0]['id'];
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
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin</title>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" type="application/javascript"></script>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>


<div class="main">
  <div class="content new-user">    

    <div class="form" style="max-width: 600px; position: absolute; top:50%; left:50%; transform: translate(-50%,-50%);">
      <div style="text-align:center;"><a style="text-decoration: none;
    font-size: 30px;
    font-weight: 800;
    color: #606;" href="index.php">AMPLIFY ADMIN</a></div>
      <h1>Login</h1><br />
      <?php
      if($msg!=''){
      ?>
        <div style="display:block;" class="msg "><span class="<?=$class?>"><?=$msg?></span></div>   
      <?php
      }
      ?>
      <form method="post" onsubmit="return validateMe();" >        
        <label>Email</label>
        <input type="email" name="email" placeholder="Email" required />
        <label>Password</label>
        <input type="password" name="password" placeholder="Password"  required />
        <div style="text-align: right;"><input type="submit" name="" value="Login"></div>
      </form>
    </div>
  </div>
</div>
<script>
  function validateMe(){


    
    
  }
</script>