
        let currentRating = 1;
        let isPlaying = false;

        // Rating System
        document.querySelectorAll('.star').forEach(star => {
            star.addEventListener('click', function() {
                var rating = parseInt(this.getAttribute('data-rating'));
                setRating(rating);
            });

            star.addEventListener('mouseenter', function() {
                var rating = parseInt(this.getAttribute('data-rating'));
                highlightStars(rating);
            });
        });

        document.getElementById('ratingStars').addEventListener('mouseleave', function() {
            //highlightStars(currentRating);
        });

        function setRating(rating) {
            currentRating = rating;
            highlightStars(rating);
            document.getElementById('ratingText').textContent = `You rated: ${rating} out of 5`;
        }

        function highlightStars(rating) {
            document.querySelectorAll('.star').forEach((star, index) => {
                if (index < rating) {
                    star.classList.add('active');
                } else {
                    star.classList.remove('active');
                }
            });
        }

        // Video Controls
        function togglePlay() {
            const btn = event.target;
            if (isPlaying) {
                btn.textContent = '▶';
                isPlaying = false;
            } else {
                btn.textContent = '⏸';
                isPlaying = true;
            }
        }

        function seekVideo(event) {
            const progressBar = event.currentTarget;
            const rect = progressBar.getBoundingClientRect();
            const clickX = event.clientX - rect.left;
            const percentage = (clickX / rect.width) * 100;
            
            const fill = progressBar.querySelector('.progress-fill');
            fill.style.width = percentage + '%';
        }

        function toggleFullscreen() {
            const player = document.getElementById('videoPlayer');
            if (!document.fullscreenElement) {
                player.requestFullscreen();
            } else {
                document.exitFullscreen();
            }
        }

        // Playlist Dropdown
        function togglePlaylistDropdown() {
            const dropdown = document.getElementById('playlistDropdown');
            dropdown.classList.toggle('show');
        }

        function addToPlaylist(playlistName) {
            alert(`Added to ${playlistName.replace(/([A-Z])/g, ' $1').replace(/^./, str => str.toUpperCase())} playlist!`);
            document.getElementById('playlistDropdown').classList.remove('show');
        }

        function createNewPlaylist() {
            const name = prompt('Enter playlist name:');
            if (name) {
                alert(`Created new playlist: ${name}`);
            }
            document.getElementById('playlistDropdown').classList.remove('show');
        }

        

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('playlistDropdown');
            const playlistBtn = event.target.closest('.playlist');
            
            if (!playlistBtn && !dropdown.contains(event.target)) {
                dropdown.classList.remove('show');
            }
        });

        // Initialize with 4 stars
        
