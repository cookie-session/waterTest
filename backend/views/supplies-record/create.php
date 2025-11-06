<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var $model common\models\supplies\SuppliesRecord */
/** @var $material common\models\supplies\Supplies */
/** @var $users array */
/** @var $type int */
?>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">
            <?= $type == 1 ? '入库' : ($type == 2 ? '出库' : '记录') ?>
            —— <?= Html::encode($material->name) ?>
        </h3>
    </div>

    <div class="box-body">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'material_id')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'type')->hiddenInput()->label(false) ?>

        <?= $form->field($model, 'quantity')->textInput(['type' => 'number', 'min' => 1]) ?>

        <?php if ($type == 1): ?>
            <!-- 入库显示单价 -->
            <?= $form->field($model, 'price')->textInput(['type' => 'number', 'step' => '0.01']) ?>
        <?php endif; ?>

        <?php if ($type == 2): ?>
            <!-- 出库显示领取人 -->
            <?= $form->field($model, 'recipient')->dropDownList($users, ['prompt' => '选择领取人']) ?>
        <?php endif; ?>

        <?= $form->field($model, 'remark')->textarea(['rows' => 3]) ?>

       <div class="form-group text-center">
            <?php if ($type == 1): ?>
                <?= Html::submitButton('确定入库', ['class' => 'btn btn-success']) ?>
            <?php else: ?>
                <?= Html::submitButton('确定出库', ['class' => 'btn btn-danger']) ?>
            <?php endif; ?>
            <?= Html::a('返回', ['supplies/index'], ['class' => 'btn btn-default']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
