<div class="main">
    <div class="main-content">
        <div class="content-heading clearfix">
            <h2> POD Template</h2>
        </div>
        <div class="container-fluid" style="margin-top: 20px;" >
            <div class="col-md-12">
                <a class="btn btn-danger" href="<?php echo base_url() ?>pod">
					
					<span>Back</span>
				</a>
                <div class="panel panel-default" style="margin-top: 20px;">
                    
                    <form method="POST" action="">
                        <?php if(isset($error)): ?>
                            <div class="alert alert-danger" role="alert">
                            <?php echo $error ?>
                            </div>
                        <?php endif; ?>
                        <?php if(isset($success)): ?>
                            <div class="alert alert-success" role="alert">
                            Success!
                            </div>
                        <?php endif; ?>
                        <input class="form-control" type="hidden" name="id" id="nature" value="<?php echo $pod->pod_id ?>">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group col-md-4" style="margin-top:12px">
                                        <label for="wave">Shipment No.:</label>
                                        <input class="form-control" type="text" name="wave" id="wave" value="<?php echo $pod->wave ?>"  readonly>
                                    </div>
                                    <div class="form-group col-md-4" style="margin-top:12px">
                                        <label for="wave">Trip Ticket:</label>
                                        <input class="form-control" type="text" name="wave" id="wave" value="<?php echo $pod->trip_ticket ?>"  readonly>
                                    </div>
                                    <div class="form-group col-md-4" style="margin-top:12px">
                                        <label for="rdd">RDD:</label>
                                        <input class="form-control" type="text" name="rdd" id="rdd" value="<?php echo $pod->rdd ?>" readonly>
                                    </div>
                                    <div class="form-group col-md-4" style="margin-top:12px">
                                        <label for="dr">Delivery Order No:</label>
                                        <input class="form-control" type="text" name="dr" id="dr" value="<?php echo $pod->dr ?>" readonly>
                                    </div>
                                    <div class="form-group col-md-4" style="margin-top:12px">
                                        <label for="subcon_name">Subcon Name:</label>
                                        <input class="form-control" type="text" name="subcon_name" id="subcon_name" value="<?php echo $pod->subcon_name ?>" readonly>
                                    </div>
                                    <div class="form-group col-md-4" style="margin-top:12px">
                                        <label for="ship_name">Ship To Name:</label>
                                        <input class="form-control" type="text" name="ship_name" id="ship_name" value="<?php echo $pod->ship_name ?>" readonly>
                                    </div>
                                    <div class="form-group col-md-4" style="margin-top:12px">
                                        <label for="address_name">Ship To Address:</label>
                                        <input class="form-control" type="text" name="address_name" id="address_name" value="<?php echo $pod->address_name ?>" readonly>
                                    </div>
                                    <div class="form-group col-md-4" style="margin-top:12px">
                                        <label for="truck_type_name">Truck Type:</label>
                                        <input class="form-control" type="text" name="truck_type_name" id="truck_type_name" value="<?php echo $pod->truck_type_name ?>" readonly>
                                    </div>
                                    
                                    <div class="form-group col-md-4" style="margin-top:12px">
                                        <label for="plate_no">Truck Plate No:</label>
                                        <input class="form-control" type="text" name="plate_no" id="plate_no" value="<?php echo $pod->plate_no ?>" readonly>
                                    </div>
                                   
                                    <div class="form-group col-md-4" style="margin-top:12px">
                                        <label for="nature_name">Qty Loaded:</label>
                                        <input class="form-control" type="text" name="qty" id="qty" value="<?php echo $pod->qty ?>" readonly>
                                    </div>
                                    <div class="form-group col-md-4" style="margin-top:12px">
                                        <label for="nature_name">Dispatch Status:</label>
                                        <input class="form-control" type="text" name="dispatch_status" id="bu_name" value="<?php echo $pod->dispatch_status ?>" readonly>
                                    </div>
                                    <div class="form-group col-md-4" style="margin-top:12px">
                                        <label for="nature_name">Dispatch Date time:</label>
                                        <input class="form-control" type="text" name="bu_name" id="time_dispatch" value="<?php echo $pod->time_dispatch ?>"  readonly>
                                    </div>

                                    <div class="form-group col-md-4" style="margin-top:12px">
                                        <label for="nature_name">Qty Unloaded:</label>
                                        <input class="form-control" type="text" name="qty_unloaded" id="qty_unloaded" value="<?php echo $pod->qty_unloaded ?>" readonly>
                                    </div>
                                    <div class="form-group col-md-4" style="margin-top:12px">
                                        <label for="nature_name">Delivery Status:</label>
                                        <input class="form-control" type="text" name="delivery_status" id="delivery_status" value="<?php echo $pod->delivery_status ?>" readonly>
                                    </div>
                                    <div class="form-group col-md-4" style="margin-top:12px">
                                        <label for="nature_name">Delivery Remarks/Issues:</label>
                                        <input class="form-control" type="text" name="delivery_remarks" id="delivery_remarks" value="<?php echo $pod->delivery_remarks ?>" readonly>
                                    </div>
                                    
                                    <div class="form-group col-md-6" style="margin-top:12px">
                                        <label for="nature_name">Rejected Qty:</label>
                                        <input class="form-control" type="text" name="rejected_qty" id="rejected_qty" value="<?php echo $pod->rejected_qty ?>" readonly>
                                    </div>
                                    <div class="form-group col-md-6" style="margin-top:12px">
                                        <label for="nature_name">Reason of Rejection:</label>
                                        <input class="form-control" type="text" name="reason_reject" id="reason_reject" value="<?php echo $pod->reason_reject ?>" readonly> 
                                    </div>

                                    <!-- INPUT FORM -->
                            	    <div class="form-group col-md-6" style="margin-top:12px">
                                        <label for="nature_name">RUD Items Status:</label>
                                        <select class="form-control selectpicker" data-container="body" data-live-search="true" id="rud_items_status" name="rud_items_status">
                                            <option value="" selected>Select Status</option>
                                            <option value="Overrage" <?php if($pod->rud_items_status == 'Overrage') echo 'selected'; ?>>Overrage</option>
                                            <option value="Damaged" <?php if($pod->rud_items_status == 'Damaged') echo 'selected'; ?>>Damaged</option>
                                            <option value="Expired PO" <?php if($pod->rud_items_status == 'Expired PO') echo 'selected'; ?>>Expired PO</option>
                                            <option value="Not in PO" <?php if($pod->rud_items_status == 'Not in PO') echo 'selected'; ?>>Not in PO</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6" style="margin-top:12px">
                                        <label for="nature_name">CM Date:</label>
                                        <input class="form-control" type="datetime-local" name="cm_date" id="cm_date" value="<?php echo str_replace(" ", 'T', $pod->cm_date) ?>">
                                    </div>
                                    
                                    <div class="form-group col-md-4" style="margin-top:12px">
                                        <label for="receipt_pod_date">Date Upon Receipt of POD:</label>
                                        <input class="form-control" type="datetime-local" name="receipt_pod_date" id="receipt_pod_date" value="<?php echo str_replace(" ", 'T', $pod->receipt_pod_date) ?>" >
                                    </div>
                                    <div class="form-group col-md-4" style="margin-top:12px">
                                        <label for="receipt_pod_date">Date Transmittal of POD:</label>
                                        <input class="form-control" type="datetime-local" name="transmitted_pod_date" id="transmitted_pod_date" value="<?php echo str_replace(" ", 'T', $pod->transmitted_pod_date) ?>" >
                                    </div>
                                    <div class="form-group col-md-4" style="margin-top:12px">
                                        <label for="nature_name">Incomplete POD Reason:</label>
                                        <select class="form-control selectpicker" data-container="body" data-live-search="true" id="incomplete_pod_reason" name="incomplete_pod_reason">
                                            <option value="" selected>Select Reason</option>
                                            <option value="Missing Signature" <?php if($pod->incomplete_pod_reason == 'Missing Signature') echo 'selected'; ?>>Missing Signature</option>
                                            <option value="Missing Document" <?php if($pod->incomplete_pod_reason == 'Missing Document') echo 'selected'; ?>>Missing Document</option>
                                            <option value="Wrong Document" <?php if($pod->incomplete_pod_reason == 'Wrong Document') echo 'selected'; ?>>Wrong Document</option>
                                        </select>
                                    </div>
                                    
                                </div>
                            </div>
                        
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-5"></div>
                                    <div class="col-md-7" style="margin-bottom:10px;">
                                        <?php if($pod->wave_editable): ?>
											<input type="submit" class="btn btn-primary" name="submit" value="Submit">
										<?php endif; ?>
                                        
                                    </div>
                                </div>
                            </div>
                            
                    </form>
                </div>
            </div>
		</div>
    </div>
</div>

