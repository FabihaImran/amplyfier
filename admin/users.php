<?php include("session.php"); ?>
<?php include("../DB.class.php"); ?>

<?php

$whatDid="";

if(isset($_GET['do']) && $_GET['do']=="del"){
	$whatDid="del";
	$db->delete('users',"id=".$_GET['id']);
}


if(isset($_POST['email'])){// to know either form posted or not.
	
	$whatDid="update";

	$fullname=$_POST['fullname'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$phone=$_POST['phone'];
	$address=$_POST['address'];
	$role=$_POST['role'];

	$db->insert('users', [
	    'fullname' => $fullname,
	    'email' => $email,
	    'password' => $password,
	    'phone' => $phone,
	    'address' => $address,
	    'role' => $role,
	]);

}

?>

<?php include("header.php"); ?>
<div class="main">
	<div class="content users-list">
		<?php
		if($whatDid=="update")
		{
		?>
			<div class="msg" style="display: block"><span>New user has been added successfully!</span></div>
		<?php
		}else if($whatDid=="del")
		{
		?>
			<div class="msg" style="display: block"><span class="red">User has been deleted successfully!</span></div>
		<?php
		}else{
		?>
			<div class="msg"><span></span></div>
		<?php
		}
		?>		
		
		<h1>Users List</h1>
		
		<div class="table">
			<div class="th" style="text-align: center;">S.No</div>
			<div class="th">Name</div>
			<div class="th">Email</div>
			<div class="th" style="text-align:center;">Role</div>
			<div class="th" style="text-align: center;">Action</div>

			<?php
			$rows=$db->select("select * from users order by ts desc");
			for($i=0; $i<count($rows); $i++)
			{
			?>
				<div class="td" style="text-align: center;"><?=($i+1)?></div>
				<div class="td"><?php echo $rows[$i]['fullname']; ?></div>
				<div class="td"><?php echo $rows[$i]['email']; ?></div>
				<div class="td" style="text-align:center; font-weight: bold;"><?php echo $rows[$i]['role']==1 ? "Website User" : "Administrator"; ?></div>
				<div class="td" style="text-align: center;"><a href="edit-user.php?id=<?=$rows[$i]['id']?>" class="action-item">Edit</a href=""> | <a href="javascript:void(0);" id="<?=$rows[$i]['id']?>"  class="action-item delete red">Delete</a href=""></div>
			<?php
			}
			?>

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
		if( !(phone.length==11 && isNaN(parseInt(phone))==false) ){
			$(".msg span").removeClass("red").addClass("red")
			$(".msg").show();
			$(".msg span").html("Phone number should have 11 digits only");
			return false;
		}
		if(role==""){
			$(".msg span").removeClass("red").addClass("red");
			$(".msg").show();
			$(".msg span").html("Please select user's role");
			return false;
		}
		
		
	}

	$(".delete").click(function(){
		var id=$(this).attr("id");
		if(confirm("Do you really want to delete?")){
			window.location.href=`?do=del&id=`+id;
		}
	});

</script>
<?php include("footer.php"); ?>