<?php

namespace common\models;

use Yii;
use \common\models\base\AccountInfo as BaseAccountInfo;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "AccountInfo".
 */
class AccountInfo extends BaseAccountInfo
{
    const THEME_DEFAULT = 'default';
    const THEME_CERULEAN = 'cerulean';
    const THEME_COSMO = 'cosmo';
    const THEME_CYBORG = 'cyborg';
    const THEME_DARKLY = 'darkly';
    const THEME_FLATLY = 'flatly';
    const THEME_JOURNAL = 'journal';
    const THEME_LUMEN = 'lumen';
    const THEME_PAPER = 'paper';
    const THEME_READABLE = 'readable';
    const THEME_SANDSTONE = 'sandstone';
    const THEME_SIMPLEX = 'simplex';
    const THEME_SLATE = 'slate';
    const THEME_SPACELAB = 'spacelab';
    const THEME_SUPERHERO = 'superhero';
    const THEME_UNITED = 'united';
    const THEME_YETI = 'yeti';

    public function behaviors()
    {
        return [];
    }

    public function rules()
    {
        return ArrayHelper::merge(
             parent::rules(),
             [
                 [['contact', 'name', 'theme']
                     , 'filter', 'filter' => '\yii\helpers\HtmlPurifier::process']
             ]
        );
    }

    public function scenarios()
    {
        return ArrayHelper::merge(
            parent::scenarios(),
            [
                'update' => ['contact', 'name', 'theme']
            ]
        );
    }

    public static function getThemes()
    {
        return [
            self::THEME_DEFAULT => ucwords(self::THEME_DEFAULT),
            self::THEME_CERULEAN => ucwords(self::THEME_CERULEAN),
            self::THEME_COSMO => ucwords(self::THEME_COSMO),
            self::THEME_CYBORG => ucwords(self::THEME_CYBORG),
            self::THEME_DARKLY => ucwords(self::THEME_DARKLY),
            self::THEME_FLATLY => ucwords(self::THEME_FLATLY),
            self::THEME_JOURNAL => ucwords(self::THEME_JOURNAL),
            self::THEME_LUMEN => ucwords(self::THEME_LUMEN),
            self::THEME_PAPER => ucwords(self::THEME_PAPER),
            self::THEME_READABLE => ucwords(self::THEME_READABLE),
            self::THEME_SANDSTONE => ucwords(self::THEME_SANDSTONE),
            self::THEME_SIMPLEX => ucwords(self::THEME_SIMPLEX),
            self::THEME_SLATE => ucwords(self::THEME_SLATE),
            self::THEME_SPACELAB => ucwords(self::THEME_SPACELAB),
            self::THEME_SUPERHERO => ucwords(self::THEME_SUPERHERO),
            self::THEME_UNITED => ucwords(self::THEME_UNITED),
            self::THEME_YETI => ucwords(self::THEME_YETI)
        ];
    }

    public static function getThemeCssUrl($theme)
    {
        if ($theme == self::THEME_DEFAULT) {
            return '#';
        }
        return 'https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/'.$theme.'/bootstrap.min.css';
    }
}
