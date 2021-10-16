<div class="main">
    <div class="main-content">
        <div class="content-heading clearfix">
			<h2>User </h2>
        </div>
		<div class="container-fluid" style="margin-top: 20px;" >
				<a  class="btn btn-primary" href="user/create">
					
					<span>Create User</span>
				</a>
				<div style="margin-top: 20px;">
				<table id="data-table" class="table table-striped" style="width:100%" >
					<thead>
						<th>Username</th>
						<th>Full Name</th>
						<th>Role</th>
						<th>User Status</th>
						<th>Action</th>
					</thead>
					<tbody>
						<?php foreach($users as $user): ?>
							<tr>
								<td><?php echo $user->username ?></td>
								<td><?php echo $user->first_name." ".$user->last_name ?></td>
								<td><?php echo $user->role_name ?></td>
								<td><?php if($user->user_status) echo "Active"; else echo "Deactivated" ?></td>
								
								<td> 
									<a class="btn btn-primary" href="user/update/<?php echo $user->user_id ?>">
										
										<span>Update</span> 
									</a> 
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				</div>
				
			</div>
    </div>
</div>