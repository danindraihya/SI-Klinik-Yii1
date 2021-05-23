<?php

class m210521_102701_create_pasien_table extends CDbMigration
{
	// public function up()
	// {
	// }

	// public function down()
	// {
	// 	echo "m210521_102701_create_pasien_table does not support migration down.\n";
	// 	return false;
	// }

	
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
		$this->createTable('pasien', [
			'id' => 'pk',
			'nama' => 'string NOT NULL',
			'umur' => 'integer NOT NULL',
            'status' => 'boolean NOT NULL default 0',
			'cash' => 'integer NOT NULL default 0',
            'tanggal_periksa' => 'date NOT NULL'
			
		]);
	}

	public function safeDown()
	{
		$this->dropTable('pasien');
	}
	
}