<?php 
session_start();
if(isset($_GET['do']) && $_GET['do']=="logout" ){
    session_destroy();
    header("location: index.php");
    exit();
}
include("DB.class.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AMPLIFY - Music Streaming Platform</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" type="application/javascript"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
  <?php include("header.php"); ?>

  <div class="main-container">
    <div class="homescreen">
      <div class="home-text">
        <h1>Turn up the volume, Amplify your experience</h1>
        <h3>Welcome to AMPLIFY — where your music experience reaches new heights.</h3>
      </div>
    </div>

    <div class="content-area">


      <h2>Latest Video Songs</h2>
      <div class="content-section">
        <?php
        $rows=$db->select("select a.*,b.artist_name,c.album_title from videos a left join artists b on b.id=a.artist_id left join albums c on c.id=a.album_id where media_type='video' order by ts desc limit 12");
        for($i=0; $i<count($rows); $i++)
        {
        ?>
            <a href="video-play.php?vid=<?=$rows[$i]["id"]?>" class="song-card" >
              <?php
              if( (strtotime("now")-strtotime($rows[$i]["ts"]))<=86400 ){
                echo '<img class="new-song-img" src="images/new.gif" />';
              }
              ?>
              
              <div class="image-container">
                <img src="images/video/<?=$rows[$i]["thumbnail"]?>" alt="<?=$rows[$i]["video_title"]?>">
                <div class="overlay">
                  <i class="fas fa-play play-button"></i>
                </div>
              </div>
              <div class="song-title"><?=$rows[$i]["video_title"]!="" ? $rows[$i]["video_title"] : "No Album" ?></div>
              <div class="song-artist"><?=$rows[$i]["artist_name"]!="" ? $rows[$i]["artist_name"] : "No Artist" ?> <?=$rows[$i]["category"]!="" ? "(".$rows[$i]["category"].")" : "" ?></div>
            </a>
        <?php
        }
        ?>
        
      </div>

      <h2>Latest Audio Songs</h2>
      <div class="content-section">
        <?php
        $rows=$db->select("select a.*,b.artist_name,c.album_title from videos a left join artists b on b.id=a.artist_id left join albums c on c.id=a.album_id where media_type='audio' order by ts desc limit 12");
        for($i=0; $i<count($rows); $i++)
        {
        ?>
            <a href="audio-play.php?vid=<?=$rows[$i]["id"]?>" class="song-card" >
              <?php
              if( (strtotime("now")-strtotime($rows[$i]["ts"]))<=86400 ){
                echo '<img class="new-song-img" src="images/new.gif" />';
              }
              ?>
              
              <div class="image-container">
                <img src="images/audio/<?=$rows[$i]["thumbnail"]!="" ? $rows[$i]["thumbnail"] : "audio-thumb.jpg"?>" alt="<?=$rows[$i]["video_title"]?>">
                <div class="overlay">
                  <i class="fas fa-play play-button"></i>
                </div>
              </div>
              <div class="song-title"><?=$rows[$i]["video_title"]!="" ? $rows[$i]["video_title"] : "No Album" ?></div>
              <div class="song-artist"><?=$rows[$i]["artist_name"]!="" ? $rows[$i]["artist_name"] : "No Artist" ?> <?=$rows[$i]["category"]!="" ? "(".$rows[$i]["category"].")" : "" ?></div>
            </a>
        <?php
        }
        ?>
        
      </div>


      <h2>Popular Artists</h2>
      <div class="content-section-2">
        
        <?php
        $artists=$db->select("select * from artists order by artist_name");
        for($i=0; $i<count($artists); $i++)
        {
        ?>
            <a href="artist-songs.php?aid=<?=$artists[$i]['id']?>" class="artist-card">
              <img src="images/artist/<?=$artists[$i]["picture"]?>" alt="Pritam">
              <div class="artist-name"><?=$artists[$i]["artist_name"]?></div>
            </a>
        <?php
        }
        ?>

        
      </div>


      

    

    <?php include("footer.php"); ?>
    
    </div>
  </div>

  <!-- Back to Top Button -->
  <button id="backToTop" onclick="scrollToTop()">⬆</button>

<script src="main.js"></script>
</body>
</html>