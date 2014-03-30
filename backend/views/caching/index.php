<?php
use yii\helpers\Html;
?>
<?php if ($models) : ?>
    <table class="table table-bordered table-condensed table-hover table-responsive
    table-striped">
        <tr>
            <th>
                №
            </th>
            <th>
                Заголовок
            </th>
        </tr>
        <?php foreach ($models as $model) : ?>
            <tr>
                <td>
                    <?php echo Html::encode($model['id']); ?>
                </td>
                <td>
                    <?php echo Html::encode($model['title']); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else : ?>
    <h2>
        Нет записей!!!
    </h2>
<?php endif; ?>