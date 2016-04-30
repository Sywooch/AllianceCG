<?php

namespace app\components\rbac;
 
use Yii;
use yii\rbac\Rule;
 
/**
 * User group rule class.
 * Roles:
 * 
 * Administration
 * 
 * root - superuser
 * admin - administrator
 * 
 * Alliance:
 * 
 * chiefcredit - Head of Credit Department
 * creditmanager - Credit Specialist
 * 
 * Skoda:
 * 
 * skassistant - Skoda service assistant
 * skmastercons - Skoda service master-consultant
 * skdirector - Skoda Dealer Center Director
 * skservicehead - Skoda Head of Service
 */
class GroupRule extends Rule
{
    /**
     * @inheritdoc
     */
    public $name = 'group';
 
    /**
     * @inheritdoc
     */
    public function execute($user, $item, $params)
    {
        if (!Yii::$app->user->isGuest) {
            $role = Yii::$app->user->identity->role;
 
            if ($item->name === 'root') {
                return $role === $item->name;
            } 
            elseif ($item->name === 'admin') {
                return $role === $item->name;
            } 
            elseif ($item->name === 'chiefcredit') {
                return $role === $item->name;
            } 
            elseif ($item->name === 'seniorcreditspesialist') {
                return $role === $item->name || $role === 'chiefcredit';
            }
            elseif ($item->name === 'creditmanager') {
                return $role === $item->name;
            }
            elseif ($item->name === 'skassistant') {
                return $role === $item->name;
            } 
            elseif ($item->name === 'skmastercons') {
                return $role === $item->name;
            }
            elseif ($item->name === 'skservicehead') {
                return $role === $item->name;
            }
            elseif ($item->name === 'skdirector') {
                return $role === $item->name;
            }

            // if ($item->name === 'root') {
            //     return $role === $item->name;
            // } elseif ($item->name === 'admin') {
            //     return $role === $item->name || $role === 'root';
            // } 
            // elseif ($item->name === 'chiefcredit') {
            //     return $role === $item->name || $role === 'root' || $role === 'admin';
            // }
            // elseif ($item->name === 'creditmanager') {
            //     return $role === $item->name || $role === 'root' || $role === 'admin';
            // }
            // elseif ($item->name === 'head') {
            //     return $role === $item->name || $role === 'root' || $role === 'admin';
            // } elseif ($item->name === 'manager') {
            //     return $role === $item->name || $role === 'root' || $role === 'admin' || $role === 'head';
            // }
        }
        return false;
    }
}