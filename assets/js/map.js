function initialize() {
	var myLatlng = new google.maps.LatLng(1.282199, 103.850796);
	var myOptions = {
	  zoom: 18,
	  center: myLatlng,
	  mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	
	var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	
	var contentString = '<div id="content">'+
		'<h1>Singapore Venture Capital & <br/>Private Equity Association</h1>'+
		'<div>'+
		'<p> 14 Robinson Road<br/> #07-02A Far East Finance Building <br/>Singapore 048545 </p>'+
		'</div>'+
		'</div>';

	var infowindow = new google.maps.InfoWindow({
		content: contentString,
		maxWidth: 400
	});
	
	var companyImage = new google.maps.MarkerImage('img/pin.png',
		new google.maps.Size(66,78),
		new google.maps.Point(0,0)
	);

	var marker = new google.maps.Marker({
		position: myLatlng,
		map: map,
		icon: companyImage,
		title: 'Singapore Venture Capital & Private Equity Association'
	});
	google.maps.event.addListener(marker, 'click', function() {
	  infowindow.open(map,marker);
	});

  }
	
 initialize();     