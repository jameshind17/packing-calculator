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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $packingSize->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $packingSize->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Packing Sizes'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="packingSizes form content">
            <?= $this->Form->create($packingSize) ?>
            <fieldset>
                <legend><?= __('Edit Packing Size') ?></legend>
                <?php
                    echo $this->Form->control('pack_size');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
