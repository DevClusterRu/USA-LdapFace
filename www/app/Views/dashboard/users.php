<?php echo $this->extend('dash_layout') ?>

<?php echo $this->section('content') ?>

<div class="container-scroller">
    <?php echo  $this->include('partials/navbar') ?>
    <div class="container-fluid page-body-wrapper">
        <?php echo  $this->include('partials/leftMenu') ?>
        <div class="main-panel">
            <div class="content-wrapper">
                <?php echo  $this->include('partials/pageHeader') ?>
                <div class="row">

                    <div class="col-12 grid-margin">


<!--                                    <style>-->
<!--                                        .butDelUsers {-->
<!--                                            width: 100%;-->
<!--                                            text-align: right;-->
<!--                                        }-->
<!--                                    </style>-->

                                    <form method="post" enctype="application/x-www-form-urlencoded" action="/usersOperation1">

                                        <div class="card" >
                                            <div class="card-body">
                                                <h4 class="card-title">Форма создания / редактирования</h4>
                                                <!--                           <p class="card-description"> Basic form layout </p>    -->
                                                <form class="forms-sample">
                                                    <div class="form-group">
                                                        <input name="id" value="<?php echo $curServer->id ?>" type="hidden" class="form-control" id="exampleInputUsername1" placeholder="ID">
                                                    </div>
                                                    <form class="forms-sample">
                                                        <div class="form-group">
                                                            <label for="exampleInputUsername1">Пользователь</label>
                                                            <input name="username" value="<?php echo $curServer->username ?>" type="text" class="form-control" id="exampleInputUsername1" placeholder="Пользователь">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputUsername1">Юридическое лицо</label>


                                                            <select name="company" class="form-control">
                                                                <?php foreach ($companys as $company){?>
                                                                    <option value="<?php echo $company["id"] ?>"><?php echo $company["name"] ?></option>
                                                                <?php } ?>
                                                            </select>


                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputUsername1">Роль</label>
                                                            <input name="role" value="<?php echo $curServer->role ?>" type="text" class="form-control" id="exampleInputUsername1" placeholder="Роль">
                                                        </div>
<!--                                                        <div class="form-group">
                                                            <label for="exampleInputUsername1">      </label>
                                                         <input name="password" value="--><?php //echo $curServer->password ?><!--" type="text" class="form-control" id="exampleInputUsername1" placeholder="Password">
                                                       </div>
-->
                                                        <!--                                         <div class="form-group">
                                                                                            <label for="exampleInputPassword1">Password</label>
                                                                                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="exampleInputConfirmPassword1">Confirm Password</label>
                                                                                            <input type="password" class="form-control" id="exampleInputConfirmPassword1" placeholder="Password">
                                                                                        </div>
                                                                                        <div class="form-check form-check-flat form-check-primary">
                                                                                            <label class="form-check-label">
                                                                                                <input type="checkbox" class="form-check-input"> Remember me <i class="input-helper"></i></label>
                                                                                        </div>
                                                          -->



                                                        <button name="submit" value="1" type="submit" class="btn btn-gradient-primary me-2">Принять</button>
                                                        <button name="cancel" value="2" class="btn btn-light">Очистить</button>
                                                    </form>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                                    <form method="post" enctype="application/x-www-form-urlencoded" action="/usersOperation2">
                                    <table class="table" style="margin-top: 20px">
                                        <thead>
                                        <tr>
                                            <th> Пользователь</th>
                                            <th> Роль</th>
                                            <th> Компания</th>
                                            <!--                                            <th> Статус</th>-->
                                            <th>Дата регистрации</th>
                                            <th>Последний вход</th>
                                            <th>Редактирование</th>
                                            <th>Удаление</th>
                                            <th>Сброс пароля</th>
                                        </tr>
                                        </thead>
                                        <tbody>


                                        <?php foreach ($usersAll as $element): ?>
                                            <tr>
                                                <td>

                                                    <?php echo $element["username"] ?>
                                                </td>
                                                <!--                                           <td>-->
                                                <?php //echo session()->get("userRoleTitle")?><!--</td>-->
                                                <td><?php echo $element["role_name"] ?></td>
                                                <td><?php echo $element["name"] ?></td>

                                                <!--                                            <td>-->
                                                <!--                                                <label class="badge badge-gradient-success">-->
                                                <?php //echo $element->status?><!--</label>-->
                                                <!--                                            </td>-->
                                                <td><?php echo $element["created_at"] ?></td>
                                                <td><?php echo $element["updated_at"] ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-gradient-primary me-2">
                                                        Редактировать
                                                    </button>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input value="<?php echo $element["id"] ?>" type="checkbox" class="form-check-input" name="checkboxDel[]">Удалить<i
                                                                    class="input-helper"></i>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input value="<?php echo $element["id"] ?>" type="checkbox" class="form-check-input" name="checkboxRes[]">Сбросить пароль<i
                                                                    class="input-helper"></i>
                                                        </label>
                                                    </div>
                                            </tr>
                                        <?php endforeach; ?>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td> <div class="butDelUsers">
                                                        <button type="submit" value="del" name="delBut" class="btn btn-gradient-primary me-2 ">Удалить</button>
                                                    </div></td>
                                                <td> <div class="butDelUsers">
                                                    <button type="submit" value="res" name="resBut" class="btn btn-gradient-primary me-2 ">Сбросить пароль</button>
                                                </div></td>
                                            </tr>

                                        </tbody>
                                    </table></form>


                        </div>
                    </div>
                </div>
            </div>
            <?php echo  $this->include('partials/footer') ?>
        </div>
    </div>
</div>

<?php echo $this->endSection() ?>

