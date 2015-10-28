<ul class="pagination">
    <?php echo $this->Paginator->prev('<<', array('tag' => 'li'), '<<', array('tag' => 'li', 'disabledTag' => 'a', 'class' => 'disabled')); ?>
    <?php echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentTag' => 'a', 'currentClass' => 'active')); ?>
    <?php echo $this->Paginator->next('>>', array('tag' => 'li'), '>>', array('tag' => 'li', 'disabledTag' => 'a', 'class' => 'disabled')); ?>

</ul>
