<?php 
session_start();
if (isset($_GET['flag'])) 
{
$flq = $_GET['flag'];
}
else
{
	$flq = 0;
}


?>

<html>
<head>
<title>Edusocial</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" href="http://jqueryvalidation.org/files/demo/site-demos.css">
<link rel="shortcut icon" href="eduu.png" /> 
<meta charset="utf-8">
</head>

<body>
	<div id="login">
		<a href="index.php">
		<img src="logo.png" id="logo">
		</a>
		<h1></h1>
		
		<form id="frr" action="login.php" method="POST">
			<input type ="submit" value="Connexion" id="cnx" name="cnx">
			
			<div id="inp">
			<input type ="text" placeholder="Login" id="in" name="user">
			<input type ="password" placeholder="Password" id="in" name="pass">
			<a href="forget.php" id="oub"> informaions de connexion oubliés ?</a>
			</div>
		</form>
	</div>
<div id="main">
<div id="Q">
	<p>Edusocial</p>

</div>
	<div id="signUP">
	<h1>Inscription</h1>
	<form action="PDO.php" method="POST" id="register">
		<div id="sign">
		
		<LABEL>Entrer votre login:</LABEL>
		<input type ="text" placeholder="login" name="name">

		<LABEL>Entrer votre nom:</LABEL>
		<input type ="text" placeholder="Nom" name="nom">

		<LABEL>Entrer votre prenom:</LABEL>
		<input type ="text" placeholder="Prenom" name="prenom">
		
		<label>Entrer votre email:</label>
		<input type ="email" placeholder="Email" name="email">
		
		<label for ="password">Entrer votre mot de passe: </label>
		<input type ="password" placeholder="Mot de passe" name="password" id="password">
		
		<label for="password_again">Confirmer votre mot de passe: </label>
		<?
			if ($flq==0) 
			{
				?>
		<label for="password_again" id="style" >mots de passe n'est pas identique </label>
				<?
			}
		?>
		<input class="left" type ="password" placeholder="Confirmer le mot de passe"  name="password_again" id="password_again">
		
		<br>
	<!--	<label>Tu es :</label> 
		<select name="EP">
			<option value="Etudiant" >Etudiant</option>
			<option value="Professeur" >Professeur</option>
		</select>
		-->
		</div>
		<div id="but">
		<input type ="submit" value="Enregistrer">
		<input type ="reset" value="Annuler">
		</div>
		<!-- <label id="ou">Où</label><br>
		<button id="f">Sign up with Facebook</button>
		<button id="g">Sign up with Google+</button> -->
	</form>
	</div>
</div>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="JS/Validate.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
<script>

$( "#register" ).validate({
rules: {
password: "required",
password_again: {
equalTo: "#password"
}
}
});
</script>
</body>
</html>