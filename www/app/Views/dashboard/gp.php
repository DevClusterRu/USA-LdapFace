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
                            <form method="post" enctype="application/x-www-form-urlencoded" action="/groupPolicyOperation">


                                <style>
                                    .form-check1 {
                                        position: relative;
                                        display: block;
                                        margin-top: -10px;
                                    }
                                </style>

                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Пользователь</th>
                                        <th style="writing-mode: vertical-rl">Группа 1</th>
                                        <th style="writing-mode: vertical-rl">Группа 2</th>
                                        <th style="writing-mode: vertical-rl">Группа 3</th>
                                        <th style="writing-mode: vertical-rl">Группа 4</th>
                                        <th style="writing-mode: vertical-rl">Группа 5</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Федя</td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Федя</td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Федя</td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Федя</td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Федя</td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Федя</td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Федя</td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Федя</td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Федя</td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Федя</td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check1">
                                                <label class="form-check-label">
                                                    <input value="2" type="checkbox" class="form-check-input" name="checkboxDel[]"><i class="input-helper"></i>
                                                    <i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>



                            </form>
                        </div>
                    </div>
                    <div style="text-align: right; margin: 20px">
                        <button type="submit" value="set" name="set"
                                class="btn btn-gradient-primary me-2 ">Установить
                        </button>
                    </div>
                </div>
            </div>
            <?php echo $this->include('partials/footer') ?>
        </div>
    </div>
</div>

<?php echo $this->endSection() ?>

