<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Users',
);

// $this->menu=array(
// 	array('label'=>'Create User', 'url'=>array('create')),
// 	array('label'=>'Manage User', 'url'=>array('admin')),
// );
?>

<h1>Users</h1>

			
<?= CHtml::link('Create User', $this->createAbsoluteUrl('user/create'), array('class' => 'btn btn-secondary btn-sm')) ?>


<table class="table table-striped">
	
<thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Username</th>
      <th scope="col">Password</th>
	  <th scope="col">Nama</th>
	  <th scope="col">Jabatan</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
	  <?php
		foreach($users as $user) {
	  ?>
    	<tr>
			<th scope="row"><?= $user['id']; ?></th>
			<td><?= $user['username']; ?></td>
			<td><?= $user['password']; ?></td>
			<td><?= $user['nama']; ?></td>
			<td><?= $user['jabatan']; ?></td>
			<td><?= CHtml::link('Edit', $this->createAbsoluteUrl('user/update', array('id'=>$user['id'])), array('class' => 'btn btn-warning btn-sm')) ?> <?= CHtml::link('Delete', $this->createAbsoluteUrl('user/delete', array('id'=>$user['id'])), array('class' => 'btn btn-danger btn-sm')) ?></td>
    	</tr>
		<?php
			}
		?>
	</tbody>
</table>