<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\AdultCheck]].
 *
 * @see \common\models\AdultCheck
 */
class AdultCheckQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\AdultCheck[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\AdultCheck|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
