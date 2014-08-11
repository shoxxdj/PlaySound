<?php
	require_once('includes/bdd.php');
	require_once('includes/sessions.php');
?>

<?php
	//fonctions.php
	function verif_password($password)
	{
		//verif MD5 ! 
		return 1;
	}
	function verif_mail($mail,$bdd)
	{
		$r=$bdd->prepare('select id from users where mail=:mail');
		$r->execute(array('mail'=>$mail));

		if($r->rowCount())
		{
			return 1;
		}
		return 0;
	}

?>


	<?php

	if(isset($_POST['mail']) && $_POST['mail']!="" && verif_mail($_POST['mail'],$bdd)
	&& isset($_POST['password']) && $_POST['password']!="" && verif_password($_POST['password'])
	&& !isset($_SESSION['id']) && !isset($_SESSION['pseudo']) && !isset($_POST['reg']))
	{
			$r=$bdd->prepare('select id,pseudo from users where mail=:mail and password=:password LIMIT 1');
			$r->execute(array('mail'=>$_POST['mail'],
							  'password'=>md5($_POST['password'])));
		while($res=$r->fetch())
		{
			$_SESSION['id']=$res['id'];
			$_SESSION['pseudo']=$res['pseudo'];
		}
	}

	if(isset($_POST['pseudo']) && isset($_POST['mail']) && isset($_POST['password']) &&	isset($_POST['password2'])
		&& $_POST['pseudo']!="" && $_POST['mail']!="" && $_POST['password']!="" && isset($_POST['reg'])) 
	{
		if($_POST['password']==$_POST['password2'])
		{
			if(!verif_mail($_POST['mail'],$bdd))
			{
				$r=$bdd->prepare('insert into users (pseudo,mail,password) values (:pseudo,:mail,:password)');
				$r->execute(array('pseudo' => $_POST['pseudo'],
								  'mail' => $_POST['mail'],
								  'password' => md5($_POST['password'])));
				$s=$bdd->prepare('select id,pseudo from users where mail=:mail and password=:password');
				$s->execute(array('mail'=>$_POST['mail'],
							  'password'=>$_POST['password']));
				while($res=$s->fetch())
				{
					$_SESSION['id']=$res['id'];
					$_SESSION['pseudo']=$res['pseudo'];
				}

			}
			else
			{
				echo "<script>alert('Ce mail est déja utilisé');</script>";
			}
		}
		else
		{
			echo "<script>alert('les mots de passe sont differents');</script>";
		}
	}





	?>



			<?php if(isset($_SESSION['id']))
			{
				include('includes/head_log.php.inc');

				$req=$bdd->prepare('select u.pseudo as pseudo, f.id_following as id from follow f join users u on f.id_following=u.id where f.id_user=:id_user');
				$req->execute(array('id_user'=>$_SESSION['id']));

				while($r=$req->fetch()) 
				{
				$name=$bdd->prepare('select p.name as playlist_name from playlist p where p.id_owner=:id_owner');
				$name->execute(array('id_owner'=>$r['id']));

				$play=$bdd->prepare('select id_songs from playlist where id_owner=:id_owner');
				$play->execute(array('id_owner' => $r['id']));
					
				// s.name as song_name, s.url as song_url 

			?>


				<div class='playlist_min'>
				<?php echo $r['pseudo']; ?>
				<?php 
				while($playlist_name=$name->fetch())
				{
					echo $playlist_name['name'];
					while($playlist=$play->fetch())
					{

						$id_song=explode(";",$playlist['id_songs']);
						foreach ($id_song as $value) 
						{

							$songs=$bdd->prepare('select name, url from songs where id=:id');
							$songs->execute(array('id'=>$value));
							$res=$songs->fetch();
							if($res!="")
							{
								echo "</br>";
								echo "<a href=".$res['url'].">".$res['name']."</a>";
								
							}
						}
						echo "</br>";
						echo $playlist['id']."<>".$playlist['id']."</br>";
					}
				}
				?>
				</div>	
				</hr>

			<?php
				}
					//End on While following
					if($req->rowCount()<5)
					{
						?>
						<div class='no_friends'>
						Add friends ! 
						</div>
						<?php
					}

					//End on if(isset($_SESSION['id']))
			}
			else
			{
				include('includes/head_no_log.php.inc');
				//Affichage du formulaire d'enregistrement/connection
			?>

			<div class='top_bar'>
				<form method='post' action>
					<input type='mail' name='mail'/>
					<input type='password' name='password'/>
					<input type='submit' value='Connect !'/>
				</form>
			</div>
			<div id='registring'>
				<form method="post" action>
					<input type='text' name='pseudo'/>
					<input type='mail' name='mail'/>
					<input type='password' name='password'/>
					<input type='password' name='password2'/>
					<input type='hidden' name='reg' value='register'/>
					<input type='submit' value='Register !'/>
				</form>
			</div>
		<?php
			}
		?>


	</body>