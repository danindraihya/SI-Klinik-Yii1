<?php
/* @var $this TransaksiController */

$this->breadcrumbs=array(
	'Transaksi',
);
?>


<h1>Antrian</h1>

<table class="table table-striped">
	
<thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nama Pasien</th>
      <th scope="col">Umur</th>
	  <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
	  <?php
		foreach($antrianPasien as $pasien) {
	  ?>
    	<tr>
			<th scope="row"><?= $pasien['id']; ?></th>
			<td><?= $pasien['nama']; ?></td>
			<td><?= $pasien['umur']; ?></td>
			<td><?php if($pasien['status'] == 0)  echo 'Menunggu';  ?></td>
			<td><?= CHtml::link('Pilih', $this->createAbsoluteUrl('transaksi/update', array('id'=>$pasien['id'])), array('class' => 'btn btn-warning btn-sm')) ?></td>
    	</tr>
		<?php
			}
		?>
	</tbody>
</table>