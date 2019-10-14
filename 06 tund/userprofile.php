<?php
	require("../../../config_vp2019.php");
	require("functions_main.php");
	require("functions_user.php");
	$database = "if19_tauri_mi_1";

	$userName = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];
	$userID = $_SESSION["userID"];
	$mydescription = "";
	$mybgcolor = "";
	$mytxtcolor = "";
	$profilepicture = 0;
	$displayProfile = "";

	if(isset($_SESSION["userID"])) {
		$displayProfile = getUserProfile($userID);
		echo $displayProfile;
	}
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

	//salvestab kasutaja profiili
	if(isset($_POST["submitProfile"])) {
		$mydescription = $_POST["description"];
  	$mybgcolor = $_POST["bgcolor"];
    $mytxtcolor = $_POST["txtcolor"];
    //$profilepicture = $_POST["profilepicture"];
    setUserProfile($userID, $mydescription, $mybgcolor, $mytxtcolor, $profilepicture);
	}

	//lisame lehe päise
	//require("header.php");
?>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
	<p>See leht on loodud koolis õppetöö raames ja ei sisalda tõsiseltvõetavat sisu!</p>
	<hr>
	<p>Olete sisseloginud</p>

	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
		<label>Minu kirjeldus</label><br>
		<textarea rows="10" cols="80" name="description"><?php echo $_SESSION["description"]; ?></textarea>
		<br>
		<label>Minu valitud taustavärv: </label><input name="bgcolor" type="color" value="<?php echo $_SESSION["bgcolor"] ?>"><br>
		<label>Minu valitud tekstivärv: </label><input name="txtcolor" type="color" value="<?php echo $_SESSION["txtcolor"] ?>"><br>
		<input name="submitProfile" type="submit" value="Salvesta profiil">
	</form>

	<style>
	body {
    background-color: #e8eaf9;
	color: #000000;
    }
	</style>

	<p><a href="?logout=1">LOGI VALJA</a></p>
</body>
</html>
