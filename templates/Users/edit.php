<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\user $user
 */
?>
<?= $this->Html->css('milligram.min.css') ?>

<div class="row">
    <aside class="column column-20">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $userV->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $userV->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="userVs form content">
            <?= $this->Form->create($userV,['enctype'=>'multipart/form-data']) ?>
            <fieldset>
                <legend><?= __('Edit user') ?></legend>
                <?php
                    echo $this->Form->control('username');
                    // echo $this->Form->control('password');
                    //echo $this->Form->label('Your Avatar');
                    //echo $this->Form->file('profile_img',['required'=>'true']);
                    echo $this->Form->label('Role');
                    echo $this->Form->select('role', [
                        'user' => 'user',
                        'librarian' => 'Librarian',
                        'admin' => 'Admin'
                    ]);
                    echo $this->Form->control('email');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
