<?php
/* @var $this ObatController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Obats',
);

// $this->menu=array(
// 	array('label'=>'Create Obat', 'url'=>array('create')),
// 	array('label'=>'Manage Obat', 'url'=>array('admin')),
// );
?>

<h1>Obats</h1>

		
<?= CHtml::link('Create Obat', $this->createAbsoluteUrl('obat/create'), array('class' => 'btn btn-secondary btn-sm')) ?>


<table class="table table-striped">
	
<thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nama Obat</th>
      <th scope="col">Harga</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
	  <?php
		foreach($listObat as $obat) {
	  ?>
    	<tr>
			<th scope="row"><?= $obat['id']; ?></th>
			<td><?= $obat['nama']; ?></td>
			<td><?= $obat['harga']; ?></td>
			<td><?= CHtml::link('View', $this->createAbsoluteUrl('obat/view', array('id'=>$obat['id'])), array('class' => 'btn btn-primary btn-sm')) ?> <?= CHtml::link('Edit', $this->createAbsoluteUrl('obat/update', array('id'=>$obat['id'])), array('class' => 'btn btn-warning btn-sm')) ?> <?= CHtml::link('Delete', $this->createAbsoluteUrl('obat/delete', array('id'=>$obat['id'])), array('class' => 'btn btn-danger btn-sm')) ?></td>
    	</tr>
		<?php
			}
		?>
	</tbody>
</table>
