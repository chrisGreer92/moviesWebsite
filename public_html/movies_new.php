<HTML>
 	<HEAD>
		<LINK href="form.css" rel="stylesheet">
		<TITLE>Create Movie</TITLE>
		
		<!--Include Javascript Validation Functions-->
		<SCRIPT type="text/javascript" src="validate.js"></SCRIPT>
		
		<!-- Set up script that will handle changing of Link/Create Actor Lable-->
		<SCRIPT>
		function link() {
			document.getElementById("lin_cre").innerHTML = "Link to Existing Actor";
			document.getElementById("name_input").setAttribute("list","actor_names");
		}
		function create() {
			document.getElementById("lin_cre").innerHTML = "Create New Main Actor";
			document.getElementById("name_input").setAttribute("list","");
		}
		</SCRIPT>
		
  	</HEAD>
  	<BODY onload="mov_new.reset();"> <!--Reset fields when page is reloaded-->
  		<?php include "nav/nav.php";?>
    	<H1>Create New Movie</H1>
    	<H2>Enter Details</H2>
    	
    	<!--Include Value lists, dynamically set up using php-->
		<?php include "value_lists.php";?>
		
		<!--Set up the form for actor creation-->
    	<FORM id="mov_new" action="movies_new_create.php" 
    			onsubmit="return validate_new_mov(this,document)" method="post">
    			
      		Title  <BR> 
      		<!--Include initially blank warning messages, filled using JS validation-->
      		<P id="req_title" class="warning"></P>
      		<INPUT type="text" id="title_input" maxlength="32" 
      					name="movName" autocomplete="off" >
      		<BR><BR>
      		
      		Genre  <BR>
      		<INPUT list="movie_genres" type="text" maxlength="32" 
      					name="movGen" autocomplete="off" >
      		<BR><BR>
      		
      		Year  <BR>
      		<!--Include initially blank warning messages, filled using JS validation-->
      		<P id="inv_year" class="warning"></P>
      		<INPUT id="year_input" list="years" type="number" maxlength="32" 
      					name="movYear" autocomplete="off" >
      		<BR><BR>
      		
      		Price
      		<!--Include initially blank warning messages, filled using JS validation-->
      		<P id="inv_price" class="warning"></P>
      		<INPUT id="price_input" type="text" maxlength="32" 
      					name="movPri" autocomplete="off">
      		<BR><BR>
      		
      		<!--Actor field title, changed by setting radio button-->
        		<P id="lin_cre"> Create New Main Actor</P>
        		<!--Include initially blank warning messages, filled using JS validation-->
        		<P id="req_actor" class="warning"></P>
        		<!--List initially not set but set by js on choosing "Link"-->
      		<INPUT id="name_input" list="" type="text" maxlength="32" 
      					name="actName" autocomplete="off">
      		<BR>
      		
      		<!--Set up radio buttons, that allow choice of creating new actor (default)-->
      		<!--OR linking an existing actor (and choosing name from dropdown)-->
        		<label class="radio-inline">
      			<input type="radio" onclick="create()" name="link_create" 
      						value="Create" checked="checked">Create New
    			</label>
    			<label class="radio-inline">
      			<input type="radio" onclick="link()" 
      						value="Link" name="link_create">Link To
    			</label>
      		<BR><BR>
      		
      		<!--A blank error message, filled using JS validation-->
      		<P id="required" class="error"></P><BR>
      		
      		<INPUT type="submit" value="Create"> <BR>
    	</FORM>
    	<!--Show the movies table (with no search criteria)-->
    	<?php include "movie_table.php";?>
  </BODY>
</HTML>