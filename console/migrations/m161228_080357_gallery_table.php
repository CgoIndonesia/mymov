<?php

use yii\db\Migration;

class m161228_080357_gallery_table extends Migration
{
    public function up()
    {
        $this->createTable('gallery', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ]);
    }

    public function down()
    {
        echo "m161228_080357_gallery_table cannot be reverted.\n";

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
