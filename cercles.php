<?
session_start();
	$host = "localhost";
	$user = "root";
	$bd = "eduzined";  
	$bdd =  new mysqli($host,$user, "root",$bd) ;
    if ($bdd->connect_errno)   	{echo "erreur de connecter  la base :".$bdd->connect_errno.")".$bdd->connect_error;}
	if (isset($_POST['send'])) {
		$cer = $_POST['cercle'];
		$Q = " INSERT  INTO cercles (name) values ('$cer')";
		$R = $bdd->query($Q);
	}
	
?>

<html>
<head>
<title>Cercles</title>
<link rel="stylesheet" type="text/css" href="CSS/cercles.css">
<link rel="stylesheet" type="text/css" href="css/profile.css">
</head>

<body>
		<? 	include "header.php";	?>
<div id="section">

<?
$sql = "SELECT * FROM cercles";
$result = $bdd->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) 
    {?>
		<h1> <?echo $row["name"].""?><a href="domaine.php?id=<?echo $row['id'];?>"><img src="img/icons/next.png"></a><br></h1>
<?}}?>
			
        <?
        if ($_SESSION['user']=='hamzaoui') 
        {
          # code...
        ?>
        <button id="but" type="button" class="button_p_1" onclick="toggle_visibility('foo');" >Ajoutez votre domaine </button>
        <div id="foo" style="display:none;">
        	<form action="cercles.php" method="POST">
        		<input type="text" name ="cercle">
        		<div id="foo_but">
        		<button type="submit"  name ="send">Envoyer</button>
        		<button type="reset" >Annuler</button>
        		</div>
        	</form>
        </div>
        <?}?>
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

	</div>

</body>

</html>
