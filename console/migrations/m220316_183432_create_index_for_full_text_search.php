<?php

use yii\db\Migration;

/**
 * Class m220316_183432_create_index_for_fulltext_search
 */
class m220316_183432_create_index_for_full_text_search extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        Yii::$app->db->createCommand("CREATE OR REPLACE FUNCTION make_tsvector(title TEXT, description TEXT, tags TEXT)
               RETURNS tsvector AS $$
            BEGIN
              RETURN (setweight(to_tsvector('english', title),'A') ||
                setweight(to_tsvector('english', description), 'B') || 
                setweight(to_tsvector('english', tags), 'C'));
            END
            $$ LANGUAGE 'plpgsql' IMMUTABLE;")->query();

        Yii::$app->db->createCommand(
            'CREATE INDEX IF NOT EXISTS idx_fts_videos ON videos USING gin(make_tsvector(title, description, tags));')
            ->query();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220316_183432_create_index_for_fulltext_search cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220316_183432_create_index_for_fulltext_search cannot be reverted.\n";

        return false;
    }
    */
}
