<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/**
 * @var yii\web\View $this
 * @var common\models\Category $model
 * @var yii\widgets\ActiveForm $form
 */
?>
<?php if (Yii::$app->session->hasFlash('error')) : ?>
    <div class="alert alert-danger">
        <?php echo Yii::$app->session->getFlash('error'); ?>
    </div>
<?php endif; ?>
<div class="category-form">
	<?php $form = ActiveForm::begin(); ?>
        <?php echo $form->field($model, 'parent_id')->dropDownList(
            $model->getAllForDropdownList($model->id)) ?>
        <?php echo $form->field($model, 'materialized_path')->textInput(['maxlength' => 255,
            'disabled' => 'disabled']) ?>
		<?php echo $form->field($model, 'title')->textInput(['maxlength' => 100]) ?>
        <?php
        echo $form->field($model, 'description')->widget(CKEditor::className(), [
                'options' => ['rows' => 6],
                'preset' => 'full' // basic, full, standard
            ]);
        ?>
		<div class="form-group">
			<?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update',
                ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>
	<?php ActiveForm::end(); ?>
</div>