jQuery(document).ready(function(){
	
    /**
	 * Highlight selected table row
	**/
    jQuery('.sTable input').click(function(){
		
        if(jQuery(this).is(':checked')) {
            jQuery(this).parents('tr').addClass('selected');
        } else {
            jQuery(this).parents('tr').removeClass('selected');	
        }
    });
	
	
    /**
	 * Delete a single user in a row
	**/
    jQuery('.deleteuser').click(function(){
        var c = confirm(confirm_msg);
        if(c) {
            jQuery(this).parents('tr').fadeOut();
        }
        return false;
    });
	
    /**
	 * Check/Uncheck all items in a table
	**/
    jQuery('.checkall').click(function(){
        if(!jQuery(this).is(':checked')) {
            jQuery('.sTable input[type=checkbox]').each(function(){
                jQuery(this).attr('checked',false);
                jQuery(this).parents('tr').removeClass('selected');
            });
        } else {
            jQuery('.sTable input[type=checkbox]').each(function(){
                jQuery(this).attr('checked',true);
                jQuery(this).parents('tr').addClass('selected');
            });
        }
    });
	
	
	
    /**
	 * Delete selected items in a table
	**/
    jQuery('.sTableOptions .delete').click(function(){
        var empt = true;
        jQuery('.sTable input[type=checkbox]').each(function(){
            if(jQuery(this).is(':checked')) {
                empt = false;
            }
        });
        if(empt == true) {
            alert(no_item);
        } else {
            var c = confirm(confirm_msg);
            if(c) {
                jQuery('.sTable input[type=checkbox]').each(function(){
                    if(jQuery(this).is(':checked')) {
                        jQuery(this).parents('tr').fadeOut();
                        //submit form
                        //document.frm_display.submit();
                        jQuery("#frm_display").submit();
                    }
                });
            }
        }
    });	

});