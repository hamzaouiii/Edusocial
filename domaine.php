<?
session_start();
	$host = "localhost";
	$user = "root";
	$bd = "eduzined";  
	$aut = $_SESSION['id'];

	$bdd =  new mysqli($host,$user, "root",$bd) ;
    if ($bdd->connect_errno)   	{echo "erreur de connecter  la base :".$bdd->connect_errno.")".$bdd->connect_error;}
		$var = $_GET['id'];
		$Q = "(SELECT id  FROM cercles where id=$var)";
?>
<html>

<head>
<title>Do</title>
<link rel="stylesheet" type="text/css" href="css/profile.css">
</head>

<body onload="init();">
	<? 	include "header.php";	?>



<?php
	if (isset($_POST['heart'])) 
	{
		$identificateur = $_POST['hide'];
		//adding one to the total points a post has
		$bdd->query("UPDATE posts  SET avis = avis + 1 where id=$identificateur ");
		//saving that the user yho upvoted so he will not be able to post again
		$bdd->query("INSERT INTO upvoting (voter,post_voted) values ($aut,$identificateur) ");
	}
	if (isset($_POST['x'])) 
	{
		$ide = $_POST['xx'];
		$Q = "DELETE FROM posts WHERE id = $ide";
		$bdd->query($Q);
	}

	$sql = "SELECT * FROM posts where domaine=$var order by ID ASC ";
	$res = $bdd->query($sql);
	for ($row_no=$res->num_rows - 1; $row_no >= 0 ; $row_no--) 
	{ 
		$res->data_seek($row_no);
		$row = $res->fetch_assoc();
    	$post = $row['content'];
    	$id= $row['id']; 
    	$autheur = $row['author'];  
    	$avis = $row['avis'];
    	$dada = $row['date_created_post'];
		$date = $bdd->query("SELECT TIME_TO_SEC(TIMEDIFF(now(),posts.date_created_post)) /86400 as dated from posts where date_created_post = '$dada'"); 
	 	while($date_since = $date ->fetch_assoc()) 
    	{
			$date_since_posted = $date_since["dated"];
    	}
    	$Q = "SELECT * from users where id=$autheur";
		$bdd->real_query($Q);
		$rest = $bdd->use_result();
		while ($rows = $rest->fetch_assoc()) 
		{
		    $name =  $rows['name'];
		    $image =  $rows['image'];
		    $nom = $rows["nom"];
		    $prenom = $rows["prenom"];
		    $id_poster = $rows["id"] ;
		}
	?>  

	<div id="main">
<?php
		if ( $autheur == $_SESSION['id']) 
		{
			?>
			<form id="delete_post" action="p.php" method="POST">
				<input type="submit" value=" " name="x" Onclick="return confirm('this means that you will delete your post qre you sure ?')">
				<input type="hidden" value="<?php echo "$id" ?>" name="xx">
			</form>
<?		}	?>
		<div id="infos">
			<img src="<?php echo $image; ?>" id="infos">
			<a href="profile.php?id=<?echo $id_poster;?>"><label>	<?echo $prenom." ".$nom;?>   </label></a>
			<a href="#" id="domaine"><?php echo number_format($date_since_posted,0)." jours";?></a>
		</div>
		<div id="post">
			<p><?php echo nl2br($post); ?></p>
			<div id="liste">
			<ul>	
					<?
						$none =$bdd->query("SELECT * from upvoting where voter = $aut and post_voted = $id");
						if (!$none->num_rows > 0) 
						{
					?>
				<li>
					<form action="p.php" method="POST" id="upv">
						<input type="hidden" value="<?php echo "$id" ?>" name="hide">
						<input type="submit" value=" " id="heart" name="heart">
						<h6> <span>.</span> <?php echo $avis; ?></h6>
					</form >
				</li>

					<?
						}
						else 
						{

					?>
				<li>	
					<form action="" method="" id="deja_upv">
						
						<input type="hidden" value="<?php echo "$id" ?>" name="hide">
						<input type="submit" value=" " id="blueheart" name="blueheart" Onclick="alert('you cannot upvote a post two times !');" >	
						<h6><?php 
						if ($avis != 0) 
						{
							echo $avis; 
						}
						?></h6>
					</form>
					<?
						}
					?>
				</li>

				<li>
					<?
					$commm=$bdd->query("SELECT count(post) as count from comments where post = $id");
					while($cum = $commm ->fetch_assoc()) 
					{
						$number_comm = $cum['count'];
					}
					?>
					<form >
					<input type="submit" value=" " id="co">
					<h6> <?echo $number_comm;?> </h6>
					</form>
				</li>

			</ul>

			</div>

		</div>
		<?php
				
$sql = "SELECT * FROM comments";
$result = $bdd->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) 
    {
        $id_author= $row["author"];
        $req = "SELECT name,image from users where id = $id_author";
     	$R = $bdd->query($req);
     	$row2 = $R->fetch_assoc(); 
        $picture = $row2["image"];
         ;  

         if ($id == $row['post']) 
         	{
?>
			<div id="comments_">
						<img src="<?php echo $picture; ?>">
						<label> <?echo    $row2["name"]?></label>
						<p><?php echo $row["content"]?></p>
			</div>
			<?
         	}
	}
} 
else {
}?>
		<div id="commentaire_" >
			<form action="p.php" method="POST">
						<textarea type ="text" id="comment" name="comment"></textarea>

						<input type ="submit" id="ok" value="Commenter" name="send">
						<input type="hidden" value="<?php echo "$id" ?>" name="post_id">
			</form>
		</div>
	</div>
<?php 
}
?>
</body>

</html>