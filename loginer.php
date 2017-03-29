<?php
session_start();
$host = "localhost";
	$user = "root";
	$bd = "eduzined";  
	$bdd= new PDO("mysql:host=".$host.";dbname=".$bd, $user,"root");	
?>

<html>

<head>
<title>Edusocial | Erreur de Login</title>
<link rel="stylesheet" type="text/css" href="css/error.css">
<link rel="shortcut icon" href="eduu.png" /> 
<meta charset="utf-8">
</head>

<body>	
	<header>
		<div id="logoetnom">
		<img src="logo.png" id="logo">
		<h1>Edusocial</h1>
		</div>		
	</header>
	
	<div id="box">
		<div id="signUP">
	<h1>Informations incorrects</h1>
	<form action="login.php" method="POST" id="register">
	
	
		<div id="sign">
		
		<LABEL>Entrer votre de login:</LABEL>
		<input type ="text" placeholder="Username" name="user">
		
		<label for ="password">Entrer votre mot de passe: </label>
		<input type ="password" placeholder="Mot de passe" name="pass" id="password">
		<a href="forget.php" id="oub">Oublier votre infos login ?</a>
	
		<?php
    if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
    echo '<ul class="err">';
    foreach($_SESSION['ERRMSG_ARR'] as $msg) {
    ?>
    <h5> <?php echo $msg; ?></h5>
    <?php
    }
    echo '</ul>';
    unset($_SESSION['ERRMSG_ARR']);
    }
    ?>
		<button type="submit" name ="cnx" value ="Connexion">Connexion</button>

		</div>
	</form>
	</div>
	</div>

		

</body>
</html>