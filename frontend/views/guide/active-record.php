<h1>
    Active Record
</h1>
<hr />
<p>
    Active Record реализует шаблон проектирования <a href="http://en.wikipedia.org/wiki/Active_record" target="_blank">Active Record</a>. Предпосылка за Active Record в том, что отдельный объект [[yii\db\ActiveRecord|ActiveRecord]] связан с конкретной строкой в таблице базы данных. Атрибуты объекта отображаются в столбцах соответствующей таблицы. Ссылка на атрибут Active Record эквивалентно доступу к соответствующему столбцу таблицы бд для этой записи.
</p>
<p>
    В качестве примера, пусть будет класс ActiveRecord Customer связанный с таблицей tbl_customer. Это означает, что атрибут класса name, автоматически отображается в столбец name в tbl_customer. Благодаря Active Record, предположим, что переменная $customer является объектом класса Customer, чтобы получить значение столбца name для строки таблицы, вы можете использовать выражение $customer->name. В этом примере Active Record предоставляет объектно-ориентированный интерфейс для доступа к данным, хранящимся в базе данных. Но Active Record предоставляет гораздо больше возможностей, чем просто объектно-ориентированный интерфейс для доступа к данным.
</p>
<p>
    С Active Record, вместо того чтобы писать сырые выражения SQL для выполнения запросов к базе данных, вы можете вызывать интуитивные методы для достижения тех же целей. Например, вызов [[yii\db\ActiveRecord::save()|save()]] будет выполнять операцию INSERT или UPDATE запроса, создание или обновление строки в соответствующей таблице класса ActiveRecord:<br />
    <?php
    highlight_string("<?php
\$customer = new Customer();
\$customer->name = 'Qiang';
\$customer->save();  // a new row is inserted into tbl_customer
?>");
    ?>
</p>
<h2>
    Объявление класса ActiveRecord
</h2>
<hr />
<p>
    Чтобы объявить класс ActiveRecord вам нужно расширить класс [[yii\db\ActiveRecord]] и реализовать метод tableName:<br />
    <?php
    highlight_string("<?php
use yii\\db\\ActiveRecord;

class Customer extends ActiveRecord
{
    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return 'tbl_customer';
    }
}
?>");
    ?>
</p>
<p>
    Метод tableName должен вернуть только имя таблицы базы данных, связанной с классом.
</p>
<p>
    Экземпляры классов могут быть получены одним из двух способов:
</p>
<ul>
    <li>Использование оператора new, чтобы создать новый, пустой объект</li>
    <li>Используя метод получения существуещей записи (или записей) в базе данных</li>
</ul>
<h2>
    Подключение к базе данных
</h2>
<hr />
<p>
    ActiveRecord полагается на [[yii\db\Connection|DB connection]], чтобы выполнять основные операции DB. По умолчанию ActiveRecord предполагает, что существует компонент приложения с именем db, который обеспечивает необходимый экземпляр [[yii\db\Connection]]. Обычно этот компонент настроен в файле конфигурации приложения:<br />
    <?php
    highlight_string("<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\\db\\Connection',
            'dsn' => 'mysql:host=localhost;dbname=testdb',
            'username' => 'demo',
            'password' => 'demo',
        ],
    ],
];
?>");
    ?>
</p>
<p>
    Пожалуйста, прочитайте раздел основы баз данных, чтобы узнать больше о том, как настроить и использовать соединение с базой данных.
</p>
<h2>
    Запрос данных из базы данных
</h2>
<hr />
<p>
    Есть два метода ActiveRecord для запроса данных из базы данных:
</p>
<ul>
    <li>[[yii\db\ActiveRecord::find()]]</li>
    <li>[[yii\db\ActiveRecord::findBySql()]]</li>
</ul>
<p>
    Оба метода возвращают экземпляр [[yii\db\ActiveQuery]], который расширяется от [[yii\db\Query]], и, следовательно, поддерживает тот же набор гибких и мощных методов DB запросов. Следующие примеры демонстрируют некоторые возможности.<br />
    <?php
    highlight_string("<?php
// to retrieve all *active* customers and order them by their ID:
\$customers = Customer::find()
    ->where(['status' => \$active])
    ->orderBy('id')
    ->all();

// to return a single customer whose ID is 1:
\$customer = Customer::find(1);

// the above code is equivalent to the following:
\$customer = Customer::find()
    ->where(['id' => 1])
    ->one();

// to retrieve customers using a raw SQL statement:
\$sql = 'SELECT * FROM tbl_customer';
\$customers = Customer::findBySql(\$sql)->all();

// to return the number of *active* customers:
\$count = Customer::find()
    ->where(['status' => \$active])
    ->count();

// to return customers in terms of arrays rather than `Customer` objects:
\$customers = Customer::find()
    ->asArray()
    ->all();
// each element of \$customers is an array of name-value pairs

// to index the result by customer IDs:
\$customers = Customer::find()->indexBy('id')->all();
// \$customers array is indexed by customer IDs
?>");
    ?>
</p>
<p>
    Пакетный запрос также поддерживается при работе с Active Record. Например,<br />
    <?php
    highlight_string("<?php
// fetch 10 customers at a time
foreach (Customer::find()->batch(10) as \$customers) {
    // \$customers is an array of 10 or fewer Customer objects
}
// fetch 10 customers at a time and iterate them one by one
foreach (Customer::find()->each(10) as \$customer) {
    // \$customer is a Customer object
}
// batch query with eager loading
foreach (Customer::find()->with('orders')->each() as \$customer) {
}
?>");
    ?>
</p>
<p>
    Как поясняется в Query Builder, пакетный запрос очень полезен, когда вы выбираете большой объем данных из базы данных. Он будет держать ваше использование памяти под пределом.
</p>
<h2>
    Доступ к столбцам данных
</h2>
<hr />
<p>
    ActiveRecord переводит каждый столбец соответствующей строки таблицы базы данных к атрибуту в объекте ActiveRecord. Атрибут ведет себя как любое обычное public свойство объекта. Имя атрибута будет то же самое, что и соответствующее имя столбца с учетом регистра.
</p>
<p>
    Чтобы прочитать значение столбца, вы можете использовать следующий синтаксис:<br />
    <?php
    highlight_string("<?php
// \"id\" and \"email\" are the names of columns in the table associated with \$customer ActiveRecord object
\$id = \$customer->id;
\$email = \$customer->email;
?>");
    ?>
</p>
<p>
    Чтобы изменить значение столбца, надо присвоить новое значение для связанного свойства и сохранить объект:<br />
    <?php
    highlight_string("<?php
\$customer->email = 'jane@example.com';
\$customer->save();
?>");
    ?>
</p>
<h2>
    Манипулирование данными в базе данных
</h2>
<hr />
<p>
    ActiveRecord предоставляет следующие методы для вставки, обновления и удаления данных в базе данных:
</p>
<ul>
    <li>[[yii\db\ActiveRecord::save()|save()]]</li>
    <li>[[yii\db\ActiveRecord::insert()|insert()]]</li>
    <li>[[yii\db\ActiveRecord::update()|update()]]</li>
    <li>[[yii\db\ActiveRecord::delete()|delete()]]</li>
    <li>[[yii\db\ActiveRecord::updateCounters()|updateCounters()]]</li>
    <li>[[yii\db\ActiveRecord::updateAll()|updateAll()]]</li>
    <li>[[yii\db\ActiveRecord::updateAllCounters()|updateAllCounters()]]</li>
    <li>[[yii\db\ActiveRecord::deleteAll()|deleteAll()]]</li>
</ul>
<p>
    Обратите внимание, что статические методы [[yii\db\ActiveRecord::updateAll()|updateAll()]], [[yii\db\ActiveRecord::updateAllCounters()|updateAllCounters()]] и [[yii\db\ActiveRecord::deleteAll()|deleteAll()]] применяются ко всей таблице базы данных. Другие методы применяются только к строке, связанной с объектом ActiveRecord.<br />
    <?php
    highlight_string("<?php
// to insert a new customer record
\$customer = new Customer();
\$customer->name = 'James';
\$customer->email = 'james@example.com';
\$customer->save();  // equivalent to \$customer->insert();

// to update an existing customer record
\$customer = Customer::find(\$id);
\$customer->email = 'james@example.com';
\$customer->save();  // equivalent to \$customer->update();

// to delete an existing customer record
\$customer = Customer::find(\$id);
\$customer->delete();

// to increment the age of ALL customers by 1
Customer::updateAllCounters(['age' => 1]);
?>");
    ?>
</p>
<blockquote>
    <p>
        Информация: метод save() выполняет SQL оператор INSERT или UPDATE, в зависимости от того, что  ActiveRecord сохраняет новый объект или нет, проверяя ActiveRecord::isNewRecord.
    </p>
</blockquote>
<h2>
    Ввод и проверка данных
</h2>
<hr />
<p>
    ActiveRecord наследует проверки данных и ввода данных функций из [[yii\base\Model]]. Проверка данных вызывается автоматически при выполнении save(). Если проверка данных не удается, то операция сохранения будет отменена.
</p>
<p>
    Для получения дополнительной информации обратитесь к разделу Model данного руководства.
</p>
<h2>
    Запросы реляционных данных
</h2>
<hr />
<p>
    Вы можете использовать ActiveRecord также для выполнения запросов к реляционным данным таблицы (то есть, выбор данных из таблицы А также может тянуть соответствующие данные из таблицы B). Благодаря ActiveRecord, возвращаемые реляционные данные могут быть доступны как свойства объекта ActiveRecord, связанные с основной таблицей.
</p>
<p>
    Например, при задании соответствующего отношения, путем доступа $customer->orders вы можете получить массив объектов Order, которые представляют заказы указанного клиента (customer).
</p>
<p>
    Чтобы объявить отношение, надо определить getter метод, который возвращает объект [[yii\db\ActiveQuery]], который имеет информацию о контексте отношения и следовательно будет запрашиваться только для связанных записей. Например,<br />
    <?php
    highlight_string("<?php
class Customer extends \\yii\\db\\ActiveRecord
{
    public function getOrders()
    {
        // Customer has_many Order via Order.customer_id -> id
        return \$this->hasMany(Order::className(), ['customer_id' => 'id']);
    }
}

class Order extends \\yii\\db\\ActiveRecord
{
    // Order has_one Customer via Customer.id -> customer_id
    public function getCustomer()
    {
        return \$this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }
}
?>");
    ?>
</p>
<p>
    Методы [[yii\db\ActiveRecord::hasMany()]] и [[yii\db\ActiveRecord::hasOne()]] использующиея в коде выше, используются для моделирования отношений один-ко-многим и один-к-одному в реляционной базе данных. Например, клиент имеет много заказов, и заказ имеет одного клиента. Оба метода принимают два параметра и возвращают объект [[yii\db\ActiveQuery]]:
</p>
<ul>
    <li>$class - название класса соответствующей модели(ей). Значение должно быть полным именем класса.</li>
    <li>$link - связь между столбцами из двух таблиц. Значение должно быть передано в виде массива. Ключами массива являются имена столбцов из таблицы, связанной с $class, в то время как значениями массива являются имена столбцов из объявляющего класса. Это хорошая практика, чтобы определить отношения, основанные на  внешних ключах таблицы.</li>
</ul>
<p>
    После объявления отношения, получать реляционные данные так же легко, как и доступ к свойствам компонента, который определяется соответствующим getter методом:<br />
    <?php
    highlight_string("<?php
// get the orders of a customer
\$customer = Customer::find(1);
\$orders = \$customer->orders;  // \$orders is an array of Order objects
?>");
    ?>
</p>
<p>
    За сценой, приведенный выше код выполняет следующие два SQL запросов, по одному для каждой строки кода:<br />
    <?php
    highlight_string("<?php
SELECT * FROM tbl_customer WHERE id=1;
SELECT * FROM tbl_order WHERE customer_id=1;
?>");
    ?>
</p>
<blockquote>
    <p>
        Совет: Если вы опять запросите выражение $customer->orders, то он не будет выполнять второй SQL запрос снова. Запрос SQL выполняется только в первый раз, когда это выражение запрашивается. Любые дальнейшие запросы вернут только ранее полученные результаты, которые кэшируются внутренне. Если вы хотите повторно запросить реляционные данные, просто удалите существующие данные из первого запроса: unset($customer->orders);.
    </p>
</blockquote>
<p>
    Иногда, вы можете передать параметры в реляционный запрос. Например, вместо того чтобы вернуть все заказы клиента, вы можете вернуть только большие заказы, чей предварительный итог превышает указанную сумму. Чтобы сделать это, объявите отношение bigOrders следующим getter методом:<br />
    <?php
    highlight_string("<?php
class Customer extends \\yii\\db\\ActiveRecord
{
    public function getBigOrders(\$threshold = 100)
    {
        return \$this->hasMany(Order::className(), ['customer_id' => 'id'])
            ->where('subtotal > :threshold', [':threshold' => \$threshold])
            ->orderBy('id');
    }
}
?>");
    ?>
</p>
<p>
    Помните, что hasMany() возвращает объект [[yii\db\ActiveQuery]], который позволяет настраивать запрос с помощью методов объекта [[yii\db\ActiveQuery]].
</p>
<p>
    За счет объявленния выше, если вы запрашиваете $customer->bigOrders, то он вернет только заказы, чей предварительный итог больше чем 100. Чтобы указать другое пороговое значение, используйте следующий код:<br /
    <?php
    highlight_string("<?php
\$orders = \$customer->getBigOrders(200)->all();
?>");
    ?>
</p>
<blockquote>
    <p>
        Примечание: Метод отношения возвращает экземпляр [[yii\db\ActiveQuery]]. Если вы запрашиваете отношение как атрибут (т.е. свойство класса), то возвращаемое значение будет результатом запроса об отношении, которое может быть экземпляром [[yii\db\ActiveRecord]], массив значений отношения, или null, в зависимости от кратности связи. Например, $customer->getOrders() возвращает экземпляр ActiveQuery, в то время как $customer->orders возвращает массив объектов Order (или пустой массив, если нет результатов запроса).
    </p>
</blockquote>
<h2>
    Отношения со сводной таблицой
</h2>
<hr />
<p>
    Иногда две таблицы связаны друг с другом через таблицу посредника под названием сводная таблица. Чтобы объявить такие отношения, мы можем настроить объект [[yii\db\ActiveQuery]], вызвав его метод [[yii\db\ActiveQuery::via()|via()]] или [[yii\db\ActiveQuery::viaTable()|viaTable()]].
</p>
<p>
    Например, если таблица tbl_order и таблица tbl_item связаны через сводную таблицы tbl_order_item, то мы можем объявить отношение items в классе Order вроде следующего:<br />
    <?php
    highlight_string("<?php
class Order extends \\yii\\db\\ActiveRecord
{
    public function getItems()
    {
        return \$this->hasMany(Item::className(), ['id' => 'item_id'])
            ->viaTable('tbl_order_item', ['order_id' => 'id']);
    }
}
?>");
    ?>
</p>
<p>
    [[yii\db\ActiveQuery::via()|via()]] метод похож на [[yii\db\ActiveQuery::viaTable()|viaTable()]] за исключением того, что первый параметр [[yii\db\ActiveQuery::via()|via()]] принимает имя отношения, объявленного в классе ActiveRecord вместо имени сводной таблицы. Например, перечисленное соотношение можно объявить следующим образом:<br />
    <?php
    highlight_string("<?php
class Order extends \\yii\\db\\ActiveRecord
{
    public function getOrderItems()
    {
        return \$this->hasMany(OrderItem::className(), ['order_id' => 'id']);
    }

    public function getItems()
    {
        return \$this->hasMany(Item::className(), ['id' => 'item_id'])
            ->via('orderItems');
    }
}
?>");
    ?>
</p>
<h2>
    Ленивая и жадная загрузка
</h2>
<hr />
<p>
    Как было описано ранее, когда вы получаете доступ к связанным объектам в первый раз, ActiveRecord выполнит DB запрос для получения соответствующих данных и заполнит его соответствующими объектами. Нет запрос не будет выполняться, если вы запросите те же связанные объекты снова. Мы называем это отложенной загрузки. Например,<br />
    <?php
    highlight_string("<?php
// SQL executed: SELECT * FROM tbl_customer WHERE id=1
\$customer = Customer::find(1);
// SQL executed: SELECT * FROM tbl_order WHERE customer_id=1
\$orders = \$customer->orders;
// no SQL executed
\$orders2 = \$customer->orders;
?>");
    ?>
</p>
<p>
    Отложенная загрузка очень удобна в использовании. Тем не менее могут быть проблемы с производительностью в следующей ситуации:<br />
    <?php
    highlight_string("<?php
// SQL executed: SELECT * FROM tbl_customer LIMIT 100
\$customers = Customer::find()->limit(100)->all();

foreach (\$customers as \$customer) {
    // SQL executed: SELECT * FROM tbl_order WHERE customer_id=...
    \$orders = \$customer->orders;
    // ...handle \$orders...
}
?>");
    ?>
</p>
<p>
    Сколько SQL запросов будет выполняться в коде выше, предполагается, что там более чем 100 клиентов в базе данных? 101! Первый SQL запрос возвращает 100 клиентов. Тогда для каждого клиента, SQL запрос выполнится, чтобы вернуть заказы этого клиента.
</p>
<p>
    Чтобы решить данную проблему производительности, можно использовать так называемую жадную загрузку с помощью метода [[yii\db\ActiveQuery::with()]]:<br />
    <?php
    highlight_string("<?php
// SQL executed: SELECT * FROM tbl_customer LIMIT 100;
//               SELECT * FROM tbl_orders WHERE customer_id IN (1,2,...)
\$customers = Customer::find()->limit(100)
    ->with('orders')->all();

foreach (\$customers as \$customer) {
    // no SQL executed
    \$orders = \$customer->orders;
    // ...handle \$orders...
}
?>");
    ?>
</p>
<p>
    Как вы можете видеть необходимо всего два SQL запроса для той же задачи!
</p>
<blockquote>
    <p>
        Информация: В общем, если вы жадно загружаете N отношений среди которых M отношений определяются с помощью via() или viaTable(), то общее число 1 + М + N SQL запросов будет выполняться: один запрос, чтобы вернуть строки для основной таблице, по одному для каждой из таблиц М сводных соответствующих вызовов via() или viaTable(), и один для каждого из N связанных таблиц.
    </p>
    <p>
        Примечание: Если вы настраиваете select() с жадной загрузкой, то не забудьте включить колонки, которые связывают соответствующие модели. В противном случае, соответствующие модели не будут загружены. Например,
    </p>
</blockquote>
<?php
highlight_string("<?php
\$orders = Order::find()->select(['id', 'amount'])->with('customer')->all();
// \$orders[0]->customer is always null. To fix the problem, you should do the following:
\$orders = Order::find()->select(['id', 'amount', 'customer_id'])->with('customer')->all();
?>");
?>
<p>
    Иногда, вы можете настроить реляционные запросы на лету. Это может быть сделано для отложенной загрузки и жадной загрузки. Например,<br />
    <?php
    highlight_string("<?php
\$customer = Customer::find(1);
// lazy loading: SELECT * FROM tbl_order WHERE customer_id=1 AND subtotal>100
\$orders = \$customer->getOrders()->where('subtotal>100')->all();

// eager loading: SELECT * FROM tbl_customer LIMIT 100
//                SELECT * FROM tbl_order WHERE customer_id IN (1,2,...) AND subtotal>100
\$customers = Customer::find()->limit(100)->with([
    'orders' => function(\$query) {
        \$query->andWhere('subtotal>100');
    },
])->all();
?>");
    ?>
</p>
<h2>
    Обратные отношения
</h2>
<hr />
<p>
    Отношения часто могут быть определены в парах. Например, клиент может иметь отношение с именем заказа, в то время как заказ может иметь отношение с именем клиента:<br />
    <?php
    highlight_string("<?php
class Customer extends ActiveRecord
{
    ....
    public function getOrders()
    {
        return \$this->hasMany(Order::className, ['customer_id' => 'id']);
    }
}

class Order extends ActiveRecord
{
    ....
    public function getCustomer()
    {
        return \$this->hasOne(Customer::className, ['id' => 'customer_id']);
    }
}
?>");
    ?>
</p>
<p>
    Если мы выполним следующий запрос, то мы обнаружим, что клиент заказа не тот же объект клиента, который находит эти заказы, и доступ к customer->orders будет вызывать одно выполнение SQL при доступе к клиенту о заказе будет вызван другой запрос SQL:<br />
    <?php
    highlight_string("<?php
// SELECT * FROM tbl_customer WHERE id=1
\$customer = Customer::find(1);
// echoes \"not equal\"
// SELECT * FROM tbl_order WHERE customer_id=1
// SELECT * FROM tbl_customer WHERE id=1
if (\$customer->orders[0]->customer === \$customer) {
    echo 'equal';
} else {
    echo 'not equal';
}
?>");
    ?>
</p>
<p>
    Чтобы избежать избыточного выполнения последнего оператора SQL, мы могли бы объявить обратные соотношения для клиента и отношения заказы, вызвав метод [[yii\db\ActiveQuery::inverseOf()|inverseOf()]] следующим образом:<br />
    <?php
    highlight_string("<?php
class Customer extends ActiveRecord
{
    ....
    public function getOrders()
    {
        return \$this->hasMany(Order::className, ['customer_id' => 'id'])->inverseOf('customer');
    }
}
?>");
    ?>
</p>
<p>
    Теперь, если мы выполняем тот же запрос, как показано выше, мы хотели бы получить:<br />
    <?php
    highlight_string("<?php
// SELECT * FROM tbl_customer WHERE id=1
\$customer = Customer::find(1);
// echoes \"equal\"
// SELECT * FROM tbl_order WHERE customer_id=1
if (\$customer->orders[0]->customer === \$customer) {
    echo 'equal';
} else {
    echo 'not equal';
}
?>");
    ?>
</p>
<p>
    Выше мы показали, как использовать обратные отношения в отложенной загрузке. Обратные отношения также применяются в жадной загрузке:<br />
    <?php
    highlight_string("<?php
// SELECT * FROM tbl_customer
// SELECT * FROM tbl_order WHERE customer_id IN (1, 2, ...)
\$customers = Customer::find()->with('orders')->all();
// echoes \"equal\"
if (\$customers[0]->orders[0]->customer === \$customers[0]) {
    echo 'equal';
} else {
    echo 'not equal';
}
?>");
    ?>
</p>
<blockquote>
    <p>
        Примечание: Обратная зависимость не может быть определена с соотношением, которое включает в себя поворотные таблицы. То есть, если ваше отношение определяется с помощью [[yii\db\ActiveQuery::via()|via()]] или [[yii\db\ActiveQuery::viaTable()|viaTable()]], вы не можете в дальнейшем вызвать метод [[yii\db\ActiveQuery::inverseOf()]].
    </p>
</blockquote>
<h2>
    Join со связями (отношениями)
</h2>
<hr />
<p>
    При работе с реляционными базами данных, общей задачей является объединение нескольких таблиц и применение различных условий запроса и параметров для JOIN запросов SQL. Вместо вызова [[yii\db\ActiveQuery::join()]] явно для создания JOIN запроса, можно повторно использовать существующие определения соотношения и вызвать метод [[yii\db\ActiveQuery::joinWith()]] для достижения этой цели. Например,<br />
    <?php
    highlight_string("<?php
// find all orders and sort the orders by the customer id and the order id. also eager loading \"customer\"
\$orders = Order::find()->joinWith('customer')->orderBy('tbl_customer.id, tbl_order.id')->all();
// find all orders that contain books, and eager loading \"books\"
\$orders = Order::find()->innerJoinWith('books')->all();
?>");
    ?>
</p>
<p>
    В коде выше, метод [[yii\db\ActiveQuery::innerJoinWith()|innerJoinWith()]] это ссылка на [[yii\db\ActiveQuery::joinWith()|joinWith()]] с типом соединения в качестве INNER JOIN.
</p>
<p>
    Вы можете соединиться с одним или несколькими отношениями; вы можете применить условиям к запросу отношения на лету, и вы также можете соединиться с суб-отношениями. Например,<br />
    <?php
    highlight_string("<?php
// join with multiple relations
// find out the orders that contain books and are placed by customers who registered within the past 24 hours
\$orders = Order::find()->innerJoinWith([
    'books',
    'customer' => function (\$query) {
        \$query->where('tbl_customer.created_at > ' . (time() - 24 * 3600));
    }
])->all();
// join with sub-relations: join with books and books' authors
\$orders = Order::find()->joinWith('books.author')->all();
?>");
    ?>
</p>
<p>
    За сценой, Yii сначала выполнит JOIN выражение SQL, чтобы вернуть первичные модели, удовлетворяющие условиям, примененным к JOIN SQL. Yii будет затем выполнять запрос для каждого отношения и заполнять соответствующие связанные записи.
</p>
<p>
    Разница между [[yii\db\ActiveQuery::joinWith()|joinWith()]] и [[yii\db\ActiveQuery::with()|with()]] в том, что предшествующий соединяет таблицы для первичного класса модели и соответствующие классы моделей для получения первичных моделей, в то время как второй только запросы к таблице для основного класса модели для получения первичных моделей.
</p>
<p>
    Из-за этих различий, вы можете передать условиям запроса, которые доступны только для объединения SQL выражений. Например, вы можете отфильтровать основные модели в силу условий на соответствующие моделей, как в примере выше. Вы также можете отсортировать первичные модели с помощью столбцов из связанных таблиц.
</p>
<p>
    При использовании [[yii\db\ActiveQuery::joinWith()|joinWith()]], Вы несете ответственность за устранение неоднозначности названия столбцов. В приведенных выше примерах, мы используем tbl_item.id и tbl_order.id для устранения неоднозначности ссылок таблиц идентификаторов, поскольку таблица заказов и таблица элементов содержат столбец с именем id.
</p>
<p>
    По умолчанию, когда вы соединитесь с соотношением, отношение будет также жадно загружено. Вы можете изменить это поведение, передав параметр $eagerLoading, который определяет надо ли жадно загружать указанные отношения.
</p>
<p>
    А также по умолчанию [[yii\db\ActiveQuery::joinWith()|joinWith()]] использует LEFT JOIN соединение для связанных таблиц. Вы можете указать тип соединения в параметре $joinType, чтобы установить тип соединения. Как ярлык для типа INNER JOIN, вы можете использовать [[yii\db\ActiveQuery::innerJoinWith()|innerJoinWith()]].
</p>
<p>
    Ниже приведены еще несколько примеров,<br />
    <?php
    highlight_string("<?php
// find all orders that contain books, but do not eager loading \"books\".
\$orders = Order::find()->innerJoinWith('books', false)->all();
// which is equivalent to the above
\$orders = Order::find()->joinWith('books', false, 'INNER JOIN')->all();
?>");
    ?>
</p>
<p>
    Иногда при объединении двух таблиц может потребоваться указать некоторые дополнительные условия в части ON запроса на соединение. Это может быть сделано путем вызова метода [[yii\db\ActiveQuery::onCondition()]] вроде следующего:<br />
    <?php
    highlight_string("<?php
class User extends ActiveRecord
{
    public function getBooks()
    {
        return \$this->hasMany(Item::className(), ['owner_id' => 'id'])->onCondition(['category_id' => 1]);
    }
}
?>");
    ?>
</p>
<p>
    В коде выше, метод [[yii\db\ActiveRecord::hasMany()|hasMany()]] возвращает  экземпляр [[yii\db\ActiveQuery]], который вызывать метод [[yii\db\ActiveQuery::onCondition()|onCondition()]] для указания того, что только элементы с category_id = 1 должны быть возвращены.
</p>
<p>
    При выполнении запроса с помощью [[yii\db\ActiveQuery::joinWith()|joinWith()]], on-condition будет положено в часть ON соответствующего JOIN запроса. Например,<br />
    <?php
    highlight_string("<?php
// SELECT tbl_user.* FROM tbl_user LEFT JOIN tbl_item ON tbl_item.owner_id=tbl_user.id AND category_id=1
// SELECT * FROM tbl_item WHERE owner_id IN (...) AND category_id=1
\$users = User::find()->joinWith('books')->all();
?>");
    ?>
</p>
<p>
    Обратите внимание, что если вы используете жадную загрузку с помощью метода [[yii\db\ActiveQuery::with()]] или отложенную загрузку, то on-condition будет введен в части WHERE соответствующего SQL выражения, потому что JOIN запрос не участвует . Например,<br />
    <?php
    highlight_string("<?php
// SELECT * FROM tbl_user WHERE id=10
\$user = User::find(10);
// SELECT * FROM tbl_item WHERE owner_id=10 AND category_id=1
\$books = \$user->books;
?>");
    ?>
</p>
<h2>
    Работа со связями
</h2>
<hr />
<p>
    ActiveRecord предоставляет следующие два метода для установления и разрыва отношений между двумя объектами ActiveRecord:
</p>
<ul>
    <li>[[yii\db\ActiveRecord::link()|link()]]</li>
    <li>[[yii\db\ActiveRecord::unlink()|unlink()]]</li>
</ul>
<p>
    Например, если клиент и новый заказ, то мы можем использовать следующий код, чтобы сделать заказ, принадлежащий клиенту:<br />
    <?php
    highlight_string("<?php
\$customer = Customer::find(1);
\$order = new Order();
\$order->subtotal = 100;
\$customer->link('orders', \$order);
?>");
    ?>
</p>
<p>
    [[yii\db\ActiveRecord::link()|link()]] вызываемый выше установит customer_id заказа, чтобы быть первичным ключом значения $customer, а затем вызвать [[yii\db\ActiveRecord::save()|save()]], чтобы сохранить заказ в базе данных.
</p>
<h2>
    Жизненный цикл в объекте ActiveRecord
</h2>
<hr />
<p>
    Объект ActiveRecord претерпевает различные жизненные циклы, когда он используется в различных случаях. Подклассы или поведения ActiveRecord могут "привнести" пользовательский код в эти жизненные циклы через переопределения методов и механизмов обработки событий.
</p>
<p>
    При создании экземпляра новый экземпляр ActiveRecord, мы будем иметь следующие жизненные циклы:
</p>
<ol>
    <li>constructor</li>
    <li>[[yii\db\ActiveRecord::init()|init()]]: вызовет [[yii\db\ActiveRecord::EVENT_INIT|EVENT_INIT]] событие</li>
</ol>
<p>
    При получении экземпляра ActiveRecord с помощью метода [[yii\db\ActiveRecord::find()|find()]], мы будем иметь следующие жизненные циклы:
</p>
<ol>
    <li>constructor</li>
    <li>[[yii\db\ActiveRecord::init()|init()]]: вызовет [[yii\db\ActiveRecord::EVENT_INIT|EVENT_INIT]] событие</li>
    <li>[[yii\db\ActiveRecord::afterFind()|afterFind()]]: вызовет [[yii\db\ActiveRecord::EVENT_AFTER_FIND|EVENT_AFTER_FIND]] событие</li>
</ol>
<p>
    При вызове [[yii\db\ActiveRecord::save()|save()]], чтобы вставить или обновить ActiveRecord, мы будем иметь следующие жизненные циклы:
</p>
<ol>
    <li>[[yii\db\ActiveRecord::beforeValidate()|beforeValidate()]]: вызовет [[yii\db\ActiveRecord::EVENT_BEFORE_VALIDATE|EVENT_BEFORE_VALIDATE]] событие</li>
    <li>[[yii\db\ActiveRecord::afterValidate()|afterValidate()]]: вызовет [[yii\db\ActiveRecord::EVENT_AFTER_VALIDATE|EVENT_AFTER_VALIDATE]] событие</li>
    <li>[[yii\db\ActiveRecord::beforeSave()|beforeSave()]]: вызовет [[yii\db\ActiveRecord::EVENT_BEFORE_INSERT|EVENT_BEFORE_INSERT]] или [[yii\db\ActiveRecord::EVENT_BEFORE_UPDATE|EVENT_BEFORE_UPDATE]] событие</li>
    <li>выполнение фактической вставки данных или обновления</li>
    <li>[[yii\db\ActiveRecord::afterSave()|afterSave()]]: вызовет [[yii\db\ActiveRecord::EVENT_AFTER_INSERT|EVENT_AFTER_INSERT]] или [[yii\db\ActiveRecord::EVENT_AFTER_UPDATE|EVENT_AFTER_UPDATE]] событие</li>
</ol>
<p>
    Наконец при вызове [[yii\db\ActiveRecord::delete()|delete()]], чтобы удалить ActiveRecord, мы будем иметь следующие жизненные циклы:
</p>
<ol>
    <li>[[yii\db\ActiveRecord::beforeDelete()|beforeDelete()]]: вызовет [[yii\db\ActiveRecord::EVENT_BEFORE_DELETE|EVENT_BEFORE_DELETE]] событие</li>
    <li>выполнение фактического удаления данных</li>
    <li>[[yii\db\ActiveRecord::afterDelete()|afterDelete()]]: вызовет [[yii\db\ActiveRecord::EVENT_AFTER_DELETE|EVENT_AFTER_DELETE]] событие</li>
</ol>
<h2>
    Области видимости (масштаб, предел, сфера)
</h2>
<hr />
<p>
    При вызове [[yii\db\ActiveRecord::find()|find()]] или [[yii\db\ActiveRecord::findBySql()|findBySql()]], возвращается экземпляр [[yii\db\ActiveQuery|ActiveQuery]]. Вы можете вызвать дополнительные методы запросов, такие как [[yii\db\ActiveQuery::where()|where()]], [[yii\db\ActiveQuery::orderBy()|orderBy()]], в целях дальнейшего уточнения условия запроса.
</p>
<p>
    Вполне возможно, что вы можете вызвать тот же набор методов запроса в разных местах. Если это так, то вы должны рассмотреть вопрос об определении так называемых scopes (областей). Scope является по существу метод, определенный в классе пользовательского запроса, который вызывает набор методов запроса, чтобы изменить объект запроса. Затем вы можете использовать scope как вызов обычного метода запроса.
</p>
<p>
    Два шага обязаны определить scope. При первом создании пользовательского класса запроса для вашей модели и определить необходимые методы scope в этом классе. Например, создать класс CommentQuery для модели Comment и определить active() scope метод вроде следующего:<br />
    <?php
    highlight_string("<?php
namespace app\\models;

use yii\\db\\ActiveQuery;

class CommentQuery extends ActiveQuery
{
    public function active(\$state = true)
    {
        \$this->andWhere(['active' => \$state]);
        return \$this;
    }
}
?>");
    ?>
</p>
<p>
    Важные моменты:
</p>
<ol>
    <li>Класс должен расширяться от yii\db\ActiveQuery (или другой ActiveQuery, например yii\mongodb\ActiveQuery).</li>
    <li>Метод должен быть public и должен вернуть $this для того, чтобы был возможен текучий интерфейс. Это может принимать параметры.</li>
    <li>Проверьте [[yii\db\ActiveQuery]] методы, которые очень полезны для изменения условий запроса.</li>
</ol>
<p>
    Во-вторых, переопределить [[yii\db\ActiveRecord::createQuery()]], чтобы использовать пользовательский класс запроса вместо обычного [[yii\db\ActiveQuery|ActiveQuery]]. Для приведенного выше примера, вам нужно написать следующий код:<br />
    <?php
    highlight_string("<?php
namespace app\\models;

use yii\\db\\ActiveRecord;

class Comment extends ActiveRecord
{
    public static function createQuery(\$config = [])
    {
        \$config['modelClass'] = get_called_class();
        return new CommentQuery(\$config);
    }
}
?>");
    ?>
</p>
<p>
    Вот и все. Теперь вы можете использовать свои собственные scope методы:<br />
    <?php
    highlight_string("<?php
\$comments = Comment::find()->active()->all();
\$inactiveComments = Comment::find()->active(false)->all();
?>");
    ?>
</p>
<p>
    Вы также можете использовать scopes при определении отношения. Например,<br />
    <?php
    highlight_string("<?php
class Post extends \\yii\\db\\ActiveRecord
{
    public function getActiveComments()
    {
        return \$this->hasMany(Comment::className(), ['post_id' => 'id'])->active();

    }
}
?>");
    ?>
</p>
<p>
    Или использовать scopes на лету, когда выполняется реляционный запрос:<br />
    <?php
    highlight_string("<?php
\$posts = Post::find()->with([
    'comments' => function(\$q) {
        \$q->active();
    }
])->all();
?>");
    ?>
</p>
<h3>
    Делаем это дружелюбным к IDE
</h3>
<p>
    Для того, чтобы самые современные IDE автозаполнения были рады вам, необходимо изменить возвращаемые данные для некоторых методов модели и запроса, следующим образом:<br />
    <?php
    highlight_string("<?php
/**
 * @method \\app\\models\\CommentQuery|static|null find(\$q = null) static
 * @method \\app\\models\\CommentQuery findBySql(\$sql, \$params = []) static
 */
class Comment extends ActiveRecord
{
    // ...
}
?>");
    ?>
</p>
<?php
highlight_string("<?php
/**
 * @method \\app\\models\\Comment|array|null one(\$db = null)
 * @method \\app\\models\\Comment[]|array all(\$db = null)
 */
class CommentQuery extends ActiveQuery
{
    // ...
}
?>");
?>
<h3>
    Scope по умолчанию
</h3>
<p>
    Если вы использовали Yii 1.1 раньше, то вы возможно, знаете концепцию под названием scope по умолчанию. Scope по умолчанию является scope, который применяется ко всем запросам. Вы можете определить scope по умолчанию легко путем переопределения [[yii\db\ActiveRecord::createQuery()]]. Например,<br />
    <?php
    highlight_string("<?php
public static function createQuery(\$config = [])
{
    \$config['modelClass'] = get_called_class();
    return (new ActiveQuery(\$config))->where(['deleted' => false]);
}
?>");
    ?>
</p>
<p>
    Обратите внимание, что все ваши запросы не должны затем использовать [[yii\db\ActiveQuery::where()|where()]], но можно использовать [[yii\db\ActiveQuery::andWhere()|andWhere()]] и [[yii\db\ActiveQuery::orWhere()|orWhere()]], чтобы не переопределить scope по умолчанию.
</p>
<h2>
    Транзакционные операции
</h2>
<hr />
<p>
    Когда несколько операций БД связаны и выполняются
</p>
<p>
    TODO: FIXME: WIP, TBD, <a href="https://github.com/yiisoft/yii2/issues/226" target="_blank">https://github.com/yiisoft/yii2/issues/226</a>
</p>
<p>
    , [[yii\db\ActiveRecord::afterSave()|afterSave()]], [[yii\db\ActiveRecord::beforeDelete()|beforeDelete()]] и/или [[yii\db\ActiveRecord::afterDelete()|afterDelete()]] жизненный цикл. Разработчик может прийти к решению переопределения ActiveRecord метода [[yii\db\ActiveRecord::save()|save()]] с базой данных обертывая транзакцией или даже с помощью транзакции в действии контроллера, который, строго говоря, кажется не похоже на хорошую практики (напомним, "тонкий-контроллер/толстая модель" - это фундаментальное правило).
</p>
<p>
    Вот эти пути (НЕ используйте их, если вы не уверены, что вы делаете на самом деле). Модели:<br />
    <?php
    highlight_string("<?php
class Feature extends \\yii\\db\\ActiveRecord
{
    // ...

    public function getProduct()
    {
        return \$this->hasOne(Product::className(), ['product_id' => 'id']);
    }
}

class Product extends \\yii\\db\\ActiveRecord
{
    // ...

    public function getFeatures()
    {
        return \$this->hasMany(Feature::className(), ['id' => 'product_id']);
    }
}
?>");
    ?>
</p>
<p>
    Переопределите метод [[yii\db\ActiveRecord::save()|save()]]:<br />
    <?php
    highlight_string("<?php
class ProductController extends \\yii\\web\\Controller
{
    public function actionCreate()
    {
        // FIXME: TODO: WIP, TBD
    }
}
?>");
    ?>
</p>
<p>
    Использование транзакций на уровне контроллера:<br />
    <?php
    highlight_string("<?php
class ProductController extends \\yii\\web\\Controller
{
    public function actionCreate()
    {
        // FIXME: TODO: WIP, TBD
    }
}
?>");
    ?>
</p>
<p>
    Вместо того чтобы использовать эти хрупкие методы, вы должны рассмотреть возможность использования атомарных сценариев и операций.<br />
    <?php
    highlight_string("<?php
class Feature extends \\yii\\db\\ActiveRecord
{
    // ...

    public function getProduct()
    {
        return \$this->hasOne(Product::className(), ['product_id' => 'id']);
    }

    public function scenarios()
    {
        return [
            'userCreates' => [
                'attributes' => ['name', 'value'],
                'atomic' => [self::OP_INSERT],
            ],
        ];
    }
}

class Product extends \\yii\\db\\ActiveRecord
{
    // ...

    public function getFeatures()
    {
        return \$this->hasMany(Feature::className(), ['id' => 'product_id']);
    }

    public function scenarios()
    {
        return [
            'userCreates' => [
                'attributes' => ['title', 'price'],
                'atomic' => [self::OP_INSERT],
            ],
        ];
    }

    public function afterValidate()
    {
        parent::afterValidate();
        // FIXME: TODO: WIP, TBD
    }

    public function afterSave(\$insert)
    {
        parent::afterSave(\$insert);
        if (\$this->getScenario() === 'userCreates') {
            // FIXME: TODO: WIP, TBD
        }
    }
}
?>");
    ?>
</p>
<p>
    Контроллер очень тонкий и аккуратный:<br />
    <?php
    highlight_string("<?php
class ProductController extends \\yii\\web\\Controller
{
    public function actionCreate()
    {
        // FIXME: TODO: WIP, TBD
    }
}
?>");
    ?>
</p>
<h2>
    Оптимистичные Замки
</h2>
<hr />
<p>
    TODO
</p>
<h2>
    Грязные Атрибуты
</h2>
<hr />
<p>
    TODO
</p>
<h2>
    Смотрите также
</h2>
<hr />
<ul>
    <li>Model</li>
    <li>[[yii\db\ActiveRecord]]</li>
</ul>