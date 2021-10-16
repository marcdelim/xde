<div class="main">
    <div class="main-content">
        <div class="content-heading clearfix">
				<h2>POD Template </h2>
			
        </div>
		<div class="container-fluid" style="margin-top: 20px;" >
			<div class="row">
					<div class="col-md-12">
						<div class="col-md-9">
							<a  class="btn btn-primary" href="<?php echo base_url() ?>pod/extract/<?php echo $completed ?>">
								<span>Download POD Template</span>
							</a>
						</div>
						<div class="col-md-3" style="margin-bottom:10px;">
						
							<form method="POST" action="">
								<?php if($completed): ?>
									<input type="submit" class="btn btn-warning" name="hide" value =  "Hide POD with Complete Status">
								<?php else: ?>
									<input type="submit" class="btn btn-warning" name="show" value= "Show POD with Complete Status">
								<?php endif; ?>

							</form>
						</div>
					</div>
				</div>
				<div style="margin-top: 20px;">
				<table id="data-table" class="table table-striped" style="width:100%" >
					<thead>
						<th>Shipment No.</th>
						<th>Trip Ticket </th>
						<th>Load Plan No</th>
						<th>RDD</th>
						<th>Delivery Order No</th>
						<th>Ship To Code</th>
						<th>Ship To Name</th>
						<th>Ship To Address</th>
						<th>Truck Type</th>
						<th>Subcon</th>
						<th>POD Status</th>
						<th>Billed Status</th>
						<th>Action</th>
					</thead>
					<tbody>
						<?php foreach($pods as $pod): ?>
							<tr>
								<td><?php echo $pod->wave ?></td>
								<td><?php echo $pod->trip_ticket ?></td>
								<td><?php echo $pod->load_plan ?></td>
								<td><?php echo $pod->rdd ?></td>
								<td><?php echo $pod->dr ?></td>
								<td><?php echo $pod->ship_code ?></td>
								<td><?php echo $pod->ship_name ?></td>
								<td><?php echo $pod->address_name ?></td>
								<td><?php echo $pod->truck_type_name ?></td>
								<td><?php echo $pod->subcon_name ?></td>
								<td><?php echo $pod->pod_status ?></td>
								<td><?php echo $pod->wave_editable == 0 ? "Bill Created"  : ""?></td>
								
								<td> 
									<a target="_blank" class="btn btn-primary" href="pod/update/<?php echo $pod->pod_id ?>">
										
										<?php if($pod->wave_editable): ?>
											<span>Update</span> 
										<?php else: ?>
											<span>View</span> 
										<?php endif; ?>
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