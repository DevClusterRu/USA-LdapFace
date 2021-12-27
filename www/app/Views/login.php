<?php echo $this->extend('start_layout') ?>

<?php echo $this->section('content') ?>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
            <div class="row flex-grow">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left p-5">
                        <div class="brand-logo">
                            <img src="/assets/images/logo.svg">
                        </div>
                        <h4><?php echo lang('Auth.hello')?></h4>
                        <h6 class="font-weight-light"><?php echo lang('Auth.signAndGo')?></h6>
                        <form action="/" class="pt-3" method="post">
                            <div class="form-group">
                                <input name="username" type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="<?php echo lang('Auth.username')?>">
                            </div>
                            <div class="form-group">
                                <input name="password" type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="<?php echo lang('Auth.password')?>">
                            </div>
                            <div class="mt-3">
                                <input class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" type="submit" value="<?php echo lang('Auth.doAuth')?>">
                            </div>
                            <div class="my-2 d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <label class="form-check-label text-muted">
                                        <input type="checkbox" class="form-check-input"> <?php echo lang('Auth.keepme')?> </label>
                                </div>
                                <a href="#" class="auth-link text-black"><?php echo lang('Auth.forgotPassword')?></a>
                            </div>
                            <div class="text-center mt-4 font-weight-light"> <?php echo lang('Auth.dontHaveAcc')?> <a href="/register" class="text-primary"><?php echo lang('Auth.create')?></a>
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
<?php echo $this->endSection() ?>

