    <?php $categories = $this->requestAction('/categories/menu'); ?>
    <?php if (!empty($categories)) { ?>
        <ul>
        <?php foreach ($categories as $category) { ?>
            <li><?php echo $this->Html->link($category['Category']['name'], "/categories/view/" . $category['Category']['slug']); ?></li>
            <br>
        <?php } ?>
        </ul>
    <?php } ?>
