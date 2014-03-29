<h1>
    Работа с формами
</h1>
<hr />
<p>
    Основной способ использования формы в Yii с помощью [[yii\widgets\ActiveForm]]. Этот подход должен быть предпочтительным, когда форма основана на модели. Кроме того, есть некоторые полезные методы в [[yii\helpers\Html]], которые как правило используется для добавления кнопок и текст справки к любой форме.
</p>
<p>
    При создании формы на основе модели, первый шаг заключается в определении самой модели. Модель может быть либо на основе Active Record класса, или более общего класса Model. Для этого примера входа в систему, будет использоваться общая модель:<br />
    <?php
    highlight_string("<?php
use yii\\base\\Model;

class LoginForm extends Model
{
    public \$username;
    public \$password;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     */
    public function validatePassword()
    {
        \$user = User::findByUsername(\$this->username);
        if (!\$user || !\$user->validatePassword(\$this->password)) {
            \$this->addError('password', 'Incorrect username or password.');
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if (\$this->validate()) {
            \$user = User::findByUsername(\$this->username);
            return true;
        } else {
            return false;
        }
    }
}
?>");
    ?>
</p>
<p>
    Контроллер будет передать экземпляр этой модели к представлению, в котором используется виджет Active Form:<br />
    <?php
    highlight_string("<?php
use yii\\helpers\\Html;
use yii\\widgets\\ActiveForm;

<?php \$form = ActiveForm::begin([
    'id' => 'login-form',
    'options' => ['class' => 'form-horizontal'],
]) ?>
    <?= \$form->field(\$model, 'username') ?>
    <?= \$form->field(\$model, 'password')->passwordInput() ?>

    <div class=\"form-group\">
        <div class=\"col-lg-offset-1 col-lg-11\">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>
?>");
    ?>
</p>
<p>
    В приведенном выше коде, [[yii\widgets\ActiveForm::begin()|ActiveForm::begin()]] не только создает экземпляр формы, но и знаменует собой начало формы. Все содержание, помещенное между [[yii\widgets\ActiveForm::begin()|ActiveForm::begin()]] и [[yii\widgets\ActiveForm::end()|ActiveForm::end()]] будет обернуты в тег <?php highlight_string("<?php <form> ?>"); ?>. Как и в любом виджете, вы можете указать несколько вариантов того, как виджет должен быть настроен, передав массив в метод begin. В этом случае дополнительный css класс и параметр id передаются для использования в открывающемся теге <form>.
</p>
<p>
    Для того чтобы создать элемент формы в форме вместе с label элемента и валидацией на JavaScript, надо вызвать метод [[yii\widgets\ActiveForm::field()|ActiveForm::field()]] объекта Active Form виджет. Когда вызов этого метода выводит содержимое, то результатом является регулярный (текст) вход. Чтобы настроить вывод, вы можете по цепи вызывать дополнительные методы:<br />
    <?php
    highlight_string("<?php
<?= \$form->field(\$model, 'password')->passwordInput() ?>
// or
<?= \$form->field(\$model, 'username')->textInput()->hint('Please enter your name')->label('Name') ?>
?>");
    ?>
</p>
<p>
    Это создаст все <?php highlight_string("<?php <label>, <input> ?>"); ?> и другие теги в соответствии с шаблоном, определяемым в поле формы. Чтобы добавить эти теги самому, вы можете использовать вспомогательный класс HTML. Следующий код эквивалентен коду выше:<br />
    <?php
    highlight_string("<?php
<?= Html::activeLabel(\$model, 'password') ?>
<?= Html::activePasswordInput(\$model, 'password') ?>
<?= Html::error(\$model, 'password') ?>
// or
<?= Html::activeLabel(\$model, 'username', ['label' => 'name']) ?>
<?= Html::activeTextInput(\$model, 'username') ?>
<div class=\"hint-block\">Please enter your name</div>
<?= Html::error(\$model, 'username') ?>
?>");
    ?>
</p>
<p>
    Если вы хотите использовать одно из HTML5 полей, то можно указать тип input'а непосредственно так:<br />
    <?php
    highlight_string("<?php
<?= \$form->field(\$model, 'email')->input('email') ?>
?>");
    ?>
</p>
<blockquote>
    <p>
        Совет: для изменения стиля необходимых полей со звездочкой, можно использовать
        следующий CSS:
    </p>
    <?php
    highlight_string("<?php
div.required label:after {
    content: \" *\";
    color: red;
}
?>");
    ?>
</blockquote>
<h2>
    Обработка нескольких моделей в одной форме
</h2>
<hr />
<p>
    Иногда вам нужно работать с несколькими моделями одного и того же вида в одной форме. Например, различные настройки, где каждая настройка хранится как имя-значение и представлена в модели Setting. Ниже показано, как реализовать его в Yii.
</p>
<p>
    Начнем с действия контроллера:<br />
    <?php
    highlight_string("<?php
namespace app\\controllers;

use Yii;
use yii\\base\\Model;
use yii\\web\\Controller;
use app\\models\\Setting;

class SettingsController extends Controller
{
    // ...

    public function actionUpdate()
    {
        \$settings = Setting::find()->indexBy('id')->all();

        if (Model::loadMultiple(\$settings, Yii::\$app->request->post()) && Model::validateMultiple(\$settings)) {
            foreach (\$settings as \$setting) {
                \$setting->save(false);
            }

            return \$this->redirect('index');
        }

        return \$this->render('update', ['settings' => \$settings]);
    }
}
?>");
    ?>
</p>
<p>
    В коде выше мы используем метод indexBy при извлечении моделей из базы данных, чтобы сделать массив, проиндексированный по id модели. Они будут позже использованы для идентификации поля формы. loadMultiple заполняет несколько моделей с данными формы исходя из POST и validateMultiple проверяет все модели сразу. Для того, чтобы пропустить проверку при сохранении мы передаем false в качестве параметра для сохранения.
</p>
<p>
    Теперь форма в виде обновления:<br />
    <?php
    highlight_string("<?php
<?php
use yii\\helpers\\Html;
use yii\\widgets\\ActiveForm;

\$form = ActiveForm::begin();

foreach (\$settings as \$index => \$setting) {
    echo Html::encode(\$setting->name) . ': ' . \$form->field(\$setting, \"[\$index]value\");
}

ActiveForm::end();
?>");
    ?>
</p>
<p>
    Здесь для каждого параметра мы указываем имя и input со значением. Важно добавить надлежащий индекс для имени input'а, так как это определяет loadMultiple, какую модель какими значениями заполнить.
</p>