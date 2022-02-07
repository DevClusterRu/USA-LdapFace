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
                    <div class="card-body">
                        <div class="table-responsive">
                            <form method="post" enctype="application/x-www-form-urlencoded" action="/usersGPOOperation">
                                <table class="table" style="margin-top: 20px">
                                    <?php foreach ($groupPolicy as $element): ?>
                                    <thead>
                                    <tr>
                                        <th style="writing-mode: vertical-rl"> Сотрудник </th>
                                        <th style="writing-mode: vertical-rl" > <?php echo $element["group_name"] ?> </th>

                                    </tr>
                                    <?php endforeach; ?>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($users as $elements): ?>
                                        <tr>
                                            <td><?php echo $elements["username"] ?></td>
<!--                                            <td>--><?php //echo $elements["name"] ?><!--</td>-->
<!--                                            <td>--><?php //echo $elements["inn"] ?><!--</td>-->
<!--                                            <td>--><?php //echo $elements["kpp"] ?><!--</td>-->
<!--                                            <td>-->
<!--                                                <button name="updating" type="submit"-->
<!--                                                        value="--><?php //echo $element["id"] ?><!--"-->
<!--                                                        class="btn btn-gradient-primary me-2">-->
<!--                                                    Редактировать-->
<!--                                                </button>-->
<!--                                            </td>-->

                                            <td>
                                                <div class="form-check" style="margin-top: 0">
                                                    <checked
                                                    ="checked" class="form-check-label">
                                                    <input value="<?php echo $element["id"] ?>"
                                                           type="checkbox"
                                                        <?php
                                                        if ($element["service_id"]) {
                                                            echo "checked";
                                                        }
                                                        ?>
                                                           class="form-check-input servicesSelector"
                                                           name="checkboxService"><i
                                                            class="input-helper"></i>
                                                    </label>
                                                </div>

                                            </td>
<!--                                            <td>-->
<!--                                                <div class="form-check">-->
<!--                                                    <label class="form-check-label">-->
<!--                                                        <input value="--><?php //echo $element["id"] ?><!--" type="checkbox"-->
<!--                                                               class="form-check-input" name="checkboxDel[]">Удалить<i-->
<!--                                                                class="input-helper"></i>-->
<!--                                                    </label>-->
<!--                                                </div>-->
<!--                                            </td>-->
                                        </tr>
                                    <?php endforeach; ?>
<!--                                    <tr>-->
<!--                                        <td></td>-->
<!--                                        <td></td>-->
<!--                                        <td></td>-->
<!--                                        <td></td>-->
<!--                                        <td></td>-->
<!--                                        <td>-->
<!--                                            <div class="butDelUsers">-->
<!--                                                <button type="submit" value="del" name="delete"-->
<!--                                                        class="btn btn-gradient-primary me-2 ">Удалить-->
<!--                                                </button>-->
<!--                                            </div>-->
<!--                                        </td>-->
<!--                                    </tr>-->
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

