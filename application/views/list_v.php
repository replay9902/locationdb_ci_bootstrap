<!-- Page Content -->
<div class="container">

	<?php $this->load->view('layout/navbar_v')?>
	<!-- Page Heading -->
	<h1 class="my-4">
		<a href="<?=BASE_URL?>" style="color:#000;text-decoration:none">로케이션DB </a><!-- <small>Secondary Text</small> -->
	</h1>

<div class="row">
	<div class="col-md-3 col-lg-6">
		<div class="mb-2 mr-2 btn-group">
			<button class="btn btn-primary btn-wide btn-block"><?=$location == "" ? "전체" : $location?></button>
			<button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle-split dropdown-toggle btn btn-primary"><span class="sr-only">Toggle Dropdown</span></button>
			<div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
				<a href="<?=BASE_URL?>main/index/?" class="dropdown-item">전체</a>
				<?php foreach($locations as $value){?>
				<a href="<?=BASE_URL?>main/index/?l=<?=urlencode($value->location)?>" class="dropdown-item"><?=$value->location?></a>
				<?php }?>
			</div>
			
			
		</div>
	</div>
	
	<div class="col-md-9 mb-2 text-right col-lg-6">
			<form action="<?=BASE_URL?>" method="get" id="search_form" class="form-inline" style="display:inline">
			<?php echo validation_errors(); ?>
			<?php echo form_input(array('class' => 'form-control mr-sm-2', 'placeholder' => '검색어를 입력하세요', 'name' => 'q', 'value' => $search_word))?>
			<button class="btn btn-primary my-2 my-sm-0" type="submit">검색</button>
			
		</form>
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
		
	<?php if(count($list) == 0){?>
		<div class="col-lg-12 col-sm-12 mb-12">
			<div class="card h-100">
				<div class="card-body">
					<p class="card-text"><a href="<?=BASE_URL?>">검색조건에 해당하는 데이터가 없습니다.</a></p>
				</div>
			</div>
		</div>
	<?php }?>
	</div>
	<!-- /.row -->


<!-- Pagination -->
<?php echo $pagination;?>

</div>
<!-- /.container -->