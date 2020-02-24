<?php $this->load->view('layout/navbar_v')?>

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
</script>
