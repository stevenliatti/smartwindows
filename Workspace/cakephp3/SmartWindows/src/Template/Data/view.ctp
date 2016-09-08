<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Data'), ['action' => 'edit', $data->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Data'), ['action' => 'delete', $data->id], ['confirm' => __('Are you sure you want to delete # {0}?', $data->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Data'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Data'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="data view large-9 medium-8 columns content">
    <h3><?= h($data->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($data->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Temp Int') ?></th>
            <td><?= $this->Number->format($data->temp_int) ?></td>
        </tr>
        <tr>
            <th><?= __('Temp Ext') ?></th>
            <td><?= $this->Number->format($data->temp_ext) ?></td>
        </tr>
        <tr>
            <th><?= __('Luminosity') ?></th>
            <td><?= $this->Number->format($data->luminosity) ?></td>
        </tr>
        <tr>
            <th><?= __('Date') ?></th>
            <td><?= h($data->date) ?></td>
        </tr>
        <tr>
            <th><?= __('Time') ?></th>
            <td><?= h($data->time) ?></td>
        </tr>
    </table>
</div>
