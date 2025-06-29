<?php include("session.php"); ?>
<?php include("../DB.class.php"); ?>

<?php
$posted=false;
if(isset($_POST['album'])){// to know either form posted or not.
	
	$posted=true;

	$album=$_POST['album'];
	$year=$_POST['year'];

	$db->insert('albums', [
	    'album_title' => $album,
	    'album_year' => $year,
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
			<div class="msg" style="display: block"><span>New album has been added successfully!</span></div>
		<?php
		}else{
		?>
			<div class="msg"><span></span></div>
		<?php
		}
		?>		
		
		<h1>Add New Album / Movie</h1>
		<div class="form">
			<form method="post" onsubmit="return validateMe();" >
				<label>Album / Movie Name</label>
				<input type="text" name="album" required />
				<label>Release Year</label>
				<input type="text" name="year" maxlength="4" value="<?=date("Y");?>" />				
				<div style="text-align: right;"><input type="submit" name="" value="Add"></div>
			</form>
		</div>
	</div>
</div>
<script>
	function validateMe(){
		var album=$(`input[name="album"]`).val();
		var year=$(`input[name="year"]`).val();


		if( !(year.length==4 && isNaN(parseInt(year))==false) ){
			$(".msg span").removeClass("red").addClass("red")
			$(".msg").show();
			$(".msg span").html("Relase year is not valid");
			return false;
		}
		
		
		
	}
</script>
<?php include("footer.php"); ?>