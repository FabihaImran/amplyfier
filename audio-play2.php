<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Player</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a2e 50%, #16213e 100%);
            color: #ffffff;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header h1 {
            font-size: 2.5rem;
            background: linear-gradient(45deg, #4a90e2, #64b5f6);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 10px;
        }

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
            width: 35%;
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
    <div class="container">
        <div class="header">
            <h1>Music Player</h1>
            <p>Enjoy your favorite tunes</p>
        </div>

        <div class="player-card">
            <div class="album-art">
                <div class="music-icon">♪</div>
            </div>

            <div class="song-info">
                <div class="song-title">Dream Waves</div>
                <div class="artist-name">Synthwave Artists</div>
            </div>

            <div class="progress-container">
                <div class="progress-bar" onclick="seekTo(event)">
                    <div class="progress" id="progress"></div>
                </div>
                <div class="time-info">
                    <span id="currentTime">1:24</span>
                    <span id="totalTime">3:47</span>
                </div>
            </div>

            <div class="controls">
                <button class="control-btn secondary-btn" onclick="previousTrack()">⏮</button>
                <button class="control-btn play-btn" onclick="togglePlay()" id="playBtn">▶</button>
                <button class="control-btn secondary-btn" onclick="nextTrack()">⏭</button>
            </div>

            <div class="action-buttons">
                <button class="action-btn" onclick="downloadSong()">
                    <span>⬇</span>
                    Download
                </button>
                <button class="action-btn" onclick="openPlaylistModal()">
                    <span>+</span>
                    Add to Playlist
                </button>
            </div>
        </div>

        
    </div>

    <!-- Playlist Modal -->
    <div class="modal" id="playlistModal">
        <div class="modal-content">
            <button class="close-btn" onclick="closePlaylistModal()">&times;</button>
            <h3>Create New Playlist</h3>
            <form id="playlistForm">
                <div class="form-group">
                    <label for="playlistName">Playlist Name:</label>
                    <input type="text" id="playlistName" placeholder="Enter playlist name" required>
                </div>
                <div class="form-group">
                    <label for="playlistDescription">Description (optional):</label>
                    <input type="text" id="playlistDescription" placeholder="Describe your playlist">
                </div>
                <div class="form-buttons">
                    <button type="submit" class="form-btn create-btn">Create Playlist</button>
                    <button type="button" class="form-btn cancel-btn" onclick="closePlaylistModal()">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let isPlaying = false;
        let currentProgress = 35;
        let progressInterval;

        function togglePlay() {
            const playBtn = document.getElementById('playBtn');
            if (isPlaying) {
                playBtn.innerHTML = '▶';
                clearInterval(progressInterval);
            } else {
                playBtn.innerHTML = '⏸';
                startProgressAnimation();
            }
            isPlaying = !isPlaying;
        }

        function startProgressAnimation() {
            progressInterval = setInterval(() => {
                if (currentProgress < 100) {
                    currentProgress += 0.5;
                    document.getElementById('progress').style.width = currentProgress + '%';
                    updateTime();
                } else {
                    nextTrack();
                }
            }, 1000);
        }

        function updateTime() {
            const totalSeconds = 227; // 3:47
            const currentSeconds = Math.floor((currentProgress / 100) * totalSeconds);
            const minutes = Math.floor(currentSeconds / 60);
            const seconds = currentSeconds % 60;
            document.getElementById('currentTime').textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
        }

        function seekTo(event) {
            const progressBar = event.currentTarget;
            const rect = progressBar.getBoundingClientRect();
            const clickX = event.clientX - rect.left;
            const width = rect.width;
            currentProgress = (clickX / width) * 100;
            document.getElementById('progress').style.width = currentProgress + '%';
            updateTime();
        }

        function previousTrack() {
            currentProgress = 0;
            document.getElementById('progress').style.width = '0%';
            document.getElementById('currentTime').textContent = '0:00';
            if (isPlaying) {
                clearInterval(progressInterval);
                startProgressAnimation();
            }
        }

        function nextTrack() {
            currentProgress = 0;
            document.getElementById('progress').style.width = '0%';
            document.getElementById('currentTime').textContent = '0:00';
            if (isPlaying) {
                clearInterval(progressInterval);
                startProgressAnimation();
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
                clearInterval(progressInterval);
                startProgressAnimation();
            }
        }

        // Handle playlist form submission
        document.getElementById('playlistForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const playlistName = document.getElementById('playlistName').value;
            const playlistDescription = document.getElementById('playlistDescription').value;
            
            alert(`Playlist "${playlistName}" created successfully!${playlistDescription ? '\nDescription: ' + playlistDescription : ''}`);
            closePlaylistModal();
        });

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