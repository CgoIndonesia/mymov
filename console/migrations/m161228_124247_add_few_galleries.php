<?php

use yii\db\Migration;

class m161228_124247_add_few_galleries extends Migration
{
    public function up()
    {

        $this->insert('gallery', ['name' => 'HOME PAGE GALLERY']);
        $this->insert('gallery', ['name' => 'MYMOVIE PAGE GALLERY']);
        $this->insert('gallery', ['name' => 'MEDIA PAGE GALLERY']);
    
    }


    public function down()
    {
        echo "m161228_124247_add_few_galleries cannot be reverted.\n";

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
