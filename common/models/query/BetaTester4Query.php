<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\BetaTester4]].
 *
 * @see \common\models\BetaTester4
 */
class BetaTester4Query extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\BetaTester4[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\BetaTester4|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
