<div class="panel">
    <h4 class="panel-heading"><i class="glyphicon glyphicon-bookmark"></i> Sách mới
        <?php echo $this->Html->link('xem tất cả →', '/books/index', array('class' => 'more')); ?>
    </h4>
    <?php echo $this->element('books'); ?>
</div> <!-- end new books -->