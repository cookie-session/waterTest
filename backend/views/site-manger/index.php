<?php

use common\helpers\Html;
use common\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '站点列表';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
                <div class="box-tools">
                    <?= Html::create(['edit']) ?>
                </div>
            </div>
            <div class="box-body table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class' => 'table table-hover'],
        'columns' => [
                [
                    'class' => 'yii\grid\SerialColumn',
                    'visible' => false,
                ],

                'id',
                'name',
                'company',
                [
                    'attribute' => 'province',
                    'value' => function($model){
                        return Yii::$app->services->provinces->getName($model->province);
                    }
                ],
                [
                    'attribute' => 'city',
                    'value' => function($model){
                        return Yii::$app->services->provinces->getName($model->city);
                    }
                ],
                [
                    'attribute' => 'district',
                    'value' => function($model){
                        return Yii::$app->services->provinces->getName($model->district);
                    }
                ],
                'address',
                'created_at:datetime',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => '操作',
                    'template' => '{edit} {status}',
                    'buttons' => [
                        'edit' => function($url, $model, $key){
                                return Html::edit(['edit', 'id' => $model->id]);
                        },
                        'status' => function($url, $model, $key){
                                return Html::status($model['status']);
                        },
                    ]
                ]
        ]
    ]); ?>
            </div>
        </div>
    </div>
</div>
