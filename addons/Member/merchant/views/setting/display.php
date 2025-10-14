<?php

use yii\widgets\ActiveForm;
use common\helpers\Url;
use common\widgets\ueditor\UEditor;

$this->title = '注销协议';
$this->params['breadcrumbs'][] = ['label' => $this->title];

?>

<div class="row">
    <div class="col-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li><a href="<?= Url::to(['cancel/index'])?>">会员注销(<?= Yii::$app->services->memberCancel->getApplyCount(); ?>)</a></li>
                <li><a href="<?= Url::to(['setting/config'])?>">注销设置</a></li>
                <li class="active"><a href="<?= Url::to(['setting/display'])?>">注销协议</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active">
                    <div class="box">
                        <!-- /.box-header -->
                        <?php $form = ActiveForm::begin([]); ?>
                        <div class="box-body table-responsive">
                            <?= $form->field($model, 'cancel_protocol_title')->textInput(); ?>
                            <?= $form->field($model, 'cancel_protocol')->widget(UEditor::class) ?>
                            <!-- /.box-body -->
                        </div>
                        <div class="box-footer text-center">
                            <button class="btn btn-primary" type="submit">保存</button>
                        </div>
                        <?php ActiveForm::end(); ?>
                        <!-- /.box -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
