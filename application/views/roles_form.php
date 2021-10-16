<?php include_once "partials/header.php"; ?>

	<main class="page-content">
		<div class="container-fluid">
            <h2><?php echo $action ?> Roles</h2>
            
            <a href="<?php echo base_url() ?>roles">
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
                    <label for="name">Role Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter role name"
                    value= "<?php if($action == 'Update') echo $role->role_name ?>"
                    >
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Description"
                    value= "<?php if($action == 'Update') echo $role->role_desc ?>"
                    >
                </div>
                <input type="submit" class="btn btn-primary" name="submit" value="Submit">
            </form>
			
		</div>
  	</main>


  	<?php include_once "partials/footer.php"; ?>

	</html>