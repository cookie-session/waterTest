<?php

use yii\grid\GridView;
use common\helpers\Html;
use common\helpers\ImageHelper;
use common\helpers\MemberHelper;
use kartik\daterange\DateRangePicker;

$this->title = '会员信息';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];

?>

<div class="row">
    <div class="col-12 col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= $this->title; ?></h3>
                <div class="box-tools">
                    <?= Html::create(['ajax-edit'], '创建', [
                        'data-toggle' => 'modal',
                        'data-target' => '#ajaxModal',
                    ]) ?>
                </div>
            </div>
            <div class="box-body table-responsive">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    // 重新定义分页样式
                    'tableOptions' => [
                        'class' => 'table table-hover rf-table',
                        'fixedNumber' => 2,
                        'fixedRightNumber' => 1,
                    ],
                    'columns' => [
                        [
                            'class' => 'yii\grid\SerialColumn',
                            'visible' => false, // 不显示#
                        ],
                        [
                            'attribute' => 'id',
                            'filter' => Html::activeTextInput($searchModel, 'id', [
                                    'class' => 'form-control',
                                    'style' => 'width: 50px'
                                ]
                            ),
                            'footer' => '合计',
                        ],
                        [
                            'attribute' => 'realname',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return Html::encode($model->realname);
                            },
                            'headerOptions' => ['style' => 'width:150px;'],   // 表头宽度
    'contentOptions' => ['style' => 'width:150px;'],  // 单元格宽度
                        ],
                        [
                            'attribute' => 'mobile',
                            'headerOptions' => ['class' => 'col-md-1'],
                        ],
                        [
                            'attribute' => 'memberLevel.name',
                            'label' => '角色',
                            'filter' => Html::activeDropDownList($searchModel, 'current_level', $levelMap, [
                                    'prompt' => '全部',
                                    'class' => 'form-control'
                                ]
                            ),
                            'value' => function ($model) {
                                return Html::tag('span', $model->memberLevel->name ?? '', [
                                    'class' => 'label label-outline-primary'
                                ]);
                            },
                            'format' => 'raw',
                        ],
                        [
                            'label' => '最后登录 / 注册时间',
                            'filter' => DateRangePicker::widget([
                                'language' => 'zh-CN',
                                'name' => 'queryDate',
                                'value' => (!empty($startTime) && !empty($endTime)) ? ($startTime . '-' . $endTime) : '',
                                'readonly' => 'readonly',
                                'useWithAddon' => false,
                                'convertFormat' => true,
                                'startAttribute' => 'start_time',
                                'endAttribute' => 'end_time',
                                'startInputOptions' => ['value' => $startTime],
                                'endInputOptions' => ['value' => $endTime],
                                'presetDropdown' => true,
                                'containerTemplate' => <<< HTML
        <div class="kv-drp-dropdown">
            <span class="left-ind">{pickerIcon}</span>
            <input type="text" readonly class="form-control range-value" value="{value}">
        </div>
        {input}
HTML,
                                'pluginOptions' => [
                                    'locale' => ['format' => 'Y-m-d H:i:s'],
                                    'timePicker' => true,
                                    'timePicker24Hour' => true,
                                    'timePickerSeconds' => true,
                                    'timePickerIncrement' => 1
                                ]
                            ]),
                            'value' => function ($model) {
                                return "最后访问IP：" . $model->last_ip . '<br>' .
                                    "最后访问：" . (!empty($model->last_time) ? Yii::$app->formatter->asDatetime($model->last_time) : '---') . '<br>' .
                                    "登录次数：" . $model->visit_count . '<br>' .
                                    "注册时间：" . Yii::$app->formatter->asDatetime($model->created_at) . '<br>';
                            },
                            'format' => 'raw',
                        ],
                        [
                            'header' => "操作",
                            'contentOptions' => ['class' => 'text-align-center'],
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{ajax-edit}  {recharge} {edit}{destroy}',
                            'buttons' => [
                                'ajax-edit' => function ($url, $model, $key) {
                                    return Html::a('账号密码', ['ajax-edit', 'id' => $model->id], [
                                            'data-toggle' => 'modal',
                                            'data-target' => '#ajaxModal',
                                            'class' => 'blue'
                                        ]) . '<br>';
                                },
                                'edit' => function ($url, $model, $key) {
                                    return Html::a('编辑', ['edit', 'id' => $model->id], [
                                            'class' => 'purple'
                                        ]) . '<br>';
                                },
                                'destroy' => function ($url, $model, $key) {
                                    return Html::a('删除', ['destroy', 'id' => $model->id], [
                                            'class' => 'red',
                                            'onclick' => "rfTwiceAffirm(this, '确认删除吗？', '请谨慎操作');return false;"
                                        ]) . '<br>';
                                },
                            ],
                        ],
                    ],
                    'showFooter' => true,
                ]); ?>
            </div>
        </div>
    </div>
</div>
