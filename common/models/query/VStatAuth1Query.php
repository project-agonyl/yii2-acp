<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\VStatAuth1]].
 *
 * @see \common\models\VStatAuth1
 */
class VStatAuth1Query extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\VStatAuth1[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\VStatAuth1|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
