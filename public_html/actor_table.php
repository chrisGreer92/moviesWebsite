<?php

	/*Connect to DB*/
	require_once 'login.php';
	
	$con = new mysqli($db_host, $db_user, $db_pass, $db_name);
	if($con->connect_error){
		die("Couldn't Connect to Database" . $con->connect_error);
	}
	
	/*Set up and execute SQL Query Depending on Criteria*/
	$selection = "	SELECT *, Actor.actID AS 'ID' FROM Actor
						LEFT JOIN Movie ON Actor.actID = Movie.actID
						$criteria ORDER BY Actor.actID";
	
	$search = $con->query($selection);

	/*Set up Table Header*/
	echo "<TABLE>
				<tr>
					<th>ID</th>
					<th>Actor Name</th>
					<th>Stars In</th>
				</tr>";
		
	/*Use Returned SQL arrays to set up the rest of the table*/
	while ($row = $search->fetch_array(MYSQLI_ASSOC)){
		echo "<tr>
					<td>${row['ID']}</td>
					<td>${row['actName']}</td>
					<td>${row['title']}</td>" ;
					
					/*Create Delete Button in line on the table*/
					/*Option to hide this in case of the delete pages*/
					if(!$suppress_del) { 
					echo "<td><BR><FORM name=\"deleteAct\" id=\"deleteAct\" 
					action=\"actors_delete.php\" method=\"post\">
					<INPUT type=\"hidden\" name=\"delete_id\" 
					value=\"${row['ID']}\"/>
					<INPUT type=\"submit\" class=\"delete\"
					value=\"Delete\"></FORM>
					</td>" ;
					}

		echo "</tr>";
	}
	echo "</TABLE>";
	
	mysqli_close($con); /*Close the connection*/
?>