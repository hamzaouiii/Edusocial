<?
	session_start();
	$host = "localhost";
	$user = "root";
	$bd = "eduzined"; 
	$aut = $_SESSION['id'];
	$bdd =  new mysqli($host,$user,"root",$bd) ;
	
	if ($bdd->connect_errno)   	{echo "erreur de connecter  la base :".$bdd->connect_errno.")".$bdd->connect_error;}
?>
<html>

<head>
	<link rel="stylesheet" type="text/css" href="CSS/msg.css">
	<title>Messages</title>
</head>

<body>
		<? 	include "header.php";	?>
<div id='main'>
		<div class="new_msg">
			<img src="img/profile/light.jpg">
			<label>Sanae</label>
			<p>Afirak asahbii twhctak</p>
		</div>
		<div class="new_msg">
			<img src="img/profile/light.jpg">
			<label>Sanae</label>
			<p>Afirak asahbii twhctak</p>
		</div>
		<div class="new_msg">
			<img src="img/profile/light.jpg">
			<label>Sanae</label>
			<p>Afirak asahbii twhctak</p>
		</div>
		<div class="new_msg">
			<img src="img/profile/light.jpg">
			<label>Sanae</label>
			<p>Afirak asahbii twhctak</p>
		</div>
		<div class="new_msg">
			<img src="img/profile/light.jpg">
			<label>Sanae</label>
			<p>Afirak asahbii twhctak</p>
		</div>
		<div class="new_msg">
			<img src="img/profile/light.jpg">
			<label>Sanae</label>
			<p>Afirak asahbii twhctak</p>
		</div>
		<div class="new_msg">
			<img src="img/profile/light.jpg">
			<label>Sanae</label>
			<p>Afirak asahbii twhctak</p>
		</div>
		<div class="new_msg">
			<img src="img/profile/light.jpg">
			<label>Sanae</label>
			<p>Afirak asahbii twhctak</p>
		</div>
		<div class="new_msg">
			<img src="img/profile/light.jpg">
			<label>Sanae</label>
			<p>Afirak asahbii twhctak</p>
		</div>
</div>

</body>

</html>