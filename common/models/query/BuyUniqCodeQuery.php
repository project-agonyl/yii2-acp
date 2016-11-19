<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\BuyUniqCode]].
 *
 * @see \common\models\BuyUniqCode
 */
class BuyUniqCodeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\BuyUniqCode[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\BuyUniqCode|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
