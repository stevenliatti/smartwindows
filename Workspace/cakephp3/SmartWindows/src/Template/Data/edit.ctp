<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $data->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $data->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Data'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="data form large-9 medium-8 columns content">
    <?= $this->Form->create($data) ?>
    <fieldset>
        <legend><?= __('Edit Data') ?></legend>
        <?php
            echo $this->Form->input('temp_int');
            echo $this->Form->input('temp_ext');
            echo $this->Form->input('luminosity');
            echo $this->Form->input('date');
            echo $this->Form->input('time');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
