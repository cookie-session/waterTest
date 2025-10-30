<?php

use common\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Site\Site */
/* @var $form yii\widgets\ActiveForm */

$this->title = '新增站点';
$this->params['breadcrumbs'][] = ['label' => '站点列表', 'url' => ['index']];
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
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'company')->textInput(['maxlength' => true]) ?>
                    <?= \common\widgets\linkage\Linkage::widget([
                            'form' => $form,
                            'model' => $model,
                            'template' => 'long',
                            'one' => [
                                'name' => 'province', // 字段名称
                                'title' => '请选择省', // 字段名称
                                'list' => Yii::$app->services->provinces->getCityMapByPid(), // 字段名称
                            ],
                            'two' => [
                                'name' => 'city', // 字段名称
                                'title' => '请选择市', // 字段名称
                                'list' => Yii::$app->services->provinces->getCityMapByPid($model->province, 2), // 字段名称
                            ],
                            'three' => [
                                'name' => 'district', // 字段名称
                                'title' => '请选择区', // 字段名称
                                'list' => Yii::$app->services->provinces->getCityMapByPid($model->city, 3), // 字段名称
                            ],
                    ]); ?>
                    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
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
