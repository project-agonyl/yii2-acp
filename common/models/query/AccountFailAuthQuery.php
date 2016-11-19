<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\AccountFailAuth]].
 *
 * @see \common\models\AccountFailAuth
 */
class AccountFailAuthQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\AccountFailAuth[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\AccountFailAuth|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
