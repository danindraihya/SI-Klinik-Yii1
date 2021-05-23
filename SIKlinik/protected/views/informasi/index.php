<?php
/* @var $this InformasiController */

$this->breadcrumbs=array(
	'Informasi',
);
?>
<h1>Pembayaran</h1>

<div>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Umur</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                
                foreach($pasienBayar as $pasien) {

					$antrianPasien = Yii::app()->db->createCommand()
						->from('pasien')
						->where('id=:id', array(':id' => $pasien['pasien_id']))
						->queryAll();
                    
                    ?>
                    <tr>
                        <th scope="row"><?= $antrianPasien[0]['id']; ?></th>
                        <td><?= $antrianPasien[0]['nama']; ?></td>
                        <td><?= $antrianPasien[0]['umur']; ?></td>
                        <td>Menunggu Pembayaran</td>
						<td><?= CHtml::link('Bayar', $this->createAbsoluteUrl('informasi/update', array('idPasien'=>$antrianPasien[0]['id'], 'idUser'=>$pasien['user_id'])), array('class' => 'btn btn-primary btn-sm')) ?></td>
                    <tr>
                    <?php
                }

                foreach($pasienSelesai as $pasien) {

					$antrianPasien = Yii::app()->db->createCommand()
						->from('pasien')
						->where('id=:id', array(':id' => $pasien['pasien_id']))
						->queryAll();

                    ?>
                    <tr>
                        <th scope="row"><?= $antrianPasien[0]['id']; ?></th>
                        <td><?= $antrianPasien[0]['nama']; ?></td>
                        <td><?= $antrianPasien[0]['umur']; ?></td>
                        <td>Selesai Pembayaran</td>
                        <td><?= CHtml::link('Lihat', $this->createAbsoluteUrl('informasi/history', array('idPasien'=>$antrianPasien[0]['id'], 'idUser'=>$pasien['user_id'])), array('class' => 'btn btn-secondary btn-sm')) ?></td>
                    <tr>
                    <?php
                }
            ?>
        </tbody>
    </table>
</div>
