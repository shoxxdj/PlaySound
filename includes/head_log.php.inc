<html>
	<head>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js" type="text/javascript"></script>   
	   	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
		<link type="text/css" rel="stylesheet" href="css/main_styles.css">
	</head>

<body>
	<div id="top_bar">
		<ul>
		   <li><a href='index.php'><span>Home</span></a></li>
		   <li><a href='newplaylist.php'><span>New Playlist</span></a></li>
		   <li><a href='#'><span>Search</span></a></li>
		   <li class="last">
		   				<span>
		   					<form method="post" action>
				   				<input type="hidden" name="disconnect" value="disconnect"/>
								<input type="submit" value="Disconnect"/>
							</form>
						</span>
			</li>
		</ul>
	</div>