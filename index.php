<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pizzeria Amanda </title>
  <link rel="stylesheet" href="main.css">
  <link rel="stylesheet" href="tabs.css">
  <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/5bd8ffc29f.js" crossorigin="anonymous"></script>
</head>
<body>
  <?php
  $pdo = new PDO("mysql:dbname=amanda;charset=utf8mb4;host=localhost", 'sqllab','Tomten2009');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  ?>

  <main>
    <section id="landing-page">
      <div class="nav-slider">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
      </div>

      <!-- <img src='bird.png'> <br> -->
      <header class="title-background">
        <h2 class="title"> PIZZERIA AMANDA <br> Töreboda </h2>
      </header>
      <!-- <img src='bird.png'> <br> -->
    </section>
    <section class="nav-slider-section">
      <button class="close-nav-slider"> X </button>
      <section class="nav-links-container">
        <ul>
          <!-- <li> <a class="nav-links" href='order.php' target="_blank"> Beställ online </a></li> -->
          <li> <a class="nav-links" href=#menu> Se vår meny </a></li> <!-- här ska order.php vara-->
          <li> <a class="nav-links" href=#open> Öppettider </a></li>
        </ul>
      </section>
    </section>

    <section id="menu">
      <h2 class="menu-title"> Meny </h2>
      <section class="tabs-contanier">
        <section class="tabs">  <!-- flikarna i sig -->
          <button class="tabHeader active-tab" data-tab="1">Pizza</button> <!-- data tab för att se active class, vilken länk de har klickat på-->
          <button class="tabHeader" data-tab="2">Kebab</button>
          <button class="tabHeader" data-tab="3">Kyckling</button>
          <button class="tabHeader" data-tab="4">Sallad</button>
          <button class="tabHeader" data-tab="5">Lunchpaket</button>
        </section>

        <section id="tabSection-1" class="tabSection show-tab">
          <?php
          echo "<ol class='pizza'>";
          echo "<h3>I samtliga pizzor ingår tomatsås och ost <br/> </h3>";
          echo "<h3>Familjepizza <b>190:-</b> </h3>";
          foreach($pdo->query("SELECT * FROM meny WHERE typ='enkel' ORDER BY nr ASC;") as $meny){
            echo "<li>";
            echo "<p>".$meny['namn']. " <b class='priser'>" .$meny['pris'].":- </b> </p> " .$meny['ingredienser']. " ";
            echo "</li>";
          }
          echo "<br/>";
          echo "<h3>Familjepizza <b>210:-</b> </h3>";
          foreach($pdo->query("SELECT * FROM meny WHERE typ='pizza' ORDER BY nr ASC;") as $meny){
            echo "<li>";
            echo "<p>".$meny['namn']. " <b class='priser'>" .$meny['pris'].":- </b> </p> " .$meny['ingredienser']. " ";
            echo "</li>";
          }
          echo "<br/>";
          echo "<h3>Familjepizza <b>230:-</b> </h3>";
          echo "<h3>Mexicanska pizzor (starka pizzor, nr 27-29)</h3>";
          foreach($pdo->query("SELECT * FROM meny WHERE typ='mexican' ORDER BY nr ASC;") as $meny){
            echo "<li>";
            echo "<p>".$meny['namn']. " <b class='priser'>" .$meny['pris'].":- </b> </p> " .$meny['ingredienser']. " ";
            echo "</li>";
          }
          echo "<br/>";
          echo "<h3>SPECIALPIZZOR</h3>";
          echo "<h3>Familjepizza <b>250:-</b> </h3>";
          foreach($pdo->query("SELECT * FROM meny WHERE typ='special' ORDER BY nr ASC;") as $meny){
            echo "<li>";
            echo "<p>".$meny['namn']. " <b class='priser'>" .$meny['pris'].":- </b> </p> " .$meny['ingredienser']. " ";
            echo "</li>";
          }

          echo "</ol>";
          ?>
        </section>

        <section id="tabSection-2" class="tabSection hide-tab">
          <?php
          echo "<ol class='pizza'>";
          foreach($pdo->query("SELECT * FROM meny WHERE typ='kebab' ORDER BY nr ASC;") as $meny){
            echo "<li>";
            echo "<p>".$meny['namn']. " <b class='priser'>" .$meny['pris'].":- </b> </p> " .$meny['ingredienser']. " ";
            echo "</li>";
          }
          echo "</ol>";
          ?>

        </section>

        <section id="tabSection-3" class="tabSection hide-tab">
          <?php
          echo "<ol class='pizza'>";
          foreach($pdo->query("SELECT * FROM meny WHERE typ='kyckling' ORDER BY nr ASC;") as $meny){
            echo "<li>";
            echo "<p>".$meny['namn']. " <b class='priser'>" .$meny['pris'].":- </b> </p> " .$meny['ingredienser']. " ";
            echo "</li>";
          }
          echo "</ol>";
          ?>

        </section>

        <section id="tabSection-4" class="tabSection hide-tab">
          <?php
          echo "<ol class='pizza'>";
          echo "<h3>I samtliga sallader ingår isbergssallad, röd paprika, purjolök, gurka, tomat, majs </h3>";
          foreach($pdo->query("SELECT * FROM meny WHERE typ='sallad' ORDER BY nr ASC;") as $meny){
            echo "<li>";
            echo "<p>".$meny['namn']. " <b class='priser'>" .$meny['pris'].":- </b> </p> " .$meny['ingredienser']. " ";
            echo "</li>";
          }
          echo "</ol>";
          ?>

        </section>

        <section id="tabSection-5" class="tabSection hide-tab">
          <ol class='lunch'>
            <h3> Lunchpaket 90:- vardagar kl 11-14 </h3>
            <p> Följande gäller för lunchpaket: </p>
            <li> Pizzor nr 1-40, ej nr 31 </li>
            <li> Kebab i bröd, Kebabtallrik </li>
            <li> Kyckling i bröd </li>
            <li> Sallader </li>
            <p> Sallad, dricka & kaffe ingår </p>
          </ol>


        </section>

      </section>
    </section>

    <!--  FOOTER -->
    <section id="restaurant-info">
      <section class ="info-container">
        <section class="address-content">
          <h2 class="restaurant-info-title"><i class="fas fa-map-marker-alt"></i>Adress </h2>
          <p class="address"> Kyrkogatan 15</p>
          <p class="address"> Töreboda, Sverige </p>
          <p class="address"> <i class="fas fa-phone"></i> Ring & beställ: <a href="tel:+46050612033"> 0506 - 120 33</a> </p>
        </section>

        <section id='open' class="business-hours">
          <h2 class="restaurant-info-title"><i class="fas fa-clock"></i> Öppettider </h2>
          <p class="hours"> Måndag-Torsdag: 11-21 </p>
          <p class="hours"> Fredag-Lördag: 11-22 </p>
          <p class="hours"> Söndag: 12-21 </p>

        </section>

        <section class="contact-content"> <!-- sociala medier -->
          <h2 class="restaurant-info-title"> <i class="fas fa-users"></i> Följ oss </h2>
          <p class="media"> <a href='https://www.facebook.com/PizzeriaAmandaToreboda/' target='_blank'> <i class='fab fa-facebook'></i> Facebook </a></p>
        </section>

      </section>

    </section>

    <a id='top' class="gotop" href="#landing-page"> <i class="fas fa-angle-double-up fa-3x"></i> </a>

    <script>

    window.onscroll = function() {scrollFunction()};

    function scrollFunction(){
      var goTop = document.getElementById('top');
      console.log(600<window.scrollY);

      if(600<window.scrollY){
        goTop.style.display = "block";
      }
      else{
        goTop.style.display = "none";
      }
    }


    </script>

  </main>
  <script src="main.js"></script>
  <script src="tabs.js"> </script>

</body>
</html>
