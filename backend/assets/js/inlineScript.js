
 var data='';
  var action = '';
  var savebutton = "<input type='button' class='ajaxsave' value='Save'>";
  var updatebutton = "<input type='button' class='ajaxupdate' value='Update'>";
  var cancel = "<input type='button' class='ajaxcancel' value='Cancel'>";
  var emailfilter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;	
   var pre_tds; 
var field_arr = new Array('text','text','text','text','text');
  var field_pre_text= new Array('Enter Paid Amount','Total Man Criteria','Outstanding Amount Due','Due Date','Payment Date');
  var field_name = new Array('paid_amount','payment_type','outstanding_amount','due_date','payment_date'); 
  
 jQuery(function(){
 jQuery.ajax({
	     url:"http://localhost/CodeIgniter/ae/admin/ajax-payment/1",
                  type:"POST",
                  data:"actionfunction=showData",
        cache: false,
        success: function(response){
		 
		  jQuery('#demoajax').html(response);
		  createInput();
		  
		}
		
	   });
 
  
 jQuery('#demoajax').on('click','.ajaxsave',function(){
     
	   var paid_amount =  jQuery("input[name='"+field_name[0]+"']");
	   var payment_type = jQuery("input[name='"+field_name[1]+"']");
	   var outstanding_amount =jQuery("input[name='"+field_name[2]+"']");
	   var due_date = jQuery("input[name='"+field_name[3]+"']");
	   var payment_date = jQuery("input[name='"+field_name[4]+"']");
	   if(validate(paid_amount,payment_type,outstanding_amount,due_date,payment_date)){
	   data = "paid_amount="+paid_amount.val()+"&payment_type="+payment_type.val()+"&outstanding_amount="+outstanding_amount.val()+"&due_date="+due_date.val()+"&payment_date="+payment_date.val()+"&actionfunction=saveData";
       jQuery.ajax({
	     url:"http://localhost/CodeIgniter/ae/admin/ajax-payment/1",
                  type:"POST",
                  data:data,
        cache: false,
        success: function(response){
		   if(response!='error'){
		      jQuery('#demoajax').html(response);
		  createInput();
		     }
		}
		
	   });
      }	
      else{
	   return;
	  }	  
	   });
 jQuery('#demoajax').on('click','.ajaxedit',function(){
      var edittrid = jQuery(this).parent().parent().attr('id');
    	var tds = jQuery('#'+edittrid).children('td');
        var tdstr = '';
		var td = '';
		pre_tds = tds;
		for(var j=0;j<field_arr.length;j++){
		   
		     tdstr += "<td><input type='"+field_arr[j]+"' name='"+field_name[j]+"' value='"+jQuery(tds[j]).html()+"' placeholder='"+field_pre_text[j]+"'></td>";
		  }
		  tdstr+="<td>"+updatebutton +" " + cancel+"</td>";
		  jQuery('#createinput').remove();
		  jQuery('#'+edittrid).html(tdstr);
	   });
	   
 jQuery('#demoajax').on('click','.ajaxupdate',function(){
       var edittrid = jQuery(this).parent().parent().attr('id');
	   var paid_amount =  jQuery("input[name='"+field_name[0]+"']");
	   var payment_type = jQuery("input[name='"+field_name[1]+"']");
	   var outstanding_amount = jQuery("input[name='"+field_name[2]+"']");
	   var due_date = jQuery("input[name='"+field_name[3]+"']");
	   var payment_date = jQuery("input[name='"+field_name[4]+"']");
	   if(validate(paid_amount,payment_type,outstanding_amount,due_date,payment_date)){
	   data = "paid_amount="+paid_amount.val()+"&payment_type="+payment_type.val()+"&outstanding_amount="+outstanding_amount.val()+"&due_date="+due_date.val()+"&payment_date="+payment_date.val()+"&editid="+edittrid+"&actionfunction=updateData";
       jQuery.ajax({
	     url:"http://localhost/CodeIgniter/ae/admin/ajax-payment/1",
                  type:"POST",
                  data:data,
        cache: false,
        success: function(response){
		   if(response!='error'){
		      jQuery('#demoajax').html(response);
		  createInput();
		     }
		}
		
	   });
}
else{
return;
}	   
	   });
 jQuery('#demoajax').on('click','.ajaxdelete',function(){
       var edittrid = jQuery(this).parent().parent().attr('id');
	   
	   data = "deleteid="+edittrid+"&actionfunction=deleteData";
       jQuery.ajax({
	     url:"http://localhost/CodeIgniter/ae/admin/ajax-payment/1",
                  type:"POST",
                  data:data,
        cache: false,
        success: function(response){
		   if(response!='error'){
		      jQuery('#demoajax').html(response);
		  createInput();
		     }
		}
		
	   });	   
	   });
 jQuery('#demoajax').on('click','.ajaxcancel',function(){
      var edittrid = jQuery(this).parent().parent().attr('id');
	  
        jQuery('#'+edittrid).html(pre_tds);
		createInput();
	   });	 
	     
	   });
	   
 function createInput(){
  var blankrow = "<tr id='createinput'>";   
  for(var i=0;i<field_arr.length;i++){
	  blankrow+= "<td class='ajaxreq'><input type='"+field_arr[i]+"' name='"+field_name[i]+"' placeholder='"+field_pre_text[i]+"' /></td>";
	}
	blankrow+="<td class='ajaxreq'>"+savebutton+"</td></tr>";
  jQuery('#demoajax').append(blankrow);	
  }
 function validate(paid_amount,payment_type,outstanding_amount,due_date,payment_date){
var contact = jQuery('input[name=contact]');
		
		
		if (paid_amount.val()=='') {
			paid_amount.addClass('hightlight');
			return false;
		} else paid_amount.removeClass('hightlight');

		return true;
		}
