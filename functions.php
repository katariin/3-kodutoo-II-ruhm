 <?php 
 
 	 
 	// uhenduse loomiseks kasuta 
 	require_once("config.php"); 
	
 	$database = "if15_jekavor"; 
	 
 	// paneme sessiooni kaima, saame kasutada $_SESSION muutujaid 
 	session_start(); 
  

	
	
	
 	 
 	// lisame kasutaja ab'i 
 	function createUser($create_email, $password_hash, $firstname, $lastname){ 
 		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]); 
 		 
		$stmt = $mysqli->prepare("INSERT INTO users_login (email, password, firstname, lastname) VALUES (?, ?, ?, ?)"); 
 		$stmt->bind_param("ssss", $create_email, $create_password_hash, $firstname, $lastname); 
 		$stmt->execute(); 
 		$stmt->close(); 
 		 
 		$mysqli->close();		 
 	} 
 	 
	 
	 
 	//logime sisse 
	function loginUser($email, $password_hash){ 
 		 
 		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]); 
 		 
 		$stmt = $mysqli->prepare("SELECT id, email FROM users_login WHERE email=? AND password=?"); 
	    $stmt->bind_param("ss", $email, $password_hash); 
 		$stmt->bind_result($id_from_db, $email_from_db); 
		$stmt->execute(); 
 		if($stmt->fetch()){ 
 			echo "kasutaja id=".$id_from_db; 
 			 
			$_SESSION["id_from_db"] = $id_from_db; 
 			$_SESSION["user_email"] = $email_from_db; 
 			 
 			//suunan kasutaja data.php lehele 
			header("Location: data.php"); 
 			 
 			 
		  }else{ 
 			echo "Wrong password or email!"; 
		} 
 		$stmt->close(); 
 		 
 		$mysqli->close(); 
    } 
	 
 	 

    	function createFashion($clothes, $brand, $size, $color){
		// globals on muutuja kхigist php failidest mis on ьhendatud
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("INSERT INTO fashion (clothes, brand, size, color) VALUES (?, ?, ?, ?)");
		$stmt->bind_param("issis", $_SESSION["id_from_db"], $clothes, $brand, $size, $color);
		
		$message = "";
		
		if($stmt->execute()){
			// see on tхene siis kui sisestus ab'i хnnestus
			$message = "Edukalt sisestatud andmebaasi";
			
		}else{
			// execute on false, miski lдks katki
			echo $stmt->error;
		}
		
		$stmt->close();
		$mysqli->close();
		return $message;
		
	}
	
	
	function getUserData(){
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("SELECT id, email FROM users_login");
		$stmt->bind_result($id, $user_email);
		$stmt->execute();
		
	
		$array = array();

		while($stmt->fetch()){
			
			// loon objekti iga while tsukli kord
			$fashion = new StdClass();
			$fashion->id = $id;
			$fashion->email = $user_email;
			
			// lisame selle massiivi
			array_push($array, $fashion);

			
		}
		
		$stmt->close();
		$mysqli->close();
		
		return $array;
		
		
	}
	
	
	/*
		function getFashionData(){
		
			$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
			
			$stmt = $mysqli->prepare("SELECT clothes, brand, size, color FROM fashion WHERE user_id = ?");
			$stmt->bind_param("s", $_SESSION["user_email"]);
			$stmt->bind_result($clothes, $brand, $size, $color);
			$stmt->execute();
			
			// tuhi massiiv kus hoiame objekte (1 rida andmeid)
			$array = array();

			while($stmt->fetch()){
				
				// loon objekti iga while tsukli kord
				$fashion = new StdClass();
				$fashion->clothes = $clothes;
				$fashion->brand = $brand;
				$fashion->size = $size;
				$fashion->color = $color;
				
				// lisame selle massiivi
				array_push($array, $fashion);

				
			}
			
			$stmt->close();
			$mysqli->close();
			
			return $array;
	}
	*/
	
	function getClothes(){
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("SELECT id, user_id, clothes, brand, size, color FROM fashion");
		$stmt->bind_result($id, $user_id, $clothes, $brand, $size, $color);
		$stmt->execute();
		
		// tuhi massiiv kus hoiame objekte (1 rida andmeid)
		$array = array();

		while($stmt->fetch()){
			
			// loon objekti iga while tsukli kord
			$fashionn = new StdClass();
			$fashionn->id = $id;
			$fashionn->user_id = $user_id;
			$fashionn->clothes = $clothes;
			$fashionn->brand = $brand;
			$fashionn->size = $size;
			$fashionn->color = $color;
			
			// lisame selle massiivi
			array_push($array, $fashionn);
			
		}
		
		$stmt->close();
		$mysqli->close();
		
		return $array;
		
		
	}
	
	
	function deleteClothes($id_to_be_deleted){
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("UPDATE fashion SET deleted=NOW() WHERE id=?");
		$stmt->bind_param("i", $id_to_be_deleted);
		
		if($stmt->execute()){
			// sai edukalt kustutatud
			header("Location: table.php");
			
		}
		
		$stmt->close();
		$mysqli->close();
		
	}
	
 	 
 
 
 
?>