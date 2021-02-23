<?php

use yii\db\Migration;

class m170107_202552_order_record_blog extends Migration
{
    public function up()
    {

        $this->insert('order', ['source_type' => 5]);
    }

    public function down()
    {
        echo "m170107_202552_order_record_blog cannot be reverted.\n";

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
