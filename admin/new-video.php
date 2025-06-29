<?php include("session.php"); ?>
<?php include("../DB.class.php"); ?>

<?php
$posted=false;
if(isset($_POST['video_title'])){// to know either form posted or not.
	
	$posted=true;

	$video_title=$_POST['video_title'];
	$desc=$_POST['desc'];
	$video_code=$_POST['video_code'];
	$category=$_POST['category'];
	$artist=$_POST['artist'];
	$album=$_POST['album'];


	$fileName='';
	if(isset($_FILES['image'])){
		$uploadDir = '../images/video/'; // Make sure this directory exists and is writable
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
	    'video_title' => $video_title,
	    'video_description' => $desc,
	    'video_code' => $video_code,
	    'category' => $category,
	    'media_type' => 'video',
	    'artist_id' => $artist,
	    'album_id' => $album,
	];

	if($fileName!=''){
		$data['thumbnail'] = $fileName;
	}

	$db->insert('videos', $data);

}
?>

<?php include("header.php"); ?>
<div class="main">
	<div class="content new-user">
		<?php
		if($posted)
		{
		?>
			<div class="msg" style="display: block"><span>New video has been added successfully!</span></div>
		<?php
		}else{
		?>
			<div class="msg"><span></span></div>
		<?php
		}
		?>		
		
		<h1>Add New Video</h1>
		<div class="form">
			<form method="post" onsubmit="return validateMe();"  enctype="multipart/form-data" >
				<label>Video Title</label>
				<input type="text" name="video_title" required />
				<label>Description</label>
				<textarea name="desc" required ></textarea>
				<label>Embed Code</label>
				<textarea name="video_code" required ></textarea>
				<label>Category</label>
				<select name="category">
					<option value="">-- Select Category --</option>
					<option value="Pakistani">Pakistani</option>
					<option value="Indian">Indian</option>
					<option value="English">English</option>
				</select>
				<label>Artist</label>
				<select name="artist">
					<option value="0">-- Select Artist --</option>
					<?php
					$rows2=$db->select("select * from artists order by artist_name");
					for($i=0; $i<count($rows2); $i++)
					{
					?>
						<option value="<?=$rows2[$i]["id"]?>"><?=$rows2[$i]["artist_name"]?></option>
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
						<option value="<?=$rows2[$i]["id"]?>"><?=$rows2[$i]["album_title"]?></option>
					<?php
					}
					?>
				</select>
				<label>Upload Thumbnail</label>
				<input type="file" name="image" />
				<div style="text-align: right;"><input type="submit" name="" value="Add"></div>
			</form>
		</div>
	</div>
</div>
<script>
	function validateMe(){
		
	}
</script>
<?php include("footer.php"); ?>