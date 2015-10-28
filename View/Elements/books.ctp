<div class="row">
    <?php foreach ($books as $book): ?>
    <div class="col col-lg-3">
        <div class="book-thumbnail">
            <?php echo $this->Html->link($this->Html->image( $book['Book']['image']), '/books/view/'.$book['Book']['slug'], array('escape' => false)); ?>
            <div class="caption book-info">
                <h4><?php echo $book['Book']['title']; ?></h4>
                <?php foreach ($book['Writer'] as $writer) {
                    echo $this->Html->link($writer['name'], '/writers/view/'.$writer['slug'], array('class' => 'author'))." - ";
                }
                ?>
                <p class="price"><?php echo $this->Number->currency($book['Book']['sale_price'],' VND', array('places' => 0, 'wholePosition' => 'after')); ?></p>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
