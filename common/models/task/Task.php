<?php

namespace common\models\task;

use Yii;

/**
 * This is the model class for table "rf_task".
 *
 * @property int $id 主键
 * @property string $name 任务名称
 * @property int $site_id 任务站点ID（关联站点表）
 * @property int $group_id 执行小组ID（关联小组表）
 * @property int|null $scheme_id 方案ID（关联任务方案表）
 * @property string|null $task_time 任务时间
 * @property string|null $description 任务说明
 * @property int|null $status 任务状态：0=未开始，1=进行中，2=已完成，3=已取消
 * @property int|null $created_at 创建时间
 * @property int|null $updated_at 更新时间
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rf_task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['scheme_id', 'task_time', 'description', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 0],
            [['name', 'site_id', 'group_id'], 'required'],
            [['site_id', 'group_id', 'scheme_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['task_time'], 'safe'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'name' => '任务名称',
            'site_id' => '任务站点ID（关联站点表）',
            'group_id' => '执行小组ID（关联小组表）',
            'scheme_id' => '方案ID（关联任务方案表）',
            'task_time' => '任务时间',
            'description' => '任务说明',
            'status' => '任务状态：0=未开始，1=进行中，2=已完成，3=已取消',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
}
