<?php

class m210521_105245_create_user_table extends CDbMigration
{
	// public function up()
	// {
		
	// }

	// public function down()
	// {
	// 	echo "m210521_105245_create_user_table does not support migration down.\n";
	// 	return false;
	// }

	
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
		$this->createTable('user', [
			'id' => 'pk',
			'username' => 'string NOT NULL',
			'password' => 'string NOT NULL',
			'nama' => 'string NOT NULL',
			'jabatan' => 'string NOT NULL'
		]);
	}

	public function safeDown()
	{
		$this->dropTabele('user');
	}
	
}