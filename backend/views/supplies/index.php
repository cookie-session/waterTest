<?php

use common\helpers\Html;
use common\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '物资列表';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
                <div class="box-tools">
                    <?= Html::create(['edit'],'新增物资',[
                        'class' => "btn btn-success btn-sm"
                    ]) ?>
                </div>
            </div> 
            <div class="box-body table-responsive">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'tableOptions' => ['class' => 'table table-hover text-center'],
                    'rowOptions' => function ($model) {
                        // 如果当前库存 <= 预警库存，则背景色为淡红色
                        if ($model->stock <= $model->warning_stock && $model->warning_stock != 0) {
                            return ['style' => 'background-color: #faeaeaff;']; // 淡红色
                        }
                        return [];
                    },
                    'columns' => [
                        [
                            'class' => 'yii\grid\SerialColumn',
                            'visible' => false,
                        ],

                        //'id',
                        [
                            'attribute' => 'image',
                            'format' => 'html',
                            'value' => function ($model) {
                                return Html::img($model->image, [
                                    'width' => 60,
                                    'height' => 60,
                                    'style' => 'border-radius:6px;object-fit:cover;'
                                ]);
                            },
                        ],
                        [
                            'attribute' => 'number',
                            'format' => 'html',
                            'value' => function($model){
                                return '<div>'.$model->name.'</div>'.
                                       "<div>".$model->number ."</div>";
                            },
                        ],
                        [
                            'attribute' => 'brand',
                            'format' => 'html',
                            'label'=>'规格信息',
                            'value' => function($model) {
                                $typeName = $model->type ? $model->type->name : '无';
                                return '<div>类型：' . $typeName . '</div>' .
                                    '<div>品牌：' . Html::encode($model->brand) . '</div>' .
                                    '<div>型号：' . Html::encode($model->model_num) . '</div>';
                            },
                        ],
                        [
                            'attribute' => 'warehouse_id',
                            'value' => function($model){
                                return $model->warehouse ? $model->warehouse->name : '无';
                            },
                        ],
                        'price',
                        [
                            'attribute' => 'warning_stock',
                            'label' => '库存警戒值',
                            'value' => function($model){
                                return $model->warning_stock == 0 ? '不设警戒' : $model->warning_stock. $model->unit;
                            },
                        ],
                        
                        [
                            'attribute' => 'stock',
                            'label' => '当前库存',
                            'value' => function($model){
                                return $model->stock == 0 ? '无库存' : $model->stock. $model->unit;
                            },
                        ],
                        'description:ntext',
                        //'status',
                        [
                            'attribute' => 'created_at',
                            'label'=> "创建时间",
                            'format' => 'raw',
                            'value' => function ($model) {
                                return date('Y-m-d H:i:s', $model->created_at);
                            },
                        ],
                        //'updated_at',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => '操作',
                            'template' => '{in-stock} {out-stock} {edit} {status} ',
                            'buttons' => [
                                'edit' => function($url, $model, $key){
                                        return Html::edit(['edit', 'id' => $model->id]);
                                },
                                'status' => function($url, $model, $key){
                                        return Html::status($model['status']);
                                },
                                'in-stock' => function ($url, $model, $key) {
                                    return Html::a('入库', ['supplies-record/create', 'material_id' => $model->id, 'type' => 1], [
                                        'class' => 'btn btn-success btn-sm',
                                    ]);
                                },
                                'out-stock' => function ($url, $model, $key) {
                                    return Html::a('出库', ['supplies-record/create', 'material_id' => $model->id, 'type' => 2], [
                                        'class' => 'btn btn-danger btn-sm',
                                    ]);
                                },
                            ]
                        ]
                ]
                ]); ?>
            </div>
        </div>
    </div>
</div>


<?php
$recordUrl = Url::to(['supplies-record/create']);
$js = <<<JS
$('.record-btn').on('click', function() {
    var materialId = $(this).data('id');
    var type = $(this).data('type');
    var title = type == 1 ? '入库' : '出库';
    
    layer.open({
        type: 2,  // iframe 弹窗
        title: title + '操作',
        shadeClose: true,
        shade: 0.3,
        area: ['500px', '420px'],
        content: '{$recordUrl}?material_id=' + materialId + '&type=' + type
    });
});
JS;
$this->registerJs($js);
?>