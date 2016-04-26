<?php

namespace app\modules\alliance\models\query;

/**
 * This is the ActiveQuery class for [[\app\modules\alliance\models\Creditcalendar]].
 *
 * @see \app\modules\alliance\models\Creditcalendar
 */
class CalendarQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\modules\alliance\models\Creditcalendar[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\modules\alliance\models\Creditcalendar|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
