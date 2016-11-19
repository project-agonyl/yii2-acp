<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\FRIEND0]].
 *
 * @see \common\models\FRIEND0
 */
class FRIEND0Query extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\FRIEND0[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\FRIEND0|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
