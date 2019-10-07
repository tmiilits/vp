<?php

	require("../../../config_vp2019.php");
	require("functions_main.php");
	require("functions_user.php");
	$database = "if19_tauri_mi_1";
	
	//kui pole sisseloginud
	if(!isset($_SESSION["userFirstname"])){
		//siis jõuga sisselogimise lehele
		header("Location: page.php");
		exit();
	}	
	
	//väljalogimine
	if(isset($_GET["logout"])){
		session_destroy();
		header("Location: page.php");
		exit();
	}
	
	$userName = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];
	
	//lisame lehe päise
	require("header.php");
?>


<body>
	<?php
			echo "<h1>" .$userName ." koolitöö leht </h1>";
	?>
	<p>See leht on loodud koolis õppetöö raames ja ei sisalda tõsiseltvõetavat sisu!</p>
	<hr>
	<p><a href="?logout=1">Logi välja!</a> | <a href="userprofile.php">Kasutajaprofiil</a></p>
</body)
</html>
