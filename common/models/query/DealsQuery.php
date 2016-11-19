<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Deals]].
 *
 * @see \common\models\Deals
 */
class DealsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\Deals[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\Deals|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
