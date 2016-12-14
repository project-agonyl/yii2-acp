<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\BundleItem]].
 *
 * @see \common\models\BundleItem
 */
class BundleItemQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\BundleItem[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\BundleItem|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
