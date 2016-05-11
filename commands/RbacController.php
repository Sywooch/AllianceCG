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


        // PERMISSION "createCreditcalendarPost"
        $privateCreditcalendarPost = $auth->createPermission('privateCreditcalendarPost');
        $privateCreditcalendarPost->description = 'Alliance Creditcalendar Create Private Post';
        $auth->add($privateCreditcalendarPost);

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

        // PERMISSION "viewCreditcalendarPost"
        $viewCreditcalendarPost = $auth->createPermission('viewCreditcalendarPost');
        $viewCreditcalendarPost->description = 'Alliance Creditcalendar View post';
        $auth->add($viewCreditcalendarPost);  

        // PERMISSION TO VIEW OWN RECORDS FOR CREDITCALENDAR CONTROLLER
        // ADDED PERMISSION "viewCreditcalendarOwnPost" RELATED WITH CREDITCALENDAR AUTHOR RULE.
        $viewCreditcalendarOwnPost = $auth->createPermission('viewCreditcalendarOwnPost');
        $viewCreditcalendarOwnPost->description = 'View own post in Creditcalendar';
        $viewCreditcalendarOwnPost->ruleName = $creditcalendarAuthorRule->name;
        $auth->add($viewCreditcalendarOwnPost);   

        // PERMISSION "viewCreditcalendarPost"
        $deleteCreditcalendarPost = $auth->createPermission('deleteCreditcalendarPost');
        $deleteCreditcalendarPost->description = 'Alliance Creditcalendar Delete post';
        $auth->add($deleteCreditcalendarPost);    


        // PERMISSION TO EDIT OWN RECORDS FOR CREDITCALENDAR CONTROLLER
        // ADDED PERMISSION "updateCreditcalendarOwnPost" RELATED WITH CREDITCALENDAR AUTHOR RULE.
        $updateCreditcalendarOwnPost = $auth->createPermission('updateCreditcalendarOwnPost');
        $updateCreditcalendarOwnPost->description = 'Update own post in Creditcalendar';
        $updateCreditcalendarOwnPost->ruleName = $creditcalendarAuthorRule->name;
        $auth->add($updateCreditcalendarOwnPost);

        // PERMISSION "updateCreditcalendarOwnPost" USED FROM "updateCreditcalendarPost"
        $auth->addChild($updateCreditcalendarOwnPost, $updateCreditcalendarPost);


        // PERMISSION "viewCreditcalendarPost"
        $accessCreditReferences = $auth->createPermission('accessCreditReferences');
        $accessCreditReferences->description = 'Alliance Creditcalendar Delete post';
        $auth->add($accessCreditReferences);         

        // ===  CREDITCALENDAR_END  ===        

        // ===  SKODA_BEGIN ===

        // PERMISSION "skodaIsVisible"
        $skodaIsVisible = $auth->createPermission('skodaIsVisible');
        $skodaIsVisible->description = 'Skoda Module Is Visible Permission';
        $auth->add($skodaIsVisible);

        // ===  SKODA_END ===

        // ===  ADMIN_BEGIN ===

        // PERMISSION "adminIsVisible"
        $adminIsVisible = $auth->createPermission('adminIsVisible');
        $adminIsVisible->description = 'Admin Module Is Visible Permission';
        $auth->add($adminIsVisible);

        // ===  ADMIN_END ===
 
        // Roles
        $authGuest = $auth->createRole('authGuest');
        $authGuest->description = 'Default Auth Role';
        $authGuest->ruleName = $groupRule->name;
        $auth->add($authGuest); 

        $skassistant = $auth->createRole('skassistant');
        $skassistant->description = 'Skoda. Ассистент сервиса';
        $skassistant->ruleName = $groupRule->name;
        $auth->add($skassistant);     
        // PERMISSION TO VIEW SKODA MODULE
        $auth->addChild($skassistant, $skodaIsVisible);
 
        $skmastercons = $auth->createRole('skmastercons');
        $skmastercons ->description = 'Skoda. Мастер-консультант';
        $skmastercons ->ruleName = $groupRule->name;
        $auth->add($skmastercons);
        $auth->addChild($skmastercons, $skassistant);
        // PERMISSION TO VIEW SKODA MODULE
        $auth->addChild($skmastercons, $skodaIsVisible);
 
        $skservicehead = $auth->createRole('skservicehead');
        $skservicehead ->description = 'Skoda. Руководитель отдела сервиса';
        $skservicehead ->ruleName = $groupRule->name;
        $auth->add($skservicehead);
        $auth->addChild($skservicehead, $skmastercons);
        // PERMISSION TO VIEW SKODA MODULE
        $auth->addChild($skservicehead, $skodaIsVisible);
 
        $skdirector = $auth->createRole('skdirector');
        $skdirector ->description = 'Skoda. Директор дилерского центра';
        $skdirector ->ruleName = $groupRule->name;
        $auth->add($skdirector);
        $auth->addChild($skdirector, $skservicehead);
        // PERMISSION TO VIEW SKODA MODULE
        $auth->addChild($skdirector, $skodaIsVisible);

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
        $auth->addChild($chiefcredit, $updateCreditcalendarOwnPost);
        // PERMISSION TO SET RESPONSIBLE IN CREDITCALENDAR
        $auth->addChild($chiefcredit, $creditcalendarSetResponsibles);
        // PERMISSION TO VIEW CREDITCALENDAR COMPONENTS
        $auth->addChild($chiefcredit, $creditcalendarIsVisible);
        // PERMISSION TO DELETE CREDITCALENDAR COMPONENTS
        $auth->addChild($chiefcredit, $deleteCreditcalendarPost);
        // INHERITANCE PERMISSION TO VIEW OWN RECORDS IN Creditcalendar
        $auth->addChild($chiefcredit, $viewCreditcalendarOwnPost); 
        // PERMISSION TO CREATE PRIVATE RECORDS IN Creditcalendar
        $auth->addChild($chiefcredit, $privateCreditcalendarPost);
        // PERMISSION TO CREATE RECORDS IN Credit References
        $auth->addChild($chiefcredit, $accessCreditReferences);

        // SENIOR CREDIT SPECIALIST
        $seniorcreditspesialist = $auth->createRole('seniorcreditspesialist');
        $seniorcreditspesialist->description = 'SENIOR CREDIT SPECIALIST';
        $seniorcreditspesialist->ruleName = $groupRule->name;
        $auth->add($seniorcreditspesialist);
        // INHERITANCE FROM creditmanager ROLE
        $auth->addChild($seniorcreditspesialist, $creditmanager);
        // INHERITANCE FROM chiefcredit ROLE
        $auth->addChild($seniorcreditspesialist, $chiefcredit);
        // INHERITANCE PERMISSION TO CREATE RECORDS IN Creditcalendar
        $auth->addChild($seniorcreditspesialist, $createCreditcalendarPost);
        // INHERITANCE PERMISSION TO UPDATE RECORDS IN Creditcalendar
        $auth->addChild($seniorcreditspesialist, $updateCreditcalendarOwnPost);
        // PERMISSION TO SET RESPONSIBLE IN CREDITCALENDAR
        $auth->addChild($seniorcreditspesialist, $creditcalendarSetResponsibles);   
        // INHERITANCE PERMISSION TO VIEW OWN RECORDS IN Creditcalendar
        $auth->addChild($seniorcreditspesialist, $viewCreditcalendarOwnPost);   
        // PERMISSION TO VIEW CREDITCALENDAR COMPONENTS
        $auth->addChild($seniorcreditspesialist, $creditcalendarIsVisible);
        // PERMISSION TO DELETE CREDITCALENDAR COMPONENTS
        $auth->addChild($seniorcreditspesialist, $deleteCreditcalendarPost);
        // PERMISSION TO CREATE PRIVATE RECORDS IN Creditcalendar
        $auth->addChild($seniorcreditspesialist, $privateCreditcalendarPost);
        // PERMISSION TO CREATE RECORDS IN Credit References
        $auth->addChild($seniorcreditspesialist, $accessCreditReferences);

        // ===   CREDIT_DEPARTMENT_END   ===
        
        // ===   APPLICATION_ADMINITSRATION   ===
 
        $admin = $auth->createRole('admin');
        $admin->description = 'Администратор';
        $admin->ruleName = $groupRule->name;
        $auth->add($admin);
        // INHERITANCE PERMISSION TO CREATE RECORDS IN Creditcalendar
        $auth->addChild($admin, $createCreditcalendarPost);
        // INHERITANCE PERMISSION TO UPDATE RECORDS IN Creditcalendar
        $auth->addChild($admin, $updateCreditcalendarPost);
        // PERMISSION TO SET RESPONSIBLE IN CREDITCALENDAR
        $auth->addChild($admin, $creditcalendarSetResponsibles);
        // PERMISSION TO VIEW CREDITCALENDAR COMPONENTS
        $auth->addChild($admin, $creditcalendarIsVisible);
        // PERMISSION TO VIEW ADMIN COMPONENTS
        $auth->addChild($admin, $adminIsVisible);
        // PERMISSION TO VIEW SKODA MODULE
        $auth->addChild($admin, $skodaIsVisible);
        // CHILD TO CHIEFCREDIT ROLE
        $auth->addChild($admin, $skdirector);
        $auth->addChild($admin, $deleteCreditcalendarPost);
 
        $root = $auth->createRole('root');
        $root->description = 'Superuser';
        $root->ruleName = $groupRule->name;
        $auth->add($root);
        $auth->addChild($root, $admin);
        
        // ===   APPLICATION_ADMINITSRATION   ===
 
        // Superadmin assignments
        if ($id !== null) {
            $auth->assign($root, $id);
        }
    }
}