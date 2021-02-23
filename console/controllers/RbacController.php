<?php
/**
 * Created by PhpStorm.
 * User: ANDREW
 * Date: 7/19/2016
 * Time: 11:47 AM
 */

namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

// Create simple, permissions


        // add "index" permission
        $index = $auth->createPermission('index');
        $index->description = 'Index';
        $auth->add($index);

        // add "error" permission
        $error = $auth->createPermission('error');
        $error->description = 'Error';
        $auth->add($error);

        // add "sign-up" permission
        $signup = $auth->createPermission('signup');
        $signup->description = 'Sign-up';
        $auth->add($signup);

        // add "create" permission
        $create = $auth->createPermission('create');
        $create->description = 'Create';
        $auth->add($create);

        // add "update" permission
        $update = $auth->createPermission('update');
        $update->description = 'Update';
        $auth->add($update);

        // add "delete" permission
        $delete = $auth->createPermission('delete');
        $delete->description = 'Delete';
        $auth->add($delete);

        // add "login" permission
        $login = $auth->createPermission('login');
        $login->description = 'Log In';
        $auth->add($login);

        // add "logout" permission
        $logout = $auth->createPermission('logout');
        $logout->description = 'Logout';
        $auth->add($logout);


        // add "customer" role and give this role the "sign-up" permission
        $customer = $auth->createRole('customer');
        $auth->add($customer);
        $auth->addChild($customer, $signup);
        $auth->addChild($customer, $index);
        $auth->addChild($customer, $login);
        $auth->addChild($customer, $logout);

        // add "admin" role and give this role the "All" permissions
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $index);
        $auth->addChild($admin, $login);
        $auth->addChild($admin, $logout);
        $auth->addChild($admin, $create);
        $auth->addChild($admin, $update);
        $auth->addChild($admin, $delete);
        $auth->addChild($admin, $error);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($admin, 1);
      
    }
}