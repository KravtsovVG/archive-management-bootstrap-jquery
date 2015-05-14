				<div class="container">
					<div class="row">
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="main_">
							<tr>
								<td class="left_">
									<div id="data-tree"></div>
								</td>
								<td class="right_">
									<h3>Data Kategori</h3>

									<!-- tempat untuk menampilkan data kategori -->
									<div id="data-category"></div>
									<?php
										if(substr($_SESSION['admin'], 0, 1) != 3 ){
											?>
											<div class="input-prepend input-append">

												<a href="#dialog-category" id="0" class="btn tambah" data-toggle="modal">
													<i class="icon-plus"></i> Tambah Kategori
												</a>
												<i class="add-on"> atau </i>
												<a href="?subkategori=true" class="btn">
													<i class="icon-plus"></i> Tambah Subkategori
												</a>
											</div>
											<?php
										}
									?>
								</td>
							</tr>
						</table>
					</div>
				</div>

				<?php require_once 'api/kategori/kategori.modal.php'; ?>