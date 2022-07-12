<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Record[]|\Cake\Collection\CollectionInterface $records
 */
?>
<?=$this->Flash->render()?>
<?= $this->Html->css('milligram.min.css') ?>

<div class="records index content">
    
    <h3><?= __('My Books') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('book_name') ?></th>
                    <th><?= $this->Paginator->sort('borrow_date') ?></th>
                    <th><?= $this->Paginator->sort('return_date') ?></th>
                   
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr>
                    <td><?= $this->Number->format($record->id) ?></td>
                    <td><?= h($record->book_name) ?></td>
                    <td><?= h($record->borrow_date) ?></td>{
                    <td><?php if($record->return_date){ echo(strtoupper(h($record->return_date)));} else{ echo('-');}?></td>
                    
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'singleBook', $record->book_id]) ?>
                        <?php if($record->is_returned=='false'){
                         echo $this->Html->link(__('Return'), ['action' => 'returnBook', $record->id]);
                        } 
                         ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
