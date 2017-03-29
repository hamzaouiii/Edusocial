<?
session_start();
?>
<html>
<head>
<title> Parametres</title>
<link rel="stylesheet" type="text/css" href="css/profile.css">
<link rel="shortcut icon" href="eduu.png" /> 
</head>
<body>
<?include "header.php" ?>
	<div id="edit_place">

		<span id ="sss" >Modifier votre mot de passe <button Onclick="toggle_visibility('mot_de_pass');"></button></span>
		
		<div id="mot_de_pass" style="display:none;" >		
			<form>
				<tr>
					<td>
						<h5>Entrer votre ancien mot de passe :</h5>
					</td>		
					<td>
						<input type="password" name="pass_1">
					</td>	
				</tr>
				<tr>
					<td>
						<h5>Entrer votre nouveau mot de passe :</h5>
					</td>
					<td>
						<input type="password" name="pass_1">
					</td>
				</tr>
				
				<br><button id="down">Enregistrer les changements</button>
				
			</form>
			</table>
		</div>

		<span id ="sss" >Modifier Votre  de email <button Onclick="toggle_visibility('email');"></button></span>
		<div id="email" style="display:none;" >		
			<form>
				<tr>
					<td>
						<h5>Entrer votre ancien mot de passe :</h5>
					</td>		
					<td>
						<input type="password" name="pass_1">
					</td>	
				</tr>
				<tr>
					<td>
						<h5>Entrer votre nouveau mot de passe :</h5>
					</td>
					<td>
						<input type="password" name="pass_1">
					</td>
				</tr>
				
				<br><button id="down">Enregistrer les changements</button>
				
			</form>
			</table>
		</div>

		<span id ="sss" >Modifier Votre  de nom d'utilisateur <button Onclick="toggle_visibility('user');"></button></span>
		<div id="user" style="display:none;" >		
			<form>
				<tr>
					<td>
						<h5>Entrer votre ancien nom d'utilisateur :</h5>
					</td>		
					<td>
						<input type="password" name="pass_1">
					</td>	
				</tr>
				<tr>
					<td>
						<h5>Entrer votre nouveau nom d'utilisateur :</h5>
					</td>
					<td>
						<input type="password" name="pass_1">
					</td>
				</tr>
				
				<br><button id="down">Enresgistrer les changements</button>
				
			</form>
			</table>
		</div>
		<span id ="sss" >Modifier Votre  nom <button Onclick="toggle_visibility('mot_de_pass');"></button></span>
		<span id ="sss" >Modifier Votre  prenom <button Onclick="toggle_visibility('mot_de_pass');"></button></span>

    </div>
   <script type="text/javascript">
    function toggle_visibility(id) 
    {
       var e = document.getElementById(id);
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';
    }
</script>

</body>