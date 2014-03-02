<h1>
    Поведения
</h1>
<hr />
<p>
    Поведение (также известная как mixin (класс участвующий во множественном наследовании, обогощает производный класс некоторыми дополнительными свойствами)) может быть использовано для повышения функциональности существующего компонента, не изменяя код компонента. В частности, поведение может "придать" свои публичные методы и свойства в компонент, что делает их напрямую доступными через самого компонента.Поведение может также реагировать на события, вызванные в компоненте, тем самым перехватывая нормальное выполнение кода. В отличие от трейтов РНР, поведение может быть присоединено к классам во время выполнения.
</p>
<h2>
    Использование поведений
</h2>
<hr />
<p>
    Поведение может быть применено к любому классу, который наследуется от [[yii\base\Component]]. Для того, чтобы присоединить поведение к классу, класс компонент должен реализовать метод поведения (behaviors()). В качестве примера, Yii предоставляет [[yii\behaviors\TimestampBehavior]] поведение для автоматического обновления поля временных меток при сохранении [[yii\db\ActiveRecord|Active Record]] модели:<br />
    <?php
    highlight_string("<?php
use yii\behaviors\TimestampBehavior;

class User extends ActiveRecord
{
    // ...

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
                ],
            ],
        ];
    }
}
?>");
    ?>
</p>
<p>
    В приведенном выше коде, ключ 'timestamp' может быть использован для ссылки на поведение через компонент. Например, $user->timestamp дает прилагаемый экземпляр поведения 'timestamp'. Соответствующий массив конфигурация используется для создания объекта [[yii\behaviors\TimestampBehavior|TimestampBehavior]].
</p>
<p>
    Кроме реакции на события insert и update в ActiveRecord, TimestampBehavior также обеспечивает метод touch(), который может назначить текущую метку времени к указанному атрибуту. Как упомянуто выше, вы можете получить доступ к этому метод напрямую через компонент:<br />
    <?php
    highlight_string("<?php
\$user->touch('login_time');
?>");
    ?>
</p>
<p>
    Если вам не нужен доступ к поведению через объект, или поведение не надо настраивать, то можно использовать упрощенный формат при указании поведения:<br />
    <?php
    highlight_string("<?php
use yii\behaviors\TimestampBehavior;

class User extends ActiveRecord
{
    // ...

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            // or the following if you want to access the behavior object
            // 'timestamp' => TimestampBehavior::className(),
        ];
    }
}
?>");
    ?>
</p>
<h2>
    Создание собственных поведений
</h2>
<hr />
<p>
    Для создания собственного поведения, необходимо определить класс, наследующийся от [[yii\base\Behavior]]:<br />
    <?php
    highlight_string("<?php
namespace app\\components;

use yii\\base\\Behavior;

class MyBehavior extends Behavior
{
}
?>");
    ?>
</p>
<p>
    Чтобы сделать его настраиваемым, как [[yii\behaviors\TimestampBehavior]], надо добавить public свойства:<br />
    <?php
    highlight_string("<?php
namespace app\\components;

use yii\\base\\Behavior;

class MyBehavior extends Behavior
{
    public \$attr;
}
?>");
    ?>
</p>
<p>
    Теперь, когда используется поведение, вы можете установить атрибут, к которому должно применяться поведение:<br />
    <?php
    highlight_string("<?php
namespace app\\models;

use yii\\db\\ActiveRecord;

class User extends ActiveRecord
{
    // ...

    public function behaviors()
    {
        return [
            'mybehavior' => [
                'class' => 'app\\components\\MyBehavior',
                'attr' => 'member_type'
            ],
        ];
    }
}
?>");
    ?>
</p>
<p>
    Поведения обычно пишутся, чтобы принять меры при возникновении определенных событий. Пример назначения обрабочика события на определенное событие:<br />
    <?php
    highlight_string("<?php
namespace app\\components;

use yii\\base\\Behavior;
use yii\\db\\ActiveRecord;

class MyBehavior extends Behavior
{
    public \$attr;

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeInsert',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeUpdate',
        ];
    }

    public function beforeInsert() {
        \$model = \$this->owner;
        // Use \$model->\$attr
    }

    public function beforeUpdate() {
        \$model = \$this->owner;
        // Use \$model->\$attr
    }
}
?>");
    ?>
</p>