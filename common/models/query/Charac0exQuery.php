<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Charac0ex]].
 *
 * @see \common\models\Charac0ex
 */
class Charac0exQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\Charac0ex[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\Charac0ex|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
