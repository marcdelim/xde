<div class="main">
    <div class="main-content">
        <div class="content-heading clearfix">
            <h2> Upload Cost Center</h2>
            <a class="btn btn-danger" href="/rfp/center">
					
					<span>Back</span>
				</a>
        </div>
        <div class="container-fluid" style="margin-top: 20px;" >
            <div class="col-md-12">
               
                <div class="panel panel-default">
                    
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
                                <div class="form-group col-md-12" style="margin-top:12px">
                                    <label for="file_name">Description:</label>
                                    <input class="form-control" type="file" name="file_name" id="file_name">
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

