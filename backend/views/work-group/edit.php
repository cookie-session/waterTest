<?php

use common\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\member\Member;
use softark\duallistbox\DualListbox;
/* @var $this yii\web\View */
/* @var $model common\models\WorkGroup\WorkGroup */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Work Group';
$this->params['breadcrumbs'][] = ['label' => 'Work Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
// 获取所有用户
$users = ArrayHelper::map(Member::find()->where(['type'=>1])->all(), 'id', 'realname');

// 编辑模式下加载已选成员
$model->selectedMembers = $model->getMemberIds();

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
                    <?= $form->field($model, 'site_id')->dropDownList(
                        $sites,
                        ['prompt' => '请选择站点']
                    )->label('所属站点') ?>
                    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'selectedMembers')->widget(DualListbox::class, [
                        'items' => $users,
                        'options' => ['multiple' => true, 'size' => 15],
                        'clientOptions' => [
                            'nonSelectedListLabel' => '所有用户',
                            'selectedListLabel' => '小组成员',
                            'filterPlaceHolder' => '搜索...',
                            'moveOnSelect' => false,
                            'infoText' => '共 {0} 个用户',               // 显示全部时
                            'infoTextEmpty' => '无用户',                // 空列表时
                            'infoTextFiltered' => '筛选到 {0} 条数据', // 筛选后
                            'filterTextClear' => '显示全部',
                        ],
                    ])->label('小组成员'); ?>
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
