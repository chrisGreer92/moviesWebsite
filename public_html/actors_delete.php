<HTML>
	<HEAD>
		<LINK href="form.css" rel="stylesheet">
		<TITLE>Delete Actor</TITLE>
	</HEAD>
	<BODY>
		<?php include "nav/nav.php" ;?>
		<?php
			/*Include validation file to get the functions*/
			include "phpValidation.php";
			
			/*Set Variables from delete form/button*/
			if (isset($_POST["delete_id"]) && $_POST["delete_id"] != "")
				$delete_id = fix_string($_POST["delete_id"]);
				
			/*php Vaidation in case ID not set*/
			$fail = validate_criteria($delete_id);
		
			if( $fail == "" ){
				
				/*Connect to DB*/
				require_once 'login.php';
	
				$con = new mysqli($db_host, $db_user, $db_pass, $db_name);
				if($con->connect_error){
					die("Couldn't Connect to Database" . $con->connect_error);
				}
				
				/*Set up and execute SQL Query*/
				$deletion = "DELETE FROM Actor WHERE actID=$delete_id";
				$delete = $con->query($deletion);
				
				/*Capture error*/
				$error = $con->error;
				
				if($delete) {/*If deleted fine, inform the user*/
					echo "<BR><H2> Actor Deleted Successfully</H2><BR>";
					include "actor_table.php";
					
					/*If not, check if it's because of fk constraint*/
				} elseif(strpos($error,'update a parent row') ==	false) {
					echo "<H2 class=\"error\"> Problem Deleting Records
							<BR>$error</H2>";
							
				} else { /*If it is, give user the option to delete both*/
    				echo "<H2 class=\"error\">  Actor Cannot Be Deleted Without Also
    						Deleting The Related Movie. 
    						<BR> Would you Like to Delete Both? </H2>";
    						
    				/*Setup form button to do the deleting*/
    				echo "<FORM name=\"deleteBoth\" id=\"deleteBoth\" 
							action=\"delete_both.php\" method=\"post\">
							<INPUT type=\"hidden\" name=\"delete_id\" 
							value=\"$delete_id\"/>
							<INPUT type=\"submit\" class=\"delete\"
							value=\"Delete Both\"></FORM>";
					
					/*Show the records to be deleted*/	
					$criteria = "WHERE Actor.actID=$delete_id ";
					/*At this point delete button on table is unnecessary so suppress*/
    				$suppress_del = 1;
								
					include "actor_table.php";
				}
			
			}
			else{ /*Will only fail here if there's no id originally*/
				echo "<H2 class=\"error\">  $fail </H2>";
			}
			mysqli_close($con); /*Close the connection*/
		?>	
	</BODY>
</HTML>