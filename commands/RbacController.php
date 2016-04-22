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


        // Creditcalendar правило проверки автора записи
        $creditcalendarAuthorRule = new CreditcalendarAuthorRule();
        $auth->add($creditcalendarAuthorRule);


        // Permissions

        // Разрешение "createCreditcalendarPost"
        $createCreditcalendarPost = $auth->createPermission('createCreditcalendarPost');
        $createCreditcalendarPost->description = 'Alliance Creditcalendar Create Post';
        $auth->add($createCreditcalendarPost);

        // Разрешение "updateCreditcalendarPost"
        $updateCreditcalendarPost = $auth->createPermission('updateCreditcalendarPost');
        $updateCreditcalendarPost->description = 'Alliance Creditcalendar Update post';
        $auth->add($updateCreditcalendarPost);        


        // Разрешение редактирования собственных записей в Контроллере Creditcalendar.

        // добавляем разрешение "updateCreditcalendarOwnPost" и привязываем к нему правило.
        $updateCreditcalendarOwnPost = $auth->createPermission('updateCreditcalendarOwnPost');
        $updateCreditcalendarOwnPost->description = 'Update own post in Creditcalendar';
        $updateCreditcalendarOwnPost->ruleName = $creditcalendarAuthorRule->name;
        $auth->add($updateCreditcalendarOwnPost);

        // "updateCreditcalendarOwnPost" используется из "updateCreditcalendarPost"
        $auth->addChild($updateCreditcalendarOwnPost, $updateCreditcalendarPost);        
 
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
        
        // Кредитный специалист
        $creditmanager = $auth->createRole('creditmanager');
        $creditmanager ->description = 'Кредитный специалист';
        $creditmanager ->ruleName = $groupRule->name;
        $auth->add($creditmanager);
        // Разрешение редактирования собственных записей
        $auth->addChild($creditmanager, $updateCreditcalendarOwnPost);
        // Разрешение создания записей
        $auth->addChild($creditmanager, $createCreditcalendarPost);

        // Руководитель ОКиС
        $chiefcredit = $auth->createRole('chiefcredit');
        $chiefcredit->description = 'Руководитель ОКиС';
        $chiefcredit->ruleName = $groupRule->name;
        $auth->add($chiefcredit);
        // Наследование от роли "Кредитный специалист"
        $auth->addChild($chiefcredit, $creditmanager);
        // Наследование разрешения создания записей контроллера Creditcalendar
        $auth->addChild($chiefcredit, $createCreditcalendarPost);
        // Наследование разрешения редактирования записей контроллера Creditcalendar
        $auth->addChild($chiefcredit, $updateCreditcalendarPost);
 
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