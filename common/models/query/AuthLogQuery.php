<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\AuthLog]].
 *
 * @see \common\models\AuthLog
 */
class AuthLogQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\AuthLog[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\AuthLog|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
