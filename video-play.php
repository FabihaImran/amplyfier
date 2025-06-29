<?php 
include("session.php"); 
include("DB.class.php"); 

$rows=$db->select("select a.*,b.artist_name,c.album_title from videos a left join artists b on b.id=a.artist_id left join albums c on c.id=a.album_id where a.id=".$_GET['vid']);



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VideoStream - Watch Videos Online</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" type="application/javascript"></script>
    <link rel="stylesheet" href="style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

  
  <?php include("header.php") ?>
 

    <div class="container">
        <!-- Video Player Section -->
        <div class="video-section">
            <div class="video-player" id="videoPlayer">
            <?=$rows[0]["video_code"]?>
             </div>
        </div>

        <!-- Video Info Section -->
        <div class="video-info-detail">
            <h1 class="video-title"><?=$rows[0]["video_title"]?></h1>
            <div class="video-meta">
                <div class="channel-info">
                  
                </div>
            
                <!-- <button class="action-btn">
                    <span>💾</span> Download
                </button> -->
                <div class="dropdown">
                    <!-- <button class="action-btn playlist" onclick="togglePlaylistDropdown()">
                        <span>➕</span> Add to Playlist
                    </button> -->
                    <div class="dropdown-content" id="playlistDropdown">
                        <div class="dropdown-item" onclick="addToPlaylist('favorites')">❤️ Favorites</div>
                        <div class="dropdown-item" onclick="addToPlaylist('watchlater')">⏰ Watch Later</div>
                        <div class="dropdown-item" onclick="addToPlaylist('pakistanimusic')">🎵 Pakistani Music</div>
                        <div class="dropdown-item" onclick="addToPlaylist('season15')">📺 Season 15</div>
                        <div class="dropdown-item" onclick="createNewPlaylist()">➕ Create New Playlist</div>
                    </div>
                </div>
            </div>
        </div>        

        <!-- Description Section -->
        <div class="description-section">
            <div class="rating-total">
                <?php
                for($i=1; $i<=5; $i++){
                    echo '<span class="rating-overall">★</span>';
                }
                ?>
                
            </div>
            <div class="rating-count"></div>
            <div class="description-header">Description</div>
            <div class="description-text"><?=$rows[0]["video_description"]?>
                <br><br>
                🎵 Artists: <?=$rows[0]["artist_name"]?><br>
                🏢 Album / Movie: <?=$rows[0]["album_title"]!="" ? $rows[0]["album_title"] : "--" ?><br>
                🎬 Category: <?=$rows[0]["category"]?><br>
                📅 Posted Date: <?=date("d M, Y",strtotime($rows[0]["ts"]))?>
            </div>
        </div>

        <!-- Rating Section -->
        <div class="rating-section">
            <div class="rating-header">Rate Song</div>
            <div class="rating-display">
                <div class="stars" id="ratingStars">
                    <span class="star" data-rating="1">★</span>
                    <span class="star" data-rating="2">★</span>
                    <span class="star" data-rating="3">★</span>
                    <span class="star" data-rating="4">★</span>
                    <span class="star" data-rating="5">★</span>
                </div>
                <div class="rating-info" style="display:none;">
                    <div class="rating-text" id="ratingText"><span>5</span> out of 5</div>                    
                </div>
            </div>

            <div class="comments-header">Your Review</div>
            
            <div class="comment-form">
                <textarea class="comment-input" placeholder="Add some review about this song..." id="commentInput"></textarea>
                <div style="text-align:right;"><button class="comment-submit" >Submit Rating & Review</button></div>
            </div>
        </div>

        <!-- Comments Section -->
        <div class="comments-section">
            

            <div class="comments-list" id="commentsList">
                
                <?php
                $sumReviews=0;
                $reviews=$db->select("select a.*,b.fullname,b.email from reviews a inner join users b on a.user_id=b.id inner join videos c on a.media_id=c.id where c.media_type='video' and a.media_id=".$_GET['vid']);
                $totalReviews=count($reviews);
                for($i=0; $i<count($reviews); $i++){
                    $sumReviews+=((int)$reviews[$i]['rating']);
                ?>
                    <div class="comment <?=$reviews[$i]['user_id']==$_SESSION['userid'] ? "comment-mine" : "" ?> ">
                        <div class="comment-header">
                            <div class="comment-avatar"><?=substr($reviews[$i]['fullname'],0,1)?></div>
                            <div class="comment-author">@<?=explode("@",$reviews[$i]['email'])[0]?></div>
                            <div class="comment-time"><?=date("d M, Y h:ia",strtotime($reviews[$i]['ts']))?></div>
                        </div>
                        <div class="comment-text ">
                        <?php
                        for($x=1; $x<=5; $x++){
                            $selected='';
                            if($x<=$reviews[$i]['rating'])$selected=' yellow ';
                            echo '<span style="font-size:18px;" class="rating-overall '.$selected.'">★</span>';
                        }
                        ?><br />
                        <?=$reviews[$i]['review']?>
                        
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
        
    </div>
<!-- Main Footer -->
    <footer class="main-footer">
        <div class="footer-content">
            <!-- Footer Top Section -->
            <div class="footer-top">
                <!-- Brand Column -->
                <div class="footer-brand">
                    <div class="footer-logo">
                        <i class="fas fa-music"></i>
                        AMPLIFY
                    </div>
                    <p class="footer-description">
                        Discover, stream, and share music from millions of tracks worldwide. Your ultimate destination for music streaming with high-quality audio and personalized recommendations.
                    </p>
                    <div class="social-links">
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                        <a href="#" aria-label="Spotify"><i class="fab fa-spotify"></i></a>
                        <a href="#" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>

                <!-- Product Column -->
                <div class="footer-column">
                    <h3>Product</h3>
                    <ul>
                        <li><a href="#">Free Music</a></li>
                        <li><a href="#">Premium</a></li>
                        <li><a href="#">Family Plan</a></li>
                        <li><a href="#">Student Discount</a></li>
                        <li><a href="#">Download App</a></li>
                        <li><a href="#">Web Player</a></li>
                        <li><a href="#">Car Integration</a></li>
                    </ul>
                </div>

                <!-- Support Column -->
                <div class="footer-column">
                    <h3>Support</h3>
                    <ul>
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Community</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; 2025 AMPLIFY. All rights reserved.</p>
        </div>
    </footer>
    
     
    <script src="main.js"></script>
    <script>       

       $(document).ready(function(){
        // Comments
        $(".comment-submit").click(async function(){
            const input = document.getElementById('commentInput');
            const commentText = input.value.trim();
            
            if (commentText) {

                var thisStar=``;
                for(var p=1; p<=5; p++){
                    if(p<=currentRating)
                        thisStar+=`<span style="font-size:18px;" class="rating-overall yellow" >★</span>`;
                    else
                        thisStar+=`<span style="font-size:18px;" class="rating-overall" >★</span>`;
                }

                $(".comment-mine").remove();
                const commentsList = document.getElementById('commentsList');
                const newComment = document.createElement('div');
                newComment.className = 'comment comment-mine';
                newComment.innerHTML = `
                    <div class="comment-header">
                        <div class="comment-avatar"><?=substr($_SESSION['fullname'],0,1)?></div>
                        <div class="comment-author">@<?=explode("@",$_SESSION['email'])[0]?></div>
                        <div class="comment-time">just now</div>
                    </div>
                    <div class="comment-text">
                    `+thisStar+`<br />
                    ${commentText}</div>
                `;
                



            const formData = new FormData();
            formData.append("mid",<?=$_GET['vid']?>);
            formData.append("uid",<?=$_SESSION['userid']?>);
            formData.append("rating",currentRating);
            formData.append("review",$(".comment-input").val());

            try {
              const response = await fetch('post-review.php', {
                method: 'POST',
                body: formData
              });

              const result = await response.text(); // use .json() if server returns JSON
              console.log('Server says:', result);
            } catch (error) {
              console.error('Upload failed:', error);
            }




                commentsList.insertBefore(newComment, commentsList.firstChild);
                input.value = '';
            }
        });

       });//ready

       //var ratingTotal=`<span style="font-size:18px;" class="rating-overall yellow">★</span>'`;
       <?php
       if($totalReviews>0)
            $avg=$sumReviews/$totalReviews;
        else
            $avg=1;
       ?>
       var avg=parseInt(<?=$avg;?>)

       thisStar=``;
        for(var p=1; p<=5; p++){
            if(p<=avg)
                thisStar+=`<span class="rating-overall yellow" >★</span>`;
            else
                thisStar+=`<span class="rating-overall" >★</span>`;
        }

       $(".rating-total").html(thisStar);
       $(".rating-count").html(`(<?=$totalReviews?> reviews)`);


       setTimeout(() => {
            highlightStars(currentRating);
        }, 10); 
       
    </script>
</body>
</html>