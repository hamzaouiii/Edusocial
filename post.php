<?php
	session_start();
	
	$aut = $_SESSION['id'];
	$host = "localhost";
	$user = "root";
	$bd = "eduzined";  
	$bdd =  new mysqli($host,$user, "root",$bd);
	if (isset($_GET['id'])) 
	{
		$idd=$_GET['id'];
	}
	if(isset($_POST['send']))
	{
		$comment = $_POST['comment'];
		$post = $_POST['post_id'];
		$aut = $_SESSION['id'];

		$q ="INSERT INTO comments (content,post,author) VALUES  ('$comment',$post,$aut)";
        $sql  = $bdd->query($q);
 
	}
$sql = "SELECT * FROM posts where id=$idd";
	$res = $bdd->query($sql);
		$row = $res->fetch_assoc();
    	$post = $row['content'];
    	$id= $row['id']; 
    	$autheur = $row['author'];  
    	$avis = $row['avis'];
    	$dada = $row['date_created_post'];
    	$domaine = $row['domaine'];
		$date = $bdd->query("SELECT TIME_TO_SEC(TIMEDIFF(now(),posts.date_created_post)) as dated from posts where date_created_post = '$dada'"); 
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
<html>
<head>
<title><?echo $prenom." ".$nom;?></title>
<link rel="stylesheet" type="text/css" href="css/profile.css">
<link rel="shortcut icon" href="eduu.png" /> 
</head>

<body>
	<?include "header.php";
	?>
<div id="postting">
	<div id="main">
		<?
		$query_that_has_to_do_with_the_domaine = "SELECT * from cercles where id='$domaine'";
		$result_of_the_query_that_has_to_do_with_the_domaine = $bdd->query($query_that_has_to_do_with_the_domaine);
		$row_of_domaine = $result_of_the_query_that_has_to_do_with_the_domaine->fetch_assoc();
		?>
		<div class="domaine" ><a href="domaine.php?id=<?echo $row_of_domaine['id'];?>"><?echo $row_of_domaine['name'];?></a></div>

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

if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) 
    {
        $id_author= $row["author"];
        $req = "SELECT * from users where id = $id_author";
     	$R = $bdd->query($req);
     	$row2 = $R->fetch_assoc(); 
        $picture = $row2["image"];
         ;  

         if ($id == $row['post']) 
         	{
?>
			<div id="comments_">
						<img src="<?php echo $picture; ?>">
						<a href="profile.php?id=<?echo $row2['id'];?>"><label> <?echo    $row2["prenom"]." " .$row2["nom"]?></label></a>
						<p><?php echo nl2br($row["content"]);?></p>
			</div>
			<?
         	}
	}
} 
?>
		<div id="commentaire_" >
			<form action="post.php?id=<?echo $idd;?>" method="POST">
						<textarea type ="text" id="comment" name="comment"> </textarea>
			
						<input type ="submit" id="ok" value="Commenter" name="send">
						<input type="hidden" value="<?php echo "$id" ?>" name="post_id">
		
			</form>
		</div>
	</div>
</div>

</body>
