
<div class="wrap">
	<div class="mainbox">
		<div class="mainbg">
			<!-- <img src="<?=BASE_URL?>assets/images/main_logo.png" alt="드론 측정데이타 관리시스템"> -->
		</div>
		<div class="mainform">
			<div class="log-title">Login</div>
			<?php echo validation_errors(); ?>
			<?php echo form_open('auth'); ?>
				<div class="login-id">
					<input type="text" name="mem_id" id="loginId" value="<?php echo set_value('mem_id')?>" placeholder="ID">
				</div>
				<div class="login-pw">
					<input type="password" name="mem_pwd" id="loginPw" value="<?php echo set_value('mem_pwd')?>" placeholder="PASSWORD">
				</div>
				<div class="loginsave">
					<input type="checkbox" id="save"><label for="save">아이디저장</label>
				</div>
				<div class="loginbtn">
					<input type="submit" class="btn_button" value="로그인" />
				</div>
			</form>
			<div class="login-find">
				<ul>
					<li><a href="#">등록요청</a></li>
					<li><a href="#">아이디찾기</a></li>
					<li><a href="#">패스워드찾기</a></li>
				</ul>
			</div>
			<div class="copyright">Copyright © 2018 SIS Corporation. All rights reserved</div>
		</div>
	</div>
</div>