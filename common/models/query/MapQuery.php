<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Map]].
 *
 * @see \common\models\Map
 */
class MapQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\Map[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\Map|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
