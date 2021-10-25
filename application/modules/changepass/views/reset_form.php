<div class="main">
    <div class="main-content">
        <div class="content-heading clearfix">
            <h2> Reset Password</h2>
            <a class="btn btn-danger" href="<?php echo base_url() ?>login">
					
					<span>Back to Login</span>
		</a>
            
        </div>
        <div class="container-fluid" style="margin-top: 20px;" >
        
        <div class="col-md-3"></div>    
            <div class="col-md-6">
               
                <div class="panel panel-default">
                    
                    <form method="POST" action="">
                        <?php if(isset($error)): ?>
                            <div class="alert alert-danger" role="alert">
                            <?php echo $error ?>
                            </div>
                        <?php endif; ?>
                        <?php if(isset($success)): ?>
                            <div class="alert alert-success" role="alert">
                            <?php echo $success ?>
                            </div>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group col-md-12" style="margin-top:12px">
                                    <label for="email">Email:</label>
                                    <input class="form-control" type="text" name="email" id="email" required>

                                </div>
                            </div>
                        </div>  

                        <div class="row">
                            <div class="col-md-5"></div>
                            <div class="col-md-7" style="margin-bottom:10px;">
                                <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
		</div>
    </div>
</div>

