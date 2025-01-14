<HTML>
	<HEAD>
		<LINK href="form.css" rel="stylesheet">
		<TITLE>Delete Both</TITLE>
	</HEAD>
	<BODY>
		<?php include "nav/nav.php" ;?>

		<?php

			/*Include validation file to get the functions*/
			include "phpValidation.php";
			
			/*Set Variables from Form*/
			if (isset($_POST["delete_id"]) && $_POST["delete_id"] != "")
				$delete_id = fix_string($_POST["delete_id"]);
	
			/*php Vaidation in case of issues with JS*/
			$fail = validate_criteria($delete_id);
		
			if( $fail == "" ){
				
				/*Connect to DB*/
				require_once 'login.php';
	
				$con = new mysqli($db_host, $db_user, $db_pass, $db_name);
				if($con->connect_error){
					die("Couldn't Connect to Database" . $con->connect_error);
				}
				
				/*Set up and execute SQL Queries to delete from both*/
				$mov_deletion = "DELETE FROM Movie WHERE actID=$delete_id";
				$mov_delete = $con->query($mov_deletion);
				
				/*Check movie was deleted successfully*/
				if($mov_delete) {
					echo "<BR><H2> Movie Deleted Successfully</H2>";
				} else {
    				$error = $con->error;
					echo "<H2 class=\"error\"> Problem Deleting Movie
							<BR>$error</H2>";
				}
			
				$act_deletion = "DELETE FROM Actor WHERE actID=$delete_id";
				$act_delete = $con->query($act_deletion);
				
				/*Check actor was deleted successfully*/
				if($act_delete) {
					echo "<H2> Actor Deleted Successfully</H2>";
				} else {
    				$error = $con->error;
					echo "<H2 class=\"error\"> Problem Deleting Actor
							<BR>$error</H2>";
				}

				/*Show the movie table*/
				echo "<BR>";
				include "movie_table.php";
			
			}
			else{ /*Will only fail php validation if no id is set*/
				echo "<H2 class=\"error\">  $fail </H2>";
			}
			mysqli_close($con); /*Close the connection*/
	?>	
	</BODY>
</HTML>