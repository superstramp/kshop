<div class="panel panel-info">
    <h4 class="panel-heading"><i class="glyphicon glyphicon-user"></i> <?php echo h($category['Category']['name']); ?>
    </h4>
</div>
<!-- new element -->
<div class="panel">
    <h4 class="panel-heading"><i class="glyphicon glyphicon-th"></i>
        <small> Các sách trong danh muc:</small> <?php echo h($category['Category']['name']); ?>
    </h4>
    <?php echo $this->element('books'); ?>
    <?php echo $this->element('pagination', array('object' => 'book')); ?>
</div> <!-- end element -->