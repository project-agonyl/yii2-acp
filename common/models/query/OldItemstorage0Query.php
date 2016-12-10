<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\OldItemstorage0]].
 *
 * @see \common\models\OldItemstorage0
 */
class OldItemstorage0Query extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\OldItemstorage0[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\OldItemstorage0|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
