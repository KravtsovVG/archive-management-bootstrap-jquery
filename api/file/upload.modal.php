				<!-- awal untuk modal dialog -->
				<div id="dialog-upload" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></button>
						<h3 id="myModalLabel">Unggah File</h3>
					</div>
					<br />
					<!-- tempat untuk menampilkan form upload -->
					<form enctype="multipart/form-data" class="form-horizontal" id="form-upload" method="POST" action="api/file/upload.input.php">
						<div class="modal-upload">
							<?php require_once 'api/file/upload.form.php' ?>
						</div>
						<div class="modal-footer">
							<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Batal</button>
							<input type="submit" id="upload" class="btn btn-success" value="Unggah">
						</div>
					</form>
				</div>
				<!-- akhir kode modal dialog -->