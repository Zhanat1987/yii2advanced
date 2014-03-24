<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var backend\models\search\CategorySearch $searchModel
 */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">
	<h1><?= Html::encode($this->title) ?></h1>
	<?php //echo $this->render('_search', ['model' => $searchModel]); ?>
	<p>
		<?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
	</p>
	<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
            // http://stuff.cebe.cc/yii2docs/yii-grid-column.html
			['class' => 'yii\grid\SerialColumn'],
			'id',
			'parent_id',
			'materialized_path',
			'title',
			'description',
			[
                // http://stuff.cebe.cc/yii2docs/yii-grid-actioncolumn.html
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'width: 70px;']
            ],
		],
	]); ?>
</div>