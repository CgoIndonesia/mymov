<?php

use yii\db\Migration;

class m161226_081926_add_short_description_feild_accommodation extends Migration
{
    public function up()
    {
          $this->addColumn('accommodations', 'short_description', 'text');
    }

    public function down()
    {
        echo "m161226_081926_add_short_description_feild_accommodation cannot be reverted.\n";

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
