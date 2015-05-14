				<script type="text/javascript">

					$(function(){
					  var q = [

						<?php
						if(!$query = mysql_query("SELECT * FROM user")){
							die(mysql_error());
						};
						while($data = mysql_fetch_array($query)){
						?>

							{ value: '<?php echo $data['nama']; ?>' },
							{ value: '<?php echo $data['username']; ?>' },

						<?php 
						};
						?>
					  ];
					  $('#autocomplete').autocomplete({
					    lookup: q
					  });
					});

				</script>

				<div class="container">
					<div class="row">
						<table border="0" cellpadding="0" cellspacing="0" width="100%" class="main_">
							<tr>
								<td class="left_">
									<div id="data-tree"></div>
								</td>
								<td class="right_">
									<form class="form-search" id="custom-search-form" method="GET">
										<input type="hidden" name="pencarian" value="user">
										<div class="input-prepend">
										    <i class="add-on">Nama / Username</i>
										</div>
									    <div class="input-append input-prepend">
									    	<input type="text" placeholder="Cari" name="q" id="autocomplete">
									    </div>
									    <button type="submit" class="btn"><i class="icon-search"></i></button>
									</form>
								<hr>
									<h3><?php if(isset($_GET['pencarian'])){echo "Hasil Pencarian ";}; ?>Data User</h3>

									<!-- tempat untuk menampilkan data user -->
									<div id="data-user"></div>
								</td>
							</tr>
						</table>
					</div>
				</div>

				<?php require_once 'api/user/user.modal.php'; ?>