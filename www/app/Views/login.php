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
                        <h4><?php echo lang('Auth.hello') ?></h4>
                        <h6 class="font-weight-light"><?php echo lang('Auth.signAndGo') ?></h6>
                        <form action="/" class="pt-3" method="post">
                            <div class="form-group">
                                <input name="phone" type="text" class="form-control form-control-lg ph"
                                       placeholder="<?php echo lang('Auth.usernamePhone') ?>">
                            </div>

                            <script>
                                $('.ph').usPhoneFormat({
                                    format: '(xxx) xxx-xxxx',
                                });
                            </script>

                            <div class="form-group">
                                <button style="width: 100%" class="btn btn-gradient-success btn-md auth-form-btn">
                                    <i class="mdi mdi-upload btn-icon-prepend"></i>
                                    <?php echo lang('Auth.codeRequest') ?>
                                </button>
                            </div>


                            <div class="form-group">
                                <input name="password" type="password" class="form-control form-control-lg"
                                       id="exampleInputPassword1" placeholder="<?php echo lang('Auth.smsCode') ?>">
                            </div>
                            <div class="mt-3">
                                <input class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn"
                                       type="submit" value="<?php echo lang('Auth.doAuth') ?>">
                            </div>
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

