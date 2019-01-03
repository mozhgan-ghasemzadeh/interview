
 var map;
 var options = {
 	zoom : 6,
 	center: {lat: 53.4808, lng: -2.2426}
 }

    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), options);
    }


function getJson(url){
  function handle_json() {
    if (this.readyState == 4 && this.status == 200) {
      var data=JSON.parse(http_request.responseText);
     	 initialMarkers(data,url);

    }
  }

  var http_request = new XMLHttpRequest();
  http_request.onreadystatechange = handle_json;
  http_request.open("GET", url, true);
  http_request.send(null);
}

getJson("data/events.json");
getJson("data/user.json");

function initialMarkers(data,url){
	var marker,icon;
	if (url =="data/events.json"){
		icon = "http://maps.google.com/mapfiles/ms/icons/red-dot.png";
		for (var i=0;i<data.length;i++){
			var coords = {lat: parseFloat(data[i].geo.lat),lng:parseFloat(data[i].geo.lng) };
			addMarkers(coords,icon,data[i].title,data[i].url,data[i].date);
			
		}

	}
	else{
		icon = "http://maps.google.com/mapfiles/ms/icons/green-dot.png";
		var coords = {lat: parseFloat(data.geo.lat),lng:parseFloat(data.geo.lng) };
		marker = new google.maps.Marker({
			position : coords,
			map:map,
			icon :icon
		});
	}
	
	
}


function addMarkers(coords,icon,title,url,date){
	var marker = new google.maps.Marker({
			position : coords,
			map:map,
			icon :icon
		}); 
	content='<h5><a href="'+url +'">'+title+'</a></h5><p>'+date+'</p>';

	var infoWindow = new google.maps.InfoWindow({
		content: content
	});
	marker.addListener("click",function(){

		infoWindow.open(map,marker);
	});
}



