<?php

namespace app\commands;
 
use Yii;
use yii\console\Controller;
use app\components\rbac\GroupRule;
use yii\rbac\DbManager;
 
/**
 * RBAC console controller.
 */
class RbacController extends Controller
{
    /**
     * Initial RBAC action
     * @param integer $id Superadmin ID
     */
    public function actionInit($id = null)
    {
        $auth = new DbManager;
        $auth->init();
 
        $auth->removeAll(); //удаляем старые данные
        // Rules
        $groupRule = new GroupRule();
 
        $auth->add($groupRule);
 
        // Roles
        $manager = $auth->createRole('manager');
        $manager->description = 'Manager';
        $manager->ruleName = $groupRule->name;
        $auth->add($manager);
 
        $head = $auth->createRole(' head ');
        $head ->description = 'head ';
        $head ->ruleName = $groupRule->name;
        $auth->add($head);
        $auth->addChild($head, $manager);
 
        $admin = $auth->createRole('admin');
        $admin->description = 'Admin';
        $admin->ruleName = $groupRule->name;
        $auth->add($admin);
        $auth->addChild($admin, $head);
 
        $root = $auth->createRole('root');
        $root->description = 'root';
        $root->ruleName = $groupRule->name;
        $auth->add($root);
        $auth->addChild($root, $admin);
 
        // Superadmin assignments
        if ($id !== null) {
            $auth->assign($root, $id);
        }
    }
}