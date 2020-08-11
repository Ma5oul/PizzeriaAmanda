<?php
$pdo = mysqli_connect('localhost', 'sqllab','Tomten2009', 'amanda');
$pizza = mysqli_query($pdo, "SELECT pizza, COUNT(pizza) AS antal FROM stats GROUP BY pizza ORDER BY antal ASC");
//$dag = mysqli_query($pdo, "SELECT COUNT(*), dag FROM stats GROUP BY dag ORDER BY COUNT(*) DESC");
//$tid = mysqli_query($pdo, "SELECT {fn extract(hour FROM tid)} as tider, count(*) AS antal, dag FROM stats GROUP BY tider ORDER BY antal DESC");
?>

<!DOCTYPE html>
<html lang="se">
<head>
  <meta charset="UTF-8">
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
  google.charts.load('current', {'packages':['bar']});
  google.charts.setOnLoadCallback(drawChart1);
  google.charts.setOnLoadCallback(drawChart2);
  google.charts.setOnLoadCallback(drawChart3);

  //pizzor
  function drawChart1() {
    var data = google.visualization.arrayToDataTable([
      ['Pizza', 'Antal', 'Pizza'],
      <?php
      if(mysqli_num_rows($pizza)>0){
        while($row = mysqli_fetch_array($pizza)){
          echo "['".$row['pizza']."', '".$row['antal']."', ['".$row['pizza']."']],";
        }
      }
      ?>
    ]);

    var options = {
      chart: {
        title: 'Populära pizzor',
        subtitle: '',
      }
    };

    var chart = new google.charts.Bar(document.getElementById('pizza'));

    chart.draw(data, google.charts.Bar.convertOptions(options));
  }

  //dagar
  // function drawChart2() {
  //   var data = google.visualization.arrayToDataTable([
  //     ['Dag', 'Antal'],
  //     <?php
  //     if(mysqli_num_rows($dag)>0){
  //       while($row = mysqli_fetch_array($dag)){
  //         echo "['".$row['dag']."',['".$row['COUNT(*)']."']],";
  //       }
  //     }
  //     ?>
  //   ]);
  //
  //   var options = {
  //     chart: {
  //       title: 'Populära dagar',
  //       subtitle: '',
  //     }
  //   };
  //
  //   var chart = new google.charts.Bar(document.getElementById('dag'));
  //
  //   chart.draw(data, google.charts.Bar.convertOptions(options));
  // }
  //
  // //tider
  // function drawChart3() {
  //   var data = google.visualization.arrayToDataTable([
  //     ['Tid', 'Antal'],
  //     <?php
  //     if(mysqli_num_rows($tid)>0){
  //       while($row = mysqli_fetch_array($tid)){
  //         echo "['".$row['tider']."',['".$row['antal']."']],";
  //       }
  //     }
  //     ?>
  //   ]);
  //
  //   var options = {
  //     chart: {
  //       title: 'Populära tider',
  //       subtitle: 'Vilka timmar beställs det mest',
  //     }
  //   };
  //
  //   var chart = new google.charts.Bar(document.getElementById('tid'));
  //
  //   chart.draw(data, google.charts.Bar.convertOptions(options));
  // }



</script>
</head>
<body>
  <div id="pizza" style="width: 800px; height: 500px;"></div>
  <div id="dag" style="width: 800px; height: 500px;"></div>
    <div id="tid" style="width: 800px; height: 500px;"></div>
</body>
</html>
