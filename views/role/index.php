<?php

/**
 * @var $dataProvider array
 * @var $filterModel dektrium\rbac\models\Search
 * @var $this yii\web\View
 */

use kartik\grid\GridView;
use kartik\grid\ActionColumn;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = \Yii::t('userextended', 'Manage roles');
$this->params['breadcrumbs'][] = $this->title;

?>

<?php if(\Yii::$app->getModule('userextended')->showTitles): ?>
    <h1><?= \Yii::t('userextended', 'Manage roles') ?></h1>
<?php endif ?>

<?php $this->beginContent('@dektrium/rbac/views/layout.php') ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $filterModel,
    'layout' => "{items}\n{pager}",
    'pjax' => true,
    'pjaxSettings' => [
	    'neverTimeout' => true,
    ],
    'columns' => [
        [
            'attribute' => 'name',
            'format' => 'html',
            'hAlign' => 'center',
            'header'    => \Yii::t('rbac', 'Name'),
            'value' => function ($model) {
                $url = Url::to(['/rbac/role/update', 'name' => $model['name']]);
                return Html::a($model['name'],$url);
            }
        ],
        [
            'attribute' => 'description',
            'hAlign' => 'center',
            'header'    => \Yii::t('rbac', 'Description'),
        ],
        [
            'attribute' => 'rule_name',
            'hAlign' => 'center',
            'header'    => \Yii::t('rbac', 'Rule name'),
        ],
        [
            'class'      => ActionColumn::class,
            'template'   => '{update} {delete}',
            'urlCreator' => function ($action, $model) {
                return Url::to(['/rbac/role/' . $action, 'name' => $model['name']]);
            },
        ]
    ],
    'responsive' => true,
    'hover' => true,
    'panel' => [
        'before' => '<span style="margin-right: 5px;">'.
            Html::a('<i class="glyphicon glyphicon-plus"></i> '.Yii::t('userextended', 'New'),
                ['create'], ['class' => 'btn btn-new btn-success']
            ).'</span>',
        'heading'    => '<h3 class="panel-title"><i class="fa fa-users"></i></h3>',
        'type'       => 'success',
        'showFooter' => false
    ],
]) ?>

<?php $this->endContent() ?>
