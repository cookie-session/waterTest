<?php

use common\helpers\Html;
use common\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '物资出入库记录';
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
        'tableOptions' => ['class' => 'table table-hover text-center'],
        'rowOptions' => function ($model) {
            // 如果当前库存 <= 预警库存，则背景色为淡红色
            if ($model->type == 1) {
                return ['style' => 'background-color: #bbfdc6ff;']; // 淡红色
            }
            if ($model->type == 2) {
                return ['style' => 'background-color: #faeaeaff;']; // 淡红色
            }
            return [];
        },
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'visible' => false,
            ],

            [
                'attribute' => 'id',
                'label' => '序号',
                'format' => 'text',
                'value' => function($model){
                    return "#".$model->id;
                },
            ],
            [
                'attribute' => 'supplies_id',
                'label' => '物资名称',
                'value' => function($model){
                    return $model->material->name;
                },
            ],
            [
                'attribute' => 'type',
                'label' => '操作类型',
                'value' => function($model){
                    if($model->type == 1){
                        return '入库';
                    }else if($model->type == 2){
                        return '出库';
                    }
                },
            ],
            [
                'attribute' => 'quantity',
                'label' => '出入数量',
                'value' => function($model){
                    return $model->quantity;
                },
            ],
            'price',
            'operator_id',
            [
                'attribute' => 'remark',
                'value' => function($model){
                    return $model->remark != null && $model->remark != "" ? Html::decode($model->remark):"未设置";
                },
            ],
            //'created_at',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{edit}',
                'buttons' => [
                    'edit' => function($url, $model, $key){
                            return Html::edit(['edit', 'id' => $model->id]);
                    },
                ]
            ]
    ]
    ]); ?>
            </div>
        </div>
    </div>
</div>
