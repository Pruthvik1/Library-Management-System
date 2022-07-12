<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Record $record
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Record'), ['action' => 'edit', $record->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Record'), ['action' => 'delete', $record->id], ['confirm' => __('Are you sure you want to delete # {0}?', $record->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Records'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Record'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="records view content">
            <h3><?= h($record->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Book Name') ?></th>
                    <td><?= h($record->book_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Book') ?></th>
                    <td><?= $record->has('book') ? $this->Html->link($record->book->name, ['controller' => 'Books', 'action' => 'view', $record->book->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $record->has('user') ? $this->Html->link($record->user->id, ['controller' => 'Users', 'action' => 'view', $record->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Returned') ?></th>
                    <td><?= h($record->is_returned) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($record->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
