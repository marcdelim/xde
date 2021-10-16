<?php include_once "partials/header.php"; ?>

	<main class="page-content">
		<div class="container-fluid">
			<h2>Roles</h2>

			<a href="roles/create">
              <i class="fas fa-plus-circle"></i>
              <span>Create</span>
			</a>
			
			<div class="container-fluid" style="margin-top: 20px;" >
				<table id="data-table" class="table table-striped">
					<thead>
						<th>Name</th>
						<th>Description</th>
						<th>Action</th>
					</thead>
					<tbody>
						<?php foreach($roles as $role): ?>
							<tr>
								<td><?php echo $role->role_name ?></td>
								<td><?php echo $role->role_desc ?></td>
								<td> 
									<a href="roles/update/<?php echo $role->role_id ?>">
										<i class="fas fa-pencil-alt"></i>
										<span>Edit</span> 
									</a> 
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
  	</main>


  	<?php include_once "partials/footer.php"; ?>

  	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>

  	<script type="text/javascript">
		$(document).ready(function() {
			$('#data-table').DataTable();
		});
	</script>

	</html>