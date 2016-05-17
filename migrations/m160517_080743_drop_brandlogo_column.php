<?php

use yii\db\Migration;

/**
 * Handles the dropping for table `brandlogo_column`.
 */
class m160517_080743_drop_brandlogo_column extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropColumn('{{%companies}}', 'company_logo');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        echo "m160517_080743_drop_brandlogo_column cannot be reverted.\n";

        return false;
    }
}
