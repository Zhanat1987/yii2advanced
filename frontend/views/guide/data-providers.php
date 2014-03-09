<h1>
    Data providers (поставщики данных)
</h1>
<hr />
<p>
    Наборы данных для Data providers устанавливаются с помощью [[yii\data\DataProviderInterface]] и устанавливается нумерация страниц и сортировка данных. Он может быть использован в grids (сетях), lists (списках) и в других виджетах данных.
</p>
<p>
    В Yii есть три встроенных Data providers (поставщика данных): [[yii\data\ActiveDataProvider]], [[yii\data\ArrayDataProvider]] и [[yii\data\SqlDataProvider]].
</p>
<h2>
    Active data provider
</h2>
<hr />
<p>
    ActiveDataProvider предоставляет данные, выполняя DB запросы, используя [[\yii\db\Query]] и [[\yii\db\ActiveQuery]].
</p>
<p>
    Ниже приведен пример использования ActiveDataProvider для предоставления экземпляров ActiveRecord:<br />
    <?php
    highlight_string("<?php
\$provider = new ActiveDataProvider([
    'query' => Post::find(),
    'pagination' => [
        'pageSize' => 20,
    ],
]);

// get the posts in the current page
\$posts = \$provider->getModels();
?>");
    ?>
</p>
<p>
    И в следующем примере показано, как использовать ActiveDataProvider без ActiveRecord:<br />
    <?php
    highlight_string("<?php
\$query = new Query();
\$provider = new ActiveDataProvider([
    'query' => \$query->from('tbl_post'),
    'pagination' => [
        'pageSize' => 20,
    ],
]);

// get the posts in the current page
\$posts = \$provider->getModels();
?>");
    ?>
</p>
<h2>
    Array data provider
</h2>
<hr />
<p>
    ArrayDataProvider реализует data provider (поставщик данных) на основе массива данных.
</p>
<p>
    Значение в ключе [[AllModels]] предусмотрены все модели данных, которые могут быть отсортированы и/или разбиваться на страницы. ArrayDataProvider будет предоставлять данные после сортировки и/или нумерации страниц. Вы можете настроить свойства [[sort]] и [[pagination]] для настройки сортировки и нумерации страниц.
</p>
<p>
    Элементы в массиве [[allModels]] могут быть как объекты (объекты, например, модель) или ассоциативные массивы (например, результаты запроса из DAO). Убедитесь в том, что установлен [[key]] объекта с именем поля, которое уникально идентифицирует записи данных или false, если у вас нет такого поля.
</p>
<p>
    По сравнению с ActiveDataProvider, ArrayDataProvider может быть менее эффективным, потому что для этого нужно иметь [[allModels]] готовым.
</p>
<p>
    ArrayDataProvider может быть использован следующим образом:<br />
    <?php
    highlight_string("<?php
\$query = new Query();
\$provider = new ArrayDataProvider([
    'allModels' => \$query->from('tbl_post')->all(),
    'sort' => [
        'attributes' => ['id', 'username', 'email'],
    ],
    'pagination' => [
        'pageSize' => 10,
    ],
]);
// get the posts in the current page
\$posts = \$provider->getModels();
?>");
    ?>
</p>
<blockquote>
    <p>
        Примечание: если вы хотите использовать возможности сортировки, то необходимо настроить объект [[sort]] так, чтобы provider (поставщик) знал какие столбцы могут быть отсортированы.
    </p>
</blockquote>
<h2>
    SQL data provider
</h2>
<hr />
<p>
    SqlDataProvider реализует data provider (поставщика данных), основанного на простом выражении SQL. Это обеспечивает данные массивов, каждый из которых представляет ряд результата запроса (строка в таблице).
</p>
<p>
    Как и другие data providers (поставщики данных), SqlDataProvider также поддерживает сортировку и разбиение на страницы. Он делает это путем изменения [[SQL]] выражения в "ORDER BY" и "LIMIT". Вы можете настроить свойства [[sort]] и [[pagination]] для настройки сортировки и нумерации страниц.
</p>
<p>
    SqlDataProvider могут быть использованы следующим образом:<br />
    <?php
    highlight_string("<?php
\$count = Yii::\$app->db->createCommand('
    SELECT COUNT(*) FROM tbl_user WHERE status=:status
', [':status' => 1])->queryScalar();

\$dataProvider = new SqlDataProvider([
    'sql' => 'SELECTFROM tbl_user WHERE status=:status',
    'params' => [':status' => 1],
    'totalCount' => \$count,
    'sort' => [
        'attributes' => [
            'age',
            'name' => [
                'asc' => ['first_name' => SORT_ASC, 'last_name' => SORT_ASC],
                'desc' => ['first_name' => SORT_DESC, 'last_name' => SORT_DESC],
                'default' => SORT_DESC,
                'label' => 'Name',
            ],
        ],
    ],
    'pagination' => [
        'pageSize' => 20,
    ],
]);

// get the user records in the current page
\$models = \$dataProvider->getModels();
?>");
    ?>
</p>
<blockquote>
    <p>
        Примечание: если вы хотите использовать функцию разбиения на страницы, то необходимо настроить свойство [[TotalCount]] - общее количество строк (без нумерации страниц). И если вы хотите использовать для сортировки функцию, то необходимо настроить свойство [[sort]] объекта так, чтобы provider (поставщик) знал, какие столбцы могут быть отсортированы.
    </p>
</blockquote>
<h2>
    Реализация своего ​​собственного пользовательского data provider (поставщика данных)
</h2>
<hr />