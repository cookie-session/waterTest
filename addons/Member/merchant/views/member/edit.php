<?php

use yii\widgets\ActiveForm;
use common\enums\GenderEnum;
use common\enums\StatusEnum;
use kartik\select2\Select2;
use common\enums\AccessTokenGroupEnum;

$this->title = '编辑';
$this->params['breadcrumbs'][] = ['label' => '会员信息', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title];

?>

<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">基本信息</h3>
            </div>
            <?php $form = ActiveForm::begin([
                'fieldConfig' => [
                    'template' => "<div class='row'><div class='col-1 text-right'>{label}</div><div class='col-11'>{input}\n{hint}\n{error}</div></div>",
                ]
            ]); ?>
            <div class="box-body">
                <?= $form->field($model, 'username')->textInput([
                    'readonly' => true
                ]) ?>
                <?= $form->field($model, 'realname')->textInput() ?>
                <?= $form->field($model, 'mobile')->textInput() ?>
            </div>
            <div class="box-footer text-center">
                <button class="btn btn-primary" type="submit">保存</button>
                <span class="btn btn-white" onclick="history.go(-1)">返回</span>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
