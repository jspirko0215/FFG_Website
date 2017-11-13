
	<?php if($ahistory->num_rows) { ?>
	<div style="float: left">
		<a href="/members/logout">Logout</a>
	</div>
	<table border="1" align="center">
	<?php foreach ($ahistory->result_array() as $row):?>

	<tr>
		<td width="10%" align="center">
			<?=$row['id']?>
		</td>
		<td width="50%" align="center" style="padding: 0 5em">
			<?=$row['timedate_action']?>
		</td>
		<td width="*" align="center">
			<?=($row['action'] ? 'Вход' : 'Выход')?>
		</td>
	</tr>
	<?php endforeach; ?>
	</table>		

	<?php } else { ?>
	<div style="width: 100%; text-align: center">
		История пуста
	</div>
	<?php } ?>
	
	<div style="position: absolute; top: 15%"
	<?php echo $pagination; ?>
