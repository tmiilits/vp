<?php
	require("../../../config_vp2019.php");
	require("functions_film.php");
	$userName = "Tauri Miilits";
	$database = "if19_tauri_mi_1";


	$filmInfoHTML = readAllFilms();

		//lisame lehe päise
		//require("header.php");
?>


<body>
	<?php
			echo "<h1>" .$userName ." koolitöö leht </h1>";
	?>
  <p>See leht on loodud koolis õppetöö raames ja ei sisalda tõsiseltvõetavat sisu!</p>
  <hr>
  <h2>Eesti filmid</h2>
  <p>Praegu on andmebaasis järgmised filmid:</p>

  <?php
  	//echo "Server: " .$serverHost .", kasutaja: " .$serverUsername;
  	echo $filmInfoHTML;
  ?>

</body)>
</html>
