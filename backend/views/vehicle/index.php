<?php

use common\helpers\Html;
use common\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '车辆管理';
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

                    //'id',
                    [
                        'attribute' => 'photo',
                        'format' => 'html',
                        'value' => function ($model) {
                            return Html::img($model->photo, [
                                'width' => 60,
                                'height' => 60,
                                'style' => 'border-radius:6px;object-fit:cover;'
                            ]);
                        },
                    ],
                    'plate_number',
                    'brand',
                    [
                        'attribute' => 'type',
                        'label' => '车辆类型',
                        'value' => function($model){
                            $types = [
                                1 => '小货车',
                                2 => '中型货车',
                                3 => '厢式货车',
                                4 => '小轿车',
                                5 => '越野车',
                                6 => '其他',
                            ];
                            return $types[$model->type] ?? '未知';
                        }
                    ],
                    'insurance_expire',
                    'annual_check_expire',
                    'remark:ntext',
                    //'created_at',
                    //'updated_at',
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
