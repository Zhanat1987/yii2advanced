<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use zhuravljov\widgets\DateTimePicker;
use dosamigos\ckeditor\CKEditor;
use backend\assets\ArticleAsset;

/**
 * @var yii\web\View $this
 * @var common\models\Article $model
 * @var yii\widgets\ActiveForm $form
 */
ArticleAsset::register($this);
//\common\myhelpers\Debugger::debug($model->scenario);
?>
<?php if ($errors) : ?>
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php foreach ($errors as $error) : ?>
            <?php foreach ($error as $err) : ?>
                <p>
                    <b>
                        <?php echo $err; ?>
                    </b>
                </p>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<div class="article-form">
	<?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>
        <?php echo $form->field($model, 'cat_id')->dropDownList(
            (new \backend\models\Category)->getAllForDropdownList()) ?>
		<?php echo $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>
        <?php
        echo $form->field($model, 'text')->widget(CKEditor::className(), [
            'options' => ['rows' => 6],
            'preset' => 'full' // basic, full, standard
        ]);
        ?>
        <?php echo $form->field($model, 'author')->dropDownList($model->getAuthor()); ?>
        <?php
        // https://github.com/zhuravljov/yii2-datetime-widgets
        echo $form->field($model, 'created_at')->widget(DateTimePicker::className(), [
            'options' => ['class' => 'form-control'],
            'clientOptions' => [
                'format' => 'yyyy.mm.dd hh:ii:ss',
                'language' => 'ru',
                'autoclose' => true
            ],
        ]);
        ?>
		<?php
        // http://stuff.cebe.cc/yii2docs/yii-widgets-activefield.html#radioList%28%29-detail
        echo $form->field($model, 'status')->radioList($model::$status);
        ?>
		<?php echo $form->field($model, 'views')->textInput(['disabled' => 'disabled']) ?>
		<?php echo $form->field($model, 'updated_at')->textInput(['disabled' => 'disabled']) ?>
		<?php echo $form->field($model, 'img')->fileInput() ?>
        <?php echo $form->field($model, 'birthDate')->textInput() ?>
		<div class="form-group">
			<?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', [
                'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>
	<?php ActiveForm::end(); ?>
</div>