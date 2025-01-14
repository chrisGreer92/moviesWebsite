<?php
	/*Connect to DB*/
	require_once 'login.php';
	
	$con = new mysqli($db_host, $db_user, $db_pass, $db_name);
	if($con->connect_error){
		die("Couldn't Connect to Database" . $con->connect_error);
	}
	
	/*Set up and run our queries, only need unique values for the lists*/
	$actors = "SELECT DISTINCT actName FROM Actor ORDER BY actName";
	$actor_names = $con->query($actors);
	
	$titles = "SELECT DISTINCT title FROM Movie ORDER BY title";
	$movie_titles = $con->query($titles);
	
	$genres = "SELECT DISTINCT genre FROM Movie WHERE genre <> '' ORDER BY genre";
	$movie_genres = $con->query($genres);
	
	/*close the connection*/
	mysqli_close($con);
	
	/*Using the arrays generated, dynamically create DATALISTs*/
	echo "<DATALIST id=\"movie_titles\">";
	while ($row = $movie_titles->fetch_array(MYSQLI_ASSOC)){
		echo "<option value=\"" . $row['title'] . "\">";
	}
	echo "</DATALIST>";
	
	echo "<DATALIST id=\"actor_names\">";
	while ($row = $actor_names->fetch_array(MYSQLI_ASSOC)){
		echo "<option value=\"" . $row['actName'] . "\">";
	}
	echo "</DATALIST>";
	
	echo "<DATALIST id=\"movie_genres\">";
	while ($row = $movie_genres->fetch_array(MYSQLI_ASSOC)){
		echo "<option value=\"" . $row['genre'] . "\">";
	}
	echo "</DATALIST>";
	
	/*Create years in reverse order starting from this year ending in 1888*/
	echo "<DATALIST id=\"years\">";
	for($year = date("Y"); $year >= 1888 ; $year--){
		echo "<option value=\"" . $year . "\">";
	}
	echo "</DATALIST>";
	
?>