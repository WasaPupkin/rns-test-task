<?php

use yii\db\Migration;

class m161023_090810_qualifications_data extends Migration
{
    public function up()
    {
        $this->insert('qualifications', [
            'name' => 'среднее',
        ]);
        $this->insert('qualifications', [
            'name' => 'бакалавр',
        ]);
        $this->insert('qualifications', [
            'name' => 'магистр',
        ]);
        $this->insert('qualifications', [
            'name' => 'еще что-то',
        ]);
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
