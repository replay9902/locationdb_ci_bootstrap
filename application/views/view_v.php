<!-- Page Content -->
<div class="row">
	<div class="col-lg-10">
		<h1 class="font-weight-light text-center text-lg-left mt-4 mb-0"><?=$article->title?></h1>
	</div>
	<div class="mt-4 mb-0 col-lg-2">
		<a href="<?=BASE_URL?>" class="btn btn-secondary">목록</a>
	</div>
</div>
<hr class="mt-2 mb-5">
	
	
<div class="row">
	<div class="col-lg-12">
		<div class="main-card mb-3 card">
			<ul class="list-group list-group-flush">
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
	<li class="nav-item"><a role="tab" class="nav-link active" id="tab-0" data-toggle="tab" href="#tab-content-0"> <span>사진</span></a></li>
	<li class="nav-item"><a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-1"> <span>영상</span></a></li>
</ul>
	
<div class="tab-content">
	<div class="tab-pane tabs-animation fade active show" id="tab-content-0" role="tabpanel">
		<div class="row">

<?php
foreach($attachs as $value) {
	$src = BASE_URL . "data/" . $this->uri->segment(3) . "/" . $value->attach_name;
	?>
			<div class="col-lg-3 col-md-4 col-6">
				<a href="#" class="d-block mb-4 h-100"> <img class="img-fluid img-thumbnail" src="<?=$src?>" alt="">
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
			<?php if($article->video != ""){?>
			<div class="embed-responsive embed-responsive-16by9">
				<iframe class="embed-responsive-item" src="<?=$article->video?>" allowfullscreen=""></iframe>
			</div>
			<?php }else{?>
				<div class="jumbotron text-center">
				등록된 영상이 없습니다.
				</div>
			<?php }?>
			</div>
		</div>
	</div>
</div>