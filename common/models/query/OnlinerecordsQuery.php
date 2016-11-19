<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Onlinerecords]].
 *
 * @see \common\models\Onlinerecords
 */
class OnlinerecordsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\Onlinerecords[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\Onlinerecords|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
