<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\EventPoints]].
 *
 * @see \common\models\EventPoints
 */
class EventPointsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\EventPoints[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\EventPoints|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
