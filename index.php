<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>PAgination</title>
	<link rel="stylesheet" href="../dist/semantic.css">
</head>	
<body>
	<div class="ui grid">
	<div class="four wide column"></div>
	<div class="six wide column">
	<table class="ui blue celled table">
		<thead>
			<tr>
				<th>NIS</th>
				<th>Nama</th>
				<th>Kelas</th>
			</tr>
		</thead>
		<tbody>
				<?php 
					include("class2_paging.php");
					$conn = new pagination();

					$page = 1;
					if (isset($_GET['page']) && !empty($_GET['page'])) {
						$page = (int)$_GET['page'];
					}
					$dataPerPage = 3;
					if (isset($_GET['perPage']) && !empty($_GET['perPage'])) {
						$dataPerPage = (int)$_GET['perPage'];
					}
					$table = "siswa";
					foreach ($conn->getTableData($table,$page,$dataPerPage) as $value) {
						extract($value);
						echo "
							<tr>
							<td>$nis</td>
							<td>$nama</td>
							<td>$kelas</td>
							</tr>
						";

					}
				 ?>
		</tbody>
		<tfoot>
		    <tr>
		    	<th colspan="3">
			      	<div class="ui right floated pagination menu">
				        <a class="icon item">
				          	<i class="left chevron icon"></i>
				     	</a>
					      <?php 
								$conn->showPagination($table,$dataPerPage);
				 			?>
				        <a class="icon item">
				         	<i class="right chevron icon"></i>
			        	</a>
		      		</div>
		    	</th>
		  	</tr>
		</tfoot>
	</table>
</div>
</div>

</body>
</html>