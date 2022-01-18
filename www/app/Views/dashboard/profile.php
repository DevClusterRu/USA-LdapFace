<?php echo $this->extend('dash_layout') ?>

<?php echo $this->section('content') ?>

<div class="container-scroller">
    <?php echo  $this->include('partials/navbar') ?>
    <div class="container-fluid page-body-wrapper">
        <?php echo  $this->include('partials/leftMenu') ?>
        <div class="main-panel">
            <div class="content-wrapper">
<!--                --><?php //= $this->include('partials/pageHeader') ?>
                <div class="row">
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Профиль</h4>
<!--                                <p class="card-description"> Horizontal form layout </p>-->
                                <form class="forms-sample">
                                    <div class="form-group row">
                                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Ваша почта</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="exampleInputUsername2" placeholder="Email">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Контактный телефон</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="exampleInputMobile" placeholder="Mobile number">
                                        </div>
                                    </div>


                                    <button type="submit" class="btn btn-gradient-primary me-2">Применить</button>
                                    <button class="btn btn-light">Отмена</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
<!--                                <h4 class="card-title">Изменение пароля</h4>-->
                                <p class="card-description">Изменение пароля</p>
                                <form class="forms-sample">



                                    <div class="form-group row">
                                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Пароль</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Введите повторно папроль</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="exampleInputConfirmPassword2" placeholder="Password">
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-gradient-primary me-2">Изменить пароль</button>
                                    <button class="btn btn-light">Отмена</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <?php echo  $this->include('partials/footer') ?>
        </div>
    </div>
</div>

<!--<script>-->
<!--    function openAvaLoad() {-->
<!--        $('[name="newAvatar"]').click();-->
<!--    }-->
<!---->
<!--    $('[name="newAvatar"]').change(function () {-->
<!--        $("#avaForm").submit();-->
<!--    });-->
<!---->
<!--</script>-->

<?php echo $this->endSection() ?>
