<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\QuestList]].
 *
 * @see \common\models\QuestList
 */
class QuestListQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\QuestList[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\QuestList|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
