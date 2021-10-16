<?php include_once "partials/header.php"; ?>

	<main class="page-content">
		<div class="container-fluid">
			<h2>Users</h2>

			<a href="users/create">
              <i class="fas fa-plus-circle"></i>
              <span>Create</span>
			</a>
			
			<div class="container-fluid" style="margin-top: 20px;" >
				<table id="data-table" class="table table-striped">
					<thead>
						<th>Name</th>
						<th>Username</th>
						<th>Email</th>
						<th>Role</th>
						<th>Manager</th>
						<th>Date Created</th>
						<th>Date Updated</th>
						<th>Action</th>
					</thead>
					<tbody>
						<?php foreach($users as $user): ?>
							<tr>
								<td><?php echo $user->first_name.' '.$user->middle_name.' '.$user->last_name ?></td>
								<td><?php echo $user->username ?></td>
								<td><?php echo $user->email ?> </td>
								<td><?php echo $user->role_name ?> </td>
								<td><?php echo $user->manager ?> </td>
								<td><?php echo date('F j, Y', strtotime($user->date_created)) ?> </td>
								<td><?php echo date('F j, Y', strtotime($user->date_updated)) ?> </td>
								<td> 
									<a href="users/update/<?php echo $user->user_id ?>">
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