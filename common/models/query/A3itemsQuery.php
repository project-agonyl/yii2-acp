<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\A3items]].
 *
 * @see \common\models\A3items
 */
class A3itemsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\A3items[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\A3items|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
