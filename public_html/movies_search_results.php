<HTML>
	<HEAD>
		<LINK href="form.css" rel="stylesheet">
		<TITLE>Search Movies</TITLE>
	</HEAD>
	<BODY>
		<?php include "nav/nav.php" ;?>
		<?php
	
		/*Include validation file to get the functions*/
		include "phpValidation.php";

		/*Set Variables from Form*/
		if (isset($_POST["movName"]) && $_POST["movName"] != "")
			$movName = fix_string($_POST["movName"]);
		if (isset($_POST["movGen"]) && $_POST["movGen"] != "")
			$movGen = fix_string($_POST["movGen"]);
		if (isset($_POST["actName"]) && $_POST["actName"] != "")
			$actName = fix_string($_POST["actName"]);
	
		
		/*php Vaidation in case of issues with JS*/
		$fail = validate_criteria($movName . $movGen . $actName);
		
		if( $fail == "" ){
			
			/*Set up criteria variables depending on form input*/
			if(!$movGen && !$actName) { //Just Title
				$criteria = "WHERE title LIKE '%" . $movName . "%'";
			}else if(!$movName && !$actName) { //Just Genre
				$criteria = "WHERE genre LIKE '%" . $movGen . "%'";
			}else if(!$movName && !$movGen) { //Just Actor
				$criteria = "WHERE Actor.actName LIKE '%" . $actName . "%'";
				
			}else if(!$actName) { //Title and Genre
				$criteria = "WHERE title LIKE '%" . $movName . "%'
									AND genre LIKE '%" . $movGen . "%'";
			}else if(!$movGen) { //Title and Actor
				$criteria = "WHERE title LIKE '%" . $movName . "%'
									AND actName LIKE '%" . $actName . "%'";
			}else if(!$movName) { //Actor and Genre
				$criteria = "WHERE genre LIKE '%" . $movGen . "%'
									AND actName LIKE '%" . $actName . "%'";

			} else { // All 3 (Title, Genre, Actor)
				$criteria = "WHERE title LIKE '%" . $movName . "%'
									AND genre LIKE '%" . $movGen . "%'
									AND actName LIKE '%" . $actName . "%'";
			}
			
			/*Show the table with criteria set*/
			echo "<H1> Search Results</H1>";
			include "movie_table.php";
			
		}
		else{ /*Show errors if failed php validation*/
			echo "<H2 class=\"error\"> $fail </H2>";	
			
		}
		mysqli_close($con); /*Close the connection*/
		?>
		
		<BR> <!-- Button to run new Search -->
		<FORM action="movies_search.php">
			<input type="submit" value="New Search"/>
		</FORM>
	</BODY>
</HTML>