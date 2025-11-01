<?php

namespace backend\controllers;

use Yii;
use common\models\supplies\SuppliesRecord;
use common\traits\Curd;
use common\models\base\SearchModel;
use yii\web\Controller;

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
}
