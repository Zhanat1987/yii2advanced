<h1>
    Виджеты данных
</h1>
<hr />
<h2>
    ListView
</h2>
<hr />
<h2>
    DetailView
</h2>
<hr />
<p>
    DetailView отображает данные одной [[model]].
</p>
<p>
    Лучше всего использовать для отображения модели в обычном формате (например, каждый атрибут модели отображается в виде строки в таблице). Модель может быть либо экземпляром класса [[Model]] или ассоциативным массивом.
</p>
<p>
    DetailView использует свойство [[attributes]], чтобы определить какие должны быть отображены атрибуты модели и как они должны быть отформатированы.
</p>
<p>
    Типичное использование DetailView выглядит следующим образом:<br />
    <?php
    highlight_string("<?php
echo DetailView::widget([
    'model' => \$model,
    'attributes' => [
        'title',             // title attribute (in plain text)
        'description:html',  // description attribute in HTML
        [                    // the owner name of the model
            'label' => 'Owner',
            'value' => \$model->owner->name,
        ],
    ],
]);
?>");
    ?>
</p>