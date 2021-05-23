<?php

class m210521_104041_create_table_tindakan extends CDbMigration
{
	// public function up()
	// {
	// }

	// public function down()
	// {
	// 	echo "m210521_104041_create_table_tindakan does not support migration down.\n";
	// 	return false;
	// }

	
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
		$this->createTable('tindakan', [
            'id' => 'pk',
            'nama' => 'string NOT NULL',
            'biaya' => 'integer NOT NULL',
        ]);
	}

	public function safeDown()
	{
		$this->dropTable('tindakan');
	}
	
}