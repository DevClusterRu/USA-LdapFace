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
                            <h4 class="card-title">Форма создания / редактирования
                                <div class="hidder" object="addForm">-</div>
                            </h4>
                            <div class="hidden addForm">
                                <form method="post" enctype="application/x-www-form-urlencoded"
                                      action="/serversOperation">
                                    <form class="forms-sample">
                                        <div class="form-group">
                                            <input name="id"
                                                   value="<?php if (isset($curServer)) echo $curServer["id"] ?>"
                                                   type="hidden" class="form-control" id="exampleInputUsername1"
                                                   placeholder="ID">
                                        </div>
                                        <form class="forms-sample">
                                            <div class="form-group">
                                                <label for="exampleInputUsername1">Domain</label>
                                                <input name="domain"
                                                       value="<?php if (isset($curServer)) echo $curServer["domain"] ?>"
                                                       type="text" class="form-control" id="exampleInputUsername1"
                                                       placeholder="Domain">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputUsername1">URL</label>
                                                <input name="url"
                                                       value="<?php if (isset($curServer)) echo $curServer["url"] ?>"
                                                       type="text" class="form-control" id="exampleInputUsername1"
                                                       placeholder="IP">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputUsername1">Login</label>
                                                <input name="login"
                                                       value="<?php if (isset($curServer)) echo $curServer["login"] ?>"
                                                       type="text" class="form-control" id="exampleInputUsername1"
                                                       placeholder="Login">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputUsername1">Password</label>
                                                <input name="password"
                                                       value="<?php if (isset($curServer)) echo $curServer["password"] ?>"
                                                       type="text" class="form-control" id="exampleInputUsername1"
                                                       placeholder="Password">
                                            </div>
                                            <button name="addEdit" value="1" type="submit"
                                                    class="btn btn-gradient-primary me-2">Принять
                                            </button>
                                            <button name="cancel" value="2" class="btn btn-light">Очистить</button>
                                        </form>

                                    </form>
                            </div>
                        </div>
                    </div>

                    <div class="card" style="margin-top: 20px">
                        <div class="card-body">
                            <div class="table-responsive">
                                <form method="post" enctype="application/x-www-form-urlencoded"
                                      action="/serversOperation">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th> ID</th>
                                            <th> Domain</th>
                                            <th>URL</th>
                                            <th>Login</th>
                                            <th>Password</th>
                                            <th>Редактирование</th>
                                            <th>Удаление</th>
                                        </tr>
                                        </thead>
                                        <tbody>


                                        <?php foreach ($servers as $element): ?>
                                            <tr>
                                                <td><?php echo $element["id"] ?></td>
                                                <td><?php echo $element["domain"] ?></td>
                                                <td><?php echo $element["url"] ?></td>
                                                <td><?php echo $element["login"] ?></td>
                                                <td><?php echo $element["password"] ?></td>

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
                                                                   class="form-check-input" name="checkboxDel[]">Удалить
                                                            <i class="input-helper"></i>
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
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <div class="butDelUsers">
                                                    <button name="delete" value="del" type="submit"
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

<?php echo $this->endSection() ?>