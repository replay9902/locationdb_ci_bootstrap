<div id="map" class="map"></div>

<script>
var mapOptions = {
    center: new naver.maps.LatLng(35.8244817, 127.1538007),
    zoom: 10
};

var map = new naver.maps.Map('map', mapOptions);

var $window = $(window);

function getMapSize() {
    var size = new naver.maps.Size($window.width(), $window.height());
    return size;
};

map.setSize(getMapSize());
$window.on('resize', function() {
    map.setSize(getMapSize());
});



$.getJSON('<?=BASE_URL?>assets/js/latlng.json', function(data) {
	data.forEach(function(item) {
		id = item.id;
		latlng = item.latlng;
		tmp = latlng.split(',');
		lat = tmp[0];
		lng = tmp[1];
		
		var marker = new naver.maps.Marker({
		    position: new naver.maps.LatLng(lat, lng),
		    map: map
		});

		var infowindow = new naver.maps.InfoWindow({
			content: '<h5><a href="<?=BASE_URL?>main/view/'+item.id+'">'+ item.title +'</a></h5>'
		});
		
		naver.maps.Event.addListener(marker, "click", function(e) {
		    if (infowindow.getMap()) {
		    	infowindow.close();
		    } else {
		    	infowindow.open(map, marker);
		    }
		});

		
	});
});


</script>
