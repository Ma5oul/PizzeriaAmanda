<!DOCTYPE>
<html>
<head>
  <script src="https://kit.fontawesome.com/5bd8ffc29f.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
</html>
<?php

function ordertype()
{
  echo "<span class='ordertype'>";
  echo "<span class='orderoption'><a href='index.php'>Startsida</a></span>";
  echo "<span class='orderoption'><a href='#pizza'>Pizza</a></span>";
  echo "<span class='orderoption'><a href='#kebab'>Kebab</a></span>";
  echo "<span class='orderoption'><a href='#kyckling'>Kyckling</a></span>";
  echo "<span class='orderoption'><a href='#sallad'>Sallad</a></span>";
  echo "</span>";
}

?>
