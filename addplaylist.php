<html>
<head> 
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js" type="text/javascript"></script>   
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
</head>
<body>
<form method="post" name="link_1" id="link_1">
	<input type="text" name="link_1"/>
	<input type="hidden" name="submit" value="submit"/>
	<button onclick="submit(link_1)">Ajouter !</button>
</form>
<div id="result"></div>

<form method="post" name="link_2" id="link_2">
	<input type="text" name="link_2"/>
	<input type="hidden" name="submit" value="submit"/>
	<button onclick="submit(link_2)">Ajouter !</button>
</form>


<script type="text/javascript">
	

function submit(value)
{
	 
     $.ajax({  
        url : "addplaylist_checker.php",
        type : "POST",
        data : $("#"+value).serialize(),
        success: function(data){
        	$("#result").html(data); // je récupère la réponse du fichier PHP    
                }  
            });    
        return false; // j'empêche le navigateur de soumettre lui-même le formulaire  
}

</script>
<h1>lala</h1>
</body>