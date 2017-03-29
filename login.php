<?php
	session_start();
	
	$host = "localhost";
	$user = "root";
	$bd = "eduzined";  
    $bdd =  new mysqli($host,$user, "root",$bd) ;
    if ($bdd->connect_errno)   	{echo "erreur de connecter  la base :".$bdd->connect_errno.")".$bdd->connect_error;}
 
 
	//Array to store validation errors
	$errmsg_arr = array(); 
	//Validation error flag
	$errflag = false;


 	// stocker les information du login dans des variables
 	if (isset($_POST['cnx'])) {

	$username = $_POST['user'];
	$password= $_POST['pass'];
 	}
 	else
 	{
		$username = $_SESSION['user'] ;
		echo $username;
		$password= $_SESSION['pass'];
		echo $password;
 	}
	
	//Input Validations
	if($username == '') {
	$errmsg_arr[] = "Nom d'utilisateur manquant";
	$errflag = true;
	}
	if($password == '') {
	$errmsg_arr[] = "Mot de passe manquant";
	$errflag = true;
	}
	 
	if($errflag) {
	$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
	session_write_close();
	header("location: loginer.php");
	exit();
	}

	$sql = "SELECT * FROM users where name='$username' AND pass = '$password' ";
	$res = $bdd->query($sql);

//Verifier si la requete est terminer avec succes

if ($res) 
{
	if ($res->num_rows) 
	{
		//Login Successful
		session_regenerate_id();
		$res->data_seek(1);
		$row = $res->fetch_assoc();
		$_SESSION['id'] = $row['id'];
		$_SESSION['user'] = $row['name'];
		$_SESSION['nom'] = $row['nom'];
		$_SESSION['prenom'] = $row['prenom'];
		$_SESSION['pass'] = $row['pass'];
		$_SESSION['email'] = $row['email'];
	
		$_SESSION['image'] = $row['image'];
		$_SESSION['cover'] = $row['cover'];
		session_write_close();
		header("location: p.php");
		exit();
	}
	else 
	{
		//Login failed
		$errmsg_arr[] = 'informations incorrects';
		$errflag = true;
		if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: loginer.php");
		exit();	}
	}
}	

else
 {
die("Query failed");
	}
?>