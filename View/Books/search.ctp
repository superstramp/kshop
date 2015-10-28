<div class="panel panel-info">
    <h4 class="panel-heading"><i class="glyphicon glyphicon-search"></i> Tìm kiếm</h4>

    <?php echo $this->Form->create('Book', array('action' => 'get_keyword', 'novalidate' => true, 'class' => 'form-inline')); ?>
    <?php if (isset($keyword)) { ?>
        <?php echo $this->Form->input('keyword', array('class' => 'col-lg-9', 'div' => false, 'required' => false, 'error' => false, 'label' => '', 'placeholder' => $keyword)); ?>
    <?php } else { ?>
        <?php echo $this->Form->input('keyword', array('class' => 'col-lg-9', 'div' => false, 'required' => false, 'error' => false, 'label' => '', 'placeholder' => 'Enter the keyword')); ?>
    <?php } ?>
    <?php echo $this->Form->button('Search', array('type' => 'submit', 'class' => 'col-lg-2 btn btn-primary')); ?>
    <?php echo $this->Form->end() ?>

</div>
<!-- new element -->
<div class="panel">
    <?php if (isset($error_keyword)): ?>
        <div class="alert alert-danger">
            <?php foreach ($error_keyword as $error): ?>
                <?php echo $error[0]; ?>
            <?php endforeach ?>
        </div>
    <?php endif ?>
    <!-- <div class="alert alert-danger">Lỗi</div> -->
    <?php if ($notfound == false && isset($books)) { ?>
        <h4 class="panel-heading"><i class="glyphicon glyphicon-th"></i><small> Kết quả tìm kiếm: </small> <?php echo h($keyword); ?>
        </h4>
        <?php echo $this->element('books', array('books' => $books)); ?>
        <?php echo $this->element('pagination', array('object' => 'book')); ?>
    <?php } else if ($notfound) { ?>
        <p>Book not found</p>
    <?php } ?>

</div> <!-- end element -->

