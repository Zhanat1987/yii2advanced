<h1>
    События
</h1>
<hr />
<p>
    Подлежит обсуждению, смотрите также
    <a href="https://github.com/yiisoft/yii2/blob/master/docs/api/base/Component.md" target="_blank">
        Component.md
    </a>
</p>
<p>
    [[Добавить Введение]]
</p>
<h2>
    Создание обработчиков событий
</h2>
<hr />
<p>
    В Yii 1, события были определены с помощью синтаксиса метода OnEventName, например OnBeforeSave. Это уже не используется в Yii 2, так обработка событий теперь присваивается, используя метод. Первый аргумент этого метода является именем события за которым надо наблюдать, а второй является методом обработки, вызываемым при наступлении этого события:<br />
    <?php
    highlight_string("<?php
\$component->on(\$eventName, \$handler);
?>");
    ?>
</p>
<p>
    [[Ссылка на список событий]]
</p>
<p>
    Обработчик должен быть валидным PHP callback'ом. Это может быть представлено в виде:
</p>
<ul>
    <li>Имя глобальной функции</li>
    <li>Массив, состоящий из названия модели и имени метода</li>
    <li>Массив, состоящий из объекта и имени метода</li>
    <li>Анонимная функция</li>
</ul>
<?php
highlight_string("<?php
// Global function:
\$component->on(\$eventName, 'functionName');

// Model and method names:
\$component->on(\$eventName, ['Modelname', 'functionName']);

// Object and method name:
\$component->on(\$eventName, [\$obj, 'functionName']);

// Anonymous function:
\$component->on(\$eventName, function(\$event) {
    // Use \$event.
});
?>");
?>
<p>
    Как показано в примере с анонимной функцией, функция обработки события должна быть определены так, чтобы она принимает один аргумент. Это будет объект класса [[\yii\base\Event]].
</p>
<h2>
    Удаление обработчиков событий
</h2>
<hr />
<p>
    Соответствующий off метод удаляет обработчика событий:<br />
    <?php
    highlight_string("<?php
// \$component->off(\$eventName);
?>");
    ?>
</p>
<p>
    Yii поддерживает возможность связать несколько обработчиков с одним и тем же событием. При использовании off как указано выше, все обработчики будут удалены. Чтобы удалить только определенный обработчик, его надо передать в качестве второго аргумента в off:<br />
    <?php
    highlight_string("<?php
// \$component->off(\$eventName, \$handler);
?>");
    ?>
</p>
<p>
    $handler должен быть указан в методе off таким же образом, как и в методе on, чтобы удалить его.
</p>
<h2>
    Параметры событий
</h2>
<hr />
<p>
    Вы можете сделать ваши обработчики событий легче для работы с ними и более мощными, передавая дополнительные значения в качестве параметров.<br />
    <?php
    highlight_string("<?php
\$component->on(\$eventName, \$handler, \$params);
?>");
    ?>
</p>
<p>
    Передаваемые параметры будут доступны в обработчик событий через $event->data, который будет массивом.
</p>
<p>
    [[Утверждение выше надо подтвердить]]
</p>
<h2>
    Глобальные события
</h2>
<hr />
<p>
    Благодаря изменению в Yii 2 о том, как создаются обработчики событий, теперь вы можете использовать "глобальные" события. Чтобы создать глобальное событие, просто присоедините обработчики к событию в экземпляра приложения:<br />
    <?php
    highlight_string("<?php
Yii::\$app->on(\$eventName, \$handler);
?>");
    ?>
</p>
<p>
    Вы можете использовать метод trigger, чтобы инициировать эти события вручную:<br />
    <?php
    highlight_string("<?php
// this will trigger the event and cause \$handler to be invoked:
Yii::\$app->trigger(\$eventName);
?>");
    ?>
</p>
<h2>
    Класс Events
</h2>
<hr />
<p>
    Вы также можете присоединить обработчики событий для всех экземпляров класса вместо отдельных экземпляров. Чтобы сделать это, используйте статический метод Event::on:<br />
    <?php
    highlight_string("<?php
Event::on(ActiveRecord::className(), ActiveRecord::EVENT_AFTER_INSERT, function (\$event) {
    Yii::trace(get_class(\$event->sender) . ' is inserted.');
});
?>");
    ?>
</p>
<p>
    Этот код определяет обработчик, который сработает для всех объектов Active Record в случае события EVENT_AFTER_INSERT.
</p>