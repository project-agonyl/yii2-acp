<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\ActivityLog]].
 *
 * @see \common\models\ActivityLog
 */
class ActivityLogQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\ActivityLog[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\ActivityLog|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
