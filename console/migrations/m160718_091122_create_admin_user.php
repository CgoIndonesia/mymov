<?php

use yii\db\Migration;


/**
 * Handles the creation for table `admin_user`.
 */
class m160718_091122_create_admin_user extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {

        $this->insert('user', [
                'username' => 'admin',
                'password_hash' => Yii::$app->security->generatePasswordHash('admin'),
                'auth_key' => Yii::$app->security->generateRandomString(),
                'status' => 1,
                'email' => 'admin@admin.com',
                'created_at' => date('U'),
                'updated_at' => date('U')
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('admin_user');
    }
}
