<?php require_once '../../inc/conf.php'; session_start(); ?>

	<img src="img/bukuLogin.png" style="padding-bottom: 20px;" width="200px">

	<div class="well" style="width: auto; width: 200px;  padding: 8px 0;">
		<div style="overflow: hidden;">
			<ul class="nav nav-list">
				Services Center
	        				<li class="divider"></li>
						<?php
						if(!$query = mysql_query("SELECT * FROM category")){
							die(mysql_error());
						};
						while($row = mysql_fetch_array($query)){
							if(!$subkategori = mysql_query("SELECT * FROM master_data WHERE id_category=".$row['id_category'])){
								die(mysql_error());
							};
						$total_subkategori = mysql_num_rows($subkategori);
						?>
						<li><label class="tree-toggler nav-header"><? echo $row['nama_category'] . " [" . $total_subkategori . "]";?></label>

	             						<ul class="nav nav-list tree">

								<?php
									if(!$querycat = mysql_query("SELECT * FROM master_data WHERE id_category=".$row['id_category'])){
										die(mysql_error());
									};
									while($rowcat = mysql_fetch_array($querycat)){
										if(!$file = mysql_query("SELECT * FROM document WHERE id_service_name=".$rowcat['id'])){
											die(mysql_error());
										};
										$totalfile = mysql_num_rows($file);
								?>
										<li><a href="?file=true&k=<?php echo $row['nama_category']?>&s=<?php echo $rowcat['subkategori']?>&param=<?php echo $rowcat['id']?>"><i class="icon-file"></i> <?php echo $rowcat['subkategori']. " <span style='padding-left: 4px; padding-right: 4px;  border-radius: 3; background: #ccc; color: #fff; font-size: 9px; float: right;'>" .$totalfile. "</span>"?></a></li>
								<?php
								}
								?>

	                					</ul>
	            					</li>
					<?php
					}
					?>
	        		</ul>
	    	</div>
	</div>

	<!-- status -->
	<div class="well" style="width: auto; width: 200px;  padding: 8px 0;">
	    <div style="overflow-y: auto; overflow-x: hidden; max-height: 300px;">
	        <ul class="nav nav-list">
	        Status
	        	<li class="divider"></li>

				<?php
					$path = '../../uploads/';
					$ar = getDirectorySize($path);
					function getDirectorySize($path){ 
					$totalsize = 0; 
					  $totalcount = 0; 
					  $dircount = 0; 
					  if ($handle = opendir ($path)){ 
					    while (false !== ($file = readdir($handle))){ 
					      $nextpath = $path . '/' . $file; 
					      if ($file != '.' && $file != '..' && !is_link ($nextpath)){ 
					        if (is_dir ($nextpath)){ 
					          $dircount++; 
					          $result = getDirectorySize($nextpath); 
					          $totalsize += $result['size']; 
					          $totalcount += $result['count']; 
					          $dircount += $result['dircount']; 
					        } 
					        elseif (is_file ($nextpath)){ 
					          $totalsize += filesize ($nextpath); 
					          $totalcount++; 
					        } 
					      } 
					    } 
					  } 
					  closedir ($handle); 
					  $total['size'] = $totalsize; 
					  $total['count'] = $totalcount; 
					  $total['dircount'] = $dircount; 
					  return $total; 
					} 

					function sizeFormat($size){ 
					    if($size<1024){ 
					        return $size." bytes"; 
					    } 
					    else if($size<(1024*1024)){ 
					        $size=round($size/1024,1); 
					        return $size." KB"; 
					    } 
					    else if($size<(1024*1024*1024)){ 
					        $size=round($size/(1024*1024),1); 
					        return $size." MB"; 
					    } 
					    else{ 
					        $size=round($size/(1024*1024*1024),1); 
					        return $size." GB"; 
					    } 

					} 
				?>

				<li><label class="tree-toggler nav-header"><?php echo "Jumlah file: ".$ar['count']; ?></label></li>
				<ul class="nav nav-list tree">
					<li><label class="tree-toggler nav-header">&raquo; <?php echo "total: ".sizeFormat($ar['size']); ?></label></li>
					<!-- <li><label class="tree-toggler nav-header">&raquo; <?php echo "direktori: ".$ar['dircount']; ?></label></li> -->
				</ul>
				<?php
				if(!$queryuser = mysql_query("SELECT * FROM user WHERE id_group != 2 && status_delete != 'Y'")){
					die(mysql_error());
				};
				$total_user = mysql_num_rows($queryuser);
				?>
				<li><label class="tree-toggler nav-header">Total User: <? echo $total_user; ?></label></li>
				<ul class="nav nav-list tree">
					<?php
					if(!$queryuseradmin = mysql_query("SELECT * FROM user WHERE id_group = 1 && status_delete != 'Y'")){
						die(mysql_error());
					};
					$total_user_admin = mysql_num_rows($queryuseradmin);
					?>
					<li><label class="tree-toggler nav-header">&raquo; Admin User: <? echo $total_user_admin; ?></label></li>
					<?php
					if(!$queryuserpublic = mysql_query("SELECT * FROM user WHERE id_group = 3 && status_delete != 'Y'")){
						die(mysql_error());
					};
					$total_user_public = mysql_num_rows($queryuserpublic);
					?>
					<li><label class="tree-toggler nav-header">&raquo; Public User: <? echo $total_user_public; ?></label></li>
				</ul>
				<?php
				if(!$queryuserlast = mysql_query("SELECT nama FROM user ORDER BY last_login DESC LIMIT 1, 1")){
					die(mysql_error());
				};
				while($rowuser = mysql_fetch_array($queryuserlast)){
				?>
				<li><label class="tree-toggler nav-header">Login Sebelumnya:</label></li>
					<ul class="nav nav-list tree">
						<li><label class="tree-toggler nav-header">&raquo; <? echo $rowuser['nama'];?></label></li>
					</ul>
				<?php
				}
				?>
	        </ul>
	    </div>
	</div>

	<!-- fungsi tree collapse -->
	<script type="text/javascript">
		$(document).ready(function () {
		$('label.tree-toggler').click(function () {
			$(this).parent().children('ul.tree').toggle(300);
		});
	});
	</script>