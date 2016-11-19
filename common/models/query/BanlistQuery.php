<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Banlist]].
 *
 * @see \common\models\Banlist
 */
class BanlistQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\Banlist[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\Banlist|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
