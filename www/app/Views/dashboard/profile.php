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
                                <form class="forms-sample" method="post" enctype="application/x-www-form-urlencoded" action="/profile/update">
                                    <div class="form-group row">
                                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Ваша почта</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="email" value="<?php echo $userInfo["email"] ?>" id="exampleInputUsername2" placeholder="Email">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="exampleInputMobile" class="col-sm-3 col-form-label" >Контактный телефон</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="phone" value="<?php echo $userInfo["phone"] ?>" id="exampleInputMobile" placeholder="Mobile number">
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
                                <form id="password_changer" class="forms-sample" method="post" enctype="application/x-www-form-urlencoded" action="/profile/passwordreset">

                                    <div class="form-group row">
                                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Пароль</label>
                                        <div class="col-sm-9">
                                            <input name="password1" type="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
                                            <div class="invalid-feedback pass_feedback">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Введите повторно пароль</label>
                                        <div class="col-sm-9">
                                            <input  name="password2" type="password" class="form-control" id="exampleInputConfirmPassword2" placeholder="Password">
                                            <div class="invalid-feedback pass_feedback">
                                            </div>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-gradient-primary me-2 pass_change">Изменить пароль</button>
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




<script>

    $(".pass_change").click(function (){
        $('[name="password1"]').removeClass("is-invalid");
        $('[name="password2"]').removeClass("is-invalid");


        if ($('[name="password1"]').val()==""){
            $('[name="password1"]').addClass("is-invalid");
            $(".pass_feedback").text("Поле должно быть заполнено!");
            return
        }

        if ($('[name="password2"]').val()==""){
            $('[name="password2"]').addClass("is-invalid");
            $(".pass_feedback").text("Поле должно быть заполнено!");
            return
        }

        if ($('[name="password1"]').val()!=$('[name="password2"]').val()){
            $('[name="password1"]').addClass("is-invalid");
            $('[name="password2"]').addClass("is-invalid");
            $(".pass_feedback").text("Пароли не идентичны!");
            return
        }
        $("#password_changer").submit();
    });

</script>

<?php echo $this->endSection() ?>
