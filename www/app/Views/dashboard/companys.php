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
                        <h4>Добавить / отредактировать компанию<div class="hidder" object="addForm">-</div></h4>

                        <div class="hidden addForm">
                            <form method="post" enctype="application/x-www-form-urlencoded" action="/companysOperation">
                                <!--                           <p class="card-description"> Basic form layout </p>    -->
                                <div class="form-group">
                                    <input name="id"
                                           value="<?php if (isset($curCompany)) echo $curCompany["id"]; ?>"
                                           type="hidden"
                                           class="form-control" id="exampleInputUsername1"
                                           placeholder="ID">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Название ЮЛ</label>
                                    <input name="name"
                                           value="<?php if (isset($curCompany)) echo $curCompany["name"] ?>"
                                           type="text" class="form-control"
                                           id="exampleInputUsername1"
                                           placeholder="Название ЮЛ" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">ИНН</label>
                                    <input name="inn"
                                           value="<?php if (isset($curCompany)) echo $curCompany["inn"] ?>"
                                           type="number" class="form-control"
                                           id="exampleInputUsername1"
                                           placeholder="ИНН"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">КПП</label>
                                    <input name="kpp"
                                           value="<?php if (isset($curCompany)) echo $curCompany["kpp"] ?>"
                                           type="number" class="form-control"
                                           id="exampleInputUsername1"
                                           placeholder="КПП">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Server</label>
                                    <select name="server" class="form-control">
                                        <?php foreach ($servers as $server) { ?>
                                            <option value="<?php echo $server["id"] ?>"><?php echo $server["domain"] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <button name="addEdit" value="1" type="submit"
                                        class="btn btn-gradient-primary me-2">Принять
                                </button>
                                <button  formnovalidate name="cancel" value="2" type="submit"
                                        class="btn btn-light">Отмена
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card" style="margin-top: 20px">
                    <div class="card-body">
                        <div class="table-responsive">
                            <form method="post" enctype="application/x-www-form-urlencoded" action="/companysOperation">
                                <table class="table" style="margin-top: 20px">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Название ЮЛ</th>
                                        <th>ИНН</th>
                                        <th>КПП</th>
                                        <th>Server</th>
                                        <th>Редактирование</th>
                                        <th>Удаление</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($companys as $element): ?>
                                        <tr>
                                            <td><?php echo $element["id"] ?></td>
                                            <td><?php echo $element["name"] ?></td>
                                            <td><?php echo $element["inn"] ?></td>
                                            <td><?php echo $element["kpp"] ?></td>
                                            <td><?php echo $element["server_domain"] ?></td>
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

<?php
if ($_GET["error"]=="companyExists"){?>
    <script>
        alert("Ошибка создания");
        location.href="/companys";
    </script>

<?php }?>

<?php
if ($_GET["error"]=="delCompanyExists"){?>
    <script>
        alert("Не удалось удалить компанию!");
        location.href="/companys";
    </script>

<?php }?>

<?php echo $this->endSection() ?>


