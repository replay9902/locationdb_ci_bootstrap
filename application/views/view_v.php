<!-- Page Content -->
<div class="container">
	<div class="row">
		<h1 class="font-weight-light text-center text-lg-left mt-4 mb-0"><?=$article->title?></h1>
	</div>
	<hr class="mt-2 mb-5">
	<div class="row mt-2 mb-2">
		<div class="col-md-12 text-right">
			<a href="<?=BASE_URL?>main/index/?p=<?=$page?>&q=<?=$search_word?>&l=<?=$location?>" class="btn btn-secondary">목록</a>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="main-card mb-3 card">
				<ul class="list-group list-group-flush">
					<li class="list-group-item">
						<div class="widget-content p-0">
							<div class="widget-content-wrapper">
								<div class="widget-content-left">
									<div class="widget-heading">
										<b>지역</b>
									</div>
									<div class="widget-subheading"><?=$article->location?></div>
								</div>
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="widget-content p-0">
							<div class="widget-content-wrapper">
								<div class="widget-content-left">
									<div class="widget-heading">
										<b>분류</b>
									</div>
									<div class="widget-subheading"><?=$article->cate?></div>
								</div>
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="widget-content p-0">
							<div class="widget-content-wrapper">
								<div class="widget-content-left">
									<div class="widget-heading">
										<b>장소소개</b>
									</div>
								</div>
								<div class="widget-content-right">
									<?=$article->introduce?>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<ul class="nav nav-tabs nav-justified mb-4">
		<li class="nav-item"><a role="tab" class="nav-link active" id="tab-0" data-toggle="tab" href="#tab-content-0"> <span>사진 / 영상 [ <?=count($attachs)?> ] </span></a></li>
		<li class="nav-item"><a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-1"> <span>위치</span></a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane tabs-animation fade active show" id="tab-content-0" role="tabpanel">
			<?php if($article->video != ""){?>
			<div class="row">
				<div class="col-lg-12 col-md-12 col-12">
					<div class="embed-responsive embed-responsive-16by9">
						<iframe class="embed-responsive-item" src="<?=$article->video?>" allowfullscreen=""></iframe>
					</div>
				</div>
			</div>
			<?php }?>
			<div class="row">
			<?php
			foreach($attachs as $value) {
				$src = BASE_URL . "data/" . $this->uri->segment(3) . "/" . $value->attach_name;
				?>
				<div class="col-lg-3 col-md-4 col-6">
					<a href="<?=$src?>" class="photo" rel="photos"> <img class="img-fluid img-thumbnail" src="<?=$src?>" alt="">
					</a>
				</div>
			<?php
			}
			?>
			</div>
		</div>
		<div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-12">
					<div id="map" class="map" style="width:100%;height:auto"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="row mt-2 mb-2">
		<div class="col-md-12 text-right">
			<a href="<?=BASE_URL?>main/index/?p=<?=$page?>&q=<?=$search_word?>&l=<?=$location?>" class="btn btn-secondary">목록</a>
		</div>
	</div>
</div>

<script type="text/javascript">
<?php
$position = explode(",",$article->latlng);
$lat = $position[0] != "" ? $position[0] : 35.8244817;
$lng = $position[1] != "" ? $position[1] : 127.1538007;
?>
var lat = <?=$lat?>;
var lng = <?=$lng?>;
var title = '<?=$article->title?>';

var mapOptions = {
    center: new naver.maps.LatLng(lat, lng),
    zoom: 10
};
var map = new naver.maps.Map('map', mapOptions);

var $window = $(window);
var $container = $('.container');

function getMapSize() {
    var size = new naver.maps.Size($container.width(), $container.width() / 2);
    return size;
};

map.setSize(getMapSize());
$window.on('resize', function() {
    map.setSize(getMapSize());
});

var marker = new naver.maps.Marker({
    position: new naver.maps.LatLng(lat, lng),
    map: map
});


jQuery(function($){
	
	$('.photo').fancybox({
		padding : 0,
		imageScale : true,
		overlayShow : true,
		overlayOpacity : 0.9,
		cyclic : true,
		transitionIn : 'fade',	//elastic, fade, none
		transitionOut : 'fade',	//elastic, fade, none
		speedIn : 500,
		speedOut : 500,
		zoomOpacity : true,
		titleShow : true,
		titleFormat : this.title,
		titlePosition : 'over'		// outside, inside, over
	});
});
</script>