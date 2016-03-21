<?php 
 	 
 	require_once("edit_functions.php"); 
 	 
	//kas kasutaja uuendab andmeid 
 	if(isset($_POST["update"])){ 
		 
 		updateClothes($_POST["id"],$_POST["clothes"],$_POST["brand"],$_POST["size"],$_POST["color"]); 
 	} 
 	 
 	 
 	 
 	//id mida muudame 
 	if(!isset($_GET["edit"])){ 

	 
 		header("location: table.php"); 
		 
 	}else{ 
           // saada kätte kõige uuemad andmed selle id kohta
 		$fashion_objekt = getSingleClothes($_GET["edit"]); 
		
	var_dump($fashion_objekt); 
 	} 
 	 
	 
 	 
 	 
	 
 ?> 

   
   			<h2>Muuda riietus</h2>
	    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" ><br>
		<input type='hidden' name='id' value="<?=$_GET["edit"] ?>"><br>
		
			<label for="clothes" >Clothes</label><br>
	    <input id="clothes" name="clothes" type="text" value="<?php echo $fashion_objekt->clothes;?>" ><br><br>
			<label for="brand" >Brand</label><br>
	    <input id="brand" name="brand" type="text" value="<?php echo $fashion_objekt>brand;?>" ><br><br>
			<label for="size" >Size</label><br>
	    <input id="size" name="size" type="text" value="<?php echo $fashion_objekt->size;?>" ><br><br>
			<label for="color" >Color</label><br>
	    <input id="color" name="color" type="text" value="<?=$fashion_objekt->color;?>"><br><br>
  	
	    <input type="submit" name="update" value="Submit">
	    </form>

		
		
		
		
		
		<link rel="stylesheet" href="style.css" type="text/css" /> 
