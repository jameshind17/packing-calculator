<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PackingSize[]|\Cake\Collection\CollectionInterface $packingSizes
 */
?>
<div class="packingSizes index content">
    <?= $this->Html->link(__('New Packing Size'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Packing Sizes') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('pack_size') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($packingSizes as $packingSize): ?>
                <tr>
                    <td><?= $this->Number->format($packingSize->id) ?></td>
                    <td><?= $this->Number->format($packingSize->pack_size) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $packingSize->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $packingSize->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $packingSize->id], ['confirm' => __('Are you sure you want to delete # {0}?', $packingSize->id)]) ?>
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
