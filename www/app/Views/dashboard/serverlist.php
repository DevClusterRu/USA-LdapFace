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
                                    <form method="post" enctype="application/x-www-form-urlencoded" action="/delServersList">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th> ID</th>
                                            <th> Domain </th>
                                            <!--                                            <th> Статус</th>-->
                                            <th>ip</th>
                                            <th>login</th>
                                            <th>password</th>
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
                                                    <button type="button" class="btn btn-gradient-primary me-2">
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
                                                    <button type="submit" class="btn btn-gradient-primary me-2 ">Удалить</button>
                                                </div></td>
                                        </tr>
                                        </tbody>
                                    </table></form>
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