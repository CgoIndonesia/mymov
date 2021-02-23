<?php
use yii\db\Schema;
use yii\db\Migration;

class m160728_130101_categories_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%categories}}', [
            'id' => Schema::TYPE_PK,
            'left' => Schema::TYPE_INTEGER . ' NOT NULL',
            'right' => Schema::TYPE_INTEGER . ' NOT NULL',
            'root' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'level' => Schema::TYPE_INTEGER . ' NOT NULL',
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'alias' => Schema::TYPE_STRING . ' NOT NULL',
            'seo_title' => Schema::TYPE_STRING . ' NOT NULL',
            'seo_description' => Schema::TYPE_TEXT . ' NOT NULL',
            'seo_keywords' => Schema::TYPE_STRING . ' NOT NULL',
            'status' => Schema::TYPE_BOOLEAN . ' NOT NULL',
            'order' => Schema::TYPE_INTEGER  . ' NOT NULL DEFAULT 0',
            'type' => Schema::TYPE_INTEGER  . ' NOT NULL DEFAULT 0',
            'cache' => Schema::TYPE_BOOLEAN . ' NOT NULL',

        ], $tableOptions);

    }

    public function down()
    {
        echo "m160728_130101_categories_table cannot be reverted.\n";

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
