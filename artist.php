<?php 
include("session.php"); 
include("DB.class.php"); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Taylor Swift - KENTHA</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Your CSS -->
  <link rel="stylesheet" href="style.css" />
</head>

<body>

  <!-- Background Pattern -->
  <div class="bg-pattern"></div>

  <!-- Navigation Bar -->
  <?php include("header.php"); ?>

  <!-- Main Section -->
  <main>

    <!-- Hero Section -->
    <section class="hero">      
      <h1 class="page-title">ARTISTS</h1>
      <div class="title-underline"></div>




<!-- Artist Cards Grid -->
    <section class="artists-grid">

      <!-- Artist: Taylor Swift -->
       <?php
        $artists=$db->select("select * from artists order by artist_name");
        for($i=0; $i<count($artists); $i++)
        {
        ?>
          <a href="artist-songs.php?aid=<?=$artists[$i]['id']?>" class="artist-card">
            <div class="artist-image" style="background-image: url('images/artist/<?=$artists[$i]['picture']?>');"></div>
            <div class="artist-info">
              <h3 class="artist-name"><?=$artists[$i]['artist_name']?></h3>              
            </div>
          </a>
        <?php
        }
        ?>



    </section> <!-- End of artist grid -->

    <!-- Load More Button -->
    <br />&nbsp;
























  <?php include("footer.php"); ?>
    








    </section>

    








    <!-- Back to Top Button -->
    <button id="backToTop" onclick="scrollToTop()">⬆</button>

  </main>

  <!-- JavaScript -->
  <script src="main.js"></script>
</body>

</html>
