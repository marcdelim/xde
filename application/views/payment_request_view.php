<?php include_once "partials/header.php"; ?>

	<main class="page-content">
		<div class="container-fluid">
            <h2><?php echo $action ?> Payment Request</h2>
            
            <a href="<?php echo base_url() ?>payment_request">
              <i class="fas fa-backward"></i>
              <span>Back</span>
			</a>

            <form method="POST" action=''>
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
                <div class="form-group">
                    <label for="bu">Business Unit</label>
                    <input type="text" class="form-control" id="bu" readonly value= "<?php echo $pay->bu_name ?>">
                </div>
                <div class="form-group">
                    <label for="rfp_number">RFP #</label>
                    <input type="text" class="form-control" id="rfp_number" readonly value= "<?php echo $pay->rfp_number ?>">
                </div>
                <div class="form-group">
                    <label for="rfp_date">RFP Date</label>
                    <input type="text" class="form-control" id="rfp_date" readonly value= "<?php echo date('F j, Y', strtotime($pay->rfp_date)) ?>">
                </div>
                <div class="form-group">
                    <label for="bill_ref">Billing Reference</label>
                    <input type="text" class="form-control" id="bill_ref" readonly value= "<?php echo $pay->billing_reference ?>">
                </div>
                <div class="form-group">
                    <label for="particular">Particular</label>
                    <input type="text" class="form-control" id="particular" readonly value= "<?php echo $pay->particulars ?>">
                </div>
                <div class="form-group">
                    <label for="invoice_date">Invoice Date</label>
                    <input type="text" class="form-control" id="invoice_date" readonly value= "<?php echo date('F j, Y', strtotime($pay->invoice_date)) ?>">
                </div>
                <div class="form-group">
                    <label for="invoice_receive_date">Invoice Receive Date</label>
                    <input type="text" class="form-control" id="invoice_receive_date" readonly value= "<?php echo date('F j, Y', strtotime($pay->invoice_receive_date)) ?>">
                </div>
                <div class="form-group">
                    <label for="due_date">Due Date</label>
                    <input type="text" class="form-control" id="due_date" readonly value= "<?php echo date('F j, Y', strtotime($pay->due_date)) ?>">
                </div>
                <div class="form-group">
                    <label for="payee">Payee</label>
                    <input type="text" class="form-control" id="payee" readonly value= "<?php echo $pay->payee ?>">
                </div>
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="text" class="form-control" id="amount" readonly value= "<?php echo $pay->amount ?>">
                </div>
                <div class="form-group">
                    <label for="preparer">Preparer</label>
                    <input type="text" class="form-control" id="preparer" readonly value= "<?php echo $pay->preparer ?>">
                </div>
                <div class="form-group">
                    <label for="manager">Manager</label>
                    <input type="text" class="form-control" id="manager" readonly value= "<?php echo $pay->manager ?>">
                </div>

                <?php if($pay->status == 'waiting for approval' && $this->session->userdata('role_id') != 1): ?>

                    <?php if($pay->creator): ?>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="custom-select" id="status" name="status">
                                <option value="" selected>Select your option</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                    <?php else: ?>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="custom-select" id="status" name="status">
                                <option value="" selected>Select your option</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="reject_comment">Reject Comment</label>
                            <input type="text" class="form-control" id="reject_comment" name="reject_comment">
                        </div>

                    <?php endif; ?>
                    <input type="submit" class="btn btn-primary" name="submit" value="Submit">

                <?php else:  ?>

                <div class="form-group">
                    <label for="status">Status</label>
                    <input type="text" class="form-control" id="status" readonly value= "<?php echo $pay->status ?>">
                </div>
                    <?php if($pay->status == 'rejected' ): ?>

                    <div class="form-group">
                        <label for="reject">Status</label>
                        <input type="text" class="form-control" id="reject" readonly value= "<?php echo $pay->reject ?>">
                    </div>

                    <?php endif; ?>
                <?php endif; ?>
                
            </form>
			
		</div>
  	</main>


  	<?php include_once "partials/footer.php"; ?>

	</html>