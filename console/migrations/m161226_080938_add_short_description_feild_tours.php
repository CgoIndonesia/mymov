<?php

use yii\db\Migration;

class m161226_080938_add_short_description_feild_tours extends Migration
{
     public function up()
    {
          $this->addColumn('tours', 'short_description', 'text');
    }
    public function down()
    {
        echo "m161226_080938_add_short_description_feild_tours cannot be reverted.\n";

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
