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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" type="application/javascript"></script>


</head>
<body>

   <!-- Header -->
  <?php include("header.php"); ?>
 
    <div class="container">

         <h1>Albums</h1>



        <div class="video-grid">
            <?php
            $rows=$db->select("select * from albums order by ts");
        for($i=0; $i<count($rows); $i++)
            {
            ?>
                <div class="video-card" onclick="window.location.href='album-songs.php?aid=<?=$rows[$i]["id"]?>';">
                    <div class="thumbnail">
                   
                        <div class="thumbnail"><img src="images/album.jpg" alt=""></div>
                        <div class="thumbnail-overlay">
                            <div class="play-button">▶</div>
                        </div>
                    </div>
                    <div class="video-info">
                        <div class="video-title"><?=$rows[$i]['album_title']?></div>
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