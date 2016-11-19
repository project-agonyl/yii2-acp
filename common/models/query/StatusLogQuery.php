<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\StatusLog]].
 *
 * @see \common\models\StatusLog
 */
class StatusLogQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\StatusLog[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\StatusLog|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
