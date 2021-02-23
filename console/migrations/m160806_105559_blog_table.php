<?php

use yii\db\Migration;
use yii\db\Schema;

class m160806_105559_blog_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%blog}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'alias' => Schema::TYPE_STRING . ' NOT NULL',
            'content' => Schema::TYPE_TEXT . ' NOT NULL',
            'seo_title' => Schema::TYPE_STRING . ' NOT NULL',
            'seo_description' => Schema::TYPE_TEXT . ' NOT NULL',
            'seo_keywords' => Schema::TYPE_STRING . ' NOT NULL',
            'create_time' => Schema::TYPE_DATETIME . ' NOT NULL',
            'update_time' => Schema::TYPE_DATETIME . ' NOT NULL',
            'status' => Schema::TYPE_BOOLEAN . ' NOT NULL',
            'cache' => Schema::TYPE_BOOLEAN . ' NOT NULL',
            'author_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'category_id' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
    }

    public function down()
    {
        echo "m160806_105559_blog_table cannot be reverted.\n";

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
