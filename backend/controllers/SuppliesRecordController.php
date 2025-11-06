<?php

namespace backend\controllers;

use Yii;
use common\models\supplies\SuppliesRecord;
use common\models\supplies\Supplies;
use common\traits\Curd;
use common\models\base\SearchModel;
use yii\web\Controller;
use common\models\member\Member;

/**
* SuppliesRecord
*
* Class SuppliesRecordController
* @package backend\controllers
*/
class SuppliesRecordController extends BaseController
{
    use Curd;

    /**
    * @var SuppliesRecord
    */
    public $modelClass = SuppliesRecord::class;


    /**
    * 首页
    *
    * @return string
    * @throws \yii\web\NotFoundHttpException
    */
    public function actionIndex()
    {
        $searchModel = new SearchModel([
            'model' => $this->modelClass,
            'scenario' => 'default',
            'partialMatchAttributes' => [], // 模糊查询
            'defaultOrder' => [
                'id' => SORT_DESC
            ],
            'pageSize' => $this->pageSize
        ]);

        $dataProvider = $searchModel
            ->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }


    /**
     * 出入库操作
     */
    public function actionCreate($material_id, $type = 1)
    {
        $material = Supplies::findOne($material_id);
        if (!$material) {
            throw new NotFoundHttpException('物资不存在');
        }

        $model = new SuppliesRecord();
        $model->material_id = $material_id;
        $model->type = $type;
        $model->created_at = time();
        $model->operator_id = Yii::$app->user->id ?? 0; // ✅ 自动记录操作人

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // 更新库存
            if ($model->type == 1) {
                $material->stock += $model->quantity;
            } else {
                $material->stock -= $model->quantity;
                if ($material->stock < 0) {
                    $material->stock = 0;
                }
            }
            $material->save(false);

            Yii::$app->session->setFlash('success', '操作成功');
            return $this->redirect(['supplies/index']);
        }

        // 获取用户列表（用于下拉选择领取人）
        $users = Member::find()->select(['realname', 'id'])->indexBy('id')->column();

        return $this->render('create', [
            'model' => $model,
            'material' => $material,
            'users' => $users,
            'type' => $type,
        ]);
    }
    
}
