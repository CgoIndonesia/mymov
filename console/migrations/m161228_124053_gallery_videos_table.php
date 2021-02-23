<?php

use yii\db\Migration;

class m161228_124053_gallery_videos_table extends Migration
{
    public function up()
    {
        $this->createTable('gallery_videos', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'description' => $this->string(),
            'video' => $this->string(),
            'gallery_id' => $this->string()
            ]);
    }

    public function down()
    {
        echo "m161228_124053_gallery_videos_table cannot be reverted.\n";

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
