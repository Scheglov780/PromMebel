<?php

use yii\db\Migration;

/**
 * Class m200414_162251_init_migrate
 */
class m200414_162251_init_migrate extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200414_162251_init_migrate cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200414_162251_init_migrate cannot be reverted.\n";

        return false;
    }
    */
}
