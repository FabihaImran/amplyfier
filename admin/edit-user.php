<?php include("session.php"); ?>
<?php include("../DB.class.php"); ?>

<?php
$posted=false;
if(isset($_POST['email'])){// to know either form posted or not.
	
	$posted=true;

	$fullname=$_POST['fullname'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$phone=$_POST['phone'];
	$address=$_POST['address'];
	$role=$_POST['role'];

	$db->update('users', [
	    'fullname' => $fullname,
	    'email' => $email,
	    'password' => md5($password),
	    'phone' => $phone,
	    'address' => $address,
	    'role' => $role,
	],"id=".$_GET['id']);

}

$rows=$db->select("select * from users where id=".$_GET['id']);

?>

<?php include("header.php"); ?>
<div class="main">
	<div class="content new-user">
		<?php
		if($posted)
		{
		?>
			<div class="msg" style="display: block"><span>User has been modified successfully!</span></div>
		<?php
		}else{
		?>
			<div class="msg"><span></span></div>
		<?php
		}
		?>		
		
		<h1>Edit User</h1>
		<div class="form">
			<form method="post" onsubmit="return validateMe();" >
				<input type="text" name="fullname" placeholder="Full Name" value="<?=$rows[0]["fullname"]?>" required />
				<input type="email" name="email" placeholder="Email" value="<?=$rows[0]["email"]?>" required />
				<input type="password" name="password" placeholder="Password"  required />
				<input type="password" name="confirm" placeholder="Confirm Password"  required />
				<input type="text" name="address" placeholder="Address (Optional)"  value="<?=$rows[0]["address"]?>" />
				<input type="text" name="phone" placeholder="Phone Number (eg: 03001234567)"  value="<?=$rows[0]["phone"]?>" maxlength="11" />
				<select name="role">
					<option value="">-- User Role --</option>
					<option <?=$rows[0]["role"]==1 ? "selected" : "" ?> value="1">User</option>
					<option <?=$rows[0]["role"]==2 ? "selected" : "" ?> value="2">Administrator</option>
				</select>
				<div style="text-align: right;"><input type="submit" name="" value="Update"></div>
			</form>
		</div>
	</div>
</div>
<script>
	function validateMe(){
		var password=$(`input[name="password"]`).val();
		var confirm=$(`input[name="confirm"]`).val();
		var phone=$(`input[name="phone"]`).val();
		var role=$(`select[name="role"]`).val();


		if(password!=confirm){
			$(".msg span").removeClass("red").addClass("red");
			$(".msg").show();
			$(".msg span").html("Password doesn't match");
			return false;
		}
		/*if( !(phone.length==11 && isNaN(parseInt(phone))==false) ){
			$(".msg span").removeClass("red").addClass("red")
			$(".msg").show();
			$(".msg span").html("Phone number should have 11 digits only");
			return false;
		}*/
		if(role==""){
			$(".msg span").removeClass("red").addClass("red");
			$(".msg").show();
			$(".msg span").html("Please select user's role");
			return false;
		}
		
		
	}
</script>
<?php include("footer.php"); ?>