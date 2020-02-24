<div class="container">
	<div class="row">
    	<h1 class="my-4">
    		<a href="#" style="color:#000;text-decoration:none">좌표변환</a>
    	</h1>
		<div class="col-lg-12">
			<table class="table table-striped">
				<thead>
					<tr>
						<th scope="col">순번</th>
						<th scope="col">로케이션명</th>
						<th scope="col">주소</th>
						<th scope="col">좌표</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$i = 0;
                foreach($list as $l){
                	$link = base_url("main/view/".$l->id."?p=".$page."&q=".$search_word."&l=".$location);
                	$thumbnail = isset($l->thumbnail) && $l->thumbnail != "" ? BASE_URL."data/".$l->id."/".$l->thumbnail : "http://placehold.it/700x400"; 
                ?>
					<tr>
						<th scope="row"><?=$total_rows - $start - $i?></th>
						<td><?=anchor($link, $l->title, 'title="'.$l->title.'"')?></td>
						<td><?=$l->address?></td>
						<td><?=$l->latlng?></td>
					</tr>
				<?php 
				$i++;
                }?>
				</tbody>
			</table>
		</div>
	</div>
	
	<!-- Pagination -->
	<?php echo $pagination;?>
</div>