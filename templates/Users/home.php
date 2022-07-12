<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
    <title>Live Library | Home</title>
    <?= $this->Html->css('style.css') ?>
    <style>
        .book{
            width: 200px;
            height: 290px;
        }
    </style>
</head>

<body style="background-color:#fff ;">
    <main class="main-content">
        <div class="page">
            <div class="container">
                <h2 class="section-title">Latest Books</h2>
                <ul class="news-list">
                    <?php foreach($books as $book):?>
                    <li>
                        <figure><?= $this->Html->image($book->book_img,['class'=>'book']) ?></figure>
                        <h3 class="entry-titlee"><?=$this->Html->link( $book->title,['controller' => 'users', 'action' => 'singleBook',$book->id])?></h3>
                        <div class="date"><?=h($book->auther)?></div>
                        <p><?=substr($book->summary, 0, strrpos(substr($book->summary, 0, 90), " ")).'...';?></p>
                    </li>
                    <?php endforeach?>
                    
                </ul>
                <h3>&nbsp;<?=$this->Html->link('All Books..',['controller' => 'books', 'action' => 'allBooks'])?></h3>

                <hr class="separator padding">
                <h2 class="section-title">Popular Books</h2>
                <ul class="news-list">
                    <?php foreach($pbooks as $book):?>
                    <li>
                        <figure><?= $this->Html->image($book['book_img'],['class'=>'book']) ?></figure>
                        <h3 class="entry-titlee"><?=$this->Html->link( $book['title'],['controller' => 'users', 'action' => 'singleBook',$book['id']])?></h3>
                        <div class="date"><?=h($book['auther'])?></div>
                        <p><?=substr($book['summary'], 0, strrpos(substr($book['summary'], 0, 90), " ")).'...';?></p>
                        <div>Frequency: <?=h($book['count'])?></div>
                    </li>
                    <?php endforeach?>
                </ul>
            </div>
        </div>
    </main>
    <footer class="site-footer">
        <div class="container">
            <div class="colophon">Copyright 20<?= date('y') ?> Queueloop. Designed by <a href="#" title="Designed by Parth Lunagariya" target="_blank">Parth Lunagariya</a>. All rights reserved.</div>
        </div>
    </footer>
    </div>
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/app.js"></script>
</body>

</html>