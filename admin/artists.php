<?php include("session.php"); ?>
<?php include("../DB.class.php"); ?>

<?php

$whatDid="";

if(isset($_GET['do']) && $_GET['do']=="del"){
	$whatDid="del";
	$db->delete('artists',"id=".$_GET['id']);
}


?>

<?php include("header.php"); ?>
<div class="main">
	<div class="content users-list">
		<?php
		if($whatDid=="del")
		{
		?>
			<div class="msg" style="display: block"><span class="red">Artist has been deleted successfully!</span></div>
		<?php
		}else{
		?>
			<div class="msg"><span></span></div>
		<?php
		}
		?>		
		
		<h1>Artist List</h1>
		
		<div class="table" style="grid-template-columns: 100px auto auto 200px;">
			<div class="th" style="text-align: center;">S.No</div>
			<div class="th">Artist Name</div>
			<div class="th">Date of Birth</div>
			<div class="th" style="text-align: center;">Action</div>

			<?php
			$rows=$db->select("select * from artists order by artist_name");
			for($i=0; $i<count($rows); $i++)
			{
			?>
				<div class="td" style="text-align: center;"><?=($i+1)?></div>
				<div class="td"><?php echo $rows[$i]['artist_name']; ?></div>
				<div class="td"><?php echo $rows[$i]['dob']; ?></div>
				<div class="td" style="text-align: center;"><a href="edit-artist.php?id=<?=$rows[$i]['id']?>" class="action-item">Edit</a href=""> | <a href="javascript:void(0);" id="<?=$rows[$i]['id']?>"  class="action-item delete red">Delete</a href=""></div>
			<?php
			}
			?>

		</div>

	</div>
</div>
<script>
	
	$(".delete").click(function(){
		var id=$(this).attr("id");
		if(confirm("Do you really want to delete?")){
			window.location.href=`?do=del&id=`+id;
		}
	});

</script>
<?php include("footer.php"); ?>