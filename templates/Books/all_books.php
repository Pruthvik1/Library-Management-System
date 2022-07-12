<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\user $user
 */
?>
<?= $this->Html->css('milligram.min.css') ?>
<?= $this->Html->css('style.css') ?>

<style>
    .book{
        width:180px;
        height: 220px;
    }
    body{
        background-color:#fff ;
    }
</style>

<div class="row">
    <aside class="column column-10" style="padding-top:50px ;">
        <div class="side-nav">
            <h3 class="heading"><?php (!isset($cat)) ? $c='All Categories': $c=$cat->name ;echo $c; ?></h3>
            <?php foreach($cats as $cat):?>
                <?= $this->Html->link(__($cat->name), ['action' => 'allBooks',$cat->id], ['class' => 'side-nav-item']) ?>
            <?php endforeach ?>
        </div>
    </aside>
    <div class="column-responsive column-60">
    <main class="main-content">
        <div class="page">
            <div class="container">
                <!-- <h2 class="section-title">Latest Books</h2> -->
                <ul class="news-list">
                <?php for($i=1;$i<9;$i++):?>

                    <?php foreach($books as $book):?>
                    <li>
                        <figure><?= $this->Html->image($book->book_img,['class'=>'book']) ?></figure>
                        <h3 class="entry-titlee"><?=$this->Html->link( $book->title,['controller' => 'users', 'action' => 'singleBook',$book->id])?></h3>
                        <div class="date"><?=h($book->auther)?></div>
                        <!-- <p><?php //echo substr($book->summary, 0, strrpos(substr($book->summary, 0, 90), " ")).'...';?></p> -->
                    </li>
                    <?php endforeach?>
                    <?php endfor ?>
                   
                </ul>
               
            </div>
        </div>
    </main>
    </div>
</div>
