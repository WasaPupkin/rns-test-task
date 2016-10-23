<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "qualifications".
 *
 * @property integer $qualification_id
 * @property string $name
 */
class Qualification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qualifications';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'qualification_id' => 'Qualification ID',
            'name' => 'Name',
        ];
    }
}
