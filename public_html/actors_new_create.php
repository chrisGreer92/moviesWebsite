<HTML>
	<HEAD>
		<LINK href="form.css" rel="stylesheet">
		<TITLE>Create Actor</TITLE>
	</HEAD>
	<BODY>
		<?php include "nav/nav.php" ;?>
		<?php
			/*Include validation file to get the functions*/
			include "phpValidation.php";
			
			/*Set Variables from Form*/
			if (isset($_POST["actName"]) && $_POST["actName"] != "")
				$actName = fix_string($_POST["actName"]);
				
			/*php Vaidation in case of issues with JS*/
			$fail = validate_creation($actName, "Actor","Name");
		
			if( $fail == "" ){
				/*Connect to DB*/
				require_once 'login.php';
	
				$con = new mysqli($db_host, $db_user, $db_pass, $db_name);
				if($con->connect_error){
					die("Couldn't Connect to Database" . $con->connect_error);
				}
				
				/*Set up and execute SQL Creation Query*/
				$creation = "INSERT INTO Actor (actName) VALUES ( '$actName' )";
				$new_act = $con->query($creation);
				
				/*check if any issues creating actor and inform user*/
				if($new_act) {
					echo "<H2> Actor Created</H2>";
				} else {
					$error = $con->error;
					echo "<H2 class=\"error\"> Problem Creating Actor
							<BR>$error</H2>";
				}
			
				/*If they set to link to movie, capture the new actor ID and update movie*/
				$ID = $con->insert_id;
				if (isset($_POST["title"]) && $_POST["title"] != ""){
					$title = fix_string($_POST["title"]);
					$linking = "UPDATE Movie SET actID = '$ID' WHERE Movie.title='$title'";
					$link = $con->query($linking);
				}
				/*Show newly created actor*/
				$criteria = "WHERE Actor.actID = '$ID'";
				include "actor_table.php";
			}
			else{ /*Show errors if failed php validation*/
				echo "<H2 class=\"error\"> $fail </H2>";	
			}
			mysqli_close($con); /*Close the connection*/

?>	
	<BR> <!-- Button to create a new Actor -->
	<form action="actors_new.php">
		<input type="submit" value="New Actor" />
	</form>
	</BODY>
</HTML>