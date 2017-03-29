<?php
	$host = "localhost";
	$user = "root";
	$bd = "eduzined";  
	$bdd =  new mysqli($host,$user, "root",$bd) ;
    if ($bdd->connect_errno)   	{echo "erreur de connecter  la base :".$bdd->connect_errno.")".$bdd->connect_error;} 	
	$email = "";
	$flag=0;

	if (isset($_POST['send'])) 
	{
		$email = $_POST['email'];
		$flag = 1;
	}
	$sql = "SELECT * FROM users where email='$email' ";
	$res = $bdd->query($sql);
if ($res) 
{
	if ($res->num_rows) 
	{
		$drapo=1;
		$res->data_seek(1);
		$row = $res->fetch_assoc();
	}
	else
{
$drapo=2;
}	
}	
	
?>
<head>
<title>Edusocial | Oublie les informations de login</title>
<link rel="stylesheet" type="text/css" href="css/error.css">
<link rel="stylesheet" type="text/css" href="css/forget.css">
<link rel="shortcut icon" href="eduu.png" /> 
<meta charset="utf-8">
</head>
<body>	
	<header>
		<div id="logoetnom">
		<a href="index.php"><img src="logo.png" id="logo"></a>
		<h1>Edusocial</h1>
		</div>		
	</header>

	<div id="oublie" >
		<form action="forget.php" method="post">   
					<div id="recu">
										<?php
					 if ($flag==0 ) 
					{
					?>
					<h3>Entrez votre email</h3>
					<table>
					<tr>
					<td>
					<input type="email" id="pass" name="email">
					</td>	
					<td>
					<input type="submit" name="send" value="Recuperer" id="supp">	
					</tr>
					</table>

						<p>Vous trouverez vos informations de connexion dans votre email</p>
					<? 
					}
					elseif ($flag==1)
					{ 
						if ($drapo==1) 
						{
					?>
							<p>Consultez ce email: <span id="right"> <?php echo $email;?></span> Vous trouverez vos informations de connexion dedans	 .</p>

					<?
						}
					 	elseif ($drapo==2) 
					 	{
					 ?>
							<p>Ce email <span id="wrong"><?php echo $email." ";?></span> n'existe  pas dans notre base de données.</p>
					<?php
						}
					}
				?>
					</div>		

		 </form>
	</div>
		
   
  

