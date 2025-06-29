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

	$db->insert('users', [
	    'fullname' => $fullname,
	    'email' => $email,
	    'password' => md5($password),
	    'phone' => $phone,
	    'address' => $address,
	    'role' => $role,
	]);

}
?>

<?php include("header.php"); ?>
<div class="main">
	<div class="content new-user">
		<?php
		if($posted)
		{
		?>
			<div class="msg" style="display: block"><span>New user has been added successfully!</span></div>
		<?php
		}else{
		?>
			<div class="msg"><span></span></div>
		<?php
		}
		?>		
		
		<h1>Add New User</h1>
		<div class="form">
			<form method="post" onsubmit="return validateMe();" >
				<input type="text" name="fullname" placeholder="Full Name" required />
				<input type="email" name="email" placeholder="Email" required />
				<input type="password" name="password" placeholder="Password"  required />
				<input type="password" name="confirm" placeholder="Confirm Password"  required />
				<input type="text" name="address" placeholder="Address (Optional)" />
				<input type="text" name="phone" placeholder="Phone Number (eg: 03001234567)" maxlength="11" />
				<select name="role">
					<option value="">-- User Role --</option>
					<option value="1">User</option>
					<option value="2">Administrator</option>
				</select>
				<div style="text-align: right;"><input type="submit" name="" value="Add"></div>
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