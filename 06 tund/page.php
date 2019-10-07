<?php
	require("../../../config_vp2019.php");
	require("functions_main.php");
	require("functions_user.php");
	$database = "if19_tauri_mi_1";
	
	$userName = "Sisselogimata kasutaja";
	
	$notice = "";
	$email = "";
	$emailError = "";
	$passwordError = "";
	
	$photoDir = "../photos/";
	$picFileTypes = ["image/jpeg", "image/png"];
	$weekDayNamesET =["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
	$monthNamesET = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
	$fullTimeNow = date("d.m.Y H:i:s");
	$TimeNow = date("H.i.s");
	$weekDayNow = date("N");
	$dateNow = date("d");
	$monthNow = date("m");
	$yearNow = date("Y");
	$hourNow = date("H");
	$minutesNow = date("i");
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

		//info semestri kulgemise kohta
		$semesterStart = new DateTime("2019-9-2");
		$semesterEnd = new DateTime("2019-12-13");
		$semesterDuration = $semesterStart->diff($semesterEnd);
		$today = new DateTime ("now");
		$fromSemesterStart = $semesterStart->diff($today);
		//var_dump($fromSemesterStart);
		$semesterInfoHTML = "<p>Siin peaks olema info semestri kulgemise kohta!</p>";
		$elapsedValue = $fromSemesterStart->format("%r%a");
		$durationValue = $semesterDuration->format("%r%a");
		//echo $testValue;
		//<meter min="0" max="155" value="33"tmii>Väärtus</meter>
		if($elapsedValue >= 0 and $elapsedValue <= $durationValue){
			$semesterInfoHTML = "<p>Semester on täies hoos: ";
			$semesterInfoHTML .= '<meter min="0" max="' .$durationValue .'" ';
			$semesterInfoHTML .= 'value="' .$elapsedValue .'">';
			$semesterInfoHTML .= round($elapsedValue / $durationValue * 100, 1) ."%";
			$semesterInfoHTML .="</meter>";
			$semesterInfoHTML .="</p>";
		}
		if($elapsedValue < 0){
			$semesterInfoHTML = "<p>Semester pole veel alanud.</p>";
		}
		if($elapsedValue > $durationValue){
			$semesterInfoHTML = "<p>Semester on läbi!</p>";
		}

		$kuupaev = "<p>Lehe avamise hetkel oli aeg: " .$weekDayNamesET[$weekDayNow - 1] .", " . $dateNow .". " .$monthNamesET[$monthNow - 1] ." " .$yearNow ." kell " .$TimeNow . "</p>";

		//foto lisamine lehele
		$allPhotos = [];
		$dirContent = array_slice(scandir($photoDir), 2);
		//var_dump($dirContent);
		foreach ($dirContent as $file){
				$fileInfo = getImagesize($photoDir .$file);
				//var_dump($fileInfo);
				if(in_array($fileInfo["mime"], $picFileTypes) == true){
						array_push($allPhotos, $file);
				}
		}


		//var_dump($allPhotos);
		$picCount = count($allPhotos);
		$picNum = mt_rand(0, ($picCount - 1));
		//echo $allPhotos[$picNum];
		$photoFile = $photoDir .$allPhotos[$picNum];
		$randomImgHTML = '<img src="' .$photoFile .'" alt="TLÜ Terra õppehoone">';
		
		if(isset($_POST["login"])){
			if (isset($_POST["email"]) and !empty($_POST["email"])){
				$email = test_input($_POST["email"]);
			} else {
				$emailError = "Palun sisesta kasutajatunnusena e-posti aadress!";
			}
	  
			if (!isset($_POST["password"]) or strlen($_POST["password"]) < 8){
				$passwordError = "Palun sisesta parool, vähemalt 8 märki!";
			}
	  
			if(empty($emailError) and empty($passwordError)){
				$notice = signIn($email, $_POST["password"]);
			} else {
				$notice = "Ei saa sisse logida!";
			}
		}
		
		//lisame lehe päise
		require("header.php");
?>


<body>
	<?php
			echo "<h1>" .$userName ." koolitöö leht </h1>";
	?>
	<p>See leht on loodud koolis õppetöö raames ja ei sisalda tõsiseltvõetavat sisu!</p>
	<?php
			echo $semesterInfoHTML;
	?>

 	<hr>
	<?php
  		echo $kuupaev;
	?>
	<p>
	<?php
  		echo "<p>Lehe avamise hetkel oli " .$partOfDay . ".</p>";
	?>
	<hr>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<label>E-mail (kasutajatunnus):</label><br>
		<input type="email" name="email" value="<?php echo $email; ?>">&nbsp;<span><?php echo $emailError; ?></span><br>

		<label>Salasõna:</label><br>
		<input name="password" type="password">&nbsp;<span><?php echo $passwordError; ?></span><br>

		<input name="login" type="submit" value="Logi sisse">&nbsp;<span><?php echo $notice; ?>
	</form>
	<h2>Loo kasutaja</h2>
	<p>Loo endale meie lehe <a href="newuser.php">kasutajakonto</a></p>
	<hr>
	<?php
  		echo $randomImgHTML;
	?>
</body)
</html>
