<?php

class m210521_104035_create_table_obat extends CDbMigration
{
	// public function up()
	// {
	// }

	// public function down()
	// {
	// 	echo "m210521_104035_create_table_obat does not support migration down.\n";
	// 	return false;
	// }

	
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
		$this->createTable('obat', [
            'id' => 'pk',
            'nama' => 'string NOT NULL',
            'harga' => 'integer NOT NULL',
        ]);
	}

	public function safeDown()
	{
		$this->dropTable('obat');
	}
	
}