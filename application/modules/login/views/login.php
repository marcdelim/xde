<html>
    <head>

        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="<?php base_url() ?>assets/css/login.css">
    </head>

    <body>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
        <div class="container">
            <div class="card card-login mx-auto text-center">
                    
                <div class="card-body">
                    <span> <img src="<?php base_url() ?>assets/images/xde.jpg" class="w-75" alt="Logo"> </span><br/>
                    <form action="" method="post">
                        <?php if(isset($error)): ?>
                            <div class="alert alert-danger" role="alert">
                            <?php echo $error ?>
                            </div>
                        <?php endif; ?>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="username" class="form-control" placeholder="Username">
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>

                        <div class="form-group">
                            <input type="submit" name="submit" value="Login" class="btn btn-danger login_btn">
                            
                        </div>

                    </form>
                </div>
            </div>
      
        </div>
    </body>
</html>