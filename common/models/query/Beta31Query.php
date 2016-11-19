<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Beta31]].
 *
 * @see \common\models\Beta31
 */
class Beta31Query extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\Beta31[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\Beta31|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
