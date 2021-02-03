<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "to_do_list".
 *
 * @property int $id
 * @property string $title
 * @property int $created_by
 * @property int $completed_by
 * @property string $content
 * @property string $date
 * @property string $completed_date
 * @property string $status
 */
class ToDoList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'to_do_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'created_by', 'completed_by', 'content', 'date', 'completed_date'], 'required'],
            [['title', 'content', 'status'], 'string'],
            [['created_by', 'completed_by'], 'integer'],
            [['date', 'completed_date'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'created_by' => 'Created By',
            'completed_by' => 'Completed By',
            'content' => 'Content',
            'date' => 'Date',
            'completed_date' => 'Completed Date',
            'status' => 'Status',
        ];
    }
}
