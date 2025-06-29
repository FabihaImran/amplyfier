<?php 
include("session.php"); 
include("DB.class.php"); 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Platform</title>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Platform</title>
   <link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>
<body>

   <!-- Header -->
  <?php include("header.php"); ?>
 
    <div class="container">

            <?php
            $artist=$db->select("select * from artists where id=".$_GET['aid']);
            ?>
         <h1><?=$artist[0]['artist_name']?> Songs</h1>



        <div class="video-grid">
            <?php
            $rows=$db->select("select a.*,b.artist_name,c.album_title from videos a left join artists b on b.id=a.artist_id left join albums c on c.id=a.album_id where a.artist_id=".$_GET['aid']." order by ts desc");
        for($i=0; $i<count($rows); $i++)
            {
                $mediaType='video';
                if($rows[$i]['media_type']=="audio")$mediaType='audio';
            ?>
                <div class="video-card" onclick="window.location.href='<?=$mediaType?>-play.php?vid=<?=$rows[$i]["id"]?>';">
                    <div class="thumbnail">
                        <?php
                        if($rows[$i]['media_type']=="video"){
                        ?>
                            <div class="thumbnail"><img src="images/<?=$mediaType?>/<?=$rows[$i]['thumbnail']?>" alt=""></div>
                        <?php
                        }else{
                        
                        ?>
                            <div class="thumbnail"><img src="images/<?=$mediaType?>/<?=$rows[$i]['thumbnail']!="" ? $rows[$i]['thumbnail'] : "audio-thumb.jpg"; ?>" alt=""></div>
                        <?php
                        }
                        ?>
                        <div class="thumbnail-overlay">
                            <div class="play-button">▶</div>
                        </div>
                    </div>
                    <div class="video-info">
                        <div class="video-title"><?=$rows[$i]['video_title']?></div>
                        <div class="video-meta">
                         
                        </div>
                     
                    </div>
                </div>
            <?php
            }
            ?>
            </div>
        </div>

            
            




  




  



              




              



              




              



              



              

    

<script src="main.js"></script>


        </div>
    </div>

<?php include("footer.php"); ?>
    
</body>
</html>