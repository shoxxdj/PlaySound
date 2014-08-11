<?php
	require_once('includes/sessions.php');
	if(isset($_SESSION['id']))
		{
			include('includes/head_log.php.inc');
			require_once('includes/bdd.php');
?>
<div id="success" class="hidden">
	<p> You Succed ! </p>
</div>

<div id="nosongs" class="hidden">
	<p> Please add songs !</p>
</div>
<div id="playlist_add">
<input type="text" name="name_of_playlist" id="name_of_playlist"/>
</br>
<?php
		for($i=1;$i<11;$i++)
		{
?>

	<input type="text" id="url_<?php echo $i;?>" name="url_<?php echo $i;?>" placeholder="URL"/>
	<input class="hidden" id="hidden_<?php echo $i;?>" type="hiden" name="name_<?php echo $i;?>" placeholder="Entrez un nom"/>
	<button name="add_<?php echo $i;?>" onclick="verify(<?php echo $i; ?>)">Ajouter</button>
	<span class="hidden" id="inbase_<?php echo $i;?>">Already in base</span>
	</br>

<?php
		}
?>
</div>
<button name="add_my_playlist" onclick="add_my_playlist()">Envoyer ma Playlist ! </button>


	<script type="text/javascript">
		  function verify(i){
             $.ajax({
            url : "url_verifier.php",
            type : "POST",
            data : $("#url_"+i).serialize(),
            success: function(data){
                if(data=="NOPE")
                {
                	$("#hidden_"+i).attr("class","visible");
                	$("#hidden_"+i).attr("id","name_"+i);
                }
                else if(data!="")
                {
                	$("#inbase_"+i).attr("class","visible");
                }
            }
        });
        return false};


        function add_my_playlist(){
        	 $.ajax({
        	url : "add_playlist.php",
        	type : "POST",
        	data : {
        	"name":$("#name_of_playlist").val(),
        	"url_1":$("#url_1").val(),"name_1":$("#name_1").val(),
        	"url_2":$("#url_2").val(),"name_2":$("#name_2").val(),
        	"url_3":$("#url_3").val(),"name_3":$("#name_3").val(),
        	"url_4":$("#url_4").val(),"name_4":$("#name_4").val(),
        	"url_5":$("#url_5").val(),"name_5":$("#name_5").val(),
        	"url_6":$("#url_6").val(),"name_6":$("#name_6").val(),
        	"url_7":$("#url_7").val(),"name_7":$("#name_7").val(),
        	"url_8":$("#url_8").val(),"name_8":$("#name_8").val(),
        	"url_9":$("#url_9").val(),"name_9":$("#name_9").val(),
        	"url_10":$("#url_10").val(),"name_10":$("#name_10").val()
		        },
        	success : function(data){
        		if(data=="DONE")
        		{
        			$("#success").attr("class","visible");
        			$("#nosongs").attr("class","hidden");
        		}
        		if(data=="NOSONGS")
        		{
					$("#nosongs").attr("class","visible");
					$("#success").attr("class","hidden");
        		}
        	}
        });
        return false};
	</script>



<?php
}
else
{
	header('Location : index.php');
}
?>

