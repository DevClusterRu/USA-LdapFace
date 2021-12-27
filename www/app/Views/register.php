<?php echo $this->extend('start_layout') ?>

<?php echo $this->section('content') ?>

<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
            <div class="row flex-grow">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left p-5">
                        <div class="brand-logo">
                            <img src="../../assets/images/logo.svg">
                        </div>
                        <h4><?php echo lang('Auth.firstTime')?></h4>
                        <h6 class="font-weight-light"><?php echo lang('Auth.simple')?></h6>
                        <form class="needs-validation pt-3" method="post" action="/register" novalidate
                              oninput='password2.setCustomValidity(password.value != password2.value ? "Passwords do not match." : "")'>

                            <div class="form-group">
                                <input required name="username" type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="<?php echo lang('Auth.username')?>">
                                <div class="invalid-feedback">
                                    <?php echo lang('Auth.needMail')?>
                                </div>
                            </div>
                            <div class="form-group">
                                <input required name="password" type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="<?php echo lang('Auth.password')?>">
                                <div class="invalid-feedback">
                                    <?php echo lang('Auth.needPassword')?>
                                </div>
                            </div>
                            <div class="form-group">
                                <input required name="password2" type="password" class="form-control form-control-lg" id="exampleInputPasswor2" placeholder="<?php echo lang('Auth.password2')?>">
                                <div class="invalid-feedback">
                                    <?php echo lang('Auth.passwordNotIdent')?>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="form-check">
                                    <label class="form-check-label text-muted">
                                        <input type="checkbox" class="form-check-input"> <?php echo lang('Auth.terms')?> </label>
                                </div>
                            </div>
                            <div class="mt-3">
                                <input type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" value="<?php echo lang('Auth.register')?>">
                            </div>
                            <div class="text-center mt-4 font-weight-light"> <?php echo lang('Auth.alreadyHaveAcc')?> <a href="/" class="text-primary"><?php echo lang('Auth.login')?></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>


<?php echo $this->endSection() ?>