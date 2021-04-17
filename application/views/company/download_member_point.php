<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>ＪＡＦＡ（ダブルポイント）</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>resources/bootstrap/dist/css/bootstrap.css">
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker3.css">

	<style type="text/css">
		table th{
			text-align: center;
		}
		.editable_field{
			border: 0;
			text-align: right;
			width: 150px;
		}
		input{
			background-color: transparent;
		}
		.datepicker table tr td span{
			font-size: 14px;
		}
	</style>
</head>
<body">
			
	<table class="table table-bordered">
		<thead>
			<tr>
				<th nowrap="nowrap">会員名</th>
				<th nowrap="nowrap">メールアドレス</th>
				<th nowrap="nowrap">加盟企業分</th>
				<th nowrap="nowrap">会員分</th>
			</tr>						
		</thead>
		<tbody id="">
			<?php
			foreach ($members as $key => $member) { 
				 // echo "<pre>"; print_r($member);
				?>
				<tr>
					<td><a target="_blank" href="<?= base_url() ?>purchase_list/<?= $member['user_id'] ?>"><?= $member['fullname']  ?></a></td>
					<td><?= $member['email'] ?></td>
					<td><?= floor($member['temp']->company_point); ?></td>
					<td><?= floor($member['temp']->user_point) ?></td>
				</tr>

				<?php
			}
			?>

		</tbody>
		
	</table>	
	<input type="hidden" id="base_url" name="base_url" value="<?= base_url() ?>">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	
</body>
</html>