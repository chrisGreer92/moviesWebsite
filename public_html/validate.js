// Check any of the actor search criteria is set
function validate_act (form,doc){   
    
    if (form.actName.value =="" && form.actMov.value ==""){
    	
    	alert("No Search Criteria Entered");
    	doc.getElementById("required").innerHTML = "Search Criteria Required";
				
    	return false;
    }
    // Actors names could be checked for numbers but some actors have odd names...
    // E.g. Andre 3000

    return true;
}

// Check if actor name has been set for creation
function validate_new_act (form,doc) {
	
	if (form.actName.value ==""){
		
   	alert("Actor Needs a Name");
    	doc.getElementById("required").innerHTML = "Actor Requires a Name";
    	doc.getElementById("req_actor").innerHTML = "Required";
    	doc.getElementById("name_input").setAttribute("style","border-color:red");
    	
     	return false;
   }
   
   return true;
	
}

// Check any of the movie search criteria is set
function validate_mov (form,doc){   
    
    if (form.actName.value =="" && form.movName.value ==""
    		&& form.movGen.value ==""){

    	alert("No Search Criteria Entered");
    	doc.getElementById("required").innerHTML = "Search Criteria Required";
     	return false;
    }

    return true;
}


// Check if movie title/actor has been set for creation
// ALSO whether the price and year are valid
function validate_new_mov (form,doc){   
    
	var alrt = "";    
    
    if (form.movName.value =="" || form.actName.value =="" ){
    			
      doc.getElementById("required").innerHTML = "Movie Requires a Title and Main Actor";
      doc.getElementById("req_title").innerHTML = "Required";
      doc.getElementById("req_actor").innerHTML = "Required";
      doc.getElementById("name_input").setAttribute("style","border-color:red");
      doc.getElementById("title_input").setAttribute("style","border-color:red");	 
       
      var values = "Movie needs a Title and Main Actor\r\r";
      alrt = alrt.concat(values);
    }
    
    if (form.movYear.value !=null && form.movYear.value !=""){
		if (form.movYear.value < 1888 || form.movYear.value > new Date().getFullYear() ){
    		//alert("Invalid Year");
    		doc.getElementById("year_input").setAttribute("style","border-color:red");
    		doc.getElementById("inv_year").innerHTML = "Invalid Year";
    		
			var year = "Invalid Year\r\r";
      	alrt = alrt.concat(year);
      }
    }
    
    if (form.movPri.value !=null && form.movPri.value !=""){
		var regex = /^-?[0-9]+(?:\.[0-9]{1,2})?$/;
		if (!regex.test(form.movPri.value)){
    		//alert("Invalid Price Format");
    		doc.getElementById("price_input").setAttribute("style","border-color:red");
    		doc.getElementById("inv_price").innerHTML = "Invalid Price Format";

			var price = "Invalid Price Format\r\r";
      	alrt = alrt.concat(price);
      }
    }
    
    
    if (alrt){ //Display alert with all the alert strings
    	alert(alrt);
    	return false;
    }

    return true;
}
