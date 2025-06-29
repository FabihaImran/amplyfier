<?php include("session.php"); ?>
<?php include("../DB.class.php"); ?>

<?php
$errMsg="";
$posted=false;
if(isset($_POST['video_title'])){// to know either form posted or not.
	
	$posted=true;

	$video_title=$_POST['video_title'];
	$desc=$_POST['desc'];
	$category=$_POST['category'];
	$artist=$_POST['artist'];
	$album=$_POST['album'];


	$fileName='';
	if(isset($_FILES['image'])){
		$uploadDir = '../images/audio/'; // Make sure this directory exists and is writable
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


	$songFileName='';
	if(isset($_FILES['song']) && $_FILES['song']['name']!=""){
		$uploadDir = '../uploaded/audios/'; // Make sure this directory exists and is writable
	    $fileTmpPath = $_FILES['song']['tmp_name'];
	    $songFileName = basename($_FILES['song']['name']);
	    $uploadPath = $uploadDir . $songFileName;
	    if (!is_dir($uploadDir)) {
	        mkdir($uploadDir, 0777, true);
	    }

	    // Move the uploaded file
	    if (move_uploaded_file($fileTmpPath, $uploadPath)) {
	    	//Success
	        
	    } else {
	        $songFileName='';
	        $errMsg="Something went wrong uploading song file.";
	    }

	}


	if($errMsg==""){
    	$data=[
		    'video_title' => $video_title,
		    'video_description' => $desc,
		    'category' => $category,
		    'media_type' => 'audio',
		    'artist_id' => $artist,
		    'album_id' => $album,
		];


		if($songFileName!=''){
			$data['video_code'] = $songFileName;
		}

		if($fileName!=''){
			$data['thumbnail'] = $fileName;
		}

		$db->update('videos', $data,"id=".$_GET['id']);
	}
	

}

$rows=$db->select("select * from videos where media_type='audio' and id=".$_GET['id']);


?>

<?php include("header.php"); ?>
<div class="main">
	<div class="content new-user">
		<?php
		if($posted)
		{
			if($errMsg==""){
			?>
				<div class="msg" style="display: block"><span>Audio has been modified successfully!</span></div>
			<?php
			}else{
			?>
				<div class="msg" style="display: block"><span class="red"><?=$errMsg;?></span></div>
			<?php
			}
		}else{
		?>
			<div class="msg"><span></span></div>
		<?php
		}
		?>		
		
		<h1>Edit Audio</h1>
		<div class="form">
			<form method="post" onsubmit="return validateMe();"  enctype="multipart/form-data" >
				<label>Song Title</label>
				<input type="text" name="video_title" required  value="<?=$rows[0]["video_title"]?>" />
				<label>Description</label>
				<textarea name="desc" required ><?=$rows[0]["video_description"]?></textarea>
				<label>Upload Song File</label>
				<input type="file" name="song" /><br />
				<?=$rows[0]["video_code"]?>
				<label>Category</label>
				<select name="category">
					<option value="">-- Select Category --</option>
					<option <?=$rows[0]["category"]=="Pakistani" ? "selected" : ""; ?> value="Pakistani">Pakistani</option>
					<option <?=$rows[0]["category"]=="Indian" ? "selected" : ""; ?> value="Indian">Indian</option>
					<option <?=$rows[0]["category"]=="English" ? "selected" : ""; ?> value="English">English</option>
				</select>
				<label>Artist</label>
				<select name="artist">
					<option value="0">-- Select Artist --</option>
					<?php
					$rows2=$db->select("select * from artists order by artist_name");
					for($i=0; $i<count($rows2); $i++)
					{
					?>
						<option <?=$rows[0]["artist_id"]==$rows2[$i]["id"] ? "selected" : ""; ?> value="<?=$rows2[$i]["id"]?>"><?=$rows2[$i]["artist_name"]?></option>
					<?php
					}
					?>
				</select>
				<label>Album</label>
				<select name="album">
					<option value="0">-- Select Album --</option>
					<?php
					$rows2=$db->select("select * from albums order by album_title");
					for($i=0; $i<count($rows2); $i++)
					{
					?>
						<option  <?=$rows[0]["album_id"]==$rows2[$i]["id"] ? "selected" : ""; ?> value="<?=$rows2[$i]["id"]?>"><?=$rows2[$i]["album_title"]?></option>
					<?php
					}
					?>
				</select>
				<label>Upload Song Thumbnail</label>
				<input type="file" name="image" />
				<div style="text-align: right;"><input type="submit" name="" value="Update"></div>
			</form></div></div></div>
<script>
	function validateMe(){}
</script>
<?php include("footer.php"); ?>