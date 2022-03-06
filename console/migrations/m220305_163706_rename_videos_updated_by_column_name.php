<?php

use yii\db\Migration;

/**
 * Class m220305_163706_rename_videos_updated_by_column_name
 */
class m220305_163706_rename_videos_updated_by_column_name extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('{{%videos}}', 'updated_by', 'updated_at');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('{{%videos}}', 'updated_at', 'updated_by');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220305_163706_rename_videos_updated_by_column_name cannot be reverted.\n";

        return false;
    }
    */
}