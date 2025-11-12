<?php

namespace backend\controllers;

use Yii;
use common\models\task\Task;
use common\traits\Curd;
use common\models\base\SearchModel;
use yii\web\Controller;
use common\models\Site\Site;
use common\models\WorkGroup\WorkGroup;
use yii\helpers\ArrayHelper;
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


        $site = Site::find()->select(['id','name'])->asArray()->all();

        $workGroup = WorkGroup::find()->select(['id','name'])->asArray()->all();

        return $this->render($this->action->id, [
            'model' => $model,
            'site' => ArrayHelper::map($site,'id','name'),
            'workGroup' => ArrayHelper::map($workGroup,'id','name'),
        ]);
    }
}
