<?php

namespace backend\controllers;

use Yii;
use common\models\WorkGroup\WorkGroup;
use common\traits\Curd;
use common\models\base\SearchModel;
use yii\web\Controller;
use common\models\WorkGroup\WorkGroupMember;
use yii\helpers\ArrayHelper;
use common\models\Site\Site; 
/**
* WorkGroup
*
* Class WorkGroupController
* @package backend\controllers
*/
class WorkGroupController extends BaseController
{
    use Curd;

    /**
    * @var WorkGroup
    */
    public $modelClass = WorkGroup::class;


    /**
    * 首页
    *
    * @return string
    * @throws \yii\web\NotFoundHttpException
    */
    public function actionIndex()
    {
        $searchModel = new SearchModel([
            'model' => WorkGroup::class, // 直接传类名
            'scenario' => 'default',
            'partialMatchAttributes' => [], 
            'defaultOrder' => [
                'id' => SORT_DESC
            ],
            'pageSize' => $this->pageSize
        ]);

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // 确保 members.member 被 eager load
        $dataProvider->query->with('members.member');

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
        // 编辑模式下加载已选成员
        if (!$model->isNewRecord) {
            $model->selectedMembers = $model->getMemberIds();
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // 获取提交的成员数组
            $members = Yii::$app->request->post('WorkGroup')['selectedMembers'] ?? [];

            // 清空旧成员
            if (!$model->isNewRecord) {
                WorkGroupMember::deleteAll(['group_id' => $model->id]);
            }

            // 批量保存新成员
            foreach ($members as $userId) {
                $gm = new WorkGroupMember();
                $gm->group_id = $model->id;
                $gm->member_id = $userId;
                $gm->created_at = time();
                $gm->save(false);
            }

            Yii::$app->session->setFlash('success', $model->isNewRecord ? '小组创建成功' : '小组更新成功');
            return $this->referrer();
        }
        return $this->render($this->action->id, [
            'model' => $model,
            'sites' => ArrayHelper::map(Site::find()->where(['status' => 1])->all(), 'id', 'name')
        ]);
    }
}
