<HTML>
	<HEAD>
		<LINK href="form.css" rel="stylesheet">
		<TITLE>Search Actors</TITLE>
	</HEAD>
	<BODY>
		<?php include "nav/nav.php" ;?>
		<?php
	
			/*Include validation file to get the functions*/
			include "phpValidation.php";
		
			/*Set Variables from Form*/
			if (isset($_POST["actName"]) && $_POST["actName"] != "")
				$actName = fix_string($_POST["actName"]);
			if (isset($_POST["actMov"]) && $_POST["actMov"] != "")
				$actMov = fix_string($_POST["actMov"]);
	
			/*php Vaidation in case of issues with JS*/
			$fail = validate_criteria($actName . $actMov);
		
			if( $fail == "" ){
				
				/*Set up criteria variables depending on form input*/
				if(!$actMov) {
					$criteria = "WHERE actName LIKE '%" . $actName . "%'";
				}else if(!$actName) {
					$criteria = "WHERE Movie.title LIKE '%" . $actMov . "%'";
				} else {
					$criteria = "WHERE actName LIKE '%" . $actName . "%'
									AND Movie.title LIKE '%" . $actMov . "%'";
				}
			
				/*Show the table with criteria set*/
				echo "<H1> Search Results</H1>";
				include "actor_table.php";
			
			}
			else{ /*Show errors if failed php validation*/
				echo "<H2 class=\"error\"> $fail </H2>";
			}
			mysqli_close($con); /*Close the connection*/
		?>
		
		<BR> <!-- Button to run new Search -->
		<FORM action="actors_search.php">
			<input type="submit" value="New Search"/>
		</FORM>
	</BODY>
</HTML>