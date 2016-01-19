<?php 
 	 
	// table.php 
 	require_once("functions.php"); 
	require_once("edit_functions.php"); 

 	if(isset($_POST["update"])){ 
 		 
 		updateClothes($_POST["id"], $_POST["number_plate"], $_POST["color"]); 
 		 
 	} 
 	 

 	 
	//kas kasutaja tahab kustutada 
 	// kas aadressireal on ?delete=??!??!?! 
 	if(isset($_GET["delete"])){ 
	 
		// saadan kaasa id, mida kustutada 
		deleteClothes($_GET["delete"]); 
		 
 	} 
 	 
 	 
	 
 	$clothes_list = getClothes(); 
 	//var_dump($car_list); 
  
 ?> 
<table border=1>
<tr>
    <th>id</th>
	<th>kasutaja id</th>
	<th>Clothes</th>
	<th>Brand</th>
	<th>Size</th>
	<th>Color</th>
	<th>X</th>
 	 
 	<?php 
 	 

		for($i = 0; $i < count($clothes_list); $i++){ 
 	

			if(isset($_GET["edit"]) && $clothes_list[$i]->id == $_GET["edit"]){ 
				echo "<tr>"; 
 					echo "<form action='table.php' method='post'>"; 
					echo "<td>".$clothes_list[$i]->id."</td>"; 
 						echo "<td>".$clothes_list[$i]->user_id."</td>"; 
 						echo "<td><input name='clothes' value='".$clothes_list[$i]->clothes."'></td>"; 
 						echo "<td><input name='brand' value='".$clothes_list[$i]->brand."'></td>";
                        echo "<td><input name='size' value='".$clothes_list[$i]->size."'></td>"; 
                        echo "<td><input name='color' value='".$clothes_list[$i]->color."'></td>"; 						
 						echo "<td><input type='submit' name='update'></td>"; 
 						echo "<td><a href='table.php'>cancel</a></td>"; 
 					echo "</form>"; 
			echo "</tr>"; 
 				 
 			}else{ 
 				// tavaline rida 
 				echo "<tr>"; 
 			 
				echo "<td>".$clothes_list[$i]->id."</td>"; 
 				echo "<td>".$clothes_list[$i]->user_id."</td>"; 
 				echo "<td>".$clothes_list[$i]->clothes."</td>"; 
 				echo "<td>".$clothes_list[$i]->brand."</td>";
				echo "<td>".$clothes_list[$i]->size."</td>"; 
				echo "<td>".$clothes_list[$i]->color."</td>"; 				
 				echo "<td><a href='?delete=".$clothes_list[$i]->id."'>X</a></td>"; 
 				echo "<td><a href='?edit=".$clothes_list[$i]->id."'>edit</a></td>"; 
 			 
 				echo "</tr>"; 
 			} 
 			 
 			 
 		} 
 			 
 	 
 	?> 
 
 
 </table> 
