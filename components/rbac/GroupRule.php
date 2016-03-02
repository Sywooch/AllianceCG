<?php

namespace app\components\rbac;
 
use Yii;
use yii\rbac\Rule;
 
/**
 * User group rule class.
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
            } elseif ($item->name === 'admin') {
                return $role === $item->name || $role === 'root';
            } elseif ($item->name === 'head') {
                return $role === $item->name || $role === 'root' || $role === 'admin';
            } elseif ($item->name === 'manager') {
                return $role === $item->name || $role === 'root' || $role === 'admin' || $role === 'head';
            }
        }
        return false;
    }
}