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


                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <form id="avaForm" method="post" enctype="multipart/form-data">
                                    <input type="file" name="newAvatar" style="display: none">
                                </form>

                                <h4 class="card-title">Аватар <a href="#" onclick="openAvaLoad(); return false"><i
                                                class="mdi mdi-pencil"></i></a></h4>

                                <div class="row ava_holder">
                                    <div class="col-md-4 grid-margin avatar">
                                        <div style="background-image: url('<?php echo session()->get("userAvatar") ?>')"></div>
                                    </div>
                                </div>

                                <form method="post">
                                    <div class="form-group">
                                        <label>Ваше имя</label>
                                        <input value="<?php echo session()->get("userName") ?>" type="text"
                                               class="form-control form-control-lg" placeholder="Username"
                                               aria-label="Username" name="username">
                                    </div>

                                    <button type="submit" class="btn btn-gradient-primary mr-2">Сохранить</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?= $this->include('partials/footer') ?>
        </div>
    </div>
</div>

<script>
    function openAvaLoad() {
        $('[name="newAvatar"]').click();
    }

    $('[name="newAvatar"]').change(function () {
        $("#avaForm").submit();
    });

</script>

<?php echo $this->endSection() ?>
