<div class="main">
    <div class="main-content">
        <div class="content-heading clearfix">
            <h2> Pallet </h2>
        </div>
        <div class="container-fluid" style="margin-top: 20px;" >
            <div class="col-md-12">
                <a class="btn btn-danger" href="<?php echo base_url() ?>pod">
					
					<span>Back</span>
				</a>
                <div class="panel panel-default" style="margin-top: 20px;">
                    
                    <form method="POST" action="" enctype="multipart/form-data">
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
                                    <div class="form-group col-md-12" style="margin-top:12px">
                                        <label for="wave">Pallet Template:</label>
                                        <input class="form-control" type="file" name="inbound" id="pallet">
                                    </div>
                                </div>
                            </div>   
                        
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-5"></div>
                                    <div class="col-md-7" style="margin-bottom:10px;">
										<input type="submit" class="btn btn-primary" name="submit" value="Submit">
                                    </div>
                                </div>
                            </div>
                            
                    </form>
                </div>
            </div>
		</div>
    </div>
</div>

