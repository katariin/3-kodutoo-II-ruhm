<?php 
	 
 	require_once("functions.php"); 
 	 
 	//kontrollin, kas kasutaja on sisseloginud 
 	if(isset($_SESSION["id_from_db"])){ 
 		
 		header("Location: data.php"); 
	} 

    // Teen errori muutujad
	//siiselogimine
	$email_error = "";
	$password_error = "";
	//create users 
    $create_name_error ="";
	$create_lastname_error = "";
   // $comment_error ="";	
    $create_email_error = "";
	$create_password_error = "";	
  
   // muutujad vaartuste jaoks 
	$create_age = "";
	$create_name ="";
	$create_lastname="";
	$email = "";
	$password="";
	//$comment="";
	$create_email ="";
	$create_password=""; 
  
  
 	if($_SERVER["REQUEST_METHOD"] == "POST") {
    // *********************
    // **** LOGI SISSE *****
    // *********************
		if(isset($_POST["login"])){
			
			echo "Vajutas log in nuppu!";
			
			if ( empty($_POST["email"]) ) {
				$email_error = "E-mail on kohustuslik";
			}else{
				$email = cleanInput($_POST["email"]);
			}
			
			if ( empty($_POST["password"]) ) {
				$password_error = "Parool on kohustuslik";
			}else{
				$password = cleanInput($_POST["password"]);
			} 
 
  
			if($password_error == "" && $email_error == ""){ 
 				echo "Voib sisse logida! Kasutajanimi on ".$email." ja parool on ".$password; 
 				 
 				$password_hash = hash("sha512", $password); 
 				 
				// functions php failis kaivitan funktsiooni 
 				loginUser($email, $password_hash); 
			} 
  
 		} // login if end 

    
     // ********************* 
     // ** LOO KASUTAJA ***** 
     // ********************* 
     if(isset($_POST["create"])){
		
		echo "Vajutas create nuppu!";
		
		if (empty($_POST["name"]) ) {
			$create_name_error = "Nimi on kohustuslik";
		  }else{
			$create_name = cleanInput($_POST["name"]);
		}
		      //Kontrollime, kas nimi sisaldab ainult t2hed
			  
		if(!preg_match ("/^[a-zA-Z]*$/", $create_name)){
			$create_name_error = "Ainult tahed lubatud";
		}	  
			  
		
		if ( empty($_POST["lastname"]) ) {
			$create_lastname_error = "See vali on kohustuslik";
		  }else{
			$create_lastname = cleanInput($_POST["lastname"]);
		}
		
		if ( empty($_POST["create_email"]) ) {
			$create_email_error = "E-mail on kohustuslik";
		}else{
			$create_email = cleanInput($_POST["create_email"]);
		}
		
		if ( empty($_POST["create_password"]) ) {
			$create_password_error = "See vali on kohustuslik";
		}else{
			if(strlen($_POST["create_password"]) < 7) {
				$create_password_error = "Peab olema vahemalt 7 tahemarki pikk!";
			}else{
				$create_password = cleanInput($_POST["create_password"]);
			}
		}
		if (empty($_POST["age"])) {
			$create_age= " ";
		}else{
			$create_age = cleanInput($_POST["age"]);   
		}
		
		
		//if ( empty($_POST["comment"]) ) {
		//	$comment_error = "See vali on kohustuslik";
		//}else{
		//	$comment = cleanInput($_POST["comment"]);
		//}
  
 			if(	$create_name_error = "" && $create_lastname_error = "" && $create_email_error == "" && $create_password_error == ""){ 
 				echo "Voib kasutajat luua! Kasutajanimi on ".$create_email." ja parool on ".$create_password; 
 				 
 				$password_hash = hash("sha512", $create_password); 
 				echo "<br>"; 
 				echo $password_hash; 
 				 
 				createUser($create_name, $create_lastname, $create_email, $password_hash, $create_age);
 				 
 			}
      
     } 
  
 	
  }
  
   function cleanInput($data) { 
   	$data = trim($data); 
   	$data = stripslashes($data); 
  	$data = htmlspecialchars($data); 
  	return $data; 
  } 

  
 ?> 
 <!DOCTYPE html> 
 <html> 
 <head> 
   <title>Login</title> 
 </head> 
 <body> 
 
 
   <h2>Log in</h2> 
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" > 
   E-mail: <input name="email" type="email" placeholder="E-post" value="<?php echo $email; ?>"> <?php echo $email_error; ?><br><br> 
  Parool: <input name="password" type="password" placeholder="Parool" value="<?php echo $password; ?>"> <?php echo $password_error; ?><br><br> 
  	<input type="submit" name="login" value="Log in"> 
   </form> 
 
 
   <h2>Create user</h2> 
   <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" > 
Eesnimi: <input name="name" type="text" placeholder="Eesnimi" value="<?php echo $create_name; ?>"> <?php echo $create_name_error; ?><br><br>
Perekonnanimi: <input name="lastname" type="text" placeholder="Perekonnanimi" value="<?php echo $create_lastname; ?>"> <?php echo $create_lastname_error; ?><br><br>
E-mail: <input name="create_email" type="email" placeholder="E-post" value="<?php echo $create_email; ?>"> <?php echo $create_email_error; ?><br><br>
Parool: <input name="create_password" type="password" placeholder="Parool" ><?php echo $create_password_error; ?><br><br>
Vanus: <input name="age" type="text" placeholder="vanus" value="<?php echo $create_age; ?>"> <br><br> 
      <input type="submit" name="create" value="Create">
   </form> 
 <body> 
 <html> 
