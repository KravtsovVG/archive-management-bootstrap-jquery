				<div class="container">
					<div class="row">
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="main_">
							<tr>
								<td class="left_">
									<div id="data-tree"></div>
								</td>
								<td class="right_">
									<h3>Data Subkategori</h3>

									<!-- tempat untuk menampilkan data subkategori -->
									<div id="data-subkategori"></div>
									<?php
										if(substr($_SESSION['admin'], 0, 1) != 3 ){
											?>
											<a href="#dialog-subkategori" id="0" class="btn tambah" data-toggle="modal">
												<i class="icon-plus"></i> Tambah Subkategori
											</a>
											<?php
										}
									?>
								</td>
							</tr>
						</table>
					</div>
				</div>

				<?php require_once 'api/subkategori/subkategori.modal.php'; ?>