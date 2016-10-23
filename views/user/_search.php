<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
/* @var $citiesDataProvider */
/* @var $qualificationDataProvider */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['list'],
        'method' => 'get',
    ]); ?>

    <div class="row">

        <div class="col-md-6">
        <?= $form->field($model, 'qualification_id')->dropDownList(
            \yii\helpers\ArrayHelper::map($qualificationDataProvider->getModels(), 'qualification_id', 'name'),
            [
                'multiple' => true,
            ]
        ) ?>
        </div>

        <div class="col-md-6">
        <?= $form->field($model, 'city_id')->dropDownList(
            \yii\helpers\ArrayHelper::map($citiesDataProvider->getModels(), 'city_id', 'name'),
            [
                'multiple' => true,
            ]
        ) ?>
        </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Сбросить', \yii\helpers\Url::toRoute(''), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
