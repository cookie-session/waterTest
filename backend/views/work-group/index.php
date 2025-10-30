<?php

use common\helpers\Html;
use common\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '小组列表';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
                <div class="box-tools">
                    <?= Html::create(['edit'],'新增小组') ?>
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

                    'name',
                    [
                        'label' => '站点',
                        'value' => function($model) {
                            return $model->site ? $model->site->name : '未关联';
                        }
                    ],
                    'description',
                    // 新增成员数量列
                    [
                        'label' => '成员数量',
                        'value' => function($model) {
                            return count($model->members); // 成员总数
                        },
                    ],

                    // 新增成员姓名列
                    [
                        'label' => '成员列表',
                        'format' => 'raw',
                        'value' => function($model) {
                            $names = [];
                            foreach ($model->members as $member) {
                                $names[] = $member->member->realname ?? '';
                            }
                            return implode('，', $names); // 用中文逗号分隔
                        }
                    ],
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
