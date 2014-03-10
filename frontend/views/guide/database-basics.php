<h1>
    Основы баз данных
</h1>
<hr />
<p>
    Yii имеет слой доступа к базе данных, построенный на основе PDO PHP. Это обеспечивает равномерное API и решает некоторые несоответствия между различными СУБД. По умолчанию Yii поддерживает следующие СУБД:
</p>
<ul>
    <li>MySQL</li>
    <li>MariaDB</li>
    <li>SQLite</li>
    <li>PostgreSQL</li>
    <li>CUBRID: версия 9.1.0 или выше.</li>
    <li>Oracle</li>
    <li>MSSQL: версия 2012 или выше требуется, если хотите использовать LIMIT/OFFSET.</li>
</ul>
<h2>
    Конфигурация
</h2>
<hr />
<p>
    Для того, чтобы начать использовать базу данных, необходимо настроить компонент подключения к базе данных сначала путем добавления db компонента в конфигурации приложения (для "базового" веб-приложения config/web.php) так:<br />
    <?php
    highlight_string("<?php
return [
    // ...
    'components' => [
        // ...
        'db' => [
            'class' => 'yii\\db\\Connection',
            'dsn' => 'mysql:host=localhost;dbname=mydatabase', // MySQL, MariaDB
            //'dsn' => 'sqlite:/path/to/database/file', // SQLite
            //'dsn' => 'pgsql:host=localhost;port=5432;dbname=mydatabase', // PostgreSQL
            //'dsn' => 'cubrid:dbname=demodb;host=localhost;port=33000', // CUBRID
            //'dsn' => 'sqlsrv:Server=localhost;Database=mydatabase', // MS SQL Server, sqlsrv driver
            //'dsn' => 'dblib:host=localhost;dbname=mydatabase', // MS SQL Server, dblib driver
            //'dsn' => 'mssql:host=localhost;dbname=mydatabase', // MS SQL Server, mssql driver
            //'dsn' => 'oci:dbname=//localhost:1521/mydatabase', // Oracle
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
    ],
    // ...
];
?>");
    ?>
</p>
<p>
    Пожалуйста, обратитесь к руководству PHP для более подробной информации о формате DSN строки.
</p>
<p>
    После того как подключение компонента db настроено, вы можете получить к нему доступ, используя следующий синтаксис:<br />
    <?php
    highlight_string("<?php
\$connection = \\Yii::\$app->db;
?>");
    ?>
</p>
<p>
    Вы можете обратиться к [[yii\db\Connection]] для получения списка свойств, которые можно настроить. Также обратите внимание, что вы можете определить более одного компонента соединения с бд и использовать оба одновременно при необходимости:<br />
    <?php
    highlight_string("<?php
\$primaryConnection = \\Yii::\$app->db;
\$secondaryConnection = \\Yii::\$app->secondDb;
?>");
    ?>
</p>
<p>
    Если вы не хотите определять соединение в качестве компонента приложения, то вы можете создать его экземпляр непосредственно:<br />
    <?php
    highlight_string("<?php
\$connection = new \\yii\\db\\Connection([
    'dsn' => \$dsn,
    'username' => \$username,
    'password' => \$password,
]);
\$connection->open();
?>");
    ?>
</p>
<blockquote>
    <p>
        Совет: если вам нужно выполнить дополнительные SQL запросы сразу после установления соединения, то вы можете добавить следующие строки в ваш файл конфигурации приложения:
    </p>
    <?php
    highlight_string("<?php
return [
    // ...
    'components' => [
        // ...
        'db' => [
            'class' => 'yii\\db\\Connection',
            // ...
            'on afterOpen' => function(\$event) {
                \$event->sender->createCommand(\"SET time_zone = 'UTC'\")->execute();
            }
        ],
    ],
    // ...
];
?>");
    ?>
</blockquote>
<h2>
    Основные SQL запросы
</h2>
<hr />
<p>
    Если у вас есть экземпляр соединения, то можно выполнять запросы SQL с помощью [[yii\db\Command]].
</p>
<h3>
    SELECT
</h3>
<p>
    Когда запрос возвращает набор строк:<br />
    <?php
    highlight_string("<?php
\$command = \$connection->createCommand('SELECT * FROM tbl_post');
\$posts = \$command->queryAll();
?>");
    ?>
</p>
<p>
    Когда только одна строка возвращается:<br />
    <?php
    highlight_string("<?php
\$command = \$connection->createCommand('SELECT * FROM tbl_post WHERE id=1');
\$post = \$command->queryOne();
?>");
    ?>
</p>
<p>
    Когда есть несколько значений из одного столбца:<br />
    <?php
    highlight_string("<?php
\$command = \$connection->createCommand('SELECT title FROM tbl_post');
\$titles = \$command->queryColumn();
?>");
    ?>
</p>
<p>
    Когда есть скалярное значение:<br />
    <?php
    highlight_string("<?php
\$command = \$connection->createCommand('SELECT COUNT(*) FROM tbl_post');
\$postCount = \$command->queryScalar();
?>");
    ?>
</p>
<h2>
    UPDATE, INSERT, DELETE и т. д.
</h2>
<hr />
<p>
    Если SQL выполняется и не возвращает данные, которые вы можете использовать, то вызовите метод execute:<br />
    <?php
    highlight_string("<?php
\$command = \$connection->createCommand('UPDATE tbl_post SET status=1 WHERE id=1');
\$command->execute();
?>");
    ?>
</p>
<p>
    В качестве альтернативы следующий синтаксис, который заботится о собственных именах таблиц и столбцов с кавычками:<br />
    <?php
    highlight_string("<?php
// INSERT
\$connection->createCommand()->insert('tbl_user', [
    'name' => 'Sam',
    'age' => 30,
])->execute();

// INSERT multiple rows at once
\$connection->createCommand()->batchInsert('tbl_user', ['name', 'age'], [
    ['Tom', 30],
    ['Jane', 20],
    ['Linda', 25],
])->execute();

// UPDATE
\$connection->createCommand()->update('tbl_user', ['status' => 1], 'age > 30')->execute();

// DELETE
\$connection->createCommand()->delete('tbl_user', 'status = 0')->execute();
?>");
    ?>
</p>
<h2>
    Quoting (обрамление кавычками) имен таблиц и столбцов
</h2>
<hr />
<p>
    Большую часть времени вы будете использовать следующий синтаксис для обрамление кавычками имен таблиц и столбцов:<br />
    <?php
    highlight_string("<?php
\$sql = \"SELECT COUNT([[\$column]]) FROM {{\$table}}\";
\$rowCount = \$connection->createCommand(\$sql)->queryScalar();
?>");
    ?>
</p>
<p>
    В приведенном выше коде [[X]] будет преобразован в имя столбца в кавычках, в то время как {{Y}} будет преобразовано в имя таблицы в кавычках.
</p>
<p>
    Как вариант можно экранировать имена столбцов и таблиц вручную, используя [[yii\db\Connection::quoteTableName()]] и [[yii\db\Connection::quoteColumnName()]]:<br />
    <?php
    highlight_string("<?php
\$column = \$connection->quoteColumnName(\$column);
\$table = \$connection->quoteTableName(\$table);
\$sql = \"SELECT COUNT(\$column) FROM \$table\";
\$rowCount = \$connection->createCommand(\$sql)->queryScalar();
?>");
    ?>
</p>
<h2>
    Подготовленные выражения
</h2>
<hr />
<p>
    Для того, чтобы надежно передавать параметры запроса вы можете использовать подготовленные выражения:<br />
    <?php
    highlight_string("<?php
\$command = \$connection->createCommand('SELECT * FROM tbl_post WHERE id=:id');
\$command->bindValue(':id', \$_GET['id']);
\$post = \$command->query();
?>");
    ?>
</p>
<p>
    Еще один вариант использования запроса несколько раз, в то время как подготовить его только один раз:<br />
    <?php
    highlight_string("<?php
\$command = \$connection->createCommand('DELETE FROM tbl_post WHERE id=:id');
\$command->bindParam(':id', \$id);

\$id = 1;
\$command->execute();

\$id = 2;
\$command->execute();
?>");
    ?>
</p>
<h2>
    Транзакции
</h2>
<hr />
<p>
    Вы можете выполнять транзакционные запросы SQL следующим образом:<br />
    <?php
    highlight_string("<?php
\$transaction = \$connection->beginTransaction();
try {
    \$connection->createCommand(\$sql1)->execute();
    \$connection->createCommand(\$sql2)->execute();
    // ... executing other SQL statements ...
    \$transaction->commit();
} catch(Exception \$e) {
    \$transaction->rollBack();
}
?>");
    ?>
</p>
<p>
    Также можно вложить несколько транзакций, в случае необходимости:<br />
    <?php
    highlight_string("<?php
// outer transaction
\$transaction1 = \$connection->beginTransaction();
try {
    \$connection->createCommand(\$sql1)->execute();

    // inner transaction
    \$transaction2 = \$connection->beginTransaction();
    try {
        \$connection->createCommand(\$sql2)->execute();
        \$transaction2->commit();
    } catch (Exception \$e) {
        \$transaction2->rollBack();
    }

    \$transaction1->commit();
} catch (Exception \$e) {
    \$transaction1->rollBack();
}
?>");
    ?>
</p>
<h2>
    Работа со схемой базы данных
</h2>
<hr />
<h3>
    Получение информации о схеме
</h3>
<p>
    Вы можете получить экземпляр [[yii\db\Schema]] так:<br />
    <?php
    highlight_string("<?php
\$schema = \$connection->getSchema();
?>");
    ?>
</p>
<p>
    Он содержит набор методов, позволяющих извлекать различную информацию о базе данных:<br />
    <?php
    highlight_string("<?php
\$tables = \$schema->getTableNames();
?>");
    ?>
</p>
<p>
    Для полной информации посмотрите [[yii\db\Schema]].
</p>
<h3>
    Изменение схемы
</h3>
<p>
    Помимо основных запросов SQL, [[yii\db\Command]] содержит набор методов, позволяющих изменять схему базы данных:
</p>
<ul>
    <li>createTable, renameTable, dropTable, truncateTable</li>
    <li>addColumn, renameColumn, dropColumn, alterColumn</li>
    <li>addPrimaryKey, dropPrimaryKey</li>
    <li>addForeignKey, dropForeignKey</li>
    <li>createIndex, dropIndex</li>
</ul>
<p>
    Они могут быть использованы следующим образом:<br />
    <?php
    highlight_string("<?php
// CREATE TABLE
\$connection->createCommand()->createTable('tbl_post', [
    'id' => 'pk',
    'title' => 'string',
    'text' => 'text',
]);
?>");
    ?>
</p>
<p>
    Для полной информации посмотрите [[yii\db\Command]].
</p>