<?php
	session_start();
	
	$aut = $_SESSION['id'];
	$host = "localhost";
	$user = "root";
	$bd = "eduzined";  
	$bdd= new PDO("mysql:host=".$host.";dbname=".$bd, $user,"root");	
	
	if(isset($_POST['publie']))
	{
		$pub = $_POST['publication'];
		$dom = $_POST['domaine'];

		$q ="INSERT INTO posts (content,domaine,author) VALUES  (:pub,:dom,:aut)";
        $sql  = $bdd->prepare($q);
        $resultat = $sql->execute(array(
        	':pub' => $pub,
        	':dom' => $dom,
        	':aut' => $aut ));    
	}

	if(isset($_POST['send']))
	{
		$comment = $_POST['comment'];
		$post = $_POST['post_id'];
		$aut = $_SESSION['id'];

		$q ="INSERT INTO comments (content,post,author) VALUES  (:comment,:post,:aut)";
        $sql  = $bdd->prepare($q);
        $resultat = $sql->execute(array(
        	':comment' => $comment,
        	':post' => $post,
        	':aut' => $aut ));    
	}

		$bdd =  new mysqli($host,$user, "root",$bd) ;
		
			$user_name = $_SESSION['user'];
			$user_image = "img/profile/avatar.PNG";

?>

<html>

<head>
<title>Edusocial | Acceuil</title>
<link rel="stylesheet" type="text/css" href="css/profile.css">
<link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
<link rel="shortcut icon" href="eduu.png" /> 
<script type="text/javascript">
var observe;
if (window.attachEvent) {
    observe = function (element, event, handler) {
        element.attachEvent('on'+event, handler);
    };
}
else {
    observe = function (element, event, handler) {
        element.addEventListener(event, handler, false);
    };
}
function init () {
    var text = document.getElementById('text');
    function resize () {
        text.style.height = 'auto';
        text.style.height = text.scrollHeight+'px';
    }
    /* 0-timeout to get the already changed text */
    function delayedResize () {
        window.setTimeout(resize, 0);
    }
    observe(text, 'change',  resize);
    observe(text, 'cut',     delayedResize);
    observe(text, 'paste',   delayedResize);
    observe(text, 'drop',    delayedResize);
    observe(text, 'keydown', delayedResize);

    text.focus();
    text.select();
    resize();
}
</script>
<meta charset="utf-8">
</head>

<body onload="init()">	
	<? 	include "header.php";	?>

	<div id="publie">
		<form action="p.php" method="POST">
			<H3>Publie une question ou une idee à discuter: </h3>
			<textarea name="publication" placeholder="Ecrivez votre publication ici..." id= "text"></textarea>
			<div id="pub">
			<input type="submit" value="Publie" name="publie">
			<label>Choisissez le domaine ou vous voullez publier </label>

			<select name="domaine">

			<?
				$bdd =  new mysqli($host,$user, "root",$bd) ;
    if ($bdd->connect_errno)   	{echo "erreur de connecter  la base :".$bdd->connect_errno.")".$bdd->connect_error;}
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
	</div>	


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

	$sql = "SELECT * FROM posts order by ID ASC ";
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
				<input type="submit" value=" " name="x" Onclick="return confirm('vous avez sure ?')">
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
			<a href="post.php?id=<?echo $id;?>" id="domaine"><?php echo number_format($date_since_posted,0)." ".$time;?></a>
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
				
$sql = "SELECT * FROM comments where post = $id limit 3";
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
<?if ($number_comm>3) {
?>		<div id="click_here">
		<a  href="post.php?id=<?echo $id;?>">Cliquer ici pour voir la publication complet</a>
		</div>
<?}?>
		<div id="commentaire_" >
			<form action="p.php" method="POST">
						<textarea type ="text" id="comment" name="comment"> </textarea>
			
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