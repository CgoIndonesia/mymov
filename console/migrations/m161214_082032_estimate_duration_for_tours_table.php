<?php

use yii\db\Migration;

class m161214_082032_estimate_duration_for_tours_table extends Migration
{
    public function up()
    {
          $this->addColumn('tours', 'duration_type', 'integer');
    }

    public function down()
    {
        echo "m161214_082032_estimate_duration_for_tours_table cannot be reverted.\n";

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
