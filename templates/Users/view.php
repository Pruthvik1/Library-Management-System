<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\user $userV
 */
?>
<?= $this->Html->css('milligram.min.css') ?>

<div class="row">
    <aside class="column column-20">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit user'), ['action' => 'edit', $userV->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete user'), ['action' => 'delete', $userV->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userV->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New user'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users view content">
            <h3><?= h($userV->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('username') ?></th>
                    <td><?= h($userV->userVname) ?></td>
                </tr>
                <tr>
                    <th><?= __('Profile Img') ?></th>
                    <td><?= $this->Html->image($userV->profile_img,['style'=>'border-radius:40%;width:100px;height:100px;']) ?></td>
                </tr>
                <tr>
                    <th><?= __('Role') ?></th>
                    <td><?= h($userV->role) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($userV->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($userV->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <?php if ($user) : ?>
                <h4><?= __('Related Records') ?></h4>

                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Book Name') ?></th>
                            <th><?= __('Book Id') ?></th>
                            <th><?= __('user Id') ?></th>
                            <th><?= __('Is Returned') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($userV->records as $records) : ?>
                        <tr>
                            <td><?= h($records->id) ?></td>
                            <td><?= h($records->book_name) ?></td>
                            <td><?= h($records->book_id) ?></td>
                            <td><?= h($records->userV_id) ?></td>
                            <td><?= h($records->is_returned) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Records', 'action' => 'view', $records->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Records', 'action' => 'edit', $records->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Records', 'action' => 'delete', $records->id], ['confirm' => __('Are you sure you want to delete # {0}?', $records->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
