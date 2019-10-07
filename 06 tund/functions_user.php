<?php
	//käivitame sessiooni
	session_start();
	//var_dump($_SESSION);
	
	function signUp($name, $surname, $email, $gender, $birthDate, $password){
		$notice = null;
		$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $conn->prepare("INSERT INTO vpusers3 (firstname, lastname, birthdate, gender, email, password) VALUES (?,?,?,?,?,?)");
		echo $conn->error;
		
		//valmistame parooli salvestamiseks ette
		$options = ["cost" => 12, "salt" => substr(sha1(rand()), 0, 22)];
		$pwdhash = password_hash($password,PASSWORD_BCRYPT, $options );

		$stmt->bind_param("sssiss", $name, $surname, $birthDate, $gender, $email, $pwdhash);

		if($stmt->execute()){
			$notice = "Uue kasutaja salvestamine õnnestus";
		} else {
			$notice = "Kasutaja salvestamisel tekkis tehniline viga: " .$stmt->error;
		}

		$stmt->close();
		$conn->close();
		return $notice;
	}
	function signIn($email, $password){
		$notice = "";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("SELECT password FROM vpusers3 WHERE email=?");
		echo $mysqli->error;
		$stmt->bind_param("s", $email);
		$stmt->bind_result($passwordFromDb);
		if($stmt->execute()){
			//kui päring õnnestus
			if($stmt->fetch()){
				//kasutaja on olemas
				if(password_verify($password, $passwordFromDb)){
					//kui salasõna klapib
					$stmt->close();
					$stmt = $mysqli->prepare("SELECT id, firstname, lastname FROM vpusers3 WHERE email=?");
					echo $mysqli->error;
					$stmt->bind_param("s", $email);
					$stmt->bind_result($idFromDb, $firstnameFromDb, $lastnameFromDb);
					$stmt->execute();
					$stmt->fetch();
					$notice = "Sisse logis " .$firstnameFromDb ." " .$lastnameFromDb ."!";
					//salvestame kasutaja nime sessioonimuutujasse
					$_SESSION["userID"] = $idFromDb;
					$_SESSION["userFirstname"] = $firstnameFromDb;
					$_SESSION["userLastname"] = $lastnameFromDb;
					
					
					$stmt->close();
					$mysqli->close();
					header("Location: home.php");
					exit();
				
				} else {
					$notice = "Vale salasõna!";
				}
			} else {
				$notice = "Sellist kasutajat (" .$email .") ei leitud!";  
			}
		} else {
			$notice = "Sisselogimisel tekkis tehniline viga!" .$stmt->error;
		}
		
		$stmt->close();
		$mysqli->close();
		return $notice;
	function userprofile
	}//sisselogimine lõppeb