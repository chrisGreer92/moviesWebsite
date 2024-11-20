<HTML>
	<HEAD>
		<LINK href="form.css" rel="stylesheet">
		<TITLE>Search Actors</TITLE>
		
		<!--Include Javascript Validation Functions-->
		<SCRIPT type="text/javascript" src="validate.js"></SCRIPT>
  	</HEAD>
  	<BODY onload="act_search.reset();"> <!--Reset fields when page is reloaded-->
  		<?php include "nav/nav.php"; ?> 	
   	<H1>Search Actors</H1>
   	<H2>Enter Criteria</H2>
   	
		<!--Include Value lists, dynamically set up using php-->
		<?php include "value_lists.php";?>
		
		<!--Set up form for searching Actors table-->
    	<FORM id="act_search" action="actors_search_results.php" 
    		 onsubmit="return validate_act(this,document);" method="post">
    		
      	By Name <BR>
      	<INPUT list="actor_names" autocomplete="off" 
      	type="text" maxlength="32" name="actName">     
      	<BR><BR>
      	
			By Movie <BR>
      	<INPUT list="movie_titles" autocomplete="off" 
      	type="text" maxlength="32" name="actMov">     
      	<BR><BR>
      	
      	<!--A blank error message, filled using JS validation-->
      	<P id="required" class="error"></P><BR>
      	
      	<INPUT type="submit" value="Search"> <BR>
    	</FORM>
    	<!--Show the actors table (with no search criteria)-->
    	<?php include "actor_table.php"; ?>
  </BODY>
</HTML>
