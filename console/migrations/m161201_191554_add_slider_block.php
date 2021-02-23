<?php

use yii\db\Migration;
use yii\helpers\Json;
class m161201_191554_add_slider_block extends Migration
{
    public function up()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {

            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->insert('{{%blocks}}', [

            'name'=>'slider',
            'title'=>'Slider In Home Page',
            'content'=>Json::encode([1 => ['title','description','image'],2 => ['title','description','image'],3 => ['title','description','image'],4 => ['title','description','image'], 5 =>['title','description','image']]),
        ],$tableOptions);
    }

    public function down()
    {
        echo "m161201_191554_add_slider_block cannot be reverted.\n";

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
