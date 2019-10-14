<?php
    $userName = "Tauri Miilits";
    $fullTimeNow = date("d.m.Y H:i:s");
    $hourNow = date("H");
    $partOfDay = "hägune aeg";
    if($hourNow < 8) {
      $partOfDay = "varane hommik";
    }
    if($hourNow >= 8 and $hourNow < 16) {
  			$partOfDay = "Sobiv aeg akadeemiliseks aktiivsuseks";
  	}
  	if($hourNow >= 16 and $hourNow < 22) {
  			$partOfDay = "Puhkeaeg";
  	}
  	if($hourNow > 22) {
  		$partOfDay = "Uneaeg";
  	}
?>

<!DOCTYPE html>
<html lang="et">
<head>
<meta charset="utf-8">
  <title>Tauri progeb</title>
    <?php
      echo $userName;
    ?>
<head/>
<body>
  <?php
    echo "<h1>" .$userName ."koolitöö leht </h1>";
  ?>
  <p>See leht on loodud koolis õppetöö raames ja ei sisalda tõsiseltvõetavat sisu!</p>
  <hr>
  <p> lehe avamise hetkel oli aeg:
    <?php
      echo $fullTimeNow;
    ?>
  .<p>
  <?php
    echo "<p>Lehe avamise hetkel oli " .$partOfDay . ".</p>";
  ?>
  <hr>
</body)

</html>
