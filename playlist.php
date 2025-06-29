<?php 
include("session.php"); 
include("DB.class.php"); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AMPLIFY - Your Playlists</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="style.css">
</head>

<body>
  <?php include("header.php"); ?>

  <div class="main-content">
    <div class="page-header">
      <h1 class="page-title">Your Playlists</h1>
      <button class="create-playlist-btn" onclick="openModal()">
        <i class="fas fa-plus"></i>
        Create Playlist
      </button>
    </div>

    <div class="content-area">
  

    <div class="recent-section">
      <h2 class="section-title">Recently Played</h2>
      <div class="recent-playlists">
        <div class="recent-playlist">
          <img src="https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" alt="Chill Vibes">
          <div class="recent-info">
            <h4>Chill Vibes</h4>
            <p>45 songs • Last played 2 hours ago</p>
          </div>
        </div>
        <div class="recent-playlist">
          <img src="https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" alt="Workout Mix">
          <div class="recent-info">
            <h4>Workout Mix</h4>
            <p>32 songs • Last played yesterday</p>
          </div>
        </div>
        <div class="recent-playlist">
          <img src="https://images.unsplash.com/photo-1508700115892-45ecd05ae2ad?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" alt="Road Trip">
          <div class="recent-info">
            <h4>Road Trip Classics</h4>
            <p>67 songs • Last played 3 days ago</p>
          </div>
        </div>
        <div class="recent-playlist">
          <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" alt="Study Focus">
          <div class="recent-info">
            <h4>Study Focus</h4>
            <p>28 songs • Last played 1 week ago</p>
          </div>
        </div>
      </div>
    </div>

    <div class="playlist-grid">
      <div class="playlist-card">
        <div class="playlist-image">
          <img src="https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="My Favorites">
          <div class="playlist-overlay">
            <button class="play-btn">
              <i class="fas fa-play"></i>
            </button>
          </div>
        </div>
        <div class="playlist-info">
          <h3 class="playlist-title">My Favorites</h3>
          <div class="playlist-meta">
            <span>127 songs</span>
            <span>•</span>
            <span>8h 42m</span>
          </div>
          <p class="playlist-description">A collection of my all-time favorite tracks from various genres and eras.</p>
        </div>
      </div>

      <div class="playlist-card">
        <div class="playlist-image">
          <img src="https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Chill Vibes">
          <div class="playlist-overlay">
            <button class="play-btn">
              <i class="fas fa-play"></i>
            </button>
          </div>
        </div>
        <div class="playlist-info">
          <h3 class="playlist-title">Chill Vibes</h3>
          <div class="playlist-meta">
            <span>45 songs</span>
            <span>•</span>
            <span>3h 12m</span>
          </div>
          <p class="playlist-description">Perfect background music for relaxing, studying, or unwinding after a long day.</p>
        </div>
      </div>

      <div class="playlist-card">
        <div class="playlist-image">
          <img src="https://images.unsplash.com/photo-1508700115892-45ecd05ae2ad?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Workout Pump">
          <div class="playlist-overlay">
            <button class="play-btn">
              <i class="fas fa-play"></i>
            </button>
          </div>
        </div>
        <div class="playlist-info">
          <h3 class="playlist-title">Workout Pump</h3>
          <div class="playlist-meta">
            <span>32 songs</span>
            <span>•</span>
            <span>2h 8m</span>
          </div>
          <p class="playlist-description">High-energy tracks to keep you motivated during your workout sessions.</p>
        </div>
      </div>

      <div class="playlist-card">
        <div class="playlist-image">
          <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Road Trip">
          <div class="playlist-overlay">
            <button class="play-btn">
              <i class="fas fa-play"></i>
            </button>
          </div>
        </div>
        <div class="playlist-info">
          <h3 class="playlist-title">Road Trip Classics</h3>
          <div class="playlist-meta">
            <span>67 songs</span>
            <span>•</span>
            <span>4h 35m</span>
          </div>
          <p class="playlist-description">Classic hits and sing-along anthems perfect for long drives and adventures.</p>
        </div>
      </div>

      <div class="playlist-card">
        <div class="playlist-image">
          <img src="https://images.unsplash.com/photo-1459749411175-04bf5292ceea?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Party Mix">
          <div class="playlist-overlay">
            <button class="play-btn">
              <i class="fas fa-play"></i>
            </button>
          </div>
        </div>
        <div class="playlist-info">
          <h3 class="playlist-title">Party Mix</h3>
          <div class="playlist-meta">
            <span>89 songs</span>
            <span>•</span>
            <span>5h 23m</span>
          </div>
          <p class="playlist-description">Upbeat party songs and dance hits to get everyone moving on the dance floor.</p>
        </div>
      </div>

      <div class="playlist-card">
        <div class="playlist-image">
          <img src="https://images.unsplash.com/photo-1514525253161-7a46d19cd819?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" alt="Indie Rock">
          <div class="playlist-overlay">
            <button class="play-btn">
              <i class="fas fa-play"></i>
            </button>
          </div>
        </div>
        <div class="playlist-info">
          <h3 class="playlist-title">Indie Rock Discovery</h3>
          <div class="playlist-meta">
            <span>54 songs</span>
            <span>•</span>
            <span>3h 47m</span>
          </div>
          <p class="playlist-description">Discover amazing indie rock bands and hidden gems from the underground scene.</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Create Playlist Modal -->
  <div class="modal" id="createModal">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title">Create New Playlist</h2>
        <button class="close-btn" onclick="closeModal()">
          <i class="fas fa-times"></i>
        </button>
      </div>
      
      <form id="playlistForm">
        <div class="form-group">
          <label for="playlistName">Playlist Name</label>
          <input type="text" id="playlistName" placeholder="Enter playlist name..." required>
        </div>
        
        <div class="form-group">
          <label for="playlistDescription">Description (Optional)</label>
          <textarea id="playlistDescription" placeholder="Add a description for your playlist..."></textarea>
        </div>
        
        <div class="modal-buttons">
          <button type="button" class="btn-cancel" onclick="closeModal()">Cancel</button>
          <button type="submit" class="btn-create">Create Playlist</button>
        </div>
      </form>
    </div>

  </div>


    <?php include("footer.php"); ?>

    
        </div>
  <!-- Back to Top Button -->
  <button id="backToTop" onclick="scrollToTop()">⬆</button>

<script src="main.js"></script>
</body>

</html>