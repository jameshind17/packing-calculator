<div class="row">
    <div class="column-responsive column-100">
        <div class="packingSizes form content">
            <?= $this->Form->create(null, ['id' => 'calculator']) ?>
            <fieldset>
                <legend><?= __('Calculate packs to send') ?></legend>
                <?php
                    echo $this->Form->control('Order Quantity', ['required' => true]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
