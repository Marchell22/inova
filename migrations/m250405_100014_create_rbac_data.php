<?php

use yii\db\Migration;

class m250405_100014_create_rbac_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        // Buat permissions
        $viewDashboard = $auth->createPermission('viewDashboard');
        $viewDashboard->description = 'View dashboard';
        $auth->add($viewDashboard);

        $adminDashboard = $auth->createPermission('adminDashboard');
        $adminDashboard->description = 'Access admin dashboard';
        $auth->add($adminDashboard);

        // Buat roles
        $user = $auth->createRole('user');
        $auth->add($user);
        $auth->addChild($user, $viewDashboard);

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $user); // Admin dapat melakukan semua yang user bisa
        $auth->addChild($admin, $adminDashboard);

        // Assign role admin ke user ID 1 (biasanya admin)
        $auth->assign($admin, 1);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m250405_100014_create_rbac_data cannot be reverted.\n";

        return false;
    }
    */
}
