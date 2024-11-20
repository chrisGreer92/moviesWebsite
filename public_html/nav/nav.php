<html>
	<head> <!--Set the nav bar up-->
		<meta name="nav" content="max-width=10em width=100%">
		<link href="nav/nav.css" rel="stylesheet">
	</head>
	<body>
		<!--Get the name of the page we're currently on-->
		<?php $file = $_SERVER["SCRIPT_NAME"];?>

		<div class="topnav">
			<!--href link to go to page when clicked-->
			<a href="home.php"
 				<?php if (preg_match('/(hom)/',$file)){
					echo "class=\"active\"";}?>
			>Home
  			</a><!--php logic above to check page name for which one we set as active-->
  	
  			<a href="movies_search.php"
				<?php if (preg_match('/(movies_search)/',$file)){
					echo "class=\"active\"";}?>  
  			>Search Movies
  			</a>
  	
			<a href="actors_search.php"
  				<?php if (preg_match('/(actors_search)/',$file)){
					echo "class=\"active\"";}?>
			>Search Actors
  			</a>
  	
  			<a href="movies_new.php"
	  			<?php if (preg_match('/(movies_new)/',$file)){
					echo "class=\"active\"";}?>
			>New Movie
  			</a>
  	
  			<a href="actors_new.php"
  				<?php if (preg_match('/(actors_new)/',$file)){
					echo "class=\"active\"";}?>
			>New Actor
  			</a>
		</div>

	</body>
</html>