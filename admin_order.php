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

  if(isset($_POST['delete'])){
    $querystring='DELETE FROM ordertblStarted WHERE id=:id;';
    $stmt = $pdo->prepare($querystring);
    $stmt->bindParam(':id', $_POST['id']);
    $stmt->execute();
  }

  if(isset($_POST['start'])){
    $querystring='CALL changeOrdertbl (:id, :pizza, :tid);';
    $stmt = $pdo->prepare($querystring);
    $stmt->bindParam(':id', $_POST['id']);
    $stmt->bindParam(':pizza', $_POST['pizza']);
    $stmt->bindParam(':tid', $_POST['tid']);
    $stmt->execute();
  }


  ?>

  <h2>Beställningar</h2>


  <table class="adminOrder">
    <th>Tid</th>
    <th>Pizza</th>
    <?php
    foreach($pdo->query("SELECT id, pizza, tid FROM ordertbl ORDER BY tid ASC") as $neworder){
      echo "<tr>";
      echo "<td>"; echo date('y-m-d H:i',strtotime($neworder['tid'])); echo "</td>";
      echo "<td>".$neworder['pizza']."</td>";
      echo "<form action='admin_order.php' method='POST'>";
      echo "<td><input type='submit' name='start' value='Påbörja' /></td>";
      echo "<input type='hidden' name='id' value='".$neworder['id']."'>";
      echo "<input type='hidden' name='pizza' value='".$neworder['pizza']."'>";
      echo "<input type='hidden' name='tid' value='".$neworder['tid']."'>";
      echo "</form>";
      echo "</tr>";
    }
    ?>
  </table>


  <h2>Påbörjade</h2>
  <table class="adminOrder">
    <th>Tid</th>
    <th>Pizza</th>
    <?php
    foreach($pdo->query("SELECT id, pizza, tid FROM ordertblStarted ORDER BY tid ASC") as $order){
      echo "<tr>";
      echo "<td>"; echo date('y-m-d H:i',strtotime($order['tid'])); echo "</td>";
      echo "<td>".$order['pizza']."</td>";
      echo "<form action='admin_order.php' method='POST'>";
      echo "<td><input type='submit' name='delete' style='color: red' value='Klar' /></td>";
      echo "<input type='hidden' name='id' value='".$order['id']."'>";
      echo "</form>";
      echo "</tr>";
    }
    ?>
  </table>

</body>
</html>
