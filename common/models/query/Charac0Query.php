<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Charac0]].
 *
 * @see \common\models\Charac0
 */
class Charac0Query extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\Charac0[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\Charac0|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
