<!-- new element -->
<?php if($this->Session->check('cart')) { ?>
    <div class="panel">
        <h4 class="panel-heading"><i class="glyphicon glyphicon-shopping-cart"></i> Giỏ hàng của bạn
        </h4>
        <div class="row">

            <!-- cart -->
            <div class="">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên sách</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Xóa</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $book_index = 1; ?>
                    <?php foreach ($cart as $book) { ?>

                        <tr>
                            <td><?php echo $book_index ?></td>
                            <td><?php echo $this->Html->link($book['title'], '/books/view/'.$book['slug']); ?></td>
                            <td class="row">
                                <form class="form-inline">
                                    <?php $this->Form->create('Book', array('action' => '', 'class' => 'form-inline')); ?>
                                    <?php echo $this->Form->input('quantity', array('value' => $book['quantity'], 'label' => '',  'class'=>"col col-lg-2", 'type' => 'text', 'div' => false)); ?>
                                    <?php echo $this->Form->button('Cap nhat', array('type' => 'submit', 'class' => 'btn btn-link')); ?>
                                    <?php $this->Form->end(); ?>
                                </form>
                            </td>
                            <td><?php echo $this->Number->currency($book['sale_price'], ' VND', array('places' => 0, 'wholePosition' => 'after')); ?></td>
                            <td>
                                <?php echo $this->Form->postLink('<i class="glyphicon glyphicon-remove"></i>', '/books/remove/'.$book['id'], array('escape' => false)); ?>
                            </td>
                        </tr>

                    <?php } ?>
                    <tr>
                        <td></td>
                        <td colspan="2"><strong>Tổng cộng</strong></td>
                        <td colspan="2"><strong><?php echo $this->Number->currency($payment['total'], ' VND', array('places' => 0, 'wholePosition' => 'after')); ?></strong></td>
                    </tr>
                    <tr>
                        <td></td>
                        <?php if($this->Session->check('payment.coupon')) { ?>
                            <td colspan="2"><strong>Đã giảm <small>(Coupon: <?php echo $payment['coupon']; ?> - giảm <?php echo $payment['discount']; ?>%)</small></strong></td>
                            <td colspan="2"><strong><?php echo ($payment['total'] - $payment['pay']); ?></strong></td>
                        <?php } else { ?>
                            <td colspan="2"><strong>Đã giảm <small>(Coupon: -- - giảm 0%)</small></strong></td>
                            <td colspan="2"><strong>0</strong></td>
                        <?php } ?>
                    </tr>
                    <tr class="success">
                        <td></td>
                        <td colspan="2"><h4><strong>Giá phải trả</strong> </h4></td>
                        <?php if($this->Session->check('payment.coupon')) { ?>
                            <td colspan="2"><h4><span class="label label-danger"><?php echo $this->Number->currency($payment['pay'], ' VND', array('places' => 0, 'wholePosition' => 'after')); ?></span></h4></td>
                        <?php } else { ?>
                            <td colspan="2"><h4><span class="label label-danger"><?php echo $this->Number->currency($payment['total'], ' VND', array('places' => 0, 'wholePosition' => 'after')); ?></span></h4></td>
                        <?php } ?>
                    </tr>
                    </tbody>
                </table>
            </div>
            <?php echo $this->Form->postLink('Lam rong gio hang', '/books/empty_cart', array('class' => 'col-lg-3 btn btn-default empty')); ?>

        </div>

    </div> <!-- end element -->

    <!-- coupon -->
    <div class="panel panel-success col col-lg-4">
        <h4 class="panel-heading"><i class="glyphicon glyphicon-barcode"></i> Mã giảm giá</h4>
        <?php echo $this->Session->flash('coupon'); ?>
        <?php if($this->Session->check('payment.coupon')) { ?>
            <h3>ban da nhap  ma giam gia</h3>
        <?php } else { ?>

                <?php echo $this->Form->create('Coupon', array('action' => 'add', 'class'=>'form-inline')); ?>
                <?php echo $this->Form->input('code', array('label' => false, 'div'=>false, 'placeholder' => 'nhap ma giam gia', 'class' => 'col-lg-9')); ?>
                <?php echo $this->Form->button('Nhap', array('type' => 'submit', 'class' => 'col-lg-2 btn btn-primary'));  ?>
                <?php echo $this->Form->end(); ?>

            <h4>Ghi chú:</h4>
            <ul>
                <li>Mỗi mã giảm giá có mức giảm giá khác nhau và chỉ dùng trong khoảng thời gian quy định.</li>
                <li>Chỉ dùng một mã giảm giá khi thanh toán đơn hàng.</li>
                <li>Số tiền giảm giá được tính dựa trên <strong>số phần trăm giảm giá * tổng giá trị</strong> của đơn hàng.</li>
            </ul>
        <?php } ?>
    </div>

    <!-- customer info -->
    <div class="panel panel-info col col-lg-7 col-offset-1">
        <h4 class="panel-heading"><i class="glyphicon glyphicon-user"></i> Thanh toán đơn hàng</h4>
        <?php if(!empty($user_info)) { ?>

            <?php echo $this->Form->create('Order', array('action' => 'checkout ', 'class' => 'form-horizontal', 'inputDefaults' => array('label' => false))); ?>
            <div class="row">
                <label for="inputEmail" class="col col-lg-2 control-label">Tên</label>
                <div class="col col-lg-10">
                    <?php echo  $this->Form->input('name', array('placeholder' => 'Nhap ten', 'value' => $user_info['fullname'])); ?>
                </div>
            </div>
            <div class="row">
                <label for="inputEmail" class="col col-lg-2 control-label">Email</label>
                <div class="col col-lg-10">
                    <?php echo $this->Form->input('email', array('placeholder' => 'Nhap ten', 'value' => $user_info['email'])); ?>
                </div>
            </div>
            <div class="row">
                <label for="inputEmail" class="col col-lg-2 control-label">Địa chỉ</label>
                <div class="col col-lg-10">
                    <?php echo $this->Form->input('address', array('label' => false, 'placeholder' => 'Nhap ten', 'value' => $user_info['address'])); ?>
                </div>
            </div>
            <div class="row">
                <label for="inputEmail" class="col col-lg-2 control-label">Phone</label>
                <div class="col col-lg-10">
                    <?php echo $this->Form->input('phone', array('placeholder' => 'Nhap ten', 'value' => $user_info['phone_number'])); ?>
                </div>
            </div>
            <div class="row">
                <div class="col col-lg-10 col-offset-2">
                    <?php echo $this->Form->button('Thuc hien tahnh toan', array('type' => 'submit', 'class' => 'btn btn-primary pull-right' )); ?>
                </div>
            </div>
            <?php echo $this->Form->end(); ?>
        <?php } else { ?>
         Ban phai <?php echo $this->Html->link('dang nhap', '/users/login'); ?> de thanh toan
        <?php } ?>


    </div>
<?php } else { ?>
    <div class="panel">
        <h2>Gio hang rong</h2>
    </div>
<?php }  ?>
