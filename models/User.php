<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $user_id
 * @property integer $qualification_id
 * @property string $name
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['qualification_id', 'name'], 'required'],
            [['qualification_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'qualification_id' => 'Образование',
            'name' => 'ФИО',
        ];
    }

    public function getQualification()
    {
        return $this->hasOne(Qualification::className(), ['qualification_id' => 'qualification_id']);
    }

    public function getCities()
    {
        return $this->hasMany(City::className(), ['city_id' => 'city_id'])
            ->viaTable('users_cities', ['user_id' => 'user_id'])
            ->orderBy(['cities.name' => SORT_ASC]);
    }
}
