<?php

use yii\db\Migration;

class m161210_153158_accommodations_table extends Migration
{
    public function up()
    {
        $this->createTable('accommodations', [
            'id' => $this->primaryKey(),
            'create_time' => $this->integer(),
            'update_time' => $this->integer(),
            'name' => $this->string(),
            'alias' => $this->string(),
            'description' => $this->text(),
            'video'  => $this->string(),
            'price' => $this->money(),
            'features' => $this->string(10000),
            'status' => $this->integer(),
            'seo_title' => $this->string(),
            'seo_description' => $this->text(),
            'seo_keywords' => $this->string(),
        ]);
    }

    public function down()
    {
        echo "m161210_153158_accommodations_table cannot be reverted.\n";

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
