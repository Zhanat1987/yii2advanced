<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var common\models\ArticleTag $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="article-tag-form">

	<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'article_id')->textInput() ?>

		<?= $form->field($model, 'tag_id')->textInput() ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
