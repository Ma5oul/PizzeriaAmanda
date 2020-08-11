<!DOCTYPE>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
  <h2>Jimmy Böljas Favoritpizzeria</h2>
  <pre>

    <?php

    $pdo = new PDO("mysql:dbname=amanda;charset=utf8mb4;host=localhost", 'sqllab','Tomten2009');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Meny

    echo "<ol>";
    echo "<h3>Pizzor</h3>";
    echo "I samtliga pizzor ingår tomat och ost.<br><br>";
    echo "Pizzor 1-4 <b>85:-</b> Familjepizza <b>190:-</b><br><br>";
    foreach($pdo->query("SELECT * FROM meny WHERE typ='enkel' ORDER BY nr ASC;") as $meny){
      echo "<li>";
      echo "<b>".$meny['namn']. "</b> " .$meny['ingredienser']."";
      echo "</li>";
    }
    echo "<br>Pizzor 5-25 <b>90:-</b> Familjepizza <b>210:-</b><br><br>";
    foreach($pdo->query("SELECT * FROM meny WHERE typ='pizza' ORDER BY nr ASC;") as $meny){
      echo "<li>";
      echo "<b>".$meny['namn']. "</b> " .$meny['ingredienser']."";
      echo "</li>";
    }
    echo "<br>Pizzor 26-40 <b>95:-, ej nr 31*</b> Familjepizza <b>230:-</b><br><br>";
    foreach($pdo->query("SELECT * FROM meny WHERE typ='mexican' AND nr=1;") as $meny){
      echo "<li>";
      echo "<b>".$meny['namn']. "</b> " .$meny['ingredienser']."";
      echo "</li>";
    }
    echo "<h3>MEXICANSKA PIZZOR (starka pizzor)</h3>";
    foreach($pdo->query("SELECT * FROM meny WHERE typ='mexican' AND nr BETWEEN 2 AND 4 ORDER BY nr ASC;") as $meny){
      echo "<li>";
      echo "<b>".$meny['namn']. "</b> " .$meny['ingredienser']."";
      echo "</li>";
    }
    echo "<h3>PIZZOR</h3>";
    foreach($pdo->query("SELECT * FROM meny WHERE typ='mexican' AND nr>=5 ORDER BY nr ASC;") as $meny){
      echo "<li>";
      if ($meny['nr']==31){
        echo "<b>*".$meny['namn']. "</b> " .$meny['ingredienser']. " <b>" .$meny['pris'].":-</b>";
      }
      else {
        echo "<b>".$meny['namn']. "</b> " .$meny['ingredienser']."";
      }
      echo "</li>";
    }
    echo "<h3>SPECIALPIZZOR</h3>";
    echo "Pizzor 41-54 <b>105:-, ej nr 42*</b> Familjepizza <b>250:-</b><br><br>";
    foreach($pdo->query("SELECT * FROM meny WHERE typ='special' ORDER BY nr ASC;") as $meny){
      echo "<li>";
      if ($meny['nr']==42){
        echo "<b>*".$meny['namn']. "</b> " .$meny['ingredienser']. " <b>" .$meny['pris'].":-</b>";
      }
      else {
        echo "<b>".$meny['namn']. "</b> " .$meny['ingredienser']. " ";
      }
      echo "</li>";
    }
    echo "</ol>";
    echo "<ol>";
    echo "<h3>KEBAB</h3>";
    foreach($pdo->query("SELECT * FROM meny WHERE typ='kebab' ORDER BY nr ASC;") as $meny){
      echo "<li>";
      echo "<b>".$meny['namn']. "</b> " .$meny['ingredienser']. " <b>" .$meny['pris'].":-</b>";
      echo "</li>";
    }
    echo "</ol>";
    echo "<ol>";
    echo "<h3>KYCKLING</h3>";
    foreach($pdo->query("SELECT * FROM meny WHERE typ='kyckling' ORDER BY nr ASC;") as $meny){
      echo "<li>";
      echo "<b>".$meny['namn']. "</b> " .$meny['ingredienser']. " <b>" .$meny['pris'].":-</b>";
      echo "</li>";
    }
    echo "</ol>";
    echo "<ol>";
    echo "<h3>SALLADER</h3>";
    echo "<b>GRUNDSALLAD:</b> Isbergssallad, röd paprika, purjolök, gurka, tomat, majs. Ingår i alla sallader.<br><br>";
    foreach($pdo->query("SELECT * FROM meny WHERE typ='Sallad' ORDER BY nr ASC;") as $meny){
      echo "<li>";
      echo "<b>".$meny['namn']. "</b> " .$meny['ingredienser']. " <b>" .$meny['pris'].":-</b>";
      echo "</li>";
    }
    echo "</ol>";

    // Meny slut

    ?>

  </pre>
</body>
</html>
