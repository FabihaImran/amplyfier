<?php 
include("session.php"); 
include("DB.class.php"); 

$rows=$db->select("select a.*,b.artist_name,c.album_title from videos a left join artists b on b.id=a.artist_id left join albums c on c.id=a.album_id where media_type='audio' and a.id=".$_GET['vid']);



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AudioStream - Listen Audio Song</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" type="application/javascript"></script>
    <link rel="stylesheet" href="style.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .player-card {
            background: rgba(26, 26, 46, 0.8);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(74, 144, 226, 0.2);
            margin-bottom: 30px;
        }

        .album-art {
            width: 200px;
            height: 200px;
            background: linear-gradient(45deg, #2c3e50, #4a90e2);
            border-radius: 15px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }
        .album-art img{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .album-art .music-icon {
            font-size: 80px;
            color: rgba(255, 255, 255, 0.8);
        }

        .song-info {
            text-align: center;
            margin-bottom: 30px;
        }

        .song-title {
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 5px;
            color: #64b5f6;
        }

        .artist-name {
            font-size: 1.1rem;
            color: #b0bec5;
            margin-bottom: 10px;
        }

        .progress-container {
            margin: 20px 0;
        }

        .progress-bar {
            width: 100%;
            height: 6px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
            overflow: hidden;
            cursor: pointer;
        }

        .progress {
            height: 100%;
            background: linear-gradient(90deg, #4a90e2, #64b5f6);
            width: 0%;
            transition: width 0.3s ease;
        }

        .time-info {
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
            color: #b0bec5;
            margin-top: 5px;
        }

        .controls {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin: 30px 0;
        }

        .control-btn {
            background: rgba(74, 144, 226, 0.2);
            border: 2px solid #4a90e2;
            border-radius: 50%;
            color: #64b5f6;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .control-btn:hover {
            background: #4a90e2;
            color: white;
            transform: scale(1.1);
        }

        .play-btn {
            width: 60px;
            height: 60px;
            font-size: 24px;
        }

        .secondary-btn {
            width: 45px;
            height: 45px;
            font-size: 18px;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }

        .action-btn {
            background: rgba(74, 144, 226, 0.2);
            border: 1px solid #4a90e2;
            border-radius: 25px;
            color: #64b5f6;
            padding: 10px 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
        }

        .action-btn:hover {
            background: #4a90e2;
            color: white;
            transform: translateY(-2px);
        }

        .suggested-songs {
            background: rgba(26, 26, 46, 0.8);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(74, 144, 226, 0.2);
        }

        .suggested-songs h2 {
            color: #64b5f6;
            margin-bottom: 20px;
            text-align: center;
        }

        .song-item {
            display: flex;
            align-items: center;
            padding: 15px;
            margin: 10px 0;
            background: rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .song-item:hover {
            background: rgba(74, 144, 226, 0.2);
            border-color: #4a90e2;
            transform: translateX(5px);
        }

        .song-thumbnail {
            width: 50px;
            height: 50px;
            background: linear-gradient(45deg, #2c3e50, #4a90e2);
            border-radius: 8px;
            margin-right: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
        }

        .song-details {
            flex: 1;
        }

        .song-details h4 {
            color: #ffffff;
            margin-bottom: 5px;
        }

        .song-details p {
            color: #b0bec5;
            font-size: 0.9rem;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 1000;
            backdrop-filter: blur(5px);
        }

        .modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: linear-gradient(135deg, #1a1a2e, #16213e);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(74, 144, 226, 0.3);
            width: 90%;
            max-width: 400px;
        }

        .modal h3 {
            color: #64b5f6;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: #b0bec5;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid #4a90e2;
            border-radius: 8px;
            color: white;
            font-size: 1rem;
        }

        .form-group input:focus {
            outline: none;
            border-color: #64b5f6;
            box-shadow: 0 0 10px rgba(100, 181, 246, 0.3);
        }

        .form-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .form-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .create-btn {
            background: #4a90e2;
            color: white;
        }

        .create-btn:hover {
            background: #64b5f6;
        }

        .cancel-btn {
            background: rgba(255, 255, 255, 0.1);
            color: #b0bec5;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .cancel-btn:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            background: none;
            border: none;
            color: #b0bec5;
            font-size: 24px;
            cursor: pointer;
        }

        .close-btn:hover {
            color: #64b5f6;
        }

        @media (max-width: 600px) {
            .container {
                padding: 10px;
            }
            
            .player-card {
                padding: 20px;
            }
            
            .album-art {
                width: 150px;
                height: 150px;
            }
            
            .controls {
                gap: 15px;
            }
            
            .action-buttons {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>

  
  <?php include("header.php") ?>
 

    <div class="container">
        <!-- Audio Player Section -->
        <audio id="myAudio" src="uploaded/audios/<?=$rows[0]["video_code"]?>"></audio>
        <div class="video-section" style="max-width: 400px; margin: 0 auto;">
            <div class="player-card">
                <div class="album-art">
                    <!-- <div class="music-icon">♪</div> -->
                    <?php
                    if($rows[0]["thumbnail"]!=""){
                    ?>
                        <img src="images/audio/<?=$rows[0]["thumbnail"]?>">
                    <?php
                    }else{
                    ?>
                        <div class="music-icon">♪</div>
                    <?php
                    }
                    ?>
                </div>

                <div class="song-info">
                    <div class="song-title"><?=$rows[0]["video_title"]?></div>
                    <div class="artist-name"><?=$rows[0]["artist_name"]!="" ? $rows[0]["artist_name"] : "No Artist" ?></div>
                </div>

                <div class="progress-container">
                    <div class="progress-bar" onclick="seekTo(event)">
                        <div class="progress" id="progress"></div>
                    </div>
                    <div class="time-info">
                        <span id="currentTime">00:00</span>
                        <span id="totalTime">--:--</span>
                    </div>
                </div>

                <div class="controls">
                    <button class="control-btn secondary-btn" onclick="previousTrack()">⏮</button>
                    <button class="control-btn play-btn" onclick="togglePlay()" id="playBtn">▶</button>
                    <button class="control-btn secondary-btn" onclick="nextTrack()">⏭</button>
                </div>

                
            </div>
        </div>

        <!-- Video Info Section -->
        <div class="video-info-detail">
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
                $reviews=$db->select("select a.*,b.fullname,b.email from reviews a inner join users b on a.user_id=b.id inner join videos c on a.media_id=c.id where c.media_type='audio' and a.media_id=".$_GET['vid']);
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

        function convertSecToTime(mytime){
            var arr=(mytime/60);
            var mins=0;
            var secs=0;
            if(String(arr).indexOf(".")){ // if dot found
                mins=parseInt(String(arr).split(".")[0]);
                secs=mytime-(mins*60);
            }
            return mins.toString().padStart(2, '0')+":"+secs.toString().padStart(2, '0');

            // const totalSeconds = mytime;
            // const currentSeconds = Math.floor((currentProgress / 100) * totalSeconds);
            // const minutes = Math.floor(currentSeconds / 60);
            // const seconds = currentSeconds % 60;
            // return `${minutes}:${seconds.toString().padStart(2, '0')}`;

        }

       $(document).ready(function(){
        var myAudio = $("#myAudio")[0];
        // Comments
        myAudio.addEventListener("loadedmetadata", function () {
            const totalSeconds = Math.floor(myAudio.duration);
            //console.log(totalSeconds + " seconds");
            //console.log(convertSecToTime(totalSeconds));
            
            $("#totalTime").html(convertSecToTime(totalSeconds));
          });

        myAudio.addEventListener("timeupdate", function () {
          const totalSeconds = Math.floor(myAudio.duration);
          const seconds = Math.floor(myAudio.currentTime);
          $("#currentTime").html(convertSecToTime(seconds));
          var progPer=parseInt(seconds*100/totalSeconds);
          $(".progress-bar .progress").css("width",progPer+"%");
        });

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
       



        isPlaying = false;
        let currentProgress = 0;
        let progressInterval;

        function togglePlay() {
            const playBtn = document.getElementById('playBtn');
            if (isPlaying) {
                myAudio.pause();
                playBtn.innerHTML = '▶';
                
            } else {
                myAudio.play();
                playBtn.innerHTML = '⏸';
                
            }
            isPlaying = !isPlaying;
        }

        // function startProgressAnimation() {
        //     progressInterval = setInterval(() => {
        //         if (currentProgress < 100) {
        //             currentProgress += 0.5;
        //             document.getElementById('progress').style.width = currentProgress + '%';
        //             updateTime();
        //         } else {
        //             nextTrack();
        //         }
        //     }, 1000);
        // }

        function updateTime() {
            const totalSeconds = 227; // 3:47
            const currentSeconds = Math.floor((currentProgress / 100) * totalSeconds);
            const minutes = Math.floor(currentSeconds / 60);
            const seconds = currentSeconds % 60;
            document.getElementById('currentTime').textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
        }

        function seekTo(event) {
            if (isPlaying) {
                const totalSeconds = Math.floor(myAudio.duration);
                const seconds = Math.floor(myAudio.currentTime);

                const progressBar = event.currentTarget;
                const rect = progressBar.getBoundingClientRect();
                const clickX = event.clientX - rect.left;
                const width = rect.width;
                currentProgress = (clickX / width) * 100;

                //var progPer=parseInt(totalSeconds*(100/currentProgress));
                $(".progress-bar .progress").css("width",currentProgress+"%");

                myAudio.currentTime=Math.floor(totalSeconds*(currentProgress/100));
                myAudio.play();
            }
        }

        function previousTrack() {
            if (isPlaying) {                


                const totalSeconds = Math.floor(myAudio.duration);
                const seconds = Math.floor(myAudio.currentTime);
                myAudio.currentTime=myAudio.currentTime-10;
                if(myAudio.currentTime<0)myAudio.currentTime=0;

                myAudio.play();



            }
        }

        function nextTrack() {
            if (isPlaying) {                

                const totalSeconds = Math.floor(myAudio.duration);
                const seconds = Math.floor(myAudio.currentTime);
                myAudio.currentTime=myAudio.currentTime+10;
                if(myAudio.currentTime>totalSeconds)myAudio.currentTime=totalSeconds;

                myAudio.play();

            }
        }

        function downloadSong() {
            // Create a temporary download link
            const link = document.createElement('a');
            link.href = '#';
            link.download = 'Dream_Waves_-_Synthwave_Artists.mp3';
            link.click();
            
            // Show download notification
            alert('Download started! (This is a demo - no actual file will be downloaded)');
        }

        function openPlaylistModal() {
            document.getElementById('playlistModal').style.display = 'block';
            document.getElementById('playlistName').focus();
        }

        function closePlaylistModal() {
            document.getElementById('playlistModal').style.display = 'none';
            document.getElementById('playlistForm').reset();
        }

        function playSong(title, artist) {
            document.querySelector('.song-title').textContent = title;
            document.querySelector('.artist-name').textContent = artist;
            currentProgress = 0;
            document.getElementById('progress').style.width = '0%';
            document.getElementById('currentTime').textContent = '0:00';
            
            if (isPlaying) {
                
            }
        }

        

        // Close modal when clicking outside
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('playlistModal');
            if (event.target === modal) {
                closePlaylistModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closePlaylistModal();
            }
        });





    </script>
</body>
</html>