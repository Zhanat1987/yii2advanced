<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var common\models\Category $model
 * @var yii\widgets\ActiveForm $form
 */
\common\myhelpers\Debugger::debug($model->getErrors());
?>

<div class="category-form">

	<?php $form = ActiveForm::begin(); ?>

        <?php //echo $form->field($model, 'parent_id')->textInput() ?>
        <?php echo $form->field($model, 'parent_id')->dropDownList($model->getAllForDropdownList($model->id)) ?>

		<?php echo $form->field($model, 'materialized_path')->textInput(['maxlength' => 255,
            'disabled' => 'disabled']) ?>

		<?php echo $form->field($model, 'title')->textInput(['maxlength' => 100]) ?>

        <?php //echo $form->field($model, 'description')->textInput(['maxlength' => 255]) ?>
        <?php echo $form->field($model, 'description')->textarea(['maxlength' => 255]) ?>

		<div class="form-group">
			<?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update',
                ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
