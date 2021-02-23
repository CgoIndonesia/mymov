<?php

use yii\db\Migration;

class m161226_135653_order_table extends Migration
{
    public function up()
    {
 $this->createTable('order', [
            'id' => $this->primaryKey(),
            'order' => $this->string(5000),
            'source_type' => $this->integer(),
        ]);
    }


    public function down()
    {
        echo "m161226_135653_order_table cannot be reverted.\n";

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
