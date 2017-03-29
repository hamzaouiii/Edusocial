<?

session_start();
	$aut = $_SESSION['id'];
	$host = "localhost";
	$user = "root";
	$bd = "eduzined";
		$bdd =  new mysqli($host,$user, "root",$bd) ;


if(isset($_POST["submit"])) 
{
if($_FILES['photo']['name'])
{
	//if no errors...
	if(!$_FILES['photo']['error'])
	{
			$currentdir = getcwd();
			$target = $currentdir .'/img/profile/' . basename($_FILES['photo']['name']);
			move_uploaded_file($_FILES['photo']['tmp_name'], $target);
			$image = "img/profile/" . basename($_FILES['photo']['name']);
			$_SESSION['image'] = $image;
			$requete = "UPDATE users set image = '$image' where id = $aut";
			$bdd->query($requete);
	}
	else
	{
		$message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['photo']['error'];
	}
}
}
if(isset($_POST["cover"])) 
{
if($_FILES['cover']['name'])
{
	//if no errors...
	if(!$_FILES['cover']['error'])
	{
			$currentdir = getcwd();
			$target = $currentdir .'/img/covertures/' . basename($_FILES['cover']['name']);
			move_uploaded_file($_FILES['cover']['tmp_name'], $target);
			$cover = "img/covertures/" . basename($_FILES['cover']['name']);
			$_SESSION['cover'] = $cover;
			$requete = "UPDATE users set cover = '$cover' where id = $aut";
			$bdd->query($requete);
	}
	else
	{
		$message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['photo']['error'];
	}
}
}
?>

<html>
<head>
	<title>Edite Your Profile</title>
	<link rel="stylesheet" type="text/css" href="css/profile.css">
	<link rel="stylesheet" type="text/css" href="css/edit_profile.css">
</head>
<body>
	<?include "header.php" ;?>
	<div id="edit_place">
		<table border="1">
		 	<div id="edit_photo">
			<tr>
		<td><img id="image_prof" src="<?echo $_SESSION['image'];?>"> </td>
		 <td>
		 	<span>Changer votre image de profile </span>
		 </td>
		 <td>

 	<div id="upload" style="display:no ne;">
		 	<form action="edit_profile.php" method="post" enctype="multipart/form-data">
		 		<input size="60" type="file" name="photo" value="Changer"/>
			    <input type="submit" value="Changer" name="submit">
			</form>
		 </td>
 	</div>

			</tr>
			<tr>
				<td>
				<img id="image_cover"src="<?echo $_SESSION['cover'];?>"> 
				</td>
				<td> <span>Changer votre image de coverture</span>
				</td>
				<td>

 
		 	<form action="edit_profile.php" method="post" enctype="multipart/form-data">
		 		<input size="60" type="file" name="cover" value="Changer"/>
			    <input type="submit" value="Changer" name="cover">
			</form>
		 </td>
			</tr>
		</table>
 	</div>

</div>
</body>
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
</html>
