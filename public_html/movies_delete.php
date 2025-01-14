<HTML>
  <HEAD>
	<LINK href="form.css" rel="stylesheet">
	<TITLE>Delete Movie</TITLE>
	</HEAD>
	<BODY>
		<?php include "nav/nav.php" ;?>
		<?php
			/*Include validation file to get the functions*/
			include "phpValidation.php";
			
			/*Connect to DB*/
			require_once 'login.php';			
			
			$con = new mysqli($db_host, $db_user, $db_pass, $db_name);
				if($con->connect_error){
					die("Couldn't Connect to Database" . $con->connect_error);
				}
						
			/*Set ID if running from delete form/button*/
			if (isset($_POST["delete_id"]) && $_POST["delete_id"] != ""){
				$delete_id = fix_string($_POST["delete_id"]);
	
				/*php Vaidation in case ID not set*/
				$fail = validate_criteria($delete_id);
		
				if( $fail == "" ){
									 		
					/*Set up and execute SQL search Query*/
					$search_actor = "SELECT Actor.actID AS 'ID' FROM Actor, Movie
											WHERE Actor.actID = Movie.actID
									 		AND mvID=$delete_id";
									 		
					$search_act = $con->query($search_actor);
					
					/*Check if there's an actor linked, if so ask if they want to delete both*/
					if($search_act) {
					
						$row = $search_act->fetch_array(MYSQLI_ASSOC);
						$actor_id = $row['ID'];						
						
						echo "<H2 class=\"error\"> Movie has an actor linked. 
    							<BR> Would you Like to Delete Both? </H2>";
    						
    					/*Option to just delete movie*/
    					/*runs this form again but with different post field*/
    					echo "<FORM name=\"justMov\" id=\"justMov\" 
								action=\"movies_delete.php\" method=\"post\">
								<INPUT type=\"hidden\" name=\"movie_id\" 
								value=\"$delete_id\"/>
								<INPUT type=\"submit\" class=\"delete\"
								value=\"Just Movie\"></FORM>";
    					
						/*Option to delete both, runs the delete both php*/
    					echo "<FORM name=\"deleteBoth\" id=\"deleteBoth\" 
								action=\"delete_both.php\" method=\"post\">
								<INPUT  type=\"hidden\" name=\"delete_id\" 
								value=\"$actor_id\"/>
								<INPUT type=\"submit\" class=\"delete\"
								value=\"Delete Both\"></FORM>";		
						
						/*Show the records to be deleted*/	
						$criteria = "WHERE mvID=$delete_id ";
						/*At this point delete button on table is unnecessary so suppress*/
    					$suppress_del = 1; 
								
						include "movie_table.php";
						
					}else { /*If there's no actor linked, just delete movie*/
						
						
						/*Set up and execute SQL delete Query*/
						$deletion = "DELETE FROM Movie WHERE actID=$delete_id";
						$delete = $con->query($deletion);
				
						/*Check if successfull and inform user*/
						if($delete) {
							echo "<BR><H2> Movie Deleted Successfully</H2><BR>";
							include "movie_table.php";
						} else {
    						$error = $con->error;
							echo "<H2 class=\"error\"> Problem Deleting Movie
							<BR>$error</H2>";					
						}
					}
				}else { /*Will only fail here if the id isn't set*/
					echo "<H2> $fail </H2>";
				}
			
			/*Set ID if running this from the "only movie" form/button*/
			}elseif(isset($_POST['movie_id'])) {
				$movie_id = fix_string($_POST["movie_id"]);
			
				/*php Vaidation in case ID not set*/
				$fail = validate_criteria($movie_id);
				
				if($fail =="" ) {	
				
					/*Set up and execute SQL delete Query*/		
					$deletion = "DELETE FROM Movie WHERE mvID=$movie_id";
					$delete = $con->query($deletion);
				
					/*Check if successfull and inform user*/
					if($delete) {
						echo "<BR><H2> Movie Deleted Successfully</H2><BR>";
						include "movie_table.php";
					} else {
    					$error = $con->error;
						echo "<H2 style=\"color: darkred\";> Problem Deleting Movie
								<BR>$error</H2>";					
					}
				}else { /*Will only fail here if the id isn't set*/
					echo "<H2> $fail </H2>";
				}
			}
			mysqli_close($con); /*Close the connection*/
		?>	
	</BODY>
</HTML>