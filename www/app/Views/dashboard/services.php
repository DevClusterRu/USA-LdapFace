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
                        <h4>Добавить / отредактировать услуги
                            <div class="hidder" object="addFormService">-</div>
                        </h4>

                        <div class="<?php echo session()->get("serviceUpDown")?> addFormService">
                            <form method="post" enctype="application/x-www-form-urlencoded" action="/servicesOperation">
                                <!--                           <p class="card-description"> Basic form layout </p>    -->
                                <div class="form-group">
                                    <input name="id"
                                           value="<?php if (isset($curService)) echo $curService["id"] ?>"
                                           type="hidden"
                                           class="form-control" id="exampleInputUsername1"
                                           placeholder="ID">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Название услуги</label>
                                    <input name="name"
                                           value="<?php if (isset($curService)) echo $curService["name"] ?>"
                                           type="text" class="form-control"
                                           id="exampleInputUsername1"
                                           placeholder="Название услуги" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Тип услуги</label>

                                    <select name="typeservice" class="form-control"> <!--выпадашка-->
                                        <?php if (isset($curService)) {
                                            if ($curService["type_service"] == "once") { ?>
                                                <option value="once">Разовая оплата</option>
                                                <option value="continue">Абонимет</option>
                                            <?php } else { ?>?>
                                                <option value="continue">Абонимет</option>
                                                <option value="once">Разовая оплата</option>
                                            <?php }
                                        } else { ?>
                                            <option value="once">Разовая оплата</option>
                                            <option value="continue">Абонимет</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Стоимость</label>
                                    <input name="cost"
                                           value="<?php if (isset($curService)) echo $curService["cost"] ?>"
                                           type="number" class="form-control"
                                           id="exampleInputUsername1"
                                           placeholder="Стоимость" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Продолжительность</label>
                                    <input name="length"
                                           value="<?php if (isset($curService)) echo $curService["length"] ?>"
                                           type="text" class="form-control"
                                           id="exampleInputUsername1"
                                           placeholder="Продолжительность" required>
                                </div>


                                <button name="addEdit" value="1" type="submit"
                                        class="btn btn-gradient-primary me-2">Принять
                                </button>
                                <button type="button" onClick='location.href="/services"' name="cancel" value="2"
                                        class="btn btn-light">Отмена <!--событие он клик-->
                                </button>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="card" style="margin-top: 20px">
                    <div class="card-body">
                        <div class="table-responsive">
                            <form method="post" enctype="application/x-www-form-urlencoded" action="/servicesOperation">
                                <table class="table" style="margin-top: 20px">
                                    <thead>
                                    <tr>
                                        <th>Название услуги</th>
                                        <th>Тип услуги</th>
                                        <th>Стоимость</th>
                                        <th>Продолжительность</th>
                                        <th>Редактирование</th>
                                        <th>Удаление</th>

                                    </tr>
                                    </thead>
                                    <tbody>


                                    <?php foreach ($services

                                    as $element): ?>
                                    <tr>
                                        <td><?php echo $element["name"] ?></td>
                                        <td><?php
                                            if ($element["type_service"] == "once")
                                                echo "Разовая оплата";
                                            else
                                                echo "Абониментская оплата";
                                            ?></td>
                                        <td><?php echo $element["cost"] ?></td>
                                        <td><?php echo $element["length"] ?></td>
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

                                        <?php endforeach; ?>
                                    <tr>
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

<?php echo $this->endSection() ?>

