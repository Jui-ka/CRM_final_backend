<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property int $task_id
 * @property string $task_name
 * @property string $task_desc
 * @property string $task_status
 * @property string $created_at
 * @property int $person_id
 * @property int $emp_id
 * @property string $module_name
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_name', 'task_desc', 'task_status', 'created_at', 'person_id', 'emp_id', 'module_name'], 'required'],
            [['created_at'], 'safe'],
            [['person_id', 'emp_id'], 'integer'],
            [['task_name', 'task_desc', 'task_status', 'module_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'task_id' => 'Task ID',
            'task_name' => 'Task Name',
            'task_desc' => 'Task Desc',
            'task_status' => 'Task Status',
            'created_at' => 'Created At',
            'person_id' => 'Person ID',
            'emp_id' => 'Emp ID',
            'module_name' => 'Module Name',
        ];
    }

    public function getEmployee() {
        return $this->hasOne(Employee::className(), ['emp_id' => 'emp_id']);
    }
}
