<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\FaultMailAccount]].
 *
 * @see \common\models\FaultMailAccount
 */
class FaultMailAccountQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\FaultMailAccount[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\FaultMailAccount|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
