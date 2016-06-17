<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "files".
 *
 * @property integer $file_id
 * @property integer $object_type_id
 * @property integer $object_id
 * @property string $name
 * @property string $mime_type
 */
class Files extends ActiveRecord
{
    const OBJECT_TYPE_FOR_PRODUCTS = 1;
    const OBJECT_TYPE_FOR_ARTICLES = 2;
    const OBJECT_TYPE_FOR_NEWS = 3;
    const OBJECT_TYPE_FOR_CATEGORIES = 4;
    const OBJECT_TYPE_FOR_USERS = 5;
    const OBJECT_TYPE_FOR_COMMERCIAL = 6;
    const OBJECT_TYPE_FOR_BRANDS = 7;

    // Scenarios download files of different types
    const SCENARIO_IMAGE = 'image123';

    /**
     * @var yii\web\UploadedFile
     */
    public $file;

    public $downloadFile;

    public static function tableName()
    {
        return 'files';
    }

    public function rules()
    {
        return [
            [['object_type_id', 'object_id'], 'required'],
            [['object_type_id', 'object_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['mime_type'], 'string'],
            [['downloadFile'], 'image',
//                'skipOnEmpty' => false, // TODO: ??
                'extensions' => 'png, jpg',
                'on' => self::SCENARIO_IMAGE,
                'minWidth' => 100, 'maxWidth' => 2000,
                'minHeight' => 100, 'maxHeight' => 2000,
                'message' => 'test',
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'file_id' => 'ID файла',
            'object_type_id' => 'ID типа объекта',
            'object_id' => 'ID объекта',
            'name' => 'название файла',
            'mime_type' => 'тип файла',
        ];
    }

    /** 1. saving file (random name)
     *     DB
     *  2. DB
     *     saving file (with DB keys)
     */
    public function upload()
    {
//        var_dump($this->downloadFile);
        if ($this->validate()) {
            $path = Yii::getAlias('@app') . '/uploads/' . $this->object_type_id . DIRECTORY_SEPARATOR . $this->object_id ;
//            $structure = dirname(__DIR__) . '/uploads/487/asd/7/';
            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }
            $this->file->saveAs($path . '/'. $this->file_id . '.' . $this->file->extension);
            return true;
        } else {
            return false;
        }
    }

}