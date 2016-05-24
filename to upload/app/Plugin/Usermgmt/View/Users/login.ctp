<section class="container">
    <div class="block">
        <div class="row">
            <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                <header>
                    <h1 class="page-title">Sign In</h1>
                </header>
                <?php echo $this->Session->flash(); ?>
                <hr>
                <?php echo $this->Form->create('User', array('action' => 'login', 'id' => "form-sign-in-account")); ?>                
                    <div class="form-group">
                        <label for="form-sign-in-email">Email:</label>                        
                        <?php echo $this->Form->input("email", array('label' => false, 'div' => false, 'id' =>"form-sign-in-email", 'class' => "form-control")) ?>
                    </div><!-- /.form-group -->
                    <div class="form-group">
                        <label for="form-sign-in-password">Password:</label>                        
                        <?php echo $this->Form->input("password", array("type" => "password", 'label' => false, 'id' =>"form-sign-in-password", 'div' => false, 'class' => "form-control")) ?>
                    </div><!-- /.form-group -->
                    <div class="form-group clearfix">
                        <button type="submit" class="btn pull-right btn-default" id="account-submit">Sign In</button>
                    </div><!-- /.form-group -->
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</section>
<!-- /.block-->
<script>
    document.getElementById("UserEmail").focus();
</script>