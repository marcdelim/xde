<div class="main">
    <div class="main-content">
        <div class="content-heading clearfix">
            <h2> <?php echo $action ?> User</h2>
            <a class="btn btn-danger" href="<?php echo base_url() ?>user">
					
					<span>Back</span>
				</a>
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
                        <input class="form-control" type="hidden" name="user_id" id="user_id" value="<?php echo $user->user_id ?>">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group col-md-6" style="margin-top:12px">
                                    <label for="code">Username:</label>
                                    <input class="form-control" type="text" name="username" id="username" value="<?php echo $user->username ?>" required>

                                </div>
                                <div class="form-group col-md-6" style="margin-top:12px">
                                    <label for="address_id">Role:</label>
                                    <select class="form-control selectpicker" data-container="body" data-live-search="true" id="role_id" name="role_id" required>
                                        <option value="" selected>Select Role</option>
                                        <?php foreach($roles as $role): ?>
                                            <option value="<?php echo $role->role_id ?>" <?php if($role->role_id == $user->role_id) echo "selected" ?> ><?php echo $role->role_name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>   
                                <div class="form-group col-md-6" style="margin-top:12px">
                                    <label for="name">First Name:</label>
                                    <input class="form-control" type="text" name="first_name" id="first_name" value="<?php echo $user->first_name ?>" required>
                                </div>
                                <div class="form-group col-md-6" style="margin-top:12px">
                                    <label for="name">Last Name:</label>
                                    <input class="form-control" type="text" name="last_name" id="last_name" value="<?php echo $user->last_name ?>" required>
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

