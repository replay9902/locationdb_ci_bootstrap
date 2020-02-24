<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand" href="<?=BASE_URL?>">로케이션 DB</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbar">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item active"><a class="nav-link" href="<?=BASE_URL?>">Home<span class="sr-only">(current)</span></a></li>
			<li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Map </a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="<?=BASE_URL?>map/">Map</a>
					<a class="dropdown-item" href="<?=BASE_URL?>map/geocode/">Geocode</a>
				</div>
			</li>
		</ul>
		<form class="form-inline my-2 my-lg-0">
			<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
			<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
		</form>
		<?php if(MEM_ID){?>
		<ul class="navbar-nav navbar-right">
			<li class="nav-item active"><a class="nav-link" href="<?=BASE_URL?>auth/logout"><?=MEM_NM ? MEM_NM."님" : ""?> Logout</a></li>
		</ul>
		<?php }?>
	</div>
</nav>