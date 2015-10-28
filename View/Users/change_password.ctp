<div class="panel panel-info">
    <h4 class="panel-heading"><i class="glyphicon glyphicon-user"></i> Đổi mật khẩu</h4>
    <?php if (!empty($user_info)): ?>
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->element('errors'); ?>
        <?php echo $this->Form->create('User',array('class'=>"form-horizontal",'inputDefaults'=>array('label'=>false))); ?>
        <div class="control-group">
            <label class="control-label" for="inputUsername">Mật khẩu mới</label>
            <div class="controls">
                <?php echo $this->Form->input('password',array('required' => false, 'placeholder'=>"Nhập mật khẩu mới",'error'=>false)); ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputPassword">Xác nhận mật khẩu</label>
            <div class="controls">
                <?php echo $this->Form->input('confirm_password',array('required' => false, 'placeholder'=>"Xác nhận mật khẩu", 'type'=>'password','error'=>false)); ?>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <hr>
                <?php echo $this->Form->button('Lưu',array('type'=>"submit", 'class'=>"col-lg-2 btn btn-primary")); ?>
            </div>
        </div>
        <?php echo $this->Form->end(); ?>
    <?php else: ?>
        Bạn chưa đăng nhập, click vào đây để <?php echo $this->Html->link('đăng nhập','/login'); ?>
    <?php endif ?>

</div>