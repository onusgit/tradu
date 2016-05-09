<section class="container">
    <div class="block">
        <div class="row">
            <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                <header>
                    <h1 class="page-title">Register</h1>
                </header>
                <hr>
                <?php echo $this->Form->create('User', array('action' => 'register', 'id' => "form-register" )); ?>                
                    <div class="form-group">
                        <label for="form-register-full-name">Full Name:</label>                        
                        <?php echo $this->Form->input("first_name", array('label' => false, 'div' => false, 'id' => "form-register-full-name", 'class' => "form-control")) ?>
                    </div><!-- /.form-group -->
                    <div class="form-group">
                        <label for="form-register-email">Email:</label>                        
                        <?php echo $this->Form->input("email", array('label' => false, 'div' => false, 'class' => "form-control")) ?>                        
                    </div><!-- /.form-group -->
                    <div class="form-group">
                        <label for="form-register-password">Password:</label>                        
                        <?php echo $this->Form->input("password", array("type" => "password", 'label' => false, 'div' => false, 'class' => "form-control")) ?>
                    </div><!-- /.form-group -->
                    <div class="form-group">
                        <label for="form-register-confirm-password">Confirm Password:</label>                        
                        <?php echo $this->Form->input("cpassword", array("type" => "password", 'label' => false, 'div' => false, 'class' => "form-control")) ?>
                    </div><!-- /.form-group -->
                    <div class="checkbox pull-left">
                        <label>
                            <input type="checkbox" name="newsletter">Receive Newsletter
                        </label>
                    </div>
                    <div class="form-group clearfix">
                        <button type="submit" class="btn pull-right btn-default" id="account-submit">Create an Account</button>
                    </div>
                </form>
                <hr>
                <div class="center">
                    <figure class="note">By clicking the “Create an Account” button you agree with our <a href="terms-conditions.html" class="link">Terms and conditions</a></figure>
                </div>
            </div>
        </div>
    </div>
</section>            
<script>
    document.getElementById("UserUsername").focus();
</script>