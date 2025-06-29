<nav class="navbar">
    <a href="index.php"><div class="logo"><img src="images/logo.png" alt="" width="200px" height="80px"></div></a>

    <div class="nav-center">
      <a href="index.php"><i class="fa-solid fa-house" style="color: white; font-size: 20px;"></i></a>
      <div class="nav-links">
        <a href="videos.php">Videos</a>
        <a href="audios.php">Audios</a>
        <a href="artist.php"> Artist </a>
        <a href="album.php"> Album </a>
      </div>

    <div class="search-bar">
      <i class="fas fa-search"></i>
      <input type="text" id="searchInput" placeholder="What do you want to play?" value="<?=isset($_GET['q']) ? $_GET['q'] : "";?>" >
      <div class="search-go">Search</div>
    </div>

<div id="results" class="search-results"></div>

    </div>

    <div class="btn-sec">
      <?php
      if(isset($_SESSION['userid'])){
      ?>
        <span class="logged-in"><?=$_SESSION['fullname']?></span>
        <div class="button-box">
           <button  onclick="window.location.href='index.php?do=logout'" class="signin">Logout</button>
        </div>
      <?php
      }else{
      ?>
        <button onclick="window.location.href='login.php'" class="login">Log In</button> 
        <div class="button-box">
           <button  onclick="window.location.href='signup.php'" class="signin">Sign Up</button>
        </div>
      <?php
      }
      ?>
    </div>
  </nav>
  