<!-- Page Content -->
<div class="container">

	<!-- Page Heading -->
	<h1 class="my-4">
		로케이션DB <!-- <small>Secondary Text</small> -->
	</h1>

	<div class="row">

<?php 
foreach($list as $l){
	$link = BASE_URL."main/view/".$l->id;
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