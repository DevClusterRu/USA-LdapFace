<?php echo $this->extend('dash_layout') ?>

<?php echo $this->section('content') ?>

<div class="container-scroller">
    <?php echo $this->include('partials/navbar') ?>
    <div class="container-fluid page-body-wrapper">
        <?php echo $this->include('partials/leftMenu') ?>
        <div class="main-panel">
            <div class="content-wrapper">
                <?php echo $this->include('partials/pageHeader') ?>

                <div class="card">
                    <div class="card-body">
                        <h4>Добавить / отредактировать Group Policy<div class="hidder" object="addForm">-</div></h4>

                        <div class="<?php echo session()->get("addForm")?> addForm">
                            <form method="post" enctype="application/x-www-form-urlencoded" action="/groupPolicyOperation">
                                <!--                           <p class="card-description"> Basic form layout </p>    -->
                                <div class="form-group">
                                    <input name="id"
                                           value="<?php if (isset($curGroup)) echo $curGroup["id"] ?>"
                                           type="hidden"
                                           class="form-control" id="exampleInputUsername1"
                                           placeholder="ID">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Имя GPO</label>
                                    <input name="group_name"
                                           value="<?php if (isset($curGroup)) echo $curGroup["group_name"] ?>"
                                           type="text" class="form-control"
                                           id="exampleInputUsername1"
                                           placeholder="Имя GPO" required>
                                </div>
<!--                                --><?php //if(session()->get("userRole")>2){?><!--  -->
                                    <!--условие для ограничения просмотров, разрешение-->
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Название Юридического лица</label>
                                        <select name="company" class="form-control">
                                            <?php foreach ($companys as $company) { ?>
                                                <?php $selected=""; if ($curGroup ["company_id"]==  $company["id"]) $selected = " selected "?>
                                                <option  <?php echo $selected?> value="<?php echo $company["id"] ?>"><?php echo $company["name"] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
<!--                                --><?php //} ?><!-- -->
                                <!--конец условия для ограничения просмотров-->
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Описание GPO</label>
                                    <input name="group_description"
                                           value="<?php if (isset($curGroup)) echo $curGroup["group_description"] ?>"
                                           type="text" class="form-control"
                                           id="exampleInputUsername1"
                                           placeholder="Oписание GPO" required>
                                </div>
                                <button name="addEdit" value="1" type="submit"
                                        class="btn btn-gradient-primary me-2">Принять
                                </button>
                                <button  type="button" onClick='location.href="/groupPolicy"' name="cancel" value="2" class="btn btn-light">Отмена <!--событие он клик-->
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card" style="margin-top: 20px">
                    <div class="card-body">
                        <div class="table-responsive">
                            <form method="post" enctype="application/x-www-form-urlencoded" action="/groupPolicyOperation">
<!--                                <div class="card-body">-->
<!--                                <div class="form-group">-->

                                    <h4>   <label  for="exampleInputUsername1">Выберите Юридическое лицо</label>  </h4>
                                        <select  name="choiceCompanyTru" class="form-control" id="choiceCom" >
                                        <?php foreach ($companys as $choiceCompany) { ?>
                                            <?php $selected=""; if (session()->get("filterCompany") == $choiceCompany["id"]) $selected = " selected "?>
                                            <option  <?php echo $selected?> value="<?php echo $choiceCompany["id"] ?>"><?php echo $choiceCompany["name"] ?></option>
                                        <?php } ?>
                                    </select>
<!--                                </div>-->
                                <div id="header" class="container">
                                    <div class="table-responsive" style="margin-top: 20px">
                                    <button  style="position:absolute; right: 200px;" name="choice" value="1" type="submit"
                                            class="btn btn-gradient-primary me-2">Выбрать
                                    </button>
<!--                                </div>-->
                                    </div>
                                </div>

                                <table class="table" style="margin-top: 50px">
                                    <thead>
                                    <tr>
                                        <th> Имя GPO</th>
                                        <th> Название Юридического лица</th>
                                        <th> Описание GPO</th>
                                        <!--                                        <th>Дата регистрации</th>-->
                                        <!--                                        <th>Последний вход</th>-->
                                        <th>Редактирование</th>
                                        <th>Удаление</th>
                                    </tr>
                                    </thead>
                                    <tbody>


                                    <?php   foreach ( $groupPolicy as $element): ?>
<!--                                    --><?php //   if( $element ["company_name"] == $choiRow ){  ?>

                                        <tr>
                                            <td><?php echo $element["group_name"] ?></td>
                                            <td><?php echo $element["company_name"] ?></td>
                                            <td><?php echo $element["group_description"] ?></td>

                                            <td>
                                                <button name="updating" type="submit"
                                                        value="<?php echo $element["id"] ?>"
                                                        class="btn btn-gradient-primary me-2">
                                                    Редактировать
                                                </button>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input value="<?php echo $element["id"] ?>" type="checkbox"
                                                               class="form-check-input" name="checkboxDel[]">Удалить<i
                                                                class="input-helper"></i>
                                                    </label>
                                                </div>
                                            </td>
                                            </tr>
<!--                                        --><?php //} ?>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <div class="butDelUsers">
                                                <button type="submit" value="del" name="delete"
                                                        class="btn btn-gradient-primary me-2 ">Удалить
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
            </div>
            <?php echo $this->include('partials/footer') ?>
        </div>
    </div>
</div>

<script>

    $(".user_group_selector").click(function () { //класс и событие
        doCheckbox = "set";
        if (!$(this).prop("checked")) doCheckbox = "unset";

        userGPSet = $(this).val(); //вэлью от чекбокса хтмл
        $.ajax({
            url: '/gPOUsers/bindGPtoUser', //роут незаметный
            method: 'post',
            // dataType: 'html',
            data: {checkboxGP: userGPSet, doCheckbox: doCheckbox}// ключ-нейм необязательный ,значение -вэлью от чекбокса
            // success: function(data){ //вывод результата от контроллера через роут
            //     alert(data);
            // }
        });
    })
</script>

<?php
if ($_GET["error"]=="gpExists"){?>
    <script>
        alert("Ошибка создания");
        location.href="/groupPolicy";
    </script>

<?php }?>

<?php
if ($_GET["error"]=="delGPExists"){?>
    <script>
        alert("Ошибка удаления");
        location.href="/groupPolicy";
    </script>

<?php }?>

<?php echo $this->endSection() ?>

