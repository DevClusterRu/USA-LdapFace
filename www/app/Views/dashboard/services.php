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



                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Название услуги</th>

                                                    <th>Срок действия до </th>
                                                    <th>Стоимость</th>



                                                </tr>
                                                </thead>
                                                <tbody>


                                                <?php foreach ($servicesAll as $element): ?>
                                                    <tr>
                                                        <td>

                                                            <?php echo $element["id"] ?>
                                                        </td>

                                                        <td><?php echo $element["name"] ?></td>

                                                        <td><?php echo $element["date_to"] ?></td>
                                                        <td><?php echo $element["coast"] ?></td>




                                                    </tr>
                                                <?php endforeach;?>

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