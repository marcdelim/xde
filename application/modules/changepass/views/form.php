<div class="main">
    <div class="main-content">
        <div class="content-heading clearfix">
            <h2> Change Password</h2>
            
        </div>
        <div class="container-fluid" style="margin-top: 20px;" >
            <div class="col-md-12">
               
                <div class="panel panel-default">
                    
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group col-md-4" style="margin-top:12px">
                                    <label for="subcon_name">Current Password:</label>
                                    <input class="form-control" type="password" name="current" id="current" required>

                                </div>
                                <div class="form-group col-md-4" style="margin-top:12px">
                                    <label for="subcon_name">New Password:</label>
                                    <input class="form-control" type="password" name="new" id="new" required>

                                </div>
                                <div class="form-group col-md-4" style="margin-top:12px">
                                    <label for="subcon_name">Confirm Password:</label>
                                    <input class="form-control" type="password" name="confirm" id="confirm" required>

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

