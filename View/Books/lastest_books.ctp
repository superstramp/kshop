<!-- new element -->
<div class="panel">
    <h4 class="panel-heading"><i class="glyphicon glyphicon-th"></i>
        <small> New book:</small>
        <small class="sorts pull-right">Sort by:
            <?php echo $this->Paginator->sort('title', 'name'); ?>
            <?php echo $this->Paginator->sort('created', 'date'); ?>
        </small>
    </h4>
    <?php echo $this->element('books', array('books' => $books)); ?>
    <?php echo $this->element('pagination', array('object' => "books")); ?>
</div> <!-- end element -->



