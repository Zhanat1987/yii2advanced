<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var common\models\Category $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="category-form">

	<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'parent_id')->textInput() ?>

		<?= $form->field($model, 'materialized_path')->textInput(['maxlength' => 255]) ?>

		<?= $form->field($model, 'title')->textInput(['maxlength' => 100]) ?>

		<?= $form->field($model, 'description')->textInput(['maxlength' => 255]) ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>