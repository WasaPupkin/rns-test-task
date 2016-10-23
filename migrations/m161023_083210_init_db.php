<?php

use yii\db\Migration;
use yii\db\pgsql\Schema;

class m161023_083210_init_db extends Migration
{
    public function up()
    {
        $this->createTable('cities', [
            'city_id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
        ]);

        $this->createTable('qualifications', [
            'qualification_id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
        ]);

        $this->createTable('users', [
            'user_id' => Schema::TYPE_PK,
            'qualification_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'name' => Schema::TYPE_STRING . ' NOT NULL',
        ]);

        $this->createTable('users_cities', [
            'user_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'city_id' => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable('users_cities');
        $this->dropTable('users');
        $this->dropTable('qualifications');
        $this->dropTable('cities');

        return false;
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
