
<?php 
 	//koik AB'iga seonduv 
 	 
	// uhenduse loomiseks kasuta 
 	require_once("config.php"); 
 	$database = "if15_jekavor"; 
	 
 	// paneme sessiooni kaima, saame kasutada $_SESSION muutujaid 
	session_start(); 
  
	
	
		function createUser($create_name, $create_lastname, $create_email, $password_hash, $create_age){
		// globals on muutuja kõigist php failidest mis on ühendatud
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);

		$stmt = $mysqli->prepare("INSERT INTO users (name, lastname, email, password, gender) VALUES (?, ?, ?, ?, ?)");
					$stmt->bind_param("sssssi", $create_name, $create_lastname, $create_create_email, $create_password_hash, $create_age);
					$stmt->execute();
					$stmt->close(); 
					
						$mysqli->close();	
	}
 	 
	 
 	//logime sisse 

	 	function loginUser($email, $password_hash){
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("SELECT id, email FROM users WHERE email=? AND password=?");
		$stmt->bind_param("ss", $email, $password_hash);
		$stmt->bind_result($id_from_db, $email_from_db);
		$stmt->execute();
		if($stmt->fetch()){
			echo "kasutaja id=".$id_from_db;
			
			$_SESSION["id_from_db"] = $id_from_db;
			$_SESSION["user_email"] = $email_from_db;
			
			
			header("Location: data.php");
			
			
		}else{
			echo "Wrong password or email!";
		}
		$stmt->close();
		
		$mysqli->close();
	}
	 
 	 
 	 
 	function createFashion($clothes, $brand, $size, $color){
		// globals on muutuja kõigist php failidest mis on ühendatud
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("INSERT INTO fashion (user_id, clothes, brand, size, color) VALUES (?, ?, ?, ?, ?)");
		$stmt->bind_param("issis", $_SESSION["id_from_db"], $clothes, $brand, $size, $color);
		
		$message = "";
		
		if($stmt->execute()){
			// see on tõene siis kui sisestus ab'i õnnestus
			$message = "Edukalt sisestatud andmebaasi";
			
		}else{
			// execute on false, miski läks katki
			echo $stmt->error;
		}
		
		$stmt->close();
		$mysqli->close();
		return $message;
		
	}
 	 
 	 
 ?> 


<?php 
 	 
 	// functions.php 
 	require_once("config.php"); 
 	$database = "if15_jekavor"; 
 	  
		 function getClothes() {
			
			$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
			
			$stmt = $mysqli->prepare("SELECT id, user_id, clothes, brand, size, color FROM fashion");
			$stmt->bind_result($id, $user_id, $clothes, $brand, $size, $color);
			$stmt->execute();

			$array=array();
			
			
			while($stmt->fetch()){
				 // loon objekte
				$mode= new StdClass();
				$mode->id=$id;
				$mode->user_id = $user_id;
				$mode->clothes = $clothes;
				$mode->brand = $brand;
				$mode->size = $size;
				$mode->color = $color;
				
				    // lisame selle massiivi
					array_push($array, $mode);
				
			
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
				header("Location: table.php");
				
			}
			
            $stmt->close();
		    $mysqli->close();
	    }

 ?> 
