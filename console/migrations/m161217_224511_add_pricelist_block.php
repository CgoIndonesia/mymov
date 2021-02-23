<?php

use yii\db\Migration;

class m161217_224511_add_pricelist_block extends Migration
{
    public function up()
    {

        $tableOptions = null;

        $this->insert('{{%blocks}}', [

            'name'=>'pricelist',
            'title'=>'SERVICE PRICELIST',
            'content'=>null,
        ],$tableOptions);
    }

    public function down()
    {
        echo "m161217_224511_add_pricelist_block cannot be reverted.\n";

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
