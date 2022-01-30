<?php echo $this->extend('dash_layout') ?>

<?php echo $this->section('content') ?>

<div class="container-scroller">
    <?php echo $this->include('partials/navbar') ?>
    <div class="container-fluid page-body-wrapper">
        <?php echo $this->include('partials/leftMenu') ?>
        <div class="main-panel">
            <div class="content-wrapper">
                <!--                --><?php //= $this->include('partials/pageHeader') ?>
                <div class="row">
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Профиль<div class="hidder" object="addForm">-</div></h4>
                                <div class="hidden addForm">
                                    <!--                                                                <p class="card-description"> Horizontal form layout </p>-->
                                    <form class="forms-sample" method="post" enctype="application/x-www-form-urlencoded"
                                          action="/profile/update">
                                        <div class="form-group row">
                                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Ваша
                                                почта</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="email"
                                                       value="<?php echo $userInfo["email"] ?>"
                                                       id="exampleInputUsername2"
                                                       placeholder="Email">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="exampleInputMobile" class="col-sm-3 col-form-label">Контактный
                                                телефон</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="phone"
                                                       value="<?php echo $userInfo["phone"] ?>" id="exampleInputMobile"
                                                       placeholder="Mobile number">
                                            </div>
                                        </div>


                                        <button type="submit" class="btn btn-gradient-primary me-2">Применить</button>
                                        <button class="btn btn-light">Отмена</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                        <!--                </div>-->
                        <!---->
                        <!--                <div class="row">-->
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <!--                                <h4 class="card-title">Изменение пароля</h4>-->
                                    <h4 class="card-title">Изменение пароля<div class="hidder" object="addForm">-</div> </h4>
                                    <div class="hidden addForm">
                                        <!--                                <p class="card-description">Изменение пароля</p>-->
                                        <form id="password_changer" class="forms-sample" method="post"
                                              enctype="application/x-www-form-urlencoded"
                                              action="/profile/passwordreset">

                                            <div class="form-group row">
                                                <label for="exampleInputPassword2"
                                                       class="col-sm-3 col-form-label">Пароль</label>
                                                <div class="col-sm-9">
                                                    <input name="password1" type="password" class="form-control"
                                                           id="exampleInputPassword2" placeholder="Password">
                                                    <div class="invalid-feedback pass_feedback">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="exampleInputConfirmPassword2"
                                                       class="col-sm-3 col-form-label">Введите
                                                    повторно пароль</label>
                                                <div class="col-sm-9">
                                                    <input name="password2" type="password" class="form-control"
                                                           id="exampleInputConfirmPassword2" placeholder="Password">
                                                    <div class="invalid-feedback pass_feedback">
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="button" class="btn btn-gradient-primary me-2 pass_change">
                                                Изменить
                                                пароль
                                            </button>
                                            <button class="btn btn-light">Отмена</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>

                        <?php if (session()->get("userRole") > 1) { ?>  <!--условие для ограничения просмотров, разрешение-->
                            <!-- Здесь начало третей таблицы-->


                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <form method="post" enctype="application/x-www-form-urlencoded" action="/usersOperation">
                                            <table class="table" style="margin-top: 20px">
                                                <thead>
                                                <tr>
                                                    <th>Название услуги</th>
                                                    <th>Тип услуги</th>
                                                    <th>Стоимость, руб.</th>
                                                    <th>Текущая услуга</th>
                                                    <th>Оплачено до</th>

                                                </tr>
                                                </thead>
                                                <tbody>

                                                <?php foreach ($userServicesList as $element) { ?>

                                                    <tr>
                                                        <td><?php echo $element["name"] ?></td>
                                                        <td><?php
                                                            if ($element["type_service"] == "once")
                                                                echo "Разовая оплата";
                                                            else
                                                                echo "Абониментская оплата";
                                                            ?></td>
                                                        <td><?php echo $element["cost"] ?></td>
                                                        <td>
                                                            <div class="form-check" style="margin-top: 0">
                                                                <checked
                                                                ="checked" class="form-check-label">
                                                                <input value="<?php echo $element["id"] ?>"
                                                                       type="checkbox"
                                                                    <?php
                                                                    if ($element["service_id"]) {
                                                                        echo "checked";
                                                                    }
                                                                    ?>
                                                                       class="form-check-input servicesSelector"
                                                                       name="checkboxService"><i
                                                                        class="input-helper"></i>
                                                                </label>
                                                            </div>

                                                        </td>
                                                        <td>2022-01-19 09:41:54</td>
                                                    </tr>

                                                <?php } ?>

                                                </tbody>
                                            </table>
                                        </form>


                                    </div>
                                </div>
                            </div>
                        <?php } ?> <!--конец условия для ограничения просмотров-->

                    </div>
                    <?php echo $this->include('partials/footer') ?>
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

            $(".servicesSelector").click(function () { //класс и событие
                doCheckbox = "set";
                if (!$(this).prop("checked")) doCheckbox = "unset";

                servicesSel = $(this).val(); //вэлью от чекбокса хтмл
                $.ajax({
                    url: '/profile/bindToUser', //роут незаметный
                    method: 'post',
                    // dataType: 'html',
                    data: {checkboxService: servicesSel, doCheckbox: doCheckbox}// ключ-нейм необязательный ,значение -вэлью от чекбокса
                    // success: function(data){ //вывод результата от контроллера через роут
                    //     alert(data);
                    // }
                });


            })


            $(".pass_change").click(function () {
                $('[name="password1"]').removeClass("is-invalid");
                $('[name="password2"]').removeClass("is-invalid");


                if ($('[name="password1"]').val() == "") {
                    $('[name="password1"]').addClass("is-invalid");
                    $(".pass_feedback").text("Поле должно быть заполнено!");
                    return
                }

                if ($('[name="password2"]').val() == "") {
                    $('[name="password2"]').addClass("is-invalid");
                    $(".pass_feedback").text("Поле должно быть заполнено!");
                    return
                }

                if ($('[name="password1"]').val() != $('[name="password2"]').val()) {
                    $('[name="password1"]').addClass("is-invalid");
                    $('[name="password2"]').addClass("is-invalid");
                    $(".pass_feedback").text("Пароли не идентичны!");
                    return
                }
                $("#password_changer").submit();
            });

        </script>

        <?php echo $this->endSection() ?>
