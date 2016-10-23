<?php
/**
 * @var $this yii\web\View
 * @var $usersDataProvider
 * @var $searchModel
 * @var $citiesDataProvider
 * @var $qualificationDataProvider
 */

$this->title = 'Список пользователей';

echo $this->render('_search', [
    'model' => $searchModel,
    'citiesDataProvider' => $citiesDataProvider,
    'qualificationDataProvider' => $qualificationDataProvider,
]);

echo \yii\grid\GridView::widget([
    'dataProvider' => $usersDataProvider,
//    'filterModel' => $searchModel,
    'columns' => [
        'name',
        [
            'attribute' => 'qualification.name',
            'label' => 'Образование',
        ],
        [
            'attribute' => 'cities.name',
            'label' => 'Города',
            'value' => function($model) {
                return implode(', ', \yii\helpers\ArrayHelper::map($model->cities, 'city_id', 'name'));
            },
        ],
    ],
]);
