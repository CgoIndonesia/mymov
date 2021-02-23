<?php

use yii\db\Migration;

class m161226_064536_team_table extends Migration
{
    public function up()
    {
 $this->createTable('team', [
            'id' => $this->primaryKey(),
            'create_time' => $this->integer(),
            'update_time' => $this->integer(),
            'name' => $this->string(),
            'position' => $this->string(),
            'description' => $this->text(),
            'facebook' => $this->string(),
            'twitter' => $this->string(),
            'google_plus' => $this->string(),
            'instagram' => $this->string(),
            'seo_title' => $this->string(),
            'seo_description' => $this->text(),
            'seo_keywords' => $this->string(),
        ]);
    }

    public function down()
    {
        echo "m161226_064536_team_table cannot be reverted.\n";

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
