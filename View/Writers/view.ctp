<div class="panel panel-info">
    <h4 class="panel-heading"><i class="glyphicon glyphicon-user"></i> <?php echo h($writer['Writer']['name']); ?></h4>

    <p><?php echo h($writer['Writer']['biography']); ?></p>
</div>
<!-- new element -->
<div class="panel">
    <h4 class="panel-heading"><i class="glyphicon glyphicon-th"></i>
        <small> Các sách của tác giả:</small> <?php echo h($writer['Writer']['name']); ?>
    </h4>
    <?php echo $this->element('books'); ?>
    <?php echo $this->element('pagination', array('object' => 'book')); ?>
</div> <!-- end element -->