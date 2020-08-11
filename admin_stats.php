<!DOCTYPE>
<html>
<head>
  <meta charset="UTF-8" content="width = device-width, initial-scale 1">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
</head>
<body>
  <?php
  $pdo = new PDO("mysql:dbname=amanda;charset=utf8mb4;host=localhost", 'sqllab','Tomten2009');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  ?>

  <h2>Populära pizzor</h2>
  <?php
  $allPizza;
  foreach($pdo->query("SELECT COUNT(*) FROM stats") as $stats){
    $allPizza=$stats;
  }
   ?>

  <table>
    <th>Pizza</th>
    <th>Antal</th>
    <?php
    foreach($pdo->query("SELECT pizza, COUNT(*) FROM stats GROUP BY pizza ORDER BY COUNT(*) DESC") as $statsPizza){
      echo "<tr>";
      // echo "<td>" .$statsPizza['pizza']. " - " .$statsPizza['COUNT(*)']. "</td>";
      echo "<td>".$statsPizza['pizza']."</td>";
      echo "<td>".$statsPizza['COUNT(*)']."</td>";
      echo "</tr>";
    }
    ?>
  </table>

</body>
</html>
