<?php
include 'navbar.php';
?>
<!DOCTYPE>
<html>
<head>
  <meta charset="UTF-8" content="width = device-width, initial-scale 1">
  <link rel="shortcut icon" type="image/png" href="/rsz_bird.png"/>
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script> -->

  <script defer src="cart.js"></script>

</head>
<body>
  <?php
  $pdo = new PDO("mysql:dbname=amanda;charset=utf8mb4;host=localhost", 'sqllab','Tomten2009');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  ordertype();

  if (isset($_POST['pris'])){
    $orderdag = date( "w");

    // sätter söndag till veckodag 7
    if ($orderdag==0){
      $orderdag=7;
    }

    $nu = date('H');
    $tele=$_POST['telefon'];

    // kolla dag och tid för beställning, mån-tor
    if (($orderdag >= 1) && ($orderdag <= 4) && ($nu < 10) || ($nu >= 21)){
      $message = "Vi har för närvarande stängt. Din order har inte gått igenom.";
      echo "<script type='text/javascript'>alert('$message');</script>";
    }

    // kolla dag och tid för beställning, fre-lör
    else if (($orderdag >= 5) && ($orderdag <= 6) && ($nu < 11) || ($nu >= 22)){
      $message = "Vi har för närvarande stängt. Din order har inte gått igenom.";
      echo "<script type='text/javascript'>alert('$message');</script>";
    }

    // kolla dag och tid för beställning, sön
    else if (($orderdag == 7) && ($nu < 12) || ($nu >= 21)){
      $message = "Vi har för närvarande stängt. Din order har inte gått igenom.";
      echo "<script type='text/javascript'>alert('$message');</script>";
    }

    else {
      foreach($_POST as $key => $value) {
        $orderpizza;
        $ordering;

        $add_pizza='CALL add_pizza (:pizza, :ing, :dag, :tel)';
        $stmt = $pdo->prepare($add_pizza);
        $stmt->bindParam(':pizza', $orderpizza);
        $stmt->bindParam(':ing', $ordering);
        $stmt->bindParam(':dag', $orderdag);
        $stmt->bindParam(':tel', $tele);

        if(preg_match('@^extraIng@', $key)) {
          $exIng[$key] = $value;
          $ordering = $exIng[$key];
        }

        if(preg_match('@^pizzaNamn@', $key)) {
          $pizza[$key] = $value;
          $orderpizza = $pizza[$key];
          echo $orderpizza;
          $stmt->execute();
        }

      }

      ?>
      <script>
      localStorage.clear();
      </script>
      <?php
    }
  }

  ?>


  <div id="cart" style="opacity: 1;">
    <h3 class="vagn"> Kundvagn </h3>
  </div>

  <div class="row">
    <div class="col-sm-6">
      <div class="meny-container">


        <h2 id="pizza">Pizza</h2>
        <?php
        foreach($pdo->query("SELECT * FROM meny WHERE typ='enkel' ORDER BY nr ASC;") as $pizza){
          ?>

          <div class="pizza" id="<?php echo'pizza-'.$pizza['namn']; ?>">

            <h3 id="pizza-namn"><?php echo $pizza['namn']; ?></h3>
            <p id="pizza-ingredienser"><?php echo $pizza['ingredienser']; ?></p>
            <p id="pizza-pris"><?php echo $pizza['pris']; ?>kr</p>

            <button class="addPizza" id="addPizza<?php $pizza['namn'] ?>">Lägg till</button>
          </div>

          <?php
        }

        foreach($pdo->query("SELECT * FROM meny WHERE typ='pizza' ORDER BY nr ASC;") as $pizza){
          ?>
          <div class="pizza" id="<?php echo'pizza-'.$pizza['namn']; ?>">

            <h3 id="pizza-namn"><?php echo $pizza['namn']; ?></h3>
            <p id="pizza-ingredienser"><?php echo $pizza['ingredienser']; ?></p>
            <p id="pizza-pris"><?php echo $pizza['pris']; ?>kr</p>

            <button class="addPizza" id="addPizza<?php $pizza['namn'] ?>">Lägg till</button>
          </div>
          <?php
        }

        foreach($pdo->query("SELECT * FROM meny WHERE typ='special' ORDER BY nr ASC;") as $pizza){
          ?>
          <div class="pizza" id="<?php echo'pizza-'.$pizza['namn']; ?>">

            <h3 id="pizza-namn"><?php echo $pizza['namn']; ?></h3>
            <p id="pizza-ingredienser"><?php echo $pizza['ingredienser']; ?></p>
            <p id="pizza-pris"><?php echo $pizza['pris']; ?>kr</p>

            <button class="addPizza" id="addPizza<?php $pizza['namn'] ?>">Lägg till</button>
          </div>
          <?php
        }

        foreach($pdo->query("SELECT * FROM meny WHERE typ='mexican' ORDER BY nr ASC;") as $pizza){
          ?>
          <div class="pizza" id="<?php echo'pizza-'.$pizza['namn']; ?>">

            <h3 id="pizza-namn"><?php echo $pizza['namn']; ?></h3>
            <p id="pizza-ingredienser"><?php echo $pizza['ingredienser']; ?></p>
            <p id="pizza-pris"><?php echo $pizza['pris']; ?>kr</p>

            <button class="addPizza" id="addPizza<?php $pizza['namn'] ?>">Lägg till</button>
          </div>
          <?php
        }
        ?>

        <h2 id="kebab">Kebab</h2>
        <?php
        foreach($pdo->query("SELECT * FROM meny WHERE typ='kebab' ORDER BY nr ASC;") as $pizza){
          ?>
          <div class="pizza" id="<?php echo'pizza-'.$pizza['namn']; ?>">

            <h3 id="pizza-namn"><?php echo $pizza['namn']; ?></h3>
            <p id="pizza-ingredienser"><?php echo $pizza['ingredienser']; ?></p>
            <p id="pizza-pris"><?php echo $pizza['pris']; ?>kr</p>

            <button class="addPizza" id="addPizza<?php $pizza['namn'] ?>">Lägg till</button>
          </div>
          <?php
        }
        ?>
        <h2 id="kyckling">Kyckling</h2>
        <?php
        foreach($pdo->query("SELECT * FROM meny WHERE typ='kyckling' ORDER BY nr ASC;") as $pizza){
          ?>
          <div class="pizza" id="<?php echo'pizza-'.$pizza['namn']; ?>">

            <h3 id="pizza-namn"><?php echo $pizza['namn']; ?></h3>
            <p id="pizza-ingredienser"><?php echo $pizza['ingredienser']; ?></p>
            <p id="pizza-pris"><?php echo $pizza['pris']; ?>kr</p>

            <button class="addPizza" id="addPizza<?php $pizza['namn'] ?>">Lägg till</button>
          </div>
          <?php
        }
        ?>
        <h2 id="sallad">Sallad</h2>
        <?php
        foreach($pdo->query("SELECT * FROM meny WHERE typ='sallad' ORDER BY nr ASC;") as $pizza){
          ?>
          <div class="pizza" id="<?php echo'pizza-'.$pizza['namn']; ?>">

            <h3 id="pizza-namn"><?php echo $pizza['namn']; ?></h3>
            <p id="pizza-ingredienser"><?php echo $pizza['ingredienser']; ?></p>
            <p id="pizza-pris"><?php echo $pizza['pris']; ?>kr</p>

            <button class="addPizza" id="addPizza<?php $pizza['namn'] ?>">Lägg till</button>
          </div>
          <?php
        }
        ?>
      </div>

    </div>
  </div>


  <div class="ing-show" style="display:none">
    <div class="ingrediens-container">
      <div class="ingbutton">
        <button class="sendtocart">Fortsätt</button>
        <button class="back">Backa</button><br><br>
        <h1>Ta bort:</h1>
        <textarea rows="4" placeholder="Ange allergier eller om du vill ta bort ingredienser"></textarea><br><br>
      </div>

      <select name="botten" id="botten">
      <?php
      foreach($pdo->query("SELECT * FROM botten ORDER BY id ASC;") as $botten){
        ?>
        <option value="<?php $botten['id'] ?>"> <?php echo $botten['namn'] ?> </option>
        <?php
      }
      ?>
      </select>

      <h1 id="addtext">Lägg till:</h1><br>
      <?php
      foreach($pdo->query("SELECT * FROM ingrediens;") as $ing){
        ?>
        <div class="ingrediens" id="<?php echo'ing-'.$ing['namn']; ?>">

          <h3 id="ing-namn"><?php echo $ing['namn']; ?></h3>
          <input type="checkbox" class="addIng" name="addIng" id="<?php echo'ing-'.$ing['namn']; ?>"/>
          <p id="ing-pris"><?php echo $ing['pris']; ?>kr</p>

        </div>
        <?php
      }
      ?>

    </div>
  </div>


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



  <a id='top' class="gotop" href="#pizza"> <i class="fas fa-angle-double-up fa-3x"></i> </a>

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



</body>
</html>
