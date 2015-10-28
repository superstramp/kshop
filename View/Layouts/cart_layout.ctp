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
    <?php echo $this->Html->css('bootstrap'); ?>
    <?php echo $this->Html->css('chickenrainshop'); ?>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <!--<script src="js/html5shiv.js"></script>-->
    <!--<script src="js/respond/respond.min.js"></script>-->
<!--    <![endif]-->
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
                <?php echo $this->Html->link('ChickenrainShop', '/', array('class' => 'navbar-brand')); ?>
                <div class="nav-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><?php echo $this->Html->link('Sach moi', '/books/index', array('class' => 'navbar-brand')); ?></li>
                        <li><?php echo $this->Html->link('Sach ban chay', '/books/index', array('class' => 'navbar-brand')); ?></li>
                        <li><?php echo $this->Html->link('lien he', '/', array('class' => 'navbar-brand')); ?></li>
                    </ul>
                    <ul class="nav navbar-nav pull-right">
                        <?php echo $this->Form->create('Book', array('div' => false, 'action' => 'get_keyword', 'class' => 'navbar-form search')); ?>
                        <?php echo $this->Form->input('keyword', array('label' => '','div' => false, 'style' => "width: 200px;", 'placeholder' => 'tim kiem')); ?>
                        <?php echo $this->Form->end(); ?>

                    </ul>
                </div>
            </div>
        </div> <!-- end Main Menu -->
    </div>


    <!-- Content -->
    <div id="content">
        <div class="row">
            <!-- content -->
            <div class="content col col-lg-12">
                <?php echo $this->fetch('content'); ?>
            </div> <!-- end content -->
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

</body>
</html>