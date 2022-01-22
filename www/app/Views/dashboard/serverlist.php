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
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">

<!--                                    <style>-->
<!--                                        .butDelUsers {-->
<!--                                            width: 100%;-->
<!--                                            text-align: right;-->
<!--                                        }-->
<!--                                    </style>-->
                                    <form method="post" enctype="application/x-www-form-urlencoded" action="/serverlistOperation1">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th> ID</th>
                                            <th> Domain </th>
                                            <!--                                            <th> Статус</th>-->
                                            <th>IP</th>
                                            <th>Login</th>
                                            <th>Password</th>
                                            <!--  <th>Последний вход</th>           -->
                                            <th>Редактирование</th>
                                            <th>Удаление</th>
                                        </tr>
                                        </thead>
                                        <tbody>


                                        <?php foreach ($serverAll as $element): ?>
                                            <tr>
                                                <td>

                                                    <?php echo $element["id"] ?>
                                                </td>
                                                <!--                                           <td>-->
                                                <?php //echo session()->get("userRoleTitle")?><!--</td>-->
                                                <td><?php echo $element["domain"] ?></td>

                                                <td><?php echo $element["ip"] ?></td>
                                                <td><?php echo $element["login"] ?></td>
                                                <td><?php echo $element["password"] ?></td>

                                                <td>
                                                    <button name="updating" type="submit" value="<?php echo $element["id"] ?>" class="btn btn-gradient-primary me-2">
                                                        Редактировать
                                                    </button>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input value="<?php echo $element["id"] ?>" type="checkbox" class="form-check-input" name="checkboxDel[]">Удалить
                                                            <i class="input-helper"></i>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach;?>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td> <div class="butDelUsers">
                                                    <button  name="delBut"  value="del" type="submit" class="btn btn-gradient-primary me-2 ">Удалить</button>
                                                </div></td>
                                        </tr>
                                        </tbody>
                                    </table></form>
                                </div>
                            </div>
                        </div>


                        <form method="post" enctype="application/x-www-form-urlencoded" action="/serverlistOperation2">

                            <div class="card" style="margin-top: 20px">
                                <div class="card-body">
                                    <h4 class="card-title">Форма создания / редактирования</h4>
       <!--                           <p class="card-description"> Basic form layout </p>
       -->                            <form class="forms-sample">
                                        <div class="form-group">
                                           <input name="id" value="<?php echo $curServer->id ?>" type="hidden" class="form-control" id="exampleInputUsername1" placeholder="ID">
                                        </div>
                                   <form class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Domain</label>
                                            <input name="domain" value="<?php echo $curServer->domain ?>" type="text" class="form-control" id="exampleInputUsername1" placeholder="Domain">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">IP</label>
                                            <input name="ip" value="<?php echo $curServer->ip ?>" type="text" class="form-control" id="exampleInputUsername1" placeholder="IP">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Login</label>
                                            <input name="login" value="<?php echo $curServer->login ?>" type="text" class="form-control" id="exampleInputUsername1" placeholder="Login">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Password</label>
                                            <input name="password" value="<?php echo $curServer->password ?>" type="text" class="form-control" id="exampleInputUsername1" placeholder="Password">
                                        </div>
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
            </div>
            <?php echo  $this->include('partials/footer') ?>
        </div>
    </div>
</div>

<?php echo $this->endSection() ?>