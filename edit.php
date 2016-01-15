<?php 
 	//edit.php 
 	require_once("edit_functions.php"); 
 	 
	//kas kasutaja uuendab andmeid 
 	if(isset($_POST["update"])){ 
		 
 		updateClothes($_POST["id"],$_POST["clothes"],$_POST["brand"],$_POST["size"],$_POST["color"]); 
 	} 
 	 
 	 
 	 
 	//id mida muudame 
 	if(!isset($_GET["edit"])){ 
 		 
// ei ole aadressieal ?edit=midagi 
 		// suunan table.php lehele 
	 
 		header("location: table.php"); 
		 
 	}else{ 
 		// saada katte koige uuemad andmed selle id kohta 
		//numbrimark ja varv 
 		//kusime andmebaasist andmed id jargi 
 		 
		//saadan kaasa id 
 		$fashion = getSingleClothes($_GET["edit"]); 
	var_dump($fashion); 
 	} 
 	 
	 
 	 
 	 
	 
 ?> 
 <h2>Muuda autot</h2> 
   <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" > 
 	<input type="hidden" name="id" value="<?=$_GET["edit"];?>" >  
   	<label for="number_plate" >auto nr</label><br> 
 	<input id="number_plate" name="number_plate" type="text" value="<?php echo $car_object->number_plate;?>" ><br><br> 
   	<label for="color" >varv</label><br> 
 	<input id="color" name="color" type="text" value="<?=$car_object->color;?>"><br><br> 
   	 
 	<input type="submit" name="update" value="Salvesta"> 
   </form> 
   
   
   			<h2>Muuda faschion</h2>
	    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" ><br>
		<input type='hidden' name='id' value="<?=$_GET["edit"] ?>"><br>
		
			<label for="clothes" >Clothes</label><br>
	    <input id="clothes" name="clothes" type="text" value="<?php echo $fashion->clothes;?>" ><br><br>
			<label for="brand" >Brand</label><br>
	    <input id="brand" name="brand" type="text" value="<?php echo $fashion->brand;?>" ><br><br>
			<label for="size" >Size</label><br>
	    <input id="size" name="size" type="text" value="<?php echo $fashion->size;?>" ><br><br>
			<label for="color" >Color</label><br>
	    <input id="color" name="color" type="text" value="<?=$fashion->color;?>"><br><br>
  	
	    <input type="submit" name="update" value="Submit">
	    </form>
