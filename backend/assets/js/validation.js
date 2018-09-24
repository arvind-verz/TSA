// JavaScript Document
var namePattern = /^([a-zA-Z ]+)$/;
var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$/;
function banner4_form_valid(){
	
	if(document.banner.title.value.length==0)
	{
		document.banner.title.value="";
		document.banner.title.focus();
		document.getElementById("title").style.borderColor = 'red';
		return false;
	}
}

//  Old Js//
function vehicles_form_valid(){
	if(document.vehicles.vehicle_no.value.length==0)
	{
		document.vehicles.vehicle_no.value="";
		document.vehicles.vehicle_no.focus();
		document.getElementById("vehicle_no").style.borderColor = 'red';
		return false;
	}
	if(document.vehicles.size.value.length==0)
	{
		document.vehicles.size.value="";
		document.vehicles.size.focus();
		document.getElementById("size").style.borderColor = 'red';
		document.getElementById("vehicle_no").style.borderColor = '#CCCCCC';
		return false;
	}
	if(document.vehicles.insurance_company.value.length==0)
	{
		document.vehicles.insurance_company.value="";
		document.vehicles.insurance_company.focus();
		document.getElementById("insurance_company").style.borderColor = 'red';
		document.getElementById("vehicle_no").style.borderColor = '#CCCCCC';
		document.getElementById("size").style.borderColor = '#CCCCCC';
		return false;
	}
	if(document.vehicles.insurance_start_date.value.length==0)
	{
		document.vehicles.insurance_start_date.value="";
		document.vehicles.insurance_start_date.focus();
		document.getElementById("insurance_start_date").style.borderColor = 'red';
		document.getElementById("vehicle_no").style.borderColor = '#CCCCCC';
		document.getElementById("size").style.borderColor = '#CCCCCC';
		document.getElementById("insurance_company").style.borderColor = '#CCCCCC';
		return false;
	}
	if(document.vehicles.insurance_end_date.value.length==0)
	{
		document.vehicles.insurance_end_date.value="";
		document.vehicles.insurance_end_date.focus();
		document.getElementById("insurance_end_date").style.borderColor = 'red';
		document.getElementById("vehicle_no").style.borderColor = '#CCCCCC';
		document.getElementById("size").style.borderColor = '#CCCCCC';
		document.getElementById("insurance_company").style.borderColor = '#CCCCCC';
		document.getElementById("insurance_start_date").style.borderColor = '#CCCCCC';
		return false;
	}
	if(document.vehicles.finance_company.value.length==0)
	{
		document.vehicles.finance_company.value="";
		document.vehicles.finance_company.focus();
		document.getElementById("finance_company").style.borderColor = 'red';
		document.getElementById("vehicle_no").style.borderColor = '#CCCCCC';
		document.getElementById("size").style.borderColor = '#CCCCCC';
		document.getElementById("insurance_company").style.borderColor = '#CCCCCC';
		document.getElementById("insurance_start_date").style.borderColor = '#CCCCCC';
		document.getElementById("insurance_end_date").style.borderColor = '#CCCCCC';
		return false;
	}
	
	if(document.vehicles.insurance_premium.value.length==0)
	{
		document.vehicles.insurance_premium.value="";
		document.vehicles.insurance_premium.focus();
		document.getElementById("insurance_premium").style.borderColor = 'red';
		document.getElementById("vehicle_no").style.borderColor = '#CCCCCC';
		document.getElementById("size").style.borderColor = '#CCCCCC';
		document.getElementById("insurance_company").style.borderColor = '#CCCCCC';
		document.getElementById("insurance_start_date").style.borderColor = '#CCCCCC';
		document.getElementById("insurance_end_date").style.borderColor = '#CCCCCC';
		document.getElementById("finance_company").style.borderColor = '#CCCCCC';
		return false;
	}
	if(document.vehicles.vehicle_route.value.length==0)
	{
		document.vehicles.vehicle_route.value="";
		document.vehicles.vehicle_route.focus();
		document.getElementById("vehicle_route").style.borderColor = 'red';
		document.getElementById("vehicle_no").style.borderColor = '#CCCCCC';
		document.getElementById("size").style.borderColor = '#CCCCCC';
		document.getElementById("insurance_company").style.borderColor = '#CCCCCC';
		document.getElementById("insurance_start_date").style.borderColor = '#CCCCCC';
		document.getElementById("insurance_end_date").style.borderColor = '#CCCCCC';
		document.getElementById("finance_company").style.borderColor = '#CCCCCC';
		document.getElementById("insurance_premium").style.borderColor = '#CCCCCC';
		return false;
	}
}
function member_form_valid(){
	
	if(document.member.user_name.value.length==0)
	{
		document.member.user_name.value="";
		document.member.user_name.focus();
		document.getElementById("user_name").style.borderColor = 'red';
		return false;
	}
	if(document.member.password.value.length==0)
	{
		document.member.password.value="";
		document.member.password.focus();
		document.getElementById("password").style.borderColor = 'red';
		document.getElementById("user_name").style.borderColor = '#CCCCCC';
		return false;
	}
	if(document.member.password.value.length<5)
	{
		document.member.password.value="";
		document.member.password.focus();
		document.getElementById("password").style.borderColor = 'red';
		document.getElementById("user_name").style.borderColor = '#CCCCCC';
		return false;
	}
	if(document.member.member_id.value.length==0)
	{
		document.member.member_id.value="";
		document.member.member_id.focus();
		document.getElementById("member_id").style.borderColor = 'red';
		document.getElementById("user_name").style.borderColor = '#CCCCCC';
		document.getElementById("password").style.borderColor = '#CCCCCC';
		
		return false;
	}
	if(document.member.name.value.length==0)
	{
		document.member.name.value="";
		document.member.name.focus();
		document.getElementById("name").style.borderColor = 'red';
		document.getElementById("user_name").style.borderColor = '#CCCCCC';
		document.getElementById("password").style.borderColor = '#CCCCCC';
		document.getElementById("member_id").style.borderColor = '#CCCCCC';
		return false;
	}
	
	
	if(document.member.email.value.length==0)
	{
		document.member.email.value="";
		document.member.email.focus();
		document.getElementById("email").style.borderColor = 'red';		
		document.getElementById("user_name").style.borderColor = '#CCCCCC';
		document.getElementById("password").style.borderColor = '#CCCCCC';
		document.getElementById("member_id").style.borderColor = '#CCCCCC';
		document.getElementById("name").style.borderColor = '#CCCCCC';
		return false;
	}
	if(emailPattern.test(document.member.email.value)==false)
	{
		document.member.email.value="";
		document.member.email.focus();
		document.getElementById("email").style.borderColor = 'red';
		document.getElementById("user_name").style.borderColor = '#CCCCCC';
		document.getElementById("password").style.borderColor = '#CCCCCC';
		document.getElementById("member_id").style.borderColor = '#CCCCCC';
		document.getElementById("name").style.borderColor = '#CCCCCC';
		return false;
	}
	
	
}
function cms_form_valid(){
	
	if(document.cms.menu_name.value.length==0)
	{
		document.cms.menu_name.value="";
		document.cms.menu_name.focus();
		document.getElementById("menu_name").style.borderColor = 'red';
		return false;
	}
	if(document.cms.url_name.value.length==0)
	{
		document.cms.url_name.value="";
		document.cms.url_name.focus();
		document.getElementById("url_name").style.borderColor = 'red';
		document.getElementById("menu_name").style.borderColor = '#CCCCCC';
		return false;
	}

}

function gallery_form_valid(){
	
	if(document.gallery.title.value.length==0)
	{
		document.gallery.title.value="";
		document.gallery.title.focus();
		document.getElementById("title").style.borderColor = 'red';
		return false;
	}
}
function testimonials_form_valid(){
	
	if(document.testimonials.name.value.length==0)
	{
		document.testimonials.name.value="";
		document.testimonials.name.focus();
		document.getElementById("name").style.borderColor = 'red';
		return false;
	}

}
function news_form_valid(){
	
	if(document.news.title.value.length==0)
	{
		document.news.title.value="";
		document.news.title.focus();
		document.getElementById("title").style.borderColor = 'red';
		return false;
	}
	
	if(document.news.post_date.value.length==0)
	{
		document.news.post_date.value="";
		document.news.post_date.focus();
		document.getElementById("post_date").style.borderColor = 'red';
		document.getElementById("title").style.borderColor = '#CCCCCC';
		return false;
	}
}