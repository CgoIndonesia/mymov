<?php

use yii\db\Migration;

class m161226_221756_add_order_records extends Migration
{
    public function up()
    {

        $this->insert('order', ['source_type' => 1]);
        $this->insert('order', [ 'source_type' => 2]);
        $this->insert('order', ['source_type' => 3]);
        $this->insert('order', ['source_type' => 4]);
    }

    public function down()
    {
        echo "m161226_221756_add_order_data_accommodation cannot be reverted.\n";

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
