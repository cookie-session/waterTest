<?php

use common\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\vehicle\Vehicle */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Vehicle';
$this->params['breadcrumbs'][] = ['label' => 'Vehicles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">基本信息</h3>
            </div>
            <div class="box-body">
                <?php $form = ActiveForm::begin([
                    'fieldConfig' => [
                        'template' => "<div class='row'><div class='col-2 text-right'>{label}</div><div class='col-10'>{input}\n{hint}\n{error}</div></div>",
                    ],
                ]); ?>
                <div class="col-sm-12">
                    <?= $form->field($model, 'photo')->widget(\common\widgets\webuploader\Files::class, [
                            'type' => 'images',
                            'theme' => 'default',
                            'themeConfig' => [],
                            'config' => [
                                // 可设置自己的上传地址, 不设置则默认地址
                                // 'server' => '',
                                'pick' => [
                                    'multiple' => false,
                                ],
                            ]
                    ]); ?>
                    <?= $form->field($model, 'plate_number')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'brand')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'type')->dropDownList([
                        1 => '小货车',
                        2 => '中型货车',
                        3 => '厢式货车',
                        4 => '小轿车',
                        5 => '越野车',
                        6 => '其他',
                    ]) ?>
                    <?= $form->field($model, 'insurance_expire')->widget(kartik\datetime\DateTimePicker::class, [
                        'language' => 'zh-CN',
                        'options' => [
                            'value' => $model->isNewRecord 
                                    ? date('Y-m-d H:i:s') 
                                    : date('Y-m-d H:i:s', strtotime($model->insurance_expire))
                        ],
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd hh:ii',
                            'todayHighlight' => true, // 今日高亮
                            'autoclose' => true, // 选择后自动关闭
                            'todayBtn' => true, // 今日按钮显示
                        ]
                    ]);?>
                    <?= $form->field($model, 'annual_check_expire')->widget(kartik\datetime\DateTimePicker::class, [
                        'language' => 'zh-CN',
                        'options' => [
                            'value' => $model->isNewRecord 
                                    ? date('Y-m-d H:i:s') 
                                    : date('Y-m-d H:i:s', strtotime($model->annual_check_expire))
                        ],
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd hh:ii',
                            'todayHighlight' => true, // 今日高亮
                            'autoclose' => true, // 选择后自动关闭
                            'todayBtn' => true, // 今日按钮显示
                        ]
                    ]);?>
                    <?= $form->field($model, 'remark')->textarea(['rows' => 6]) ?>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 text-center">
                        <button class="btn btn-primary" type="submit">保存</button>
                        <span class="btn btn-white" onclick="history.go(-1)">返回</span>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
