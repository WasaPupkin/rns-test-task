<?php

namespace app\controllers;

use app\models\City;
use app\models\Qualification;
use app\models\User;
use app\models\UserSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class UserController extends Controller
{
    /**
     *
     *
     * @return string
     */
    public function actionList()
    {
        $searchModel = new UserSearch();
        $usersDataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $citiesDataProvider = new ActiveDataProvider([
            'query' => City::find(),
            'sort' => [
                'defaultOrder' => ['name' => SORT_ASC],
            ],
            'pagination' => false,
        ]);

        $qualificationDataProvider = new ActiveDataProvider([
            'query' => Qualification::find(),
            'sort' => [
                'defaultOrder' => ['name' => SORT_ASC],
            ],
            'pagination' => false,
        ]);

        return $this->render('list', [
            'usersDataProvider' => $usersDataProvider,
            'searchModel' => $searchModel,
            'citiesDataProvider' => $citiesDataProvider,
            'qualificationDataProvider' => $qualificationDataProvider,
        ]);
    }

}
