<div class="app-container">
	<div class="h-100 bg-plum-plate bg-animation" style="">
		<div class="d-flex vh-100 justify-content-center align-items-center">
			<div class="mx-auto app-login-box col-md-8">
				<div class="app-logo-inverse mx-auto mb-3"></div>
				<div class="modal-dialog w-100 mx-auto">
					<div class="modal-content">
						<?php echo form_open(base_url('auth')); ?>
						<div class="modal-body">
							<div class="h5 modal-title text-center">
								<h4 class="mt-2">
									<div>로케이션DB</div>
									<span>로그인</span>
								</h4>
							</div>
							
							<div class="form-row">
								<div class="col-md-12">
									<div class="position-relative form-group">
										<input name="mem_id" id="mem_id" placeholder="ID" type="text" value="<?php echo set_value('mem_id')?>" class="form-control">
									</div>
								</div>
								<div class="col-md-12">
									<div class="position-relative form-group">
										<input name="mem_pw" id="mem_pw" placeholder="Password" type="password"  value="<?php echo set_value('mem_pw')?>" class="form-control">
									</div>
								</div>
							</div>
							<?php echo validation_errors(); ?>
							<div class="divider"></div>
						</div>
						<div class="modal-footer clearfix">
							<div class="float-right">
								<input class="btn btn-primary btn-lg" type="submit" value="Login" />
							</div>
						</div>
						<?php echo form_close(PHP_EOL)?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

