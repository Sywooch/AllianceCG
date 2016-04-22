<?php

namespace app\commands;
 
use Yii;
use yii\console\Controller;
use app\components\rbac\GroupRule;
use app\components\rbac\CreditcalendarAuthorRule;
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


        // CREDITCALENDAR RULE TO CHECK AUTOR OF RECORDS
        $creditcalendarAuthorRule = new CreditcalendarAuthorRule();
        $auth->add($creditcalendarAuthorRule);


        // PERMISSIONS

        // ===  CREDITCALENDAR_BEGIN  ===

        // PERMISSION "createCreditcalendarPost"
        $createCreditcalendarPost = $auth->createPermission('createCreditcalendarPost');
        $createCreditcalendarPost->description = 'Alliance Creditcalendar Create Post';
        $auth->add($createCreditcalendarPost);

        // PERMISSION "creditcalendarIsVisible"
        $creditcalendarIsVisible = $auth->createPermission('creditcalendarIsVisible');
        $creditcalendarIsVisible->description = 'Alliance Creditcalendar Is Visible Permission';
        $auth->add($creditcalendarIsVisible);

        // PERMISSION "creditcalendarSetResponsibles"
        $creditcalendarSetResponsibles = $auth->createPermission('creditcalendarSetResponsibles');
        $creditcalendarSetResponsibles->description = 'Alliance Creditcalendar Set Responsibles';
        $auth->add($creditcalendarSetResponsibles);

        // PERMISSION "updateCreditcalendarPost"
        $updateCreditcalendarPost = $auth->createPermission('updateCreditcalendarPost');
        $updateCreditcalendarPost->description = 'Alliance Creditcalendar Update post';
        $auth->add($updateCreditcalendarPost);        


        // PERMISSION TO EDIT OWN RECORDS FOR CREDITCALENDAR CONTROLLER
        // ADDED PERMISSION "updateCreditcalendarOwnPost" RELATED WITH CREDITCALENDAR AUTHOR RULE.
        $updateCreditcalendarOwnPost = $auth->createPermission('updateCreditcalendarOwnPost');
        $updateCreditcalendarOwnPost->description = 'Update own post in Creditcalendar';
        $updateCreditcalendarOwnPost->ruleName = $creditcalendarAuthorRule->name;
        $auth->add($updateCreditcalendarOwnPost);

        // PERMISSION "updateCreditcalendarOwnPost" USED FROM "updateCreditcalendarPost"
        $auth->addChild($updateCreditcalendarOwnPost, $updateCreditcalendarPost);

        // ===  CREDITCALENDAR_END  ===        
 
        // Roles
        $skassistant = $auth->createRole('skassistant');
        $skassistant->description = 'Skoda. Ассистент сервиса';
        $skassistant->ruleName = $groupRule->name;
        $auth->add($skassistant);     
 
        $skmastercons = $auth->createRole('skmastercons');
        $skmastercons ->description = 'Skoda. Мастер-консультант';
        $skmastercons ->ruleName = $groupRule->name;
        $auth->add($skmastercons);
        $auth->addChild($skmastercons, $skassistant);
 
        $skservicehead = $auth->createRole('skservicehead');
        $skservicehead ->description = 'Skoda. Руководитель отдела сервиса';
        $skservicehead ->ruleName = $groupRule->name;
        $auth->add($skservicehead);
        $auth->addChild($skservicehead, $skmastercons);
 
        $skdirector = $auth->createRole('skdirector');
        $skdirector ->description = 'Skoda. Директор дилерского центра';
        $skdirector ->ruleName = $groupRule->name;
        $auth->add($skdirector);
        $auth->addChild($skdirector, $skservicehead);

        // ===   CREDIT_DEPARTMENT_BEGIN   ===
        
        // CREDIT MANAGER
        $creditmanager = $auth->createRole('creditmanager');
        $creditmanager ->description = 'Credit Manager';
        $creditmanager ->ruleName = $groupRule->name;
        $auth->add($creditmanager);
        // ALLOW TO UPDATE OWN RECORDS IN CREDITCALENDAR CONTROLLER
        $auth->addChild($creditmanager, $updateCreditcalendarOwnPost);
        // ALLOW TO CREATE RECORDS
        $auth->addChild($creditmanager, $createCreditcalendarPost);
        // PERMISSION TO VIEW CREDITCALENDAR COMPONENTS
        $auth->addChild($creditmanager, $creditcalendarIsVisible);

        // CHIEF OF CREDIT DEPARTMENT
        $chiefcredit = $auth->createRole('chiefcredit');
        $chiefcredit->description = 'Chief of Credit Department';
        $chiefcredit->ruleName = $groupRule->name;
        $auth->add($chiefcredit);
        // INHERITANCE FROM creditmanager ROLE
        $auth->addChild($chiefcredit, $creditmanager);
        // INHERITANCE PERMISSION TO CREATE RECORDS IN Creditcalendar
        $auth->addChild($chiefcredit, $createCreditcalendarPost);
        // INHERITANCE PERMISSION TO UPDATE RECORDS IN Creditcalendar
        $auth->addChild($chiefcredit, $updateCreditcalendarPost);
        // PERMISSION TO SET RESPONSIBLE IN CREDITCALENDAR
        $auth->addChild($chiefcredit, $creditcalendarSetResponsibles);
        // PERMISSION TO VIEW CREDITCALENDAR COMPONENTS
        $auth->addChild($chiefcredit, $creditcalendarIsVisible);

        // ===   CREDIT_DEPARTMENT_END   ===
 
        $admin = $auth->createRole('admin');
        $admin->description = 'Администратор';
        $admin->ruleName = $groupRule->name;
        $auth->add($admin);
        // $auth->addChild($admin, $head);
 
        $root = $auth->createRole('root');
        $root->description = 'Superuser';
        $root->ruleName = $groupRule->name;
        $auth->add($root);
        $auth->addChild($root, $admin);
 
        // Superadmin assignments
        if ($id !== null) {
            $auth->assign($root, $id);
        }
    }
}