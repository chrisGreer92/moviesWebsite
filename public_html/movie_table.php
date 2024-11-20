<?php

	/*Connect to DB*/
	require_once 'login.php';
	
	$con = new mysqli($db_host, $db_user, $db_pass, $db_name);
	if($con->connect_error){
		die("Couldn't Connect to Database" . $con->connect_error);
	}
	
	/*Set up and execute SQL Query Depending on Criteria*/
	$selection = "	SELECT *, Movie.actID AS 'ID' FROM Movie
						LEFT JOIN Actor ON Actor.actID = Movie.actID
						$criteria ORDER BY Movie.mvID";
	
	$search = $con->query($selection);
	
	/*Set up Table Header*/
	echo "<TABLE >
				<tr>
					<th>ID</th>
					<th>Title</th>
					<th>Genre</th>
					<th>Year</th>
					<th>Price</th>
					<th>Main Actor</th>
				</tr>";
	
	/*Use Returned SQL arrays to set up the rest of the table*/
	while ($row = $search->fetch_array(MYSQLI_ASSOC)){
	
		
		echo "<tr>
					<td>${row['mvID']}</td>
					<td>${row['title']}</td>
					<td>${row['genre']}</td>
					<td>${row['year']}</td>
					<td>${row['price']}</td>
					<td>${row['actName']}</td>" ;
					
					/*Create Delete Button in line on the table*/
					/*Option to hide this in case of the delete pages*/
					if(!$suppress_del) { 
					echo "<td><BR>
					<FORM name=\"deleteMov\" id=\"deleteMov\" 
					action=\"movies_delete.php\" method=\"post\">
					<INPUT type=\"hidden\" name=\"delete_id\" 
					value=\"${row['mvID']}\"/>
					<INPUT type=\"submit\"  class=\"delete\" 
					value=\"Delete\"></FORM>
					</td>" ;
					}

		echo "</tr>";
	}
	echo "</TABLE>";
	
	mysqli_close($con); /*Close the connection*/
?>