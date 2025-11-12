<?php

namespace backend\controllers;

use Yii;
use common\models\task\Task;
use common\traits\Curd;
use common\models\base\SearchModel;
use yii\web\Controller;

/**
* Task
*
* Class TaskController
* @package backend\controllers
*/
class TaskController extends BaseController
{
    use Curd;

    /**
    * @var Task
    */
    public $modelClass = Task::class;


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
