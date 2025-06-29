<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin</title>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" type="application/javascript"></script>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
	<div class="header">
		<div class="logo"><a href="index.php">AMPLIFY</a></div>
		<div class="nav">
			<ul>
				<li><a href="index.php">Dashboard</a></li>
				<li><a href="">Users</a>
					<div class="subnav">
						<ul class="submenu">
							<li><a href="new-user.php">Add New</a></li>
							<li><a href="users.php">Users List</a></li>
						</ul>
					</div>
				</li>
				<li><a href="">Videos</a>
					<div class="subnav">
						<ul class="submenu">
							<li><a href="new-video.php">Add New</a></li>
							<li><a href="videos.php">Videos List</a></li>
						</ul>
					</div>
				</li>
				<li><a href="">Audio</a>
					<div class="subnav">
						<ul class="submenu">
							<li><a href="new-audio.php">Add New</a></li>
							<li><a href="audios.php">Audio List</a></li>
						</ul>
					</div>
				</li>
				<li><a href="">Artist</a>
					<div class="subnav">
						<ul class="submenu">
							<li><a href="new-artist.php">Add New</a></li>
							<li><a href="artists.php">Artist List</a></li>
						</ul>
					</div>
				</li>
				<li><a href="">Album</a>
					<div class="subnav">
						<ul class="submenu">
							<li><a href="new-album.php">Add New</a></li>
							<li><a href="albums.php">Album List</a></li>
						</ul>
					</div>
				</li>					
				<li><a href="index.php?do=logout">Logout</a></li>
			</ul>
		</div>
	</div>