<?php

use yii\db\Migration;

class m161214_152706_guides_table extends Migration
{
    public function up()
    {
 $this->createTable('guides', [
            'id' => $this->primaryKey(),
            'create_time' => $this->integer(),
            'update_time' => $this->integer(),
            'name' => $this->string(),
            'alias' => $this->string(),
            'description' => $this->text(),
            'location' => $this->string(),
            'price' => $this->money(),
            'seo_title' => $this->string(),
            'seo_description' => $this->text(),
            'seo_keywords' => $this->string(),
        ]);
    }

    public function down()
    {
        echo "m161214_152706_guides_table cannot be reverted.\n";

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
