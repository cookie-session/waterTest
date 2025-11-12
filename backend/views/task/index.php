<?php

use common\helpers\Html;
use common\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '任务列表';
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
                'columns' => [
                    [
                        'class' => 'yii\grid\SerialColumn',
                        'visible' => false,
                    ],

                    //'id',
                    'name',
                    [
                        'attribute' => 'site_id',
                        'label' => '站点名称',
                        'value' => function($model){
                            return $model->site_id ?? '-';
                        }
                    ],
                    [
                        'attribute' => 'group_id',
                        'label' => '执行小组',
                        'value' => function($model){
                            return $model->group_id ?? '-';
                        }
                    ],
                    [
                        'attribute' => 'scheme_id',
                        'label' => '执行方案',
                        'value' => function($model){
                            return $model->scheme_id;
                        }
                    ],
                    [
                        'attribute' => 'task_time',
                        'label' => '执行时间',
                        'value' => function($model){
                            return $model->task_time;
                        }
                    ],
                    'description:ntext',
                    [
                        'attribute' => 'status',
                        'label' => '任务状态',
                        'value' => function($model){
                            if($model->status == 0) {
                                return "<span class='text-green'>未开始</span>";
                            } else if($model->status == 1) {
                                return "<span class='text-green'>进行中</span>";
                            }  else if($model->status == 2) {
                                return "<span class='text-green'>进行中</span>";
                            } else {
                                return "<span class='text-red'>已取消</span>";
                            }
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'created_at',
                        'label' => '发布时间',
                        'value' => function($model){
                            return date('Y-m-d H:i:s', $model->created_at);
                        }
                    ],
                    //'updated_at',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => '操作',
                        'template' => '{edit} {status} {delete}',
                        'buttons' => [
                            'edit' => function($url, $model, $key){
                                    return Html::edit(['edit', 'id' => $model->id]);
                            },
                            'status' => function($url, $model, $key){
                                    return Html::status($model['status']);
                            },
                            'delete' => function($url, $model, $key){
                                    return Html::delete(['delete', 'id' => $model->id]);
                            },
                        ]
                    ]
            ]
            ]); ?>
            </div>
        </div>
    </div>
</div>
