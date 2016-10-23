<?php

use yii\db\Migration;

class m161023_092404_cities_data extends Migration
{
    public function up()
    {
        $cities = [
            'Москва',
            'Санкт-Петербург',
            'Тверь',
            'Новгород',
            'Нижний Новгород',
            'Псков',
            'Омск',
            'Сочи',
            'Краснодар',
            'Хабаровск',
            'Владивасток',
        ];

        for ($i = 0; $i < count($cities); $i++) {
            $this->insert('cities', [
                'name' => $cities[$i],
            ]);
        }
    }

    public function down()
    {
        $this->truncateTable('qualifications');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
