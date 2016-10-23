<?php
/**
 * @var $this yii\web\View
 * @var $dataProvider
 */

$this->title = 'Список пользователей';

echo \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'user_id',
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
