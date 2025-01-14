<HTML>
	<HEAD>
		<LINK href="form.css" rel="stylesheet">
		<TITLE>Search Movies</TITLE>
		
		<!--Include Javascript Validation Functions-->
		<SCRIPT type="text/javascript" src="validate.js"></SCRIPT>
  	</HEAD>
  	<BODY onload="mov_search.reset();"> <!--Reset fields when page is reloaded-->
  		<?php include "nav/nav.php"; ?> 	
   	<H1>Search Movies</H1>
   	<H2>Enter Criteria</H2>
   	
   	<!--Include Value lists, dynamically set up using php-->
		<?php include "value_lists.php"; ?>


		<!--Set up form for searching Movies table-->
    	<FORM id="mov_search" action="movies_search_results.php" 
    		onsubmit="return validate_mov(this,document)" method="post">
    		
      	By Title <BR>
      	<INPUT list="movie_titles" autocomplete="off" 
      	type="text" maxlength="32" name="movName">     
      	<BR><BR>
      	
      	By Genre <BR>
      	<INPUT list="movie_genres" autocomplete="off" 
      	type="text" maxlength="32" name="movGen">     
      	<BR><BR>
      	
      	By Actor <BR>
      	<INPUT list="actor_names" autocomplete="off" 
      	type="text" maxlength="32" name="actName">     
      	<BR><BR>
      	
      	<!--A blank error message, filled using JS validation-->
      	<P id="required" style="color:darkred"></P><BR>
      	
      	<INPUT type="submit" value="Search"> <BR>
    	</FORM>
    	<!--Show the actors table (with no search criteria)-->
    	<?php include "movie_table.php"; ?>
  </BODY>
</HTML>
