<?php

namespace backend\controllers;

use Yii;
use common\models\vehicle\VehicleUsage;
use common\traits\Curd;
use common\models\base\SearchModel;
use yii\web\Controller;
use common\models\vehicle\Vehicle;
use yii\helpers\ArrayHelper;
/**
* VehicleUsage
*
* Class VehicleUsageController
* @package backend\controllers
*/
class VehicleUsageController extends BaseController
{
    use Curd;

    /**
    * @var VehicleUsage
    */
    public $modelClass = VehicleUsage::class;


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
     * 编辑/创建
     *
     * @return mixed
     */
    public function actionEdit()
    {
        $id = Yii::$app->request->get('id', null);
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->referrer();
        }

        $vehicle = Vehicle::find()->where(['status' => 1])->all();


        return $this->render($this->action->id, [
            'model' => $model,
            'vehicle' => ArrayHelper::map($vehicle, 'id', 'plate_number'),
        ]);


    }
}
