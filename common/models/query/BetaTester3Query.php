<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\BetaTester3]].
 *
 * @see \common\models\BetaTester3
 */
class BetaTester3Query extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\BetaTester3[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\BetaTester3|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
