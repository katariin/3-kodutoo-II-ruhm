
<?php 
  
 	require_once("config.php"); 
 	$database = "if15_jekavor"; 
	 
 	function getSingleClothes($edit_id){ 
 		 
 		//echo "id on ".$edit_id; 
		 
 		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]); 
 		 
 		$stmt = $mysqli->prepare("SELECT clothes, brand, size, color FROM fashion WHERE id=?");

		$stmt->bind_param("i", $edit_id);
		$stmt->bind_result($clothes, $brand, $size, $color);
		$stmt->execute();
 		
 		$fashionn = new Stdclass(); 
 		 
 		//saime uhe rea andmeid 
 		if($stmt->fetch()){
			//saan siin alles kasutada bind_result muutujaid
			$fashionn->clothes = $clothes;
			$fashionn->brand = $brand;
			$fashionn->size = $size;
			$fashionn->color = $color;
			
		}else{
			header("Location: table.php");
				
		}
		return $fashion;
		
		$stmt->close();
		$mysqli->close();
	}
  
  
	 
	 function updateClothes($id, $clothes, $brand, $size, $color){
	   $mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
	   $stmt = $mysqli->prepare("UPDATE fashion SET clothes=?, brand=?, size=?, color=? WHERE id=?");
	   $stmt->bind_param("issis", $id, $clothes, $brand, $size, $color);
	   
	    // kas 6nnestus salvestada
	   
	    if($stmt->execute()) {
		   // 6nnestus
		   echo "jah";
		  
	    }
	   
	   $stmt->close();
		$mysqli->close();
	   
	   }
 	 
 ?> 
