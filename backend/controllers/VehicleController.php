<?php

namespace backend\controllers;

use Yii;
use common\models\vehicle\Vehicle;
use common\traits\Curd;
use common\models\base\SearchModel;
use yii\web\Controller;

/**
* Vehicle
*
* Class VehicleController
* @package backend\controllers
*/
class VehicleController extends BaseController
{
    use Curd;

    /**
    * @var Vehicle
    */
    public $modelClass = Vehicle::class;


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
}
