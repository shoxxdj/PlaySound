<?php
	include('includes/bdd.php');
	for($i=1;$i<11;$i++)
	{
		if(isset($_POST["url_$i"]))
		{
			$req=$bdd->prepare('select name from songs where url=:url');
			$req->execute(array('url'=>$_POST["url_$i"]));

			if($req->rowCount()!=0)
			{
				$r=$req->fetch();
				echo $r['name'];
			}
			else
			{
				echo "NOPE";
			}


			
			$i=11;
		}
	}
?>
