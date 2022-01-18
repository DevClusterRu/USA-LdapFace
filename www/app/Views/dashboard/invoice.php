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
                                    <form method="post" enctype="application/x-www-form-urlencoded" action="/usersOperation">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>Номер счета</th>
                                                <th>Имя пользователя</th>
                                                <th>Статус счета</th>

                                            </tr>
                                            </thead>
                                            <tbody>


                                            <?php foreach ($invoiceAll as $element): ?>
                                                <tr>
                                                    <td>

                                                        <?php echo $element["invoice_num"] ?>
                                                    </td>
                                                    <!--                                           <td>-->
                                                    <?php //echo session()->get("userRoleTitle")?><!--</td>-->
                                                    <td><?php echo $element["user_id"] ?></td>

                                                    <!--                                            <td>-->
                                                    <!--                                                <label class="badge badge-gradient-success">-->
                                                    <?php //echo $element->status?><!--</label>-->
                                                    <!--                                            </td>-->
                                                    <td><?php echo $element["status"] ?></td>


                                            </tr>
                                            <?php endforeach; ?>
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

