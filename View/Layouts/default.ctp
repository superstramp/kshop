<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>
        <?php echo $title_for_layout; ?>
    </title>
    <?php echo $this->Html->meta('icon'); ?>
    <!-- Bootstrap core CSS -->
    <?php echo $this->Html->css('bootstrap'); ?>
    <!-- ChickenRainShop - ChickenRain.com -->
    <?php echo $this->Html->css('chickenrainshop'); ?>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond/respond.min.js"></script>
    <![endif]-->
    <?php
    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>

</head>
<body>
<div id="container" class="container">


    <!-- Header -->
    <div id="header">
        <!-- Main Menu - ChickenRain.com -->
        <div class="navbar mainmenu">
            <div class="container">
                <a class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <?php echo $this->Html->link('ChickenRainShop', '/', array('class'=>"navbar-brand")); ?>
                <div class="nav-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><?php echo $this->Html->link('Sách mới','/sach-moi'); ?></li>
                        <li><a href="#ban-chay">Sách bán chạy</a></li>
                        <li><a href="#lien-he">Liên hệ</a></li>
                    </ul>
                    <ul class="nav navbar-nav pull-right">
                        <?php
                        echo $this->Form->create('Book',array('action'=>'get_keyword','class'=>'navbar-form search'));
                        echo $this->Form->input('keyword',array('label'=>'','style'=>"width: 200px;", 'placeholder'=>"Tìm kiếm..."));
                        echo $this->Form->end();
                        ?>
                    </ul>
                </div>
            </div>
        </div> <!-- end Main Menu -->
    </div>


    <!-- Content -->
    <div id="content">
        <div class="row">
            <!-- content -->
            <div class="content col col-lg-9">

                <?php echo $this->fetch('content'); ?>
            </div> <!-- end content -->

            <!-- sidebar -->
            <div class="sidebar col col-lg-3">
                <?php if (!empty($user_info)) { ?>
                    <div class="panel">
                        <h4 class="panel-heading"><i class="glyphicon glyphicon-user"></i> <small>Xin chào <?php echo $user_info['fullname']; ?></strong></small></h4>
                        <ul>
                            <li><a href="">Cập nhật thông tin</a></li>
                            <li><?php echo $this->Html->link('Đổi mật khẩu', '/users/change_password'); ?></li>
                            <li><a href="">Lịch sử mua hàng</a></li>
                            <li><?php echo $this->Html->link('Dang xuat', '/users/logout'); ?></li>
                        </ul>
                    </div>
                <?php } else { ?>

                    <div class="panel">
                        <h4 class="panel-heading"><i class="glyphicon glyphicon-user"></i> <small>Xin chào <strong>khách</strong></small></h4>
                        Nhấn vào <?php echo $this->Html->link('day', '/users/login') ?> để đăng nhập.
                    </div>
                <?php } ?>



                <div class="panel panel-info">
                    <h4 class="panel-heading"><i class="glyphicon glyphicon-shopping-cart"></i> Giỏ hàng</h4>
                    <?php echo $this->element('book_cart'); ?>
                </div>
                <div class="panel">
                    <h4 class="panel-heading"><i class="glyphicon glyphicon-th-list"></i> Danh mục sách</h4>
                    <?php echo $this->element('menu'); ?>

                </div>
            </div> <!-- end sidebar -->

        </div>
    </div>
    <!-- Footer -->
    <div id="footer">
        <div class="container">
            <p class="text-muted credit">
                Giao diện thực hành khóa học <a href="http://chickenrain.com/khoa-hoc-cakephp-nang-cao">CakePHP Nâng Cao</a> -
                Bản quyền thuộc về <a href="http://chickenrain.com">ChickenRain.Com</a>
            </p>
        </div>
    </div>

</div>

<!-- Placed at the end of the document so the pages load faster -->
<?php echo $this->Html->script('jquery'); ?>
<?php echo $this->Html->script('bootstrap'); ?>

<?php echo $this->element('sql_dump'); ?>

</body>
</html>