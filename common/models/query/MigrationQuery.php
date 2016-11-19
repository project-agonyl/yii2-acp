<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Migration]].
 *
 * @see \common\models\Migration
 */
class MigrationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\Migration[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\Migration|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
