<?php
	require("../../../config_vp2019.php");
	require("functions_main.php");
	require("functions_user.php");
	$database = "if19_tauri_mi_1";

	$userName = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];
	
	$notice = null;
	$myDescription = null;


	//kui pole sisseloginud
	if(!isset($_SESSION["userID"])){
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
	if(isset($_POST["submitProfile"])){
		$notice = storeUserProfile($_POST["description"], $_POST["bgcolor"], $_POST["txtcolor"]);
		if(!empty($_POST["description"])){
			$myDescription = $_POST["description"];
		}
		$_SESSION["bgColor"] = $_POST["bgcolor"];
		$_SESSION["txtColor"] = $_POST["txtcolor"];
	} else {
		$myProfileDesc = showMyDesc();
		if(!empty($myProfileDesc)){
			$myDescription = $myProfileDesc;
		}
	}

	//lisame lehe päise
	require("header.php");
	
	
	/*<?php
	$pageHeaderHTML .= "\t" ."<style> \n";
	$pageHeaderHTML .= "\t \t body{background-color: " .$_SESSION["bgColor"] ."; \n";
	$pageHeaderHTML .= "\t \t color: " .$_SESSION["txtColor"] ."\n";
	$pageHeaderHTML .= "\t }";
	$pageHeaderHTML .= "</style> \n";
	echo $pageHeaderHTML;
	?>*/
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
		<label>Minu valitud taustavärv: </label><input name="bgcolor" type="color" value="<?php echo $_SESSION["bgColor"] ?>"><br>
		<label>Minu valitud tekstivärv: </label><input name="txtcolor" type="color" value="<?php echo $_SESSION["txtColor"] ?>"><br>
		<input name="submitProfile" type="submit" value="Salvesta profiil"><span><?php echo $notice; ?></span>
	</form>

	
	
	<p><a href="?logout=1">LOGI VALJA</a></p>
</body>
</html>
