<?php
/* @var $this PasienController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pasiens',
);

// $this->menu=array(
// 	array('label'=>'Create Pasien', 'url'=>array('create')),
// 	array('label'=>'Manage Pasien', 'url'=>array('admin')),
// );
?>

<h1>Pasien</h1>
			
<?= CHtml::link('Create Pasien', $this->createAbsoluteUrl('pasien/create'), array('class' => 'btn btn-secondary btn-sm')) ?>


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
		foreach($listPasien as $pasien) {
	  ?>
    	<tr>
			<th scope="row"><?= $pasien['id']; ?></th>
			<td><?= $pasien['nama']; ?></td>
			<td><?= $pasien['umur']; ?></td>
			<td><?php if($pasien['status'] == 0)  echo 'Menunggu'; else echo 'Selesai';  ?></td>
			<td><?= CHtml::link('View', $this->createAbsoluteUrl('pasien/view', array('id'=>$pasien['id'])), array('class' => 'btn btn-primary btn-sm')) ?> <?= CHtml::link('Edit', $this->createAbsoluteUrl('pasien/update', array('id'=>$pasien['id'])), array('class' => 'btn btn-warning btn-sm')) ?> <?= CHtml::link('Delete', $this->createAbsoluteUrl('pasien/delete', array('id'=>$pasien['id'])), array('class' => 'btn btn-danger btn-sm')) ?></td>
    	</tr>
		<?php
			}
		?>
	</tbody>
</table>