<?php include("session.php"); ?>
<?php include("../DB.class.php"); ?>

<?php

$whatDid="";

if(isset($_GET['do']) && $_GET['do']=="del"){
	$whatDid="del";
	$db->delete('videos',"id=".$_GET['id']);
}


?>

<?php include("header.php"); ?>
<div class="main">
	<div class="content users-list">
		<?php
		if($whatDid=="del")
		{
		?>
			<div class="msg" style="display: block"><span class="red">Song has been deleted successfully!</span></div>
		<?php
		}else{
		?>
			<div class="msg"><span></span></div>
		<?php
		}
		?>		
		
		<h1>Songs List</h1>
		
		<div class="table" style="grid-template-columns: 100px auto auto auto auto auto auto 200px;">
			<div class="th" style="text-align: center;">S.No</div>
			<div class="th">Video Title</div>
			<div class="th">File Name</div>
			<div class="th" style="text-align:center;">Artist</div>
			<div class="th" style="text-align:center;">Album</div>
			<div class="th" style="text-align:center;">Category</div>
			<div class="th" style="text-align:center;">Posted Date</div>
			<div class="th" style="text-align: center;">Action</div>

			<?php
			$rows=$db->select("select a.*,b.artist_name,c.album_title from videos a left join artists b on b.id=a.artist_id left join albums c on c.id=a.album_id where a.media_type='audio' order by video_title");
			for($i=0; $i<count($rows); $i++)
			{
			?>
				<div class="td" style="text-align: center;"><?=($i+1)?></div>
				<div class="td"><?php echo $rows[$i]['video_title']; ?></div>
				<div class="td"><?php echo $rows[$i]['video_code']; ?></div>
				<div class="td" style="text-align:center;"><?php echo $rows[$i]['artist_name'] ? $rows[$i]['artist_name'] : "-----"; ?></div>
				<div class="td" style="text-align:center;"><?php echo $rows[$i]['album_title'] ? $rows[$i]['album_title'] : "-----"; ?></div>
				<div class="td" style="text-align:center;"><?php echo $rows[$i]['category'] ? $rows[$i]['category'] : "-----"; ?></div>
				<div class="td" style="text-align:center;"><?php echo date("d M, Y",strtotime($rows[$i]['ts'])); ?></div>
				<div class="td" style="text-align: center;"><a href="edit-audio.php?id=<?=$rows[$i]['id']?>" class="action-item">Edit</a href=""> | <a href="javascript:void(0);" id="<?=$rows[$i]['id']?>"  class="action-item delete red">Delete</a href=""></div>
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