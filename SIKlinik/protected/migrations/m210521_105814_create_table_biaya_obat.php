<?php

class m210521_105814_create_table_biaya_obat extends CDbMigration
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
		$this->createTable('biaya_obat', [
            'id' => 'pk',
            'pasien_id' => 'integer NOT NULL',
            'obat_id' => 'integer NOT NULL',
			'jumlah' => 'integer NOT NULL',
            'total_harga' => 'integer NOT NULL',
            'status' => 'boolean NOT NULL default 0',
            'tanggal_periksa' => 'date NOT NULL',
        ]);

        // creates index for column `pasien_id`
        $this->createIndex(
            'idx-biaya_obat-pasien_id',
            'biaya_obat',
			'pasien_id'
        );

        // add foreign key for table `{{%pasien}}`
        $this->addForeignKey(
            'fk-biaya_obat-pasien_id',
            'biaya_obat',
            'pasien_id',
            'pasien',
            'id',
            'CASCADE'
        );

        // creates index for column `obat_id`
        $this->createIndex(
            'idx-biaya_obat-obat_id',
            'biaya_obat',
            'obat_id'
        );

        // add foreign key for table `{{%tindakan}}`
        $this->addForeignKey(
            'fk-biaya_obat-obat_id',
            'biaya_obat',
            'obat_id',
            'obat',
            'id',
            'CASCADE'
        );
	}

	public function safeDown()
	{
		$this->dropTable('biaya_obat');
	}
}