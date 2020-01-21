<!--sidebar-->
<section class="sidebar">
	<div class="logo">
		<a href="<?=BASE_URL?>">전화번호부</a>
	</div>
	<div class="box-body box-profile">
		<div class="user-w">
			<p class="user-img">
				<img src="<?=BASE_URL?>assets/images/user.png">
			</p>
			<p class="user-t">
				<span class="user-name"><?=MEM_ID?></span> <span class="user-subname"><?=MEM_NM?></span>
			</p>
		</div>
		<div class="progress">
			<div class="progress-w">
				<dl>
					<dt>최근 업데이트</dt>
					<dd><?=$last_modified?></dd>
					<dt>총 등록 번호</dt>
					<dd><?=$total?>개</dd>
				</dl>
			</div>
		</div>
	</div>
	<div class="sidebar-menu">
		<ul id="menu">
			<li><a href="<?=BASE_URL?>main/" class="m-title "><span class="mico1">전화번호 리스트</span></a></li>
			<li><a href="<?=BASE_URL?>main/write/" class="m-title"><span class="mico3">전화번호 등록</span></a></li>
			<li><a href="<?=BASE_URL?>main/import/" class="m-title"><span class="mico4">엑셀 업로드</span></a></li>
			<li><a href="<?=BASE_URL?>main/export/" class="m-title"><span class="mico1">엑셀 파일로 내보내기</span></a></li>
			<li><a href="<?=BASE_URL?>../" class="m-title" target="_blank"><span class="mico5">전화기에 저장</span></a></li>
				
		</ul>
	</div>
</section>
<!--sidebar//-->