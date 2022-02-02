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

                                    <form method="post" enctype="application/x-www-form-urlencoded" action="/invoicesOperation">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>Номер счета</th>
                                                <th>Юридическое лицо</th>
                                                <th>Имя пользователя</th>
                                                <th>Сумма платежа</th>
                                                <th>Статус счета</th>

                                            </tr>
                                            </thead>
                                            <tbody>


                                            <?php foreach ($invoices as $element): ?>
                                                <tr>
                                                    <td>

                                                        С_<?php echo $element["id"] ?>
                                                    </td>

                                                    <?php //echo session()->get("userRoleTitle")?><!--</td>-->
                                                    <td><?php echo $element["company_name"] ?></td>
                                                    <td><?php echo $element["username"] ?></td>

                                                    <!--                                            <td>-->
                                                    <!--                                                <label class="badge badge-gradient-success">-->
                                                    <?php //echo $element->status?><!--</label>-->
                                                    <!--                                            </td>-->
                                                    <td><?php echo $element["amount"] ?></td>
                                                <?php if ($element["status"]== "new") { ?>
                                                            <td class="text-danger">не оплачен</td>
                                                    <?php }elseif  ($element["status"]== "paid"){ ?>
                                                            <td class="text-success">оплачен</td>
                                                      <?php }  else { ?>
                                                            <td class="text-warning">частично оплачен</td>
                                                    <?php } ?>
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
            <?php echo  $this->include('partials/footer') ?>
        </div>
    </div>
</div>

<?php echo $this->endSection() ?>

