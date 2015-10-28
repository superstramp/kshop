<!-- new books -->
<div class="panel">
    <h4 class="panel-heading"><i class="glyphicon glyphicon-bookmark"></i> Chi tiết
    </h4>
    <div class="row">
        <div class="col col-lg-3">
            <div class="book-thumbnail">
                <?php echo $this->Html->image($book['Book']['image']); ?>
            </div>
        </div>
        <div class="col col-lg-9">
            <div class="bookinfo">
                <h4><?php echo h($book['Book']['title']); ?></h4>
                <p>Tác giả:
                    <?php if (!empty($book['Writer'])): ?>
                        <?php foreach ($book['Writer'] as $writer): ?>
                            <?php echo $this->Html->link($writer['name'],'/tac-gia/'.$writer['slug']); ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        Đang cập nhật
                    <?php endif; ?>
                </p>
                <p>Nhận xét:
                    <?php echo $this->Html->link($book['Book']['comment_count'].' nhận xét', '#nhanxet'); ?>
                </p>
                <p>Giá bìa: <?php echo $this->Number->currency($book['Book']['price'],' VND',array('places'=>0,'wholePosition'=>'after')); ?></p>
                <p class="yourprice">Giá bán: <span class="label label-danger"><?php echo $this->Number->currency($book['Book']['sale_price'],' VND',array('places'=>0,'wholePosition'=>'after')); ?></span></p>
<!--                <button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-shopping-cart"></i> Thêm vào giỏ </button>-->
                <?php echo $this->Form->postLink('<i class="glyphicon glyphicon-shopping-cart"></i> Thêm vào giỏ', '/books/add_to_cart/'.$book['Book']['id'], array('class' => 'btn btn-primary','escape' => false)) ?>
            </div>
        </div>

        <div class="col col-lg-12 book-content">
            <h4>Giới thiệu:</h4>
            <p>
                <?php echo h($book['Book']['info']); ?>
            </p>
            <div class=" col-lg-7">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Thông tin chi tiết</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Nhà xuất bản:</td>
                        <td><?php echo h($book['Book']['publisher']); ?></td>
                    </tr>
                    <tr>
                        <td>Ngày xuất bản</td>
                        <td><?php echo h($book['Book']['publish_date']); ?></td>
                    </tr>
                    <tr>
                        <td>Số trang:</td>
                        <td><?php echo h($book['Book']['pages']); ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div> <!-- end new books -->
<!-- related books -->
<div class="panel panel-success">
    <h4 class="panel-heading"><i class="glyphicon glyphicon-list-alt"></i> Sách liên quan
    </h4>
    <?php echo $this->element('books',array('books'=>$related_books)); ?>
</div> <!-- end related books -->
<!-- review -->
<div id="nhanxet" class="panel">
    <h4 class="panel-heading"><i class="glyphicon glyphicon-comment"></i> Nhận xét
    </h4>
    <div class="row">

        <div class="col col-lg-10">
            <?php if (!empty($comments)): ?>
                <?php foreach ($comments as $comment): ?>
                    <p class="comment">
                        <strong><?php echo $comment['User']['fullname']; ?>: </strong>
                        <?php echo $comment['Comment']['content']; ?>
                    </p>
                <?php endforeach ?>
            <?php else: ?>
                <p class="comment">Chưa có nhận xét nào</p>
            <?php endif; ?>


            <h4>Gửi nhận xét:</h4>
            <?php if(!empty($user_info)) { ?>
                <?php echo $this->element('errors'); ?>
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->Form->create('Comment',array('action'=>'add','novalidate'=>true, 'class'=>"commentform")); ?>
                <?php
//                    echo $this->Form->input('user_id',array('required'=>false,'label'=>'','type'=>'hidden','value'=>1));
                    echo $this->Form->input('book_id',array('required'=>false,'label'=>'','type'=>'hidden','value'=>$book['Book']['id']));
                    echo $this->Form->input('content', array('required' => false, 'label'=>'','rows'=>"5", 'class'=>"col-lg-12"));
                ?>
                <?php echo $this->Form->button('Gửi', array('type'=>"submit", 'class'=>"pull-right btn btn-primary col-lg-3")); ?>
                <?php echo $this->Form->end(); ?>
            <?php } else { ?>
                Ban phai <?php echo $this->Html->link('dang nhap', '/users/login'); ?> de gui binh luan
            <?php } ?>



        </div>
    </div>
</div> <!-- end review -->