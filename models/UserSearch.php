<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;
use yii\helpers\VarDumper;

/**
 * UserSearch represents the model behind the search form about `app\models\User`.
 */
class UserSearch extends User
{
    public $city_id;
    public $qualification_id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city_id' , 'qualification_id'], 'each', 'rule' => ['integer']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'qualification_id' => 'Образование',
            'city_id' => 'Город',
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find()->with('qualification', 'cities');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'defaultOrder' => ['name' => SORT_ASC],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'qualification_id' => $this->qualification_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        if($this->city_id) {
            $query->join('JOIN', User::USER_TO_CITIES_TABLENAME, User::tableName().'.user_id = '.User::USER_TO_CITIES_TABLENAME.'.user_id');
            $query->andFilterWhere([
                'city_id' => $this->city_id,
            ]);
//            $query->groupBy([
//               User::tableName().'.user_id',
//               User::tableName().'.qualification_id',
//               User::tableName().'.name',
//            ]);
        }

        return $dataProvider;
    }
}