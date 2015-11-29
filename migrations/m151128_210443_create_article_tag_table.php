<?php

use yii\db\Schema;
use yii\db\Migration;

class m151128_210443_create_article_tag_table extends Migration {

    public function up() {
        $this->createTable('{{article_tag}}', [
            'article_id' => $this->integer()->notNull(),
            'tag_id' => $this->integer()->notNull(),
        ]);
    }

    public function down() {
        if ($this->db->schema->getTableSchema('{{article_tag}}', true) !== null) {
            $this->dropTable('{{article_tag}}');
        }
    }

}
