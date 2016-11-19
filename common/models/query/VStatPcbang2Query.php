<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\VStatPcbang2]].
 *
 * @see \common\models\VStatPcbang2
 */
class VStatPcbang2Query extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\VStatPcbang2[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\VStatPcbang2|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
