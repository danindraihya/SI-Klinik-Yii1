<?php

class m210521_105808_create_table_biaya_tindakan extends CDbMigration
{
	// public function up()
	// {
	// }

	// public function down()
	// {
	// 	echo "m210521_104059_create_table_biaya_tindakan does not support migration down.\n";
	// 	return false;
	// }

	
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
		$this->createTable('biaya_tindakan', [
            'id' => 'pk',
            'pasien_id' => 'integer NOT NULL',
            'user_id' => 'integer NOT NULL',
            'tindakan_id' => 'integer NOT NULL',
            'total_harga' => 'integer NOT NULL',
            'status' => 'boolean NOT NULL default 0',
            'tanggal_periksa' => 'date NOT NULL',
        ]);

        // creates index for column `pasien_id`
        $this->createIndex(
            'idx-biaya_tindakan-pasien_id',
            'biaya_tindakan',
			'pasien_id'
        );

        // add foreign key for table `{{%pasien}}`
        $this->addForeignKey(
            'fk-biaya_tindakan-pasien_id',
            'biaya_tindakan',
            'pasien_id',
            'pasien',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-biaya_tindakan-user_id',
            'biaya_tindakan',
            'user_id'
        );

        // add foreign key for table `biaya_tindakan`
        $this->addForeignKey(
            'fk-biaya_tindakan-user_id',
            'biaya_tindakan',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `tindakan_id`
        $this->createIndex(
            'idx-biaya_tindakan-tindakan_id',
            'biaya_tindakan',
            'tindakan_id'
        );

        // add foreign key for table `{{%tindakan}}`
        $this->addForeignKey(
            'fk-biaya_tindakan-tindakan_id',
            'biaya_tindakan',
            'tindakan_id',
            'tindakan',
            'id',
            'CASCADE'
        );
	}

	public function safeDown()
	{
		$this->dropTable('biaya_tindakan');
	}
}