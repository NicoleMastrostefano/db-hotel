<!-- Partiamo da questo array di hotel.
https://www.codepile.net/pile/OEWY7Q1G
Stampare tutti i nostri hotel con tutti i dati disponibili.
Avremo un file PHP con il nostro “database” e un file con tutta la logica.
Attraverso un parametro GET da inserire direttamente nell'url (uno alla
volta), filtrare gli hotel che hanno un parcheggio, numero minimo di
stelle o massima lontananza dal centro.
Se non c'è un filtro, visualizzare come in precedenza tutti gli hotel -->


<?php include __DIR__ . '/database.php';

$parking = $_GET["parking"];
$vote = $_GET["vote"];
$dist_center = $_GET["distance_to_center"];

$filter_hotels = [];

// filtro solo gli hotel con il parcheggio
if (isset($parking)) {
  foreach ($hotels as $hotel) {
    if ($hotel["parking"]) {
      $filter_hotels[] = $hotel;
    }
  }
}
// filtro il voto identico a quello desiderato
elseif (isset($vote)) {
  foreach ($hotels as $hotel) {
    if ($hotel["vote"]==$vote){
      $filter_hotels[]=$hotel;
    }
  }
}
// filtro la distanza uguale o minore di quella desiderata
elseif (isset($dist_center)) {
  foreach ($hotels as $hotel ) {
    if($hotel["distance_to_center"]<=$dist_center){
      $filter_hotels[]=$hotel;
    }
  }
}
// Se non c'è un filtro, visualizzo tutti gli hotel
else {
  $filter_hotels = $hotels;
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <title>hotels</title>
  </head>
  <body>
    <div id="container">
    <?php
      foreach ($filter_hotels as $hotel) { ?>
        <h3><?php echo $hotel["name"]; ?></h3>
          <em><?php echo $hotel["description"] ; ?></em>
          <div>Parcheggio: <?php echo $hotel["parking"] ? 'Si' : 'No'; ?></div>
          <div>Voto: <?php echo $hotel["vote"] ; ?></div>
          <div>Distance to center: <?php echo $hotel["distance_to_center"] ; ?></div>
        <?php
      }
      ?>
    </div>
  </body>
</html>
