<!-- Page Content -->
<div class="container">

	<!-- Page Heading -->
	<h1 class="my-4">
		로케이션DB <!-- <small>Secondary Text</small> -->
	</h1>

<div class="row">
	<div class="col-md-12">
		<div class="mb-2 mr-2 btn-group">
			<button class="btn btn-primary"><?=$location == "" ? "전체" : $location?></button>
			<button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle-split dropdown-toggle btn btn-primary"><span class="sr-only">Toggle Dropdown</span></button>
			<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
				<a href="<?=BASE_URL?>main/index/?" class="dropdown-item">전체</a>
				<?php foreach($locations as $value){?>
				<a href="<?=BASE_URL?>main/index/?l=<?=urlencode($value->location)?>" class="dropdown-item"><?=$value->location?></a>
				<?php }?>
			</div>
		</div>
	</div>
</div>


	<div class="row">

	<?php 
	foreach($list as $l){
		$link = BASE_URL."main/view/".$l->id."?p=".$page."&q=".$search_word."&l=".$location;
		$thumbnail = isset($l->thumbnail) && $l->thumbnail != "" ? BASE_URL."data/".$l->id."/".$l->thumbnail : "http://placehold.it/700x400"; 
	?>
		<div class="col-lg-4 col-sm-6 mb-4">
			<div class="card h-100">
				<a href="<?=$link?>"><img class="card-img-top" src="<?=$thumbnail?>" alt=""></a>
				<div class="card-body">
					<h4 class="card-title">
						<a href="<?=$link?>"><?php echo $l->title?></a>
					</h4>
					<p class="card-text"><?php echo word_limiter($l->introduce, 10)?></p>
				</div>
			</div>
		</div>
	<?php 
	}
	?>
		
	</div>
	<!-- /.row -->


<!-- Pagination -->
<?php echo $pagination;?>

</div>
<!-- /.container -->