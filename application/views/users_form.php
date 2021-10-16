<?php include_once "partials/header.php"; ?>

	<main class="page-content">
		<div class="container-fluid">
            <h2><?php echo $action ?> User</h2>
            
            <a href="<?php echo base_url() ?>users">
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
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name"
                    value= "<?php if($action == 'Update') echo $user->first_name ?>"
                    >
                </div>
                <div class="form-group">
                    <label for="middle_name">Middle Name</label>
                    <input type="text" class="form-control" id="middle_name" name="middle_name"
                    value= "<?php if($action == 'Update') echo $user->middle_name ?>"
                    >
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name"
                    value= "<?php if($action == 'Update') echo $user->last_name ?>"
                    >
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username"
                    value= "<?php if($action == 'Update') echo $user->username ?>"
                    >
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email"
                    value= "<?php if($action == 'Update') echo $user->email ?>"
                    >
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select class="custom-select" id="role" name="role_id">
                        <option value="" selected>Select your option</option>
                        <?php foreach($roles as $role): ?>
                            <option value="<?php echo $role->role_id ?>" <?php if($action == 'Update' && $role->role_id == $user->role_id) echo 'selected' ?>><?php echo $role->role_name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="manager">Manager</label>
                    <select class="custom-select" id="role" name="manager_id">
                        <option value="" selected>Select your option</option>
                        <?php foreach($managers as $manager): ?>
                            <option value="<?php echo $manager->user_id ?>"<?php if($action == 'Update' && $manager->user_id == $user->manager_id) echo 'selected' ?>><?php echo $manager->first_name.' '.$manager->middle_name.' '.$manager->last_name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <input type="submit" class="btn btn-primary" name="submit" value="Submit">
            </form>
			
		</div>
  	</main>


  	<?php include_once "partials/footer.php"; ?>

	</html>