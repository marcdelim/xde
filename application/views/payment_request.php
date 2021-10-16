<?php include_once "partials/header.php"; ?>

	<main class="page-content">
		<div class="container-fluid">
			<h2>Payment Request</h2>

			<?php if($this->session->userdata('role_id') == 2): ?>
				<a href="payment_request/create">
				<i class="fas fa-plus-circle"></i>
				<span>Create</span>
				</a>
			<?php endif; ?>
			
			<div class="container-fluid" style="margin-top: 20px;" >
				<table id="data-table" class="table table-striped">
					<thead>
						<?php if($this->session->userdata('role_id') == 3): ?>
							<th><input type="checkbox"></th>
						<?php endif; ?>
						<th>BU Name</th>
						<th>RFP Number</th>
						<th>RFP Date</th>
						<th>Billing Reference</th>
						<th>Due Date </th>
						<th>Payee</th>
						<th>Amount</th>
						<th>Preparer</th>
						<th>Manager</th>
						<th>Status</th>
						<th>Action</th>
					</thead>
					<tbody>
						<?php foreach($pays as $pay): ?>
							<tr>
								<?php if($this->session->userdata('role_id') == 3): ?>
									<td>
										<?php if($pay->status == 'waiting for approval'): ?>
											<input type="checkbox">
										<?php endif; ?>
									</td>
								<?php endif; ?>
								<td><?php echo $pay->bu_name ?></td>
								<td><?php echo $pay->rfp_number ?></td>
								<td><?php echo date('F j, Y', strtotime($pay->rfp_date)) ?> </td>
								<td><?php echo $pay->billing_reference ?></td>
								<td><?php echo date('F j, Y', strtotime($pay->due_date)) ?> </td>
								<td><?php echo $pay->payee ?></td>
								<td><?php echo $pay->amount ?></td>
								<td><?php echo $pay->preparer ?></td>
								<td><?php echo $pay->manager ?></td>
								<td><?php echo $pay->status ?></td>
								<td> 
									<a href="payment_request/view/<?php echo $pay->payment_id ?>">
										<i class="fas fa-eye"></i>
										<span>View</span> 
									</a> 
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<?php if($this->session->userdata('role_id') == 3): ?>
					<button type="submit" class="btn btn-primary">Accept checked row</button>
					<button type="submit" class="btn btn-danger">Reject checked row</button>
				<?php endif; ?>
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