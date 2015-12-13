<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "article_tags".
 *
 * @property integer $article_id
 * @property integer $tag_id
 */
class ArticleTags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['article_id', 'tag_id'], 'required'],
            [['article_id', 'tag_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'article_id' => 'Article ID',
            'tag_id' => 'Tag ID',
        ];
    }
}
