<?php

use yii\db\Migration;

class m170102_172247_sort_columns_gallery extends Migration
{

      public function up()
      {
          $this->addColumn('gallery_images', 'sort_order', 'string');
          $this->addColumn('gallery_videos', 'sort_order', 'string');
      }

    public function down()
    {
        echo "m170102_172247_sort_columns_gallery cannot be reverted.\n";

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
