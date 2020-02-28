
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

// var infowindows = [], markers = [];

// markers[0] = new naver.maps.Marker({
//     position: new naver.maps.LatLng(37.3595704, 127.105399),
//     map: map
// });
// markers[1] = new naver.maps.Marker({
//     position: new naver.maps.LatLng(35.8244817, 127.1538007),
//     map: map
// });
</script>
