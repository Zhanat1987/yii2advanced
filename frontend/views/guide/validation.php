<h1>
    Модель валидации ссылка
</h1>
<hr />
<p>
    Этот раздел руководства не описывает как работает валидация, но вместо этого описывает все валидаторы Yii и их параметры. Для того, чтобы узнать о валидации в модели, смотрите раздел модели, подраздел валидация
</p>
<h2>
    Стандартные Yii валидаторы
</h2>
<hr />
<p>
    Стандартные Yii валидаторы могут быть указаны с использованием псевдонимов вместо ссылки на имена классов. Вот список всех валидаторов в комплекте с Yii с их наиболее полезными свойствами:
</p>
<h3>
    <code>boolean</code>: [[yii\validators\BooleanValidator|BooleanValidator]]
</h3>
<p>
    Проверяет значение атрибута на соответствие логическому значению.
</p>
<ul>
    <li><code>trueValue</code> - значение, представляющее true статус. (1)</li>
    <li><code>falseValue</code> - значение, представляющее false статус. (0)</li>
    <li><code>strict</code> - строгое сравнение вместе с типом trueValue/falseValue. (false)</li>
</ul>
<h3>
    <code>captcha</code>: [[yii\captcha\CaptchaValidator|CaptchaValidator]]
</h3>
<p>
    Проверяет, что значение атрибута совпадает с проверочным кодом, отображаемым в CAPTCHA. Следует использовать вместе с [[yii\captcha\CaptchaAction]].
</p>
<ul>
    <li><code>caseSensitive</code> - если true, то сравнение чувствительно к регистру, иначе false - не чувствительно к регистру.(false)</li>
    <li><code>captchaAction</code> - маршрут действия контроллера, который производит рендеринг CAPTCHA на картинке. ('site/captcha')</li>
</ul>
<h3>
    <code>compare</code>: [[yii\validators\CompareValidator|CompareValidator]]
</h3>
<p>
    Сравнивает указанное значение атрибута с другим значением и проверяет их на равенство между собой.
</p>
<ul>
    <li><code>compareAttribute</code> - имя атрибута с которым будет сравниваться значение текущего атрибута. (currentAttribute_repeat)</li>
    <li><code>compareValue</code> - постоянное значение с которым будет сравниваться значение текущего атрибута.</li>
    <li><code>operator</code> - оператор для сравнения. ('==')</li>
</ul>
<h3>
    <code>date</code>: [[yii\validators\DateValidator|DateValidator]]
</h3>
<p>
    Проверяет, если атрибут представляет собой дату, время или дату и время в нужном формате.
</p>
<ul>
    <li><code>format</code> - формат даты, которому значение проверяемого атрибута должно следовать в соответствии с <a href="http://www.php.net/manual/ru/datetime.createfromformat.php" target="_blank">PHP date_create_from_format</a>. ('Y-m-d')</li>
    <li><code>timestampAttribute</code> - имя атрибута для получения результата разбора.</li>
</ul>
<h3>
    <code>default</code>: [[yii\validators\DefaultValueValidator|DefaultValueValidator]]
</h3>
<p>
    Устанавливает для атрибута указанное значение по умолчанию.
</p>
<ul>
    <li><code>value</code> - значение по умолчанию, которое должно быть установлено для указанных атрибутов.</li>
</ul>
<h3>
    <code>double</code>: [[yii\validators\NumberValidator|NumberValidator]]
</h3>
<p>
    Проверяет, что значение атрибута является числом.
</p>
<ul>
    <li><code>max</code> - верхний предел числа. (null)</li>
    <li><code>min</code> - нижний предел числа. (null)</li>
</ul>
<h3>
    <code>email</code>: [[yii\validators\EmailValidator|EmailValidator]]
</h3>
<p>
    Проверяет, что значение атрибута является правильным адресом электронной почты.
</p>
<ul>
    <li><code>allowName</code> - следует ли разрешить имя в адрес электронной почты (например, John Smith <john.smith@example.com>). (false).</li>
    <li><code>checkMX</code> - проверить ли запись MX для электронной почты. (false)</li>
    <li><code>checkPort</code> - проверять ли порт 25 для электронной почты. (false)</li>
    <li><code>enableIDN</code> - проверка должен ли процесс учитывать IDN (internationalized domain names). (false)</li>
</ul>
<h3>
    <code>exist</code>: [[yii\validators\ExistValidator|ExistValidator]]
</h3>
<p>
    Проверяет, что значение атрибута существует в таблице.
</p>
<ul>
    <li><code>targetClass</code> - имя класса ActiveRecord или псевдоним класса, который должен использоваться для поиска значения
        проверяемого атрибута. (ActiveRecord класс проверяемого атрибута)</li>
    <li><code>targetAttribute</code> - ActiveRecord имя атрибута, которое следует использовать для поиска значения проверяемого атрибута. (название проверяемого атрибута)</li>
</ul>
<h3>
    <code>file</code>: [[yii\validators\FileValidator|FileValidator]]
</h3>
<p>
    Проверяет, если атрибут получает валидный загружаемый файл.
</p>
<ul>
    <li><code>types</code> - список расширений файлов, которые разрешены для загрузки. (любое)</li>
    <li><code>minSize</code> - минимальное количество байтов, необходимых для загружаемого файла.</li>
    <li><code>maxSize</code> - максимальное количество байтов, необходимое для загружаемого файла.</li>
    <li><code>maxFiles</code> - максимальное количество файлов, которое может загружаться и сохраняться в указанный атрибут (мультизагрузка). (1)</li>
</ul>
<h3>
    <code>filter</code>: [[yii\validators\FilterValidator|FilterValidator]]
</h3>
<p>
    Преобразование значение атрибута в соответствии с фильтром.
</p>
<ul>
    <li><code>filter</code> - PHP callback, который определяет фильтр.</li>
</ul>
<p>
    Как правило callback является полным именем функции PHP:<br />
    <?php
    highlight_string("<?php
['password', 'filter', 'filter' => 'trim'],
?>");
    ?>
</p>
<p>
    Или анонимная функция:<br />
    <?php
    highlight_string("<?php
['text', 'filter', 'filter' => function (\$value) {
    // here we are removing all swear words from text
    return \$newValue;
}],
?>");
    ?>
</p>
<h3>
    <code>in</code>: [[yii\validators\RangeValidator|RangeValidator]]
</h3>
<p>
    Проверяет, что значение атрибута является одним из значений списка.
</p>
<ul>
    <li><code>range</code> - список допустимых значений для значения атрибута.</li>
    <li><code>strict</code> - строгое сравнение вместе с типом. (false)</li>
    <li><code>not</code> - инвертировать логику проверки. (false)</li>
</ul>
<h3>
    <code>inline</code>: [[yii\validators\InlineValidator|InlineValidator]]
</h3>
<p>
    Использует пользовательскую функцию для проверки атрибута. Вам нужно определить public метод в своем классе модели, который позволит оценить валидность атрибута. Например, если атрибут должен  делиться на 10. В правилах вы определили бы:<br />
    <?php
    highlight_string("<?php
['attributeName', 'myValidationMethod'],
?>");
    ?>
</p>
<p>
    Затем ваш собственный метод может выглядеть следующим образом:<br />
    <?php
    highlight_string("<?php
public function myValidationMethod(\$attribute) {
    if ((\$this->\$attribute % 10) != 0) {
         \$this->addError(\$attribute, 'cannot divide value by 10');
    }
}
?>");
    ?>
</p>
<h3>
    <code>integer</code>: [[yii\validators\NumberValidator|NumberValidator]]
</h3>
<p>
    Проверяет, что значение атрибута является целым числом.
</p>
<ul>
    <li><code>max</code> - верхний предел целого числа. (null)</li>
    <li><code>min</code> - нижний предел целого числа. (null)</li>
</ul>
<h3>
    <code>match</code>: [[yii\validators\RegularExpressionValidator|RegularExpressionValidator]]
</h3>
<p>
    Проверяет, что значение атрибута соответствует заданному шаблону определенному регулярным выражением.
</p>
<ul>
    <li><code>pattern</code> - регулярное выражение, с которым будет производиться сравнение значения атрибута.</li>
    <li><code>not</code> - инвертировать ли логику проверки. (false)</li>
</ul>
<h3>
    <code>number</code>: [[yii\validators\NumberValidator|NumberValidator]]
</h3>
<p>
    Проверяет, что значение атрибута является числом.
</p>
<ul>
    <li><code>max</code> - верхний предел числа. (null)</li>
    <li><code>min</code> - нижний предел числа. (null)</li>
</ul>
<h3>
    <code>required</code>: [[yii\validators\RequiredValidator|RequiredValidator]]
</h3>
<p>
    Проверяет, что указанный атрибут не имеет нулевое или пустое значение.
</p>
<ul>
    <li><code>requiredValue</code> - значение, которому атрибут должен соответствовать. (any)</li>
    <li><code>strict</code> - строгое сравнение между значением атрибута и [[yii\validators\RequiredValidator::requiredValue|requiredValue]]. (false)</li>
</ul>
<h3>
    <code>safe</code>: [[yii\validators\SafeValidator|SafeValidator]]
</h3>
<p>
    Служит в качестве манекена валидатора, основной целью которого является отметить атрибуты, которые должны быть безопасными для массивного назначения.
</p>
<h3>
    <code>string</code>: [[yii\validators\StringValidator|StringValidator]]
</h3>
<p>
    Проверяет, что значение атрибута является строкой определенной длины.
</p>
<ul>
    <li><code>length</code> - определяет лимит для длины значения, которое должно проверяться. Может быть - равен X, [min X], [min X, max Y].</li>
    <li><code>max</code> - Максимальная длина. Если не установлено значение, то это означает, что нет максимального предела.</li>
    <li><code>min</code> - Минимальная длина. Если не установлено значение, то это означает, что нет минимального предела.</li>
    <li><code>encoding</code> - кодировка значения строки, которая будет использоваться при валидации. ([[yii\base\Application::charset]])</li>
</ul>
<h3>
    <code>unique</code>: [[yii\validators\UniqueValidator|UniqueValidator]]
</h3>
<p>
    Проверяет, что значение атрибута является уникальным в соответствующей таблице базы данных.
</p>
<ul>
    <li><code>targetClass</code> - имя класса ActiveRecord или псевдоним класса, который должен использоваться для поиска значения проверяемого атрибута. (ActiveRecord класс проверяемого атрибута)</li>
    <li><code>targetAttribute</code> - ActiveRecord имя атрибута, которое следует использовать для поиска значения проверяемого атрибута. (название проверяемого атрибута)</li>
</ul>
<h3>
    <code>url</code>: [[yii\validators\UrlValidator|UrlValidator]]
</h3>
<p>
    Проверяет, что значение атрибута является допустимым http или https URL
</p>
<ul>
    <li><code>validSchemes</code> - схема URI по умолчанию. Если входные данные не содержат часть схемы, то схема по умолчанию будет добавлена к нему. (null)</li>
    <li><code>defaultScheme</code> - список URI схем, которые должны рассматриваться при валидации. ['http', 'https']</li>
    <li><code>enableIDN</code> - проверка должен ли процесс учитывать IDN (internationalized domain names). (false)</li>
</ul>
<h2>
    Валидация значений не из контекста модели
</h2>
<hr />
<p>
    Иногда нужно проверить значение, не связанное с какой-либо моделью, например электронная почта. В классе Yii Validator имеется метод validateValue, который может помочь вам в этом. Не во всех классах валидаторов это реализовано, но в тех, которые могут работать без модели реализовано. В нашем случае для проверки почты мы можем сделать следующее:<br />
    <?php
    highlight_string("<?php
\$email = 'test@example.com';
\$validator = new yii\\validators\\EmailValidator();
if (\$validator->validate(\$email, \$error)) {
    echo 'Email is valid.';
} else {
    echo \$error;
}
?>");
    ?>
</p>
<p>
    Подлежит обсуждению: смотрите <a href="http://www.yiiframework.com/wiki/56/" target="_blank">http://www.yiiframework.com/wiki/56/</a> для формата
</p>