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
                    <select class="custom-select" id="bu" name="bu_id">
                        <option value="" selected>Select your option</option>
                        <?php foreach($bus as $bu): ?>
                            <option value="<?php echo $bu->bu_id ?>" <?php if($action == 'Update' && $bu->bu_id == $pay->role_id) echo 'selected' ?>><?php echo $bu->bu_name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="rfp_number">RFP #</label>
                    <input type="text" class="form-control" id="rfp_number" name="rfp_number"
                    value= "<?php if($action == 'Update') echo $bu->bu_desc ?>"
                    >
                </div>
                <div class="form-group">
                    <label for="rfp_date">RFP Date</label>
                    <input type="date" class="form-control" id="rfp_date" name="rfp_date"
                    value= "<?php if($action == 'Update') echo $bu->bu_desc ?>"
                    >
                </div>
                <div class="form-group">
                    <label for="bill_ref">Billing Reference</label>
                    <input type="text" class="form-control" id="bill_ref" name="bill_ref"
                    value= "<?php if($action == 'Update') echo $bu->bu_desc ?>"
                    >
                </div>
                <div class="form-group">
                    <label for="particular">Particular</label>
                    <input type="text" class="form-control" id="particular" name="particular"
                    value= "<?php if($action == 'Update') echo $bu->bu_desc ?>"
                    >
                </div>
                <div class="form-group">
                    <label for="invoice_date">Invoice Date</label>
                    <input type="date" class="form-control" id="invoice_date" name="invoice_date"
                    value= "<?php if($action == 'Update') echo $bu->bu_desc ?>"
                    >
                </div>
                <div class="form-group">
                    <label for="invoice_receive_date">Invoice Receive Date</label>
                    <input type="date" class="form-control" id="invoice_receive_date" name="invoice_receive_date"
                    value= "<?php if($action == 'Update') echo $bu->bu_desc ?>"
                    >
                </div>
                <div class="form-group">
                    <label for="due_date">Due Date</label>
                    <input type="date" class="form-control" id="due_date" name="due_date"
                    value= "<?php if($action == 'Update') echo $bu->bu_desc ?>"
                    >
                </div>
                <div class="form-group">
                    <label for="payee">Payee</label>
                    <input type="text" class="form-control" id="payee" name="payee"
                    value= "<?php if($action == 'Update') echo $bu->bu_desc ?>"
                    >
                </div>
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="text" class="form-control" id="amount" name="amount"
                    value= "<?php if($action == 'Update') echo $bu->bu_desc ?>"
                    >
                </div>
                <div class="form-group">
                    <label for="file_name">Attachment</label>
                    <input type="file" class="form-control" id="file_name" name="file_name"
                    value= "<?php if($action == 'Update') echo $bu->bu_desc ?>"
                    >
                </div>
                <input type="submit" class="btn btn-primary" name="submit" value="Submit">
            </form>
			
		</div>
  	</main>


  	<?php include_once "partials/footer.php"; ?>

	</html>