<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Book $book
 * @var \Cake\Collection\CollectionInterface|string[] $categories
 */
?>
<?= $this->Html->css('milligram.min.css') ?>

<div class="row">
    <aside class="column column-20">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Books'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Add Category'), ['controller'=>'categories','action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="books form content">
        <?= $this->Form->create($book,['enctype'=>'multipart/form-data']) ?>

            <fieldset>
                <legend><?= __('Add Book') ?></legend>
                <?php
                    echo $this->Form->control('category_id', ['options' => $categories]);
                    echo $this->Form->label('book_img');
                    echo $this->Form->file('book_img',['required'=>true]);
                    echo $this->Form->control('title');
                    // echo $this->Form->control('slug');
                    echo $this->Form->control('summary');
                    echo $this->Form->control('isbn_no');
                    echo $this->Form->control('auther');
                    echo $this->Form->control('total_qty');
                    echo $this->Form->control('available_qty');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
