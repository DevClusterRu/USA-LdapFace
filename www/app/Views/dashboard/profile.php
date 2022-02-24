<?php echo $this->extend('dash_layout') ?>

<?php echo $this->section('content') ?>

<div class="container-scroller">
    <?php echo $this->include('partials/navbar') ?>
    <div class="container-fluid page-body-wrapper">
        <?php echo $this->include('partials/leftMenu') ?>
        <div class="main-panel">
            <div class="content-wrapper">
                <?php echo $this->include('partials/pageHeader') ?>
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Профиль
                                    <div class="hidder" object="addFormProfile">-</div>
                                </h4>
                                <div class="<?php echo session()->get("profileUpDown")?> addFormProfile">
                                    <div class="row">
                                        <div class="col-md-6">

                                            <!--                                                                <p class="card-description"> Horizontal form layout </p>-->
                                            <form class="forms-sample" method="post"
                                                  enctype="application/x-www-form-urlencoded"
                                                  action="/profile/update">
                                                <div class="form-group row">
                                                    <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Ваша
                                                        почта</label>
                                                    <div class="col-sm-9">
                                                        <input onkeyup="checkСontactDetails();" type="email"
                                                               class="form-control" name="email"
                                                               value="<?php echo $userInfo["email"] ?>"
                                                               id="exampleInputUsername2"
                                                               placeholder="Email" required>
                                                        <!--                                                        <div id="validationServer03Feedback" class="invalid-feedback"> aria-describedby="validationServer03Feedback" -->
                                                        <!--                                                            Укажите ваш email.-->
                                                        <!--                                                        </div>-->
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="exampleInputMobile" class="col-sm-3 col-form-label">Контактный
                                                        телефон</label>
                                                    <div class="col-sm-9">
                                                        <input onkeyup="checkСontactDetails();" type="tel"
                                                               class="form-control" name="phone"
                                                               value="<?php echo $userInfo["phone"] ?>"
                                                               id="exampleInputMobile"
                                                               placeholder="Mobile number"
                                                               pattern="[+]{1}[7]{1}-[0-9]{3}-[0-9]{3}-[0-9]{4}"
                                                               required>
                                                        <small class="text-muted">Формат: +7-123-456-7890</small>
                                                    </div>
                                                </div>
                                                <button disabled type="submit"
                                                        class="btn btn-gradient-primary me-2 changeСontactDetailsButton">
                                                    Применить
                                                </button>
                                                <button formnovalidate class="btn btn-light">Отмена</button>
                                            </form>
                                        </div>


                                        <div class="col-md-6">
                                            <form id="password_changer" class="forms-sample" method="post"
                                                  enctype="application/x-www-form-urlencoded"
                                                  action="/profile/passwordreset">

                                                <div class="form-group row">
                                                    <label for="exampleInputPassword2"
                                                           class="col-sm-3 col-form-label">Пароль</label>
                                                    <div class="col-sm-9">
                                                        <input onkeyup="checkPass1();" name="password1" type="password"
                                                               class="form-control"
                                                               id="exampleInputPassword1" placeholder="Password"
                                                               required>
                                                        <div class="invalid-feedback pass_feedback">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleInputConfirmPassword2"
                                                           class="col-sm-3 col-form-label">Введите
                                                        повторно пароль</label>
                                                    <div class="col-sm-9">
                                                        <input onkeyup="checkPass1();" name="password2" type="password"
                                                               class="form-control changePass2Button"
                                                               id="exampleInputConfirmPassword2" placeholder="Password"
                                                               required>
                                                        <div class="invalid-feedback pass_feedback ">
                                                        </div>
                                                    </div>
                                                </div>

                                                <button disabled type="button"
                                                        class="btn btn-gradient-primary me-2 pass_change changePassButton">
                                                    Изменить
                                                    пароль
                                                </button>
                                                <button formnovalidate class="btn btn-light">Отмена</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                <?php if (session()->get("userRole") > 1 && session()->get("userRole") < 3) { ?>  <!--условие для ограничения просмотров, разрешение-->
                    <!-- Здесь начало третей таблицы-->


                    <div class="card">
                        <div class="card-body">
                            <h4>Пополнить баланс счета
                                <div class="hidder" object="addFormProfileInv">-</div>
                            </h4>

                            <div class="<?php echo session()->get("profileInvUpDown")?> addFormProfileInv">
                                <form method="post" enctype="application/x-www-form-urlencoded" action="/аddInvoice">

                                    <div class="form-group">
                                        <!--                                    <label for="exampleInputUsername1">Пополнить баланс счета</label>-->
                                        <input onkeyup="checkNumeric();" name="amount"
                                               value="<?php ?>"
                                               type="number" class="form-control"
                                               id="amountBox"
                                               placeholder="Сумма пополнения" required>
                                    </div>
                                    <button disabled name="addButton" value="1" type="submit"
                                            class="btn btn-gradient-primary me-2 addInvoiceButton">Пополнить баланс
                                    </button>
                                    <button formnovalidate name="cancel" value="2" class="btn btn-light">Очистить
                                    </button>

                                </form>
                            </div>
                        </div>
                    </div>
                    <?php //if(session()->get("userRole")>1 && session()->get("userRole")<3 ){?>


                    <div class="card" style="margin-top: 20px">
                        <div class="card-body">
                            <div class="table-responsive">
                                <form method="post" enctype="application/x-www-form-urlencoded"
                                      action="/activateServices">
                                    <table class="table" style="margin-top: 20px">
                                        <thead>
                                        <tr>
                                            <th>Название услуги</th>
                                            <th>Тип услуги</th>
                                            <th>Стоимость, руб.</th>
                                            <th>Текущая услуга</th>
                                            <th>Автопродление</th>
                                            <th>Оплачено до</th>

                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php foreach ($servicesAll as $element) { ?>

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
                                                        <label class="form-check-label">
                                                            <input value="<?php echo $element["id"] ?>"
                                                                   type="checkbox"
                                                                <?php
                                                                $checked = "";
                                                                //Перебор всех нажатых услуг этого пользователя
                                                                foreach ($userServicesList as $selected) {
                                                                    //Нашли совпадение - чекед
                                                                    if ($element["id"] == $selected["service_id"]) {
                                                                        $checked = "checked ";

                                                                        if ($selected["active"] > 0) {
                                                                            $checked .= "disabled ";
                                                                        }
                                                                    }
                                                                }

                                                                $checkedDisabled = "";
                                                                foreach ($credits as $credRow){
                                                                    if ($element["id"] == $credRow["service_id"]){
                                                                        $checkedDisabled=" checked disabled";
                                                                    }
                                                                }

                                                                if ($checkedDisabled==""){
                                                                    echo $checked;
                                                                }else echo $checkedDisabled;


                                                                ?>
                                                                   class="form-check-input servicesSelector"
                                                                   name="checkboxService[]"><i
                                                                    class="input-helper"></i>
                                                        </label>
                                                    </div>
                                                </td>

                                                <!--подтянуть данные с другой т бд-->
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
                                                               class="form-check-input autoUpdateSelector"
                                                               name="checkboxAutoUpdateSelector"><i
                                                                class="input-helper"></i>
                                                        </label>
                                                    </div>

                                                </td>
                                                <td>2022-01-19 09:41:54</td>
                                            </tr>

                                        <?php } ?>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>

                                            <td>
                                                <div class="butDelUsers">
                                                    <button type="submit" class="btn btn-gradient-primary me-2 ">
                                                        Заказать
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
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

    function checkСontactDetails() {
        if ($("#exampleInputUsername2").val() != "" || $("#exampleInputMobile").val() != "") {
            $(".changeСontactDetailsButton").prop("disabled", false);
        } else {
            $(".changeСontactDetailsButton").prop("disabled", true);
        }
    }

    function checkPass1() {
        if ($("#exampleInputPassword1").val() != "" && $(".changePass2Button").val() != "") {
            $(".changePassButton").prop("disabled", false);
        } else {
            $(".changePassButton").prop("disabled", true);
        }
    }

    function checkNumeric() {
        if ($("#amountBox").val() != "") {
            $(".addInvoiceButton").prop("disabled", false);
        } else {
            $(".addInvoiceButton").prop("disabled", true);
        }
    }
</script>


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


    $(".autoUpdateSelector").click(function () { //класс и событие
        doCheckbox = "set";
        if (!$(this).prop("checked")) doCheckbox = "unset";

        servicesSel = $(this).val(); //вэлью от чекбокса хтмл
        $.ajax({
            url: '/profile/autoUpdateToUser', //роут незаметный
            method: 'post',
            // dataType: 'html',
            data: {checkboxAutoUpdateSelector: servicesSel, doCheckbox: doCheckbox}// ключ-нейм необязательный ,значение -вэлью от чекбокса
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

<?php
if ($_GET["error"] == "passExists") {
    ?>
    <script>
        alert("Ошибка смены пароля");
        location.href = "/profile";
    </script>

<?php } ?>

<?php echo $this->endSection() ?>
