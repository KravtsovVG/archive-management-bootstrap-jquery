<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span> 
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="nav-collapse">
        <ul class="nav">
          <li class="<?php if(!@$_GET['user'] && !@$_GET['kategori'] && !@$_GET['subkategori']){echo 'active';} ?>"><a href="<?php echo $db_fungsi->root(); ?>"><i class="icon-home"></i> Home</a></li>
          <li class="dropdown <?php if(@$_GET['user'] || @$_GET['kategori'] || @$_GET['subkategori']){echo 'active';} ?>" id="master">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-th-large"></i> Menu Utama<b class="caret"></b></a>
              <ul class="dropdown-menu">
                  <li><a href="?user=true"><i class="icon-user"></i>&nbsp;&nbsp;User</a></li>
                  <li class="divider"></li>
                  <li><a href="?kategori=true"><i class="icon-tag"></i>&nbsp;&nbsp;Kategori</a></li>
                  <li><a href="?subkategori=true"><i class="icon-tags"></i>&nbsp;&nbsp;Sub Kategori</a></li>
                  <li class="divider"></li>
                  <li><a href="tentang/"><i class="icon-question-sign"></i>&nbsp;&nbsp;Tentang</a></li>
              </ul>
          </li>
          <li>
            <?php
              if(substr($_SESSION['admin'], 0, 1) != 3 ){
                if(@$_GET['user']){
                  ?><a tabindex="-1" href="#dialog-user" class="tambah" id="0" data-toggle="modal"><i class="icon-plus-sign"></i> Tambah User</a></li><?php
                }
                elseif(@$_GET['kategori']){
                  ?><a tabindex="-1" href="#dialog-category" class="tambah" id="0" data-toggle="modal"><i class="icon-plus-sign"></i> Tambah Kategori</a></li><?php
                }
                elseif(@$_GET['subkategori']){
                  ?><a tabindex="-1" href="#dialog-subkategori" class="tambah" id="0" data-toggle="modal"><i class="icon-plus-sign"></i> Tambah Sub Kategori</a></li><?php
                }
                elseif(@$_GET['file']){
                  ?><a href="#dialog-upload" id="0" class="upload" data-toggle="modal"><i class="icon-upload"></i> Unggah File</a></li><?php
                }
              }
            ?>
        </ul>
        <?php
        $username = substr($_SESSION['admin'], 2);
          if(!$queryname = mysql_query("SELECT nama FROM user WHERE username ='".$username."'")){
            die(mysql_error());
          };
          while($data = mysql_fetch_array($queryname)){
        ?>
      <ul class="nav pull-right">
          <li class="dropdown" id="user">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Hi, <?php echo $data['nama']; ?><b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="?logout=true">Logout</a></li>
            </ul>
          </li>
        </ul>
        <?php } ?>
      </div><!--/.nav-collapse -->
    </div>
  </div>
</div>