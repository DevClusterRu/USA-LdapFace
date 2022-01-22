<?php echo $this->extend('dash_layout') ?>

<?php echo $this->section('content') ?>

<div class="container-scroller">
    <?php echo  $this->include('partials/navbar') ?>
    <div class="container-fluid page-body-wrapper">
        <?php echo  $this->include('partials/leftMenu') ?>
        <div class="main-panel">

            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Пользователи AD</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> Name </th>
                                    </tr>
                                    </thead>
                                    <tbody>
            <?php
            foreach ($ldapUsers as $key=>$user){?>

                                    <tr>
                                        <td> <?php echo $key?> </td>
                                        <td> <?php echo $user?> </td>

                                    </tr>
            <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>
</div>



<?php echo $this->endSection() ?>
