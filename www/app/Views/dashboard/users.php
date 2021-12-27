<?php echo $this->extend('dash_layout') ?>

<?php echo $this->section('content') ?>

<div class="container-scroller">
    <?= $this->include('partials/navbar') ?>
    <div class="container-fluid page-body-wrapper">
        <?= $this->include('partials/leftMenu') ?>
        <div class="main-panel">
            <div class="content-wrapper">
                <?= $this->include('partials/pageHeader') ?>
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

                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th> Пользователь</th>
                                            <th> Роль</th>
                                            <!--                                            <th> Статус</th>-->
                                            <th> Дата регистрации</th>
                                            <th> Последний вход</th>
                                            <th> Редактирование</th>
                                            <th> Удаление</th>
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

                                                <!--                                            <td>-->
                                                <!--                                                <label class="badge badge-gradient-success">-->
                                                <?php //echo $element->status?><!--</label>-->
                                                <!--                                            </td>-->
                                                <td><?php echo $element["created_at"] ?></td>
                                                <td><?php echo $element["updated_at"] ?></td>
                                                <td>
                                                    <button type="submit" class="btn btn-gradient-primary me-2">
                                                        Редактировать
                                                    </button>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input">Удалить<i
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
                                                <td></td>
                                                <td> <div class="butDelUsers">
                                                        <button type="submit" class="btn btn-gradient-primary me-2 ">Удалить</button>
                                                    </div></td>
                                            </tr>

                                        </tbody>
                                    </table>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?= $this->include('partials/footer') ?>
        </div>
    </div>
</div>

<?php echo $this->endSection() ?>

