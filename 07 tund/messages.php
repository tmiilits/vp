<?php
  require("../../../config_vp2019.php");
  require("functions_main.php");
  require("functions_user.php");
  require("functions_message.php");
  $database = "if19_tauri_mi_1";
  $message = "";
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
  
	$userName = $_SESSION["userFirstname"] ." " .$_SESSION["userLastname"];
 
	$notice = null;
	$messagesHTML = null;
	
	$messagesHTML = readAllMessages();
  
  if(isset($_POST["message"])){
	if(isset($_POST["message"]) and !empty($_POST["message"])){
		$notice = storeMessage(test_input($_POST["message"]));
	}
  }
  require("header.php");
?>

<?php
	$pageHeaderHTML .= "\t" ."<style> \n";
	$pageHeaderHTML .= "\t \t body{background-color: " .$_SESSION["bgcolor"] ."; \n";
	$pageHeaderHTML .= "\t \t color: " .$_SESSION["txtcolor"] ."\n";
	$pageHeaderHTML .= "\t }";
	$pageHeaderHTML .= "</style> \n";
	echo $pageHeaderHTML;
	?>
<body>
  <?php
    echo "<h1>" .$userName ." koolitöö leht</h1>";
  ?>
  <p>See leht on loodud koolis õppetöö raames
  ja ei sisalda tõsiseltvõetavat sisu!</p>
  <hr>
  <p><a href="?logout=1">Logi välja!</a> | Tagasi <a href="home.php">avalehele</a></p>
  
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<label>Minu sõnum</label><br>
	<textarea rows="5" cols="50" name="message" placeholder="Lisa siia oma sõnum ..."></textarea>
	<br>
	<input name="submitMessage" type="submit" value="Salvesta sõnum"><span><?php echo $notice; ?></span>
	</form>
	<hr>
	<h2>Senised sõnumid</h2>
	<?php
		//echo $messagesHTML = readAllMessages();
		echo $messagesHTML = readMyMessages();
		
	?>
</body>
</html>





