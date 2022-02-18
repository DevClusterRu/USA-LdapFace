<?php echo $this->extend('dash_layout') ?>

<?php echo $this->section('content') ?>

<div class="container-scroller">
    <?php echo $this->include('partials/navbar') ?>
    <div class="container-fluid page-body-wrapper">
        <?php echo $this->include('partials/leftMenu') ?>
        <div class="main-panel">
            <div class="content-wrapper">
                <?php echo $this->include('partials/pageHeader') ?>

                <div class="card" style="margin-top: 20px">
                    <form method="post" enctype="application/x-www-form-urlencoded" action="/usersGPOOperation">
                        <div class="card-body">
                            <div class="table-responsive">

                                <style>
                                    .form-check1 {
                                        position: relative;
                                        display: block;
                                        margin-top: -10px;
                                    }
                                </style>

                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Сотрудник</th>
                                        <?php foreach ($groupPolicy as $element): ?>
                                            <th style="writing-mode: vertical-rl"><?php echo $element["group_name"] ?></th>
                                        <?php endforeach; ?>
                                        <!--                                        <th style="writing-mode: vertical-rl">Группа 2</th>-->
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <!-- Foreach place -->
                                    <?php foreach ($users as $element2): ?>
                                    <tr>
                                        <?php if ($element2["role_id"] >= 3) continue; ?>
                                        <td><?php echo $element2["username"]; ?></td>
                                        <?php foreach ($groupPolicy as $element): ?>
                                            <td>
                                                <div class="form-check form-check1">
                                                    <label class="form-check-label">


                                                        <?php
                                                        $checked = "";
                                                        //Перебор всех нажатых услуг этого пользователя
                                                        foreach ($usersSelectedGroupTotal as $selected) {
                                                            //Нашли совпадение - чекед
                                                            if ($selected["user_id"] == $element2["id"] && $selected["group_id"] == $element["id"]) {
                                                                $checked = "checked ";
                                                                break;
//                                                                if ($selected["active"] > 0) {
//                                                                    $checked .= "disabled ";
//                                                                }
                                                            }
                                                        }
                                                        ?>
                                                        <input <?php  echo $checked   ?> value="<?php echo $element2["id"] . "_" . $element["id"] ?>" <?php $element["group_name"] ?>
                                                               type="checkbox" class="form-check-input user_group_selector"
                                                               name="checkboxGP[]">
                                                        <i class="input-helper"></i>
                                                        <i class="input-helper"></i></label>
                                                </div>
                                            </td>
                                        <?php endforeach; ?>
                                        <?php endforeach; ?>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php echo $this->include('partials/footer') ?>
        </div>
    </div>
</div>

<?php
if ($_GET["error"]=="gpUsExists"){?>
    <script>
        alert("Такой пользователь уже существует");
        location.href="/gPOUsers.php";
    </script>

<?php }?>

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

<?php echo $this->endSection() ?>



