<?
	session_start();
	$host = "localhost";
	$user = "root";
	$bd = "eduzined"; 
	$aut = $_SESSION['id'];
	$bdd =  new mysqli($host,$user,"root",$bd) ;
	
	if ($bdd->connect_errno)   	{echo "erreur de connecter  la base :".$bdd->connect_errno.")".$bdd->connect_error;}

if (isset($_GET['id'])) { $id = $_GET['id']; } else $id=$aut;
	if (isset($_POST['follow'])) 
	{
		$id_followed = $id;
		$id_follower = $_SESSION['id'];
		$requete = "INSERT INTO Following (id_follower,id_followed) values ($id_follower,$id_followed)";
		$bdd->query($requete);
	}
	elseif (isset($_POST['unfollow'])) 
	{
		$id_followed = $id;
		$id_follower = $_SESSION['id'];
		$requete = "DELETE FROM  following where id_follower = $id_follower and  id_followed =$id_followed";
		$bdd->query($requete);
	}
	if (isset($_POST['x'])) 
	{
		$ide = $_POST['xx'];
		$Q = "DELETE FROM posts WHERE id = $ide";
		$bdd->query($Q);
	}

	if(isset($_POST['publie']))
	{
		$pub = $_POST['publication'];
		$dom = $_POST['domaine'];

		$insert_post_query ="INSERT INTO posts (content,domaine,author) VALUES  ($pub,$dom,$aut)";
		$bdd->query($insert_post_query);
	}
	
	$Q = "SELECT * FROM users where id = $id";
	$result = $bdd->query($Q);
 if ($result->num_rows > 0) {
    while($raw = $result->fetch_assoc()) 
 		{
?>
<html>

<head>
	<link rel="stylesheet" type="text/css" href="CSS/profile.css">
	<link rel="stylesheet" type="text/css" href="CSS/pro.css">
	<title><?echo $raw["nom"]." ".$raw["prenom"];?></title>
</head>

<body>

		<? 	include "header.php";	?>

			<div id="cover_photo" >
			<img src="<?	echo $raw["cover"];	?>">
			</div>
				<form action ="profile.php" method="POST">
				<input type="hidden">
				</form>

			<div id="profile_info" >
				<img src="<?	echo $raw["image"];	?>">
				<h3><?	echo $raw["prenom"]." ".$raw["nom"];	?><h3>
			</div>

			<?
				$id_followed = $id;
		        $id_follower = $_SESSION['id'];
		        $SQL = "SELECT * from following where id_follower = $id_follower and id_followed = $id_followed";
		        $Rea = $bdd->query($SQL);
				if (!$Rea->num_rows > 0 ) 
				{
					if ($id_followed != $id_follower) 
					{
			?>
						<div id="follow">
			  			<form action="profile.php?id=<?echo $id;?>" method="post">  
			            <input name="follow" type="submit" value="Suivre">
			            </form>
			       		</div>
       		<?
       				}
       				else
       				{
       		?>
       					<div id="follow">
       						<?
       						$Z = $bdd->query("SELECT COUNT(`id_followed`) as count FROM following WHERE id_followed =$id");
						    while($M = $Z ->fetch_assoc()) 
						    {
       						?>
       						<h4>Suivi par <?echo $M['count'];?> personnes </h4>
       					</div>
  			<?				}
       				}
       			}
       			else
       			{
       		?>
       					<div id="follow_">
			  			<form action="profile.php?id=<?echo $id;?>" method="post">  
			            <input name="unfollow" type="submit" value="Abonnée ">
			            </form>
			       		</div>
  			<?
       			}	
#SELECT TIMEDIFF(now(),posts.date_created_post) from posts
       			
       		?>
<div class="feed">
		<div id="post">
			<form id="first" action="p.php" method="POST">
				<textarea name="publication" placeholder="Ecrivez votre publication ici..."></textarea>
				<div id="pu">
				<input type="submit" value="Publie" name="publie">
			<label>Choisissez le domaine ou vous voullez publier </label>

					<select name="domaine">
					<?
						$SSS = "SELECT * FROM cercles";
						$RR = $bdd->query($SSS);
						if ($RR->num_rows > 0) {
				    	while($RRRR = $RR->fetch_assoc()) 
		  					{?>
						<option value="<?echo $RRRR["id"];?>"><?echo $RRRR["name"];?></option>
							<?}}?>

					</select>
				</div>
			</form>
			<?
			$s = "SELECT * FROM posts  where author = $id order by ID ASC ";
			$res = $bdd->query($s);
			while ($row = $res->fetch_assoc()) 
			{
		    	$post = $row['content'];
		    	$id= $row['id']; 
		    	$avis = $row['avis'];
		    	$dada = $row['date_created_post'];
		    	$domaine = $row['domaine'];
				$date = $bdd->query("SELECT TIME_TO_SEC(TIMEDIFF(now(),posts.date_created_post)) /60 as dated from posts where date_created_post = '$dada'"); 
			 	while($date_since = $date ->fetch_assoc()) 
		    	{
					$date_since_posted = $date_since["dated"];
		    	}
		    	
			?>
	<div class = "pcc_">
			<div id="publication">
				<?
		$query_that_has_to_do_with_the_domaine = "SELECT name from cercles where id='$domaine'";
		$result_of_the_query_that_has_to_do_with_the_domaine = $bdd->query($query_that_has_to_do_with_the_domaine);
		$row_of_domaine = $result_of_the_query_that_has_to_do_with_the_domaine->fetch_assoc();
		?>
		<div class="domaine" ><a href="#"><?echo $row_of_domaine['name'];?></a></div>
				<form id="delete_post" action="profile.php?id=<?echo $aut;?>" method="POST">
				<input type="submit" value=" " name="x" Onclick="return confirm('this means that you will delete your post qre you sure ?')">
				<input type="hidden" value="<?php echo "$id" ?>" name="xx">
				</form>
				<div id="infos">
				<img src="<?php echo $raw['image']; ?>" id="infos">
				<a href="profile.php?id=<?echo $id;?>"><label>	<?echo $raw["nom"]." ".$raw["prenom"];?>   </label></a>
				<?
				if ($date_since_posted<60) 
				{
					$time = "seconds";	
				}
				elseif ($date_since_posted >60 and $date_since_posted<3600) 
				{
					$date_since_posted = $date_since_posted/60;
					if ($date_since_posted == 1) {$time = "minute";}
					else $time = "minutes";
				}
				elseif ($date_since_posted >3600 and $date_since_posted< 84600) {
					$date_since_posted = $date_since_posted/3600;
					if ($date_since_posted == 1) {$time = "heur";}
					else $time = "heurs";
				}
				elseif ($date_since_posted > 84600) {
					$date_since_posted = $date_since_posted/84600;
					if ($date_since_posted == 1) {$time = "jour";}
					else $time = "jours";
				}
			?>

				<a href="#" id="domaine"><?php echo number_format($date_since_posted,0)." ".$time;?></a>
				</div>
				<p><?echo nl2br($post);?></p>
			</div>
			<?
			?>


			<?php
				
$sql = "SELECT * FROM comments";
$result = $bdd->query($sql);

if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) 
    {
        $id_author= $row["author"];
        $req = "SELECT * from users where id = $id_author";
     	$R = $bdd->query($req);
     	$row2 = $R->fetch_assoc(); 
        $picture = $row2["image"];
        if ($id == $row['post']) 
        {
?>
			<div id="comments_">
						<img src="<?php echo $picture; ?>">
						<label> <?echo    $row2["prenom"]." " .$row2["nom"]?></label>
						<p><?php echo $row["content"]?></p>
			</div>
			<?
        }
	}
}
?>
		<div id="commentaire_" >
			<form action="p.php" method="POST">
				<textarea type ="text" id="" name="comment"> </textarea>	
				<input type ="submit" id="ok" value="Commenter" name="send">
				<input type="hidden" value="<?php echo "$id" ?>" name="post_id">		
			</form>
		</div>
	</div>		
		
<?}?>

	</div>
	<div id="followers" >
			<h5>Les abonnés de <? echo $raw["prenom"]; ?></h5>

			<?
					$T = $raw["id"];
					$Qer = "SELECT * FROM users WHERE id IN (select `id_follower` from following where `id_followed` =  $T) ";
					$resu = $bdd->query($Qer);
					if ($resu->num_rows > 0) {
				    	while($row_friends = $resu->fetch_assoc()) 
		  	{?>
			<div id="one_follower">
			<a href="profile.php?id=<?echo $row_friends["id"];?>"><img src="<?echo $row_friends["image"];?>"></a>
			<a href="profile.php?id=<?echo $row_friends["id"];?>"><h6><?echo $row_friends["prenom"]." ".$row_friends["nom"];?></h6></a>
			</div>
			<?}}?>
	</div>
	<div id="followers_" >
			<h5>Les abonnements de <? echo $raw["prenom"]; ?></h5>

			<?
					$T = $raw["id"];
					$Qer = "SELECT * FROM users WHERE id IN (select `id_followed` from following where `id_follower` =  $T) ";
					$resu = $bdd->query($Qer);
					if ($resu->num_rows > 0) {
				    	while($row_friends = $resu->fetch_assoc()) 
		  	{?>
			<div id="one_follower">
			<a href="profile.php?id=<?echo $row_friends["id"];?>"><img src="<?echo $row_friends["image"];?>"></a>
			<a href="profile.php?id=<?echo $row_friends["id"];?>"><h6><?echo $row_friends["prenom"]." ".$row_friends["nom"];?></h6></a>
			</div>
			<?}}?>
	</div>
	</div>
</div>





	
</body>
<?
}
}
?>
</html>