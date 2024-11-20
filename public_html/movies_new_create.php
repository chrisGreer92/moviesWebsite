<HTML>
	<HEAD>
		<LINK href="form.css" rel="stylesheet">
		<TITLE>Create Movie</TITLE>
	</HEAD>
	<BODY>
		<?php include "nav/nav.php" ;?>
		<?php
			/*Include validation file to get the functions*/
			include "phpValidation.php";
			
			/*Set Required Variables from Form*/
			if (isset($_POST["movName"]) && $_POST["movName"] != "")
				$movName = fix_string($_POST["movName"]);
			if (isset($_POST["actName"]) && $_POST["actName"] != "")
				$actName = fix_string($_POST["actName"]);
				
			/*Check if linking or creating actor*/
			if (isset($_POST["link_create"]) && $_POST["link_create"] != "")
				$link_create = fix_string($_POST["link_create"]);
				
			/*Set the unrequired variables, if price/year not filled set to "NULL"*/
			if (isset($_POST["movGen"]) && $_POST["movGen"] != "")
				$movGen = fix_string($_POST["movGen"]);	
			if (isset($_POST["movYear"]) && $_POST["movYear"] != ""){
				$movYear = fix_string($_POST["movYear"]);
				$fail .= check_year($movYear);
			} else { $movYear ="NULL" ;
			}
			if (isset($_POST["movPri"]) && $_POST["movPri"] != ""){
				$movPri = fix_string($_POST["movPri"]);
				$fail .= check_currency($movPri);
			} else { $movPri ="NULL" ;
			}
	
			/*php Vaidation in case of issues with JS*/
			$fail = validate_creation($movName, "Movie", "title");		
			$fail .= validate_creation($actName, "Movie", "Main Actor");


			if( $fail == "" ){
			
				/*Connect to DB*/
				require_once 'login.php';
	
				$con = new mysqli($db_host, $db_user, $db_pass, $db_name);
				if($con->connect_error){
					die("Couldn't Connect to Database" . $con->connect_error);
				}
				
				/*If we're creating the actor do that first*/
				if($link_create == "Create") {
					
					/*Set up and execute SQL creation query*/
					$actor = "INSERT INTO Actor (actName) VALUES ( '$actName' )";
					$new_act = $con->query($actor);
					
					/*Check it was created correctly*/
					if($new_act) {
						/*Get ID of record that was just created*/
						$ID = $con->insert_id;
						echo "<H2> Actor Created Successfully</H2>";
					} else {
						$error = $con->error;
						echo "<H2 class=\"error\"> Problem Creating Actor
								<BR>$error</H2>";
					}
				
				/*IF we're linking actor, first need to find them*/
				}elseif($link_create == "Link") {
					
					/*Set up and execute SQL search query*/
					$actor = "SELECT actID FROM Actor WHERE actName='$actName'";
					$find_act = $con->query($actor);
					
					/*Check if search was successful, inform user if NOT*/
					if($find_act) {
						/*Get the ID of the found record*/
						$row = $find_act->fetch_array(MYSQLI_ASSOC);
						$ID = $row['actID'];
					}else{
						$error = $con->error;
						echo "<H2 class=\"error\"> Problem Finding Actor
								<BR>$error</H2>";
					}
				}
				
				/* If search/find was successful, continue with movie record creation*/
				if($new_act || $find_act) {
						
						/*Set up and execute SQL creation query*/
						/*Use the ID we Created/Found to set the actor foreign key*/
						$movie = "INSERT INTO Movie (title,genre,year,price,actID)
										VALUES ( '$movName','$movGen',$movYear ,$movPri ,'$ID' )";
						$new_mov = $con->query($movie);				
					
				}
		
				/*Check if created successfully and inform user*/
				if($new_mov) {
					echo "<H2> Movie Created Successfully</H2>";
					$criteria = "WHERE Actor.actID = '$ID'";
					include "movie_table.php";
				} else {
						$error = $con->error;
						echo "<H2 class=\"error\"> Problem Creating Movie
								<BR>$error</H2>";	
						
						/*If actor was just created but movie had an issue*/
						/*, Create form/button for option to delete the actor*/
						if($new_act){
							echo "<FORM name=\"deleteAct\" id=\"deleteAct\" 
							action=\"actors_delete.php\" method=\"post\">
							<INPUT type=\"hidden\" name=\"delete_id\" 
							value=\"$ID\"/>
							<INPUT type=\"submit\" class=\"delete\"\" 
							value=\"Delete Actor\"></FORM>";
						}
				}	
				
			}
			else{/*Show errors if failed php validation*/
				echo "<H2 class=\"error\"> $fail </H2>";
			}
		
			mysqli_close($con); /*Close the connection*/
		?>	
		<BR><!-- Button to create a new Movie -->
		<form action="movies_new.php">
			<input type="submit" value="New Movie" />
		</form>
	</BODY>
</HTML>