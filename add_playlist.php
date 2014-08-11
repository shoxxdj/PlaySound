<?php
	require_once("includes/sessions.php");
	require_once("includes/bdd.php");
	
	$ids="";
	for($i=1;$i<11;$i++)
	{
		if(isset($_POST["url_$i"]) && $_POST["url_$i"]!="")
		{
			$req=$bdd->prepare("select id from songs where url=:url");
			$req->execute(array('url'=>$_POST["url_$i"]));

			if($req->rowCount()==0)
			{
				$name="#ADD_NAME";
				if(isset($_POST["name_$i"]) && $_POST["name_$i"]!="")
				{
					//UNXSS IT ! 
					$name=htmlspecialchars($_POST["name_$i"]);
				}

				$add=$bdd->prepare('insert into songs (url,name,id_user) values (:url,:name,:id_user)');
				$add->execute(array('url'=>$_POST["url_$i"],
									'name'=>$name,
									'id_user'=>$_SESSION['id']));

				$find=$bdd->prepare('select id from songs where url=:url and id_user=:id_user and name=:name');
				$find->execute(array('url'=>$_POST["url_$i"],
									'name'=>$name,
									'id_user'=>$_SESSION['id']));
				$r=$find->fetch();
				$song_id=$r['id'];
			}
			else
			{
				$r=$req->fetch();
				$song_id=$r['id'];
			}
			$ids.=$song_id.";";
		}	
	}
	$name="#TOBEDEFINED";
	if(isset($_POST['name']) && $_POST['name']!="")
	{
		$name=htmlspecialchars($_POST['name']);
	}

	if($ids!="")
	{
		$req=$bdd->prepare('insert into playlist (name,id_songs,id_owner,date) values (:name,:id_songs,:id_owner,:date)');
		$req->execute(array(
							'name'=>$name,
							'id_songs'=>$ids,
							'id_owner'=>$_SESSION['id'],
							'date'=>date('Y/m/d')));
		echo "DONE";
	}
	else
	{
		echo "NOSONGS";
	}
	?>