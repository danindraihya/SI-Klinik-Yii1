<?php
/* @var $this TindakanController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tindakans',
);

// $this->menu=array(
// 	array('label'=>'Create Tindakan', 'url'=>array('create')),
// 	array('label'=>'Manage Tindakan', 'url'=>array('admin')),
// );
?>

<h1>Tindakan</h1>
			
<?= CHtml::link('Create Tindakan', $this->createAbsoluteUrl('tindakan/create'), array('class' => 'btn btn-secondary btn-sm')) ?>


<table class="table table-striped">
	
<thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Tindakan</th>
      <th scope="col">Biaya</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
	  <?php
		foreach($listTindakan as $tindakan) {
	  ?>
    	<tr>
			<th scope="row"><?= $tindakan['id']; ?></th>
			<td><?= $tindakan['nama']; ?></td>
			<td><?= $tindakan['biaya']; ?></td>
			<td><?= CHtml::link('View', $this->createAbsoluteUrl('tindakan/view', array('id'=>$tindakan['id'])), array('class' => 'btn btn-primary btn-sm')) ?> <?= CHtml::link('Edit', $this->createAbsoluteUrl('tindakan/update', array('id'=>$tindakan['id'])), array('class' => 'btn btn-warning btn-sm')) ?> <?= CHtml::link('Delete', $this->createAbsoluteUrl('tindakan/delete', array('id'=>$tindakan['id'])), array('class' => 'btn btn-danger btn-sm')) ?></td>
    	</tr>
		<?php
			}
		?>
	</tbody>
</table>