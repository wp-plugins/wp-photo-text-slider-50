/*
##########################################################################################################################
###### Project   : Wp photo text slider 50  																		######
###### File Name : setting.js                   																	######
###### Purpose   : This javascript validation.  																	######
###### Created   : 30-june-2011                  																	######
###### Modified  : 30-june-2011                  																	######
###### Author    : Gopi.R (http://www.gopiplus.com/work/)                       									######
###### Link      : http://www.gopiplus.com/work/2011/06/02/wordpress-plugin-wp-photo-slider-50/   					######
##########################################################################################################################
*/


function wp_50_submit()
{
	if(document.wp_50_form.wp_50_path.value=="")
	{
		alert("Please enter the image path.")
		document.wp_50_form.wp_50_path.focus();
		return false;
	}
	//else if(document.wp_50_form.wp_50_link.value=="")
//	{
//		alert("Please enter the target link.")
//		document.wp_50_form.wp_50_link.focus();
//		return false;
//	}
//	else if(document.wp_50_form.wp_50_target.value=="")
//	{
//		alert("Please enter the target status.")
//		document.wp_50_form.wp_50_target.focus();
//		return false;
//	}
	//else if(document.wp_50_form.wp_50_title.value=="")
//	{
//		alert("Please enter the image alt text.")
//		document.wp_50_form.wp_50_title.focus();
//		return false;
//	}
	else if(document.wp_50_form.wp_50_type.value=="")
	{
		alert("Please enter the gallery type.")
		document.wp_50_form.wp_50_type.focus();
		return false;
	}
	else if(document.wp_50_form.wp_50_status.value=="")
	{
		alert("Please select the display status.")
		document.wp_50_form.wp_50_status.focus();
		return false;
	}
	else if(document.wp_50_form.wp_50_order.value=="")
	{
		alert("Please enter the display order, only number.")
		document.wp_50_form.wp_50_order.focus();
		return false;
	}
	else if(isNaN(document.wp_50_form.wp_50_order.value))
	{
		alert("Please enter the display order, only number.")
		document.wp_50_form.wp_50_order.focus();
		return false;
	}
}

function wp_50_delete(id)
{
	if(confirm("Do you want to delete this record?"))
	{
		document.frm_wp_50_display.action="options-general.php?page=wp-photo-text-slider-50/image-management.php&AC=DEL&DID="+id;
		document.frm_wp_50_display.submit();
	}
}	

function wp_50_redirect()
{
	window.location = "options-general.php?page=wp-photo-text-slider-50/image-management.php";
}
