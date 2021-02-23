<?php

use yii\db\Migration;

class m161204_163533_tours_table extends Migration
{
    public function up()
    {
        $this->createTable('tours', [
            'id' => $this->primaryKey(),
            'create_time' => $this->integer(),
            'update_time' => $this->integer(),
            'ishome' => $this->integer(),
            'name' => $this->string(),
            'alias' => $this->string(),
            'description' => $this->text(),
            'maximum_members' => $this->integer(),
            'local_guides' => $this->integer(),
            'duration_type' => $this->integer(),
            'estimated_time' => $this->integer(),
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
        echo "m161204_163533_tours_table cannot be reverted.\n";

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
