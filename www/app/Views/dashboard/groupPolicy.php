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

                        <div class="hidden addForm">
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
                                           placeholder="Имя GPO">
                                </div>
<!--                                --><?php //if(session()->get("userRole")>2){?><!--  -->
                                    <!--условие для ограничения просмотров, разрешение-->
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Название Юридического лица</label>
                                        <select name="company" class="form-control">
                                            <?php foreach ($companys as $company) { ?>
                                                <option value="<?php echo $company["id"] ?>"><?php echo $company["name"] ?></option>
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
                                           placeholder="Oписание GPO">
                                </div>
                                <button name="addEdit" value="1" type="submit"
                                        class="btn btn-gradient-primary me-2">Принять
                                </button>
                                <button type="button" onClick='location.href="/groupPolicy"' name="cancel" value="2" class="btn btn-light">Отмена <!--событие он клик-->
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card" style="margin-top: 20px">
                    <div class="card-body">
                        <div class="table-responsive">
                            <form method="post" enctype="application/x-www-form-urlencoded" action="/groupPolicyOperation">
                                <table class="table" style="margin-top: 20px">
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

                                    <?php foreach ($groupPolicy as $element): ?>
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

<?php echo $this->endSection() ?>
