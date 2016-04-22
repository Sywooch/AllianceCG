<?php

namespace app\commands;
 
use Yii;
use yii\console\Controller;
use app\components\rbac\GroupRule;
use app\components\rbac\AuthorRule;
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
 
        $auth->removeAll(); 

        $groupRule = new GroupRule(); 
        $auth->add($groupRule);

        // $authorRule = new AuthorRule();
        // $auth->add($authorRule);
 
        // Roles
        $skassistant = $auth->createRole('skassistant');
        $skassistant->description = 'Skoda. Ассистент сервиса';
        $skassistant->ruleName = $groupRule->name;
        $auth->add($skassistant);     
 
        $skmastercons = $auth->createRole('skmastercons');
        $skmastercons ->description = 'Skoda. Мастер-консультант';
        $skmastercons ->ruleName = $groupRule->name;
        $auth->add($skmastercons);
        // $auth->addChild($head, $manager); 
 
        $skservicehead = $auth->createRole('skservicehead');
        $skservicehead ->description = 'Skoda. Руководитель отдела сервиса';
        $skservicehead ->ruleName = $groupRule->name;
        $auth->add($skservicehead);
        // $auth->addChild($head, $manager); 
 
        $skdirector = $auth->createRole('skdirector');
        $skdirector ->description = 'Skoda. Директор дилерского центра';
        $skdirector ->ruleName = $groupRule->name;
        $auth->add($skdirector);
        // $auth->addChild($head, $manager);
        
        $creditmanager = $auth->createRole('creditmanager');
        $creditmanager ->description = 'Кредитный специалист';
        $creditmanager ->ruleName = $groupRule->name;
        $auth->add($creditmanager);

        $chiefcredit = $auth->createRole('chiefcredit');
        $chiefcredit->description = 'Руководитель ОКиС';
        $chiefcredit->ruleName = $groupRule->name;
        $auth->add($chiefcredit);   
 
        $admin = $auth->createRole('admin');
        $admin->description = 'Администратор';
        $admin->ruleName = $groupRule->name;
        $auth->add($admin);
        // $auth->addChild($admin, $head);
 
        $root = $auth->createRole('root');
        $root->description = 'Superuser';
        $root->ruleName = $groupRule->name;
        $auth->add($root);
        // $auth->addChild($root, $admin);
        
        // add "author" role and give this role the "createPost" permission
        $author = $auth->createRole('author');
        $auth->add($author);
        // $auth->addChild($author, $createPost);

        $updateOwn = $auth->createPermission('updateOwn');
        $updateOwn->description = 'User can update own records';
        $auth->add($updateOwn);
        $auth->addChild($author, $updateOwn);

 
        // Superadmin assignments
        if ($id !== null) {
            $auth->assign($root, $id);
        }
    }
}