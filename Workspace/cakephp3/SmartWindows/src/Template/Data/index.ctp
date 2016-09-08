<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Data'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="data index large-9 medium-8 columns content">
    <h3><?= __('Data') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('temp_int') ?></th>
                <th><?= $this->Paginator->sort('temp_ext') ?></th>
                <th><?= $this->Paginator->sort('luminosity') ?></th>
                <th><?= $this->Paginator->sort('date') ?></th>
                <th><?= $this->Paginator->sort('time') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $data): ?>
            <tr>
                <td><?= $this->Number->format($data->id) ?></td>
                <td><?= $this->Number->format($data->temp_int) ?></td>
                <td><?= $this->Number->format($data->temp_ext) ?></td>
                <td><?= $this->Number->format($data->luminosity) ?></td>
                <td><?= h($data->date) ?></td>
                <td><?= h($data->time) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $data->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $data->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $data->id], ['confirm' => __('Are you sure you want to delete # {0}?', $data->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
