<?php include("session.php"); ?>
<?php include("../DB.class.php"); ?>

<?php
$posted=false;
if(isset($_POST['artist'])){// to know either form posted or not.
	
	$posted=true;

	$album=$_POST['artist'];
	$bio=$_POST['bio'];
	$dob=$_POST['dob'];

	$fileName='';
	if(isset($_FILES['image'])){
		$uploadDir = '../images/artist/'; // Make sure this directory exists and is writable
	    $fileTmpPath = $_FILES['image']['tmp_name'];
	    $fileName = basename($_FILES['image']['name']);
	    $uploadPath = $uploadDir . $fileName;
	    // Create uploads directory if it doesn't exist
	    if (!is_dir($uploadDir)) {
	        mkdir($uploadDir, 0777, true);
	    }

	    // Move the uploaded file
	    if (move_uploaded_file($fileTmpPath, $uploadPath)) {
	    	//Success
	        
	    } else {
	        $fileName='';
	    }

	}

	$data=[
	    'artist_name' => $album,
	    'bio' => $bio,
	    'dob' => $dob,	    
	];

	if($fileName!=''){
		$data['picture'] = $fileName;
	}

	$db->update('artists', $data,"id=".$_GET['id']);

}

$rows=$db->select("select * from artists where id=".$_GET['id']);

?>

<?php include("header.php"); ?>
<div class="main">
	<div class="content new-user">
		<?php
		if($posted)
		{
		?>
			<div class="msg" style="display: block"><span>Artist has been modified successfully!</span></div>
		<?php
		}else{
		?>
			<div class="msg"><span></span></div>
		<?php
		}
		?>		
		
		<h1>Edit Artist</h1>
		<div class="form">
			<form method="post" onsubmit="return validateMe();" enctype="multipart/form-data" >
				<label>Artist Name</label>
				<input type="text" name="artist" required value="<?=$rows[0]["artist_name"]?>" />
				<label>Artist's Biography</label>
				<textarea name="bio" required ><?=$rows[0]["bio"]?></textarea>
				<label>Date of Birth (eg: 1990-12-31)</label>
				<input type="text" name="dob" value="<?=$rows[0]["dob"]?>" />				
				<label>Upload Picture</label>
				<input type="file" name="image" />
				<div style="text-align: right;"><input type="submit" name="" value="Update"></div>
			</form>
		</div>
	</div>
</div>
<script>
	function validateMe(){
		var artist=$(`input[name="artist"]`).val();
		var bio=$(`select[name="bio"]`).val();
		var dob=$(`input[name="dob"]`).val();


		var dobArr=dob.split("-");
		if( !( dobArr.length==3 && !isNaN(parseInt(dobArr[0])) && !isNaN(parseInt(dobArr[1])) && !isNaN(parseInt(dobArr[2])) && parseInt(dobArr[0])<=202
		5 && parseInt(dobArr[1])<=12 && parseInt(dobArr[2])<=31 ) ){
			$(".msg span").removeClass("red").addClass("red")
			$(".msg").show();
			$(".msg span").html("Invalid date of birth");
			return false;
		}
		
	}
</script>
<?php include("footer.php"); ?>