<?php
/**
 * Created by PhpStorm.
 * User: zhanat
 * Date: 29.03.14
 * Time: 12:19
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use zhuravljov\widgets\DateTimePicker;
use zhuravljov\widgets\DatePicker;
use dosamigos\ckeditor\CKEditor;
use backend\assets\ArticleAsset;
use kartik\widgets\TimePicker;
use kartik\widgets\SwitchInput;
use kartik\widgets\Select2;
use kartik\widgets\FileInput;
ArticleAsset::register($this);
\common\myhelpers\Debugger::debug($model->getErrors('birthDate'));
//\common\myhelpers\Debugger::debug($model->getErrors());
?>
<?php
$form = ActiveForm::begin([
    'id' => 'FM-form',
    'options' => [
        'class' => 'form-horizontal',
        'enctype'=>'multipart/form-data',
    ],
]);
?>
<!--    --><?php //echo $form->field($model, 'text')->hint('Укажите имя'); ?>
<!--    --><?php //echo $form->field($model, 'password')->passwordInput(); ?>
<!--    --><?php //echo $form->field($model, 'repeatPassword')->passwordInput(); ?>
<!--    --><?php //echo $form->field($model, 'compareValue')->hint('compareValue == test'); ?>
<!--    --><?php //echo $form->field($model, 'email')->textInput(['placeholder' => 'email']); ?>
<!--    --><?php //echo $form->field($model, 'textarea')->textarea(['rows' => 10]); ?>
<!--    --><?php
//    echo $form->field($model, 'editor')->widget(CKEditor::className(), [
//        'options' => ['rows' => 6],
//        'preset' => 'full' // basic, full, standard
//    ]);
//    ?>
    <?php
    // https://github.com/zhuravljov/yii2-datetime-widgets
//    echo $form->field($model, 'date')->widget(DatePicker::className(), [
//        'options' => ['class' => 'form-control'],
//        'clientOptions' => [
//            'format' => 'yyyy-mm-dd',
//            'language' => 'ru',
//            'autoclose' => true,
//            'todayHighlight' => true,
//        ],
//    ]);
//    echo $form->field($model, 'datetime')->widget(DateTimePicker::className(), [
//        'options' => ['class' => 'form-control'],
//        'clientOptions' => [
//            'format' => 'yyyy-mm-dd hh:ii:ss',
//            'language' => 'ru',
//            'autoclose' => true,
//        ],
//    ]);
    ?>
    <?php
    // https://github.com/kartik-v/yii2-widgets
    // http://demos.krajee.com/widget-details/timepicker
//    echo $form->field($model, 'time')->widget(TimePicker::classname(), ['pluginOptions' => [
//        'showSeconds' => true
//    ]]);
    ?>
<!--    --><?php //echo $form->field($model, 'integer'); ?>
<!--    --><?php //echo $form->field($model, 'integerRange'); ?>
<?php
//echo $form->field($model, 'boolean')->widget(SwitchInput::classname(), []);
//echo $form->field($model, 'booleanStrict')->widget(SwitchInput::classname(), []);
?>
<!--    --><?php //echo $form->field($model, 'radio')->radioList($model->getList(3)); ?>
<!--    --><?php //echo $form->field($model, 'checkbox')->checkboxList($model->getList(3)); ?>
<!--    --><?php //echo $form->field($model,
//    'notIn')->radioList($model->getList(4))->hint('Только 4-й вариант правильный!!!'); ?>
<!--    --><?php //echo $form->field($model, 'select')->dropDownList($model->getList()); ?>
<!--    --><?php //echo $form->field($model, 'multiSelect')->listBox($model->getList(20),
//    ['multiple' => true, 'size' => 10]); ?>
<?php
//echo $form->field($model, 'select2')->widget(Select2::classname(), [
//    'data' => array_merge(["" => ""], $model->getList()),
//    'options' => ['placeholder' => 'Select a state ...'],
//    'pluginOptions' => [
//        'allowClear' => true
//    ],
//]);
//echo $form->field($model, 'multiSelect2')->widget(Select2::classname(), [
//    'data' => array_merge(["" => ""], $model->getList(20)),
//    'options' => [
//        'placeholder' => 'Select a state ...',
//        'multiple' => true,
//    ],
//    'pluginOptions' => [
//        'allowClear' => true
//    ],
//]);
?>
<?php
// http://demos.krajee.com/widget-details/fileinput
//echo $form->field($model, 'file')->widget(FileInput::classname(), [
//
//]);
//echo $form->field($model, 'image')->widget(FileInput::classname(), [
//    'options' => ['accept' => 'image/*'],
//]);
?>
    <?php echo $form->field($model, 'birthDate'); ?>
    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?php echo Html::submitButton('Отправить', ['class' => 'btn btn-primary']); ?>
            <?php echo Html::resetButton('Сбросить', ['class' => 'btn btn-info']); ?>
        </div>
    </div>
<?php ActiveForm::end() ?>