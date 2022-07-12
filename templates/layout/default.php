<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'Live Library : Dozens Of Books In Your Fingers';

?>
<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'cake']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <style>
        .sticky {
            /* position: fixed;
        top: 0;
        left:305px;
        width: 100%;
        margin:20px  !important;
        padding:20px !important; */
        }

        .na-link:hover {
            color: #d33c43;
        }

        a {
            text-decoration: none !important;
        }

        h-100 {
            height: 80% !important;
        }
    </style>
    <?= $this->Html->css("https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css") ?>

</head>

<body>
    <nav class="top-nav sticky">
        <div class="top-nav-title">
            <a href="<?= $this->Url->build(['controller' => 'users', 'action' => 'home']) ?>"><span>Live</span>Library</a>
        </div>

        <!-- <a class='na-link' rel="noopener" href="#">Home</a>
            <a class='na-link' rel="noopener" href="#">Books</a> -->
        <?php
        $user = $this->request->getAttribute('identity');
        // dd($user-);
        if (!isset($user)) {
            echo ('<div class="top-nav-links " style="font-size:15px">');
            echo $this->Html->link('Home', ['controller' => 'users', 'action' => 'home'], ['class' => 'na-link']);
            echo $this->Html->link('Login', ['controller' => 'users', 'action' => 'login'], ['class' => 'na-link']);
            echo ('</div>');
        }
        if (isset($user)) {
            echo ('<div class="top-nav-links " style="display:flex ;align-items:center">');
            echo $this->Html->link('Hey, ' . $user['username'], ['controller' => 'users', 'action' => 'profile', $user['id']], ['class' => 'na-link', 'style' => 'text-transform: capitalize;']);
            echo $this->Html->link('Your Books', ['controller' => 'users', 'action' => 'myRecords'], ['class' => 'na-link']);
            if ($user['role'] == 'librarian' or $user['role'] == 'admin') {
                echo $this->Html->link('Students', ['controller' => 'users', 'action' => 'student'], ['class' => 'na-link']);
                echo $this->Html->link('Add Book', ['controller' => 'books', 'action' => 'add'], ['class' => 'na-link']);
            }
            if ($user['role'] == 'admin') {
                echo $this->Html->link('Librarians', ['controller' => 'users', 'action' => 'librarian'], ['class' => 'na-link']);
            }
            echo $this->Html->link('Leave', ['controller' => 'users', 'action' => 'logout'], ['class' => 'na-link']);
            echo $this->Html->image($user->profile_img, ['style' => 'border-radius:50%;width:50px;height:50px;border:2px solid #d33c43']);
            echo ('</div>');
        }
        ?>

    </nav>
    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer>
    </footer>
</body>

</html>