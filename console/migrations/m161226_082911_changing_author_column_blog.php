<?php

use yii\db\Migration;

class m161226_082911_changing_author_column_blog extends Migration
{
    public function up()
    {
    $this->dropColumn('blog', 'author_id');
    $this->addColumn('blog', 'author','string');
    }

    public function down()
    {
        echo "m161226_082911_changing_author_column_blog cannot be reverted.\n";

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
