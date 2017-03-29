<?php
session_start();
	
	$host = "localhost";
	$user = "root";
	$bd = "eduzined";  
	$bdd =  new mysqli($host,$user, "root",$bd) ;
	
	if(isset($_POST['name']))
	{
		$name = $_POST['name'];
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$email = $_POST['email']; 
		$pass = $_POST['password'];
		$pass_ag = $_POST['password_again'];
		$image = "img/profile/avatar.png";
		
		if ($pass == $pass_ag) 
		{
			$q ="INSERT INTO users(name,nom,prenom, pass, email,image) VALUES  ('$name','$prenom' ,'$nom', '$pass', '$email', '$image')";
        	$sql  = $bdd->query($q);
        	$i_just_want_the_the_fucking_id = "SELECT id from users where email = '$email'";
        	$Query = $bdd->query($i_just_want_the_the_fucking_id);
        	$line = $Query->fetch_assoc();
	        $_SESSION['id'] = $line['id'];	  
			$_SESSION['user'] = $name;
			$_SESSION['nom'] = $nom;
			$_SESSION['prenom'] = $prenom;
			$_SESSION['image'] = $image;
			$_SESSION['pass'] = $pass;
		}
		else
		{
			header("location: index.php?flag=1");
		}


	
}	
$nab  = $_SESSION['prenom']

?>

<html>

<head>
	<link rel="stylesheet" type="text/css" href="CSS/profile.css">
	<title>Inscription terminee</title>
</head>

<body>
	<?php include "header.php"; ?>

	<div id="bonjour">
	<p >Bonjour <span > <? echo $nab ;?> </span> insciption terminee avec succee </p>
	<p>Click <a href="profile.php">ici</a> pour voir votre profile ou <a href="p.php">ici</a> pour voir L'acceuil</p>
	</div>
	
</body>



