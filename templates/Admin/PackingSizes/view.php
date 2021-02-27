<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PackingSize $packingSize
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Packing Size'), ['action' => 'edit', $packingSize->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Packing Size'), ['action' => 'delete', $packingSize->id], ['confirm' => __('Are you sure you want to delete # {0}?', $packingSize->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Packing Sizes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Packing Size'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="packingSizes view content">
            <h3><?= h($packingSize->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($packingSize->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Pack Size') ?></th>
                    <td><?= $this->Number->format($packingSize->pack_size) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
