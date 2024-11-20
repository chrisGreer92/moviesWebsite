<HTML>
 	<HEAD>
		<LINK href="form.css" rel="stylesheet">
		<TITLE>Create Actor</TITLE>
		
		<!--Include Javascript Validation Functions-->
		<SCRIPT type="text/javascript" src="validate.js"></SCRIPT>
  	</HEAD>
  	<BODY onload="act_new.reset();"> <!--Reset fields when page is reloaded-->
  		<?php include "nav/nav.php"; ?>
    	<H1>Create New Actor</H1>
    	<H2>Enter Details</H2>
    	
    	<!--Include Value lists, dynamically set up using php-->
		<?php include "value_lists.php";?>
		
		<!--Set up the form for actor creation-->
    	<FORM id="act_new" action="actors_new_create.php" 
    			onsubmit="return validate_new_act(this,document)" method="post">
    			
      		Actor Name  <BR>
      		<!--Include initially blank warning message, filled using JS validation-->
      		<P id="req_actor" class="warning"></P>
      		<INPUT id="name_input" type="text" maxlength="32" 
      					name="actName" autocomplete="off">
      		<BR><BR>
      		
        		Link to Movie <BR>
      		<INPUT list="movie_titles" type="text" maxlength="32" 
      					name="title" autocomplete="off" >
      		<BR><BR>
      		
      		<!--A blank error message, filled using JS validation-->
      		<P id="required" class="error"></P><BR>
      		
      		<INPUT type="submit" value="Create"> <BR>
    	</FORM>
    	<!--Show the actors table (with no search criteria)-->
    	<?php include "actor_table.php";?>
  </BODY>
</HTML>