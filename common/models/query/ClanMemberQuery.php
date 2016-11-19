<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\ClanMember]].
 *
 * @see \common\models\ClanMember
 */
class ClanMemberQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\ClanMember[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\ClanMember|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
