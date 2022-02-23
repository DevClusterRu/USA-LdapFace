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
                        <h4>Добавить / отредактировать пользователя<div class="hidder" object="addForm">-</div></h4>

                        <div class="hidden addForm">
                            <form method="post" enctype="application/x-www-form-urlencoded" action="/usersOperation">
                                <!--                           <p class="card-description"> Basic form layout </p>    -->
                                <div class="form-group">
                                    <input name="id"
                                           value="<?php if (isset($curUser)) echo $curUser["id"] ?>"
                                           type="hidden"
                                           class="form-control" id="exampleInputUsername1"
                                           placeholder="ID">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Пользователь</label>
                                    <input name="username"
                                           value="<?php if (isset($curUser)) echo $curUser["username"] ?>"
                                           type="text" class="form-control"
                                           id="exampleInputUsername1"
                                           placeholder="Пользователь" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">E-Mail</label>
                                    <input name="email"
                                           value="<?php if (isset($curUser)) echo $curUser["email"] ?>"
                                           type="email" class="form-control"
                                           id="exampleInputUsername1"
                                           placeholder="E-Mail" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Контактный номер
                                        телефона</label>
                                    <input name="phone"
                                           value="<?php if (isset($curUser)) echo $curUser["phone"] ?>"
                                           type="text" class="form-control"
                                           id="exampleInputUsername1"
                                           placeholder="Контактный номер"
                                           pattern="[+]{1}[7]{1}-[0-9]{3}-[0-9]{3}-[0-9]{4}"
                                           required>
                                    <small class="text-muted">Формат: +7-123-456-7890</small>
                                </div>

                                <?php if(session()->get("userRole")>2){?>  <!--условие для ограничения просмотров, разрешение-->
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Компания</label>
                                    <select name="company" class="form-control">
                                         <?php foreach ($companys as $company) { ?>
                                             <?php $selected=""; if ($curUser["company_id"] == $company["id"]) $selected = " selected "?>
                                            <option <?php echo $selected?>  value="<?php echo $company["id"] ?>"><?php echo $company["name"] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <?php } ?> <!--конец условия для ограничения просмотров-->


                                <div class="form-group">
                                    <label for="exampleInputUsername1">Роль</label>
                                    <select name="role" class="form-control">
                                         <?php foreach ($roles as $role) { ?>
<!--                                        --><?php //if(session()->get("userRole")==2){ if ($role["role_id"] > 2) continue;} ?>
                                             <?php $selected=""; if ($curUser["role_id"] == $role["role_id"]) $selected = " selected "?>
                                            <option <?php echo $selected?> value="<?php echo $role["role_id"] ?>"><?php echo $role["role_name"] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <button name="addEdit" value="1" type="submit"
                                        class="btn btn-gradient-primary me-2">Принять
                                </button>
                                <button formnovalidate name="cancel" value="2" class="btn btn-light">Очистить
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card" style="margin-top: 20px">
                    <div class="card-body">
                        <div class="table-responsive">
                            <form method="post" enctype="application/x-www-form-urlencoded" action="/usersOperation">
                                <table class="table" style="margin-top: 20px">
                                    <thead>
                                    <tr>
                                        <th> Пользователь</th>
                                        <th> Роль</th>
                                        <th> Компания</th>
<!--                                        <th>Дата регистрации</th>-->
<!--                                        <th>Последний вход</th>-->
                                        <th>Редактирование</th>
                                        <th>Удаление</th>
                                        <th>Сброс пароля</th>
                                        <th>Пригласить</th>
                                    </tr>
                                    </thead>
                                    <tbody>


                                    <?php foreach ($users as $element): ?>
                                    <?php if ($element["role_id"]==4) continue; ?>
                                        <tr>
<!--формируем ссылку для зумирования, туда попадет айди пользователя-->
                                            <!--условия для разрешения зумирование и проверка двойного зумирования, разрешение-->
                                            <td>  <?php if(session()->get("userRole")>2 && !session()->get("zoom_id")){?>
                                                <a href="/zoom/<?php echo $element["id"] ?>"><?php echo $element["username"] ?></a>
                                                <?php } else {?>
                                                    <?php echo $element["username"] ?>
                                                <?php }?>

                                            </td>
                                            <td><?php echo $element["role_name"] ?></td>
                                            <td><?php echo $element["company_name"] ?></td>
<!--                                            <td>--><?php //echo $element["created_at"] ?><!--</td>-->
<!--                                            <td>--><?php //echo $element["updated_at"] ?><!--</td>-->
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
                                            <td>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input value="<?php echo $element["id"] ?>" type="checkbox"
                                                               class="form-check-input" name="checkboxRes[]">Сбросить
                                                        пароль<i
                                                                class="input-helper"></i>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input value="<?php echo $element["id"] ?>" type="checkbox"
                                                               class="form-check-input" name="checkboxInvite[]">Пригласить<i
                                                                class="input-helper"></i>
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
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
                                        <td>
                                            <div class="butDelUsers">
                                                <button type="button" value="res" name="resBut"
                                                        class="btn btn-gradient-primary me-2 ">Сбросить пароль
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="butDelUsers">
                                                <button type="submit" value="hash" name="inv"
                                                        class="btn btn-gradient-primary me-2 ">Пригласить
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

<!--резултат проверки на стороне сервера-->
<?php
if ($_GET["error"]=="userExists"){?>
    <script>
        alert("Не удалось создать пользователя");
        location.href="/users";
    </script>

<?php }?>

<?php
if ($_GET["error"]=="editUserExists"){?>
    <script>
        alert("Не удалось изменить пользователя!");
        location.href="/users";
    </script>

<?php }?>

<?php
if ($_GET["error"]=="delUserExists"){?>
    <script>
        alert("Не удалось удалить пользователя!");
        location.href="/users";
    </script>

<?php }?>

<?php echo $this->endSection() ?>

