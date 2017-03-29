	<header>
		<div id="logoetnom">
		<img src="logo.png" id="logo">
		<h1>Edusocial</h1>
		</div>
		<div id="ul">
			<ul>
			<div id="menu">
			<li><a href="p.php">Accueil</a></li>
			<li><a href="cercles.php">Domaines</a></li>
			<li><a href="profile.php?id=<?echo $_SESSION['id']?>"> <?php echo $_SESSION['prenom'];?></a></li>
			</div>
			
			<li id="dec"><a  href="#" >  <img  onclick="toggle_visibility('setting_menu') " src="<?php echo $_SESSION['image']; ?>"></a>
			<li id="msg"><a href="msg.php"><img src="img/icons/msg.png"> <label>12</label></a></li>	
			<div id="setting_menu" style="display:none;">
				<ul >
					<li><a href="param.php">Paramétres</a></li>
					<li><a href="edit_profile.php">Modifier profile</a></li>
					<li><a href="deconnexion.php">Deconnexion</a></li>
					<li></li>
				</ul>
			</div>
			</li>
		</ul>
		</div>
	</header>
      
<script type="text/javascript">
<!--
    function toggle_visibility(id) {
       var e = document.getElementById(id);
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';
    }
//-->
</script>
