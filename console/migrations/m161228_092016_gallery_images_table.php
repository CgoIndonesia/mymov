<?php

use yii\db\Migration;

class m161228_092016_gallery_images_table extends Migration
{
    public function up()
    {
        $this->createTable('gallery_images', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'image' => $this->string(),
            'gallery_id' => $this->string()
            ]);
    }

    public function down()
    {
        echo "m161228_092016_gallery_sources_table cannot be reverted.\n";

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
