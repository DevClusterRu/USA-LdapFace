<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="/"><img src="/assets/images/logo.svg" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="/"><img src="/assets/images/logo-mini.svg"
                                                              alt="logo"/></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>
        <div class="search-field d-none d-md-block">
            <form class="d-flex align-items-center h-100" action="#">
                <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                        <i class="input-group-text border-0 mdi mdi-magnify"></i>
                    </div>
                    <input type="text" class="form-control bg-transparent border-0" placeholder="Search projects">
                </div>
            </form>
        </div>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown"
                   aria-expanded="false">
                    <div class="nav-profile-img">
                        <img src="assets/images/faces/img.png" alt="profile">
                        <span class="availability-status online"></span>
                    </div>
<!--                  условие для выделения цвета, переменная как стиль -->
                     <?php
                    $colorZoom="";
                    if (session()->get('zoom_id'))  $colorZoom='style="color: orangered"';
                    ?>
                    <div class="nav-profile-text">
                        <p class="mb-1 text-black" <?php echo $colorZoom ?> ><?php echo session()->get("userName")?></p>
                    </div>
                </a>
                <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="/profile">
                        <i class="mdi mdi-account-details mr-2 text-success"></i> <?php echo lang('Main.profile') ?>
                    </a>
                    <div class="dropdown-divider"></div>


<!--выпадашка выхода зумирования-->
                    <?php
                    $dropMenuZoom="";
                    if (session()->get('zoom_id')) echo $dropMenuZoom='<a class="dropdown-item" href="/zoomout">
                        <i class="mdi mdi-eye-off mr-2 text-primary"></i>Зум выход</a>
                    <div class="dropdown-divider"></div><!--черта-->';
                    ?>




                    <a class="dropdown-item" href="/logout">
                        <i class="mdi mdi-logout mr-2 text-primary"></i> Выход
                    </a>
                </div>
            </li>

            <?php if(session()->get("userRole")>1 && session()->get("userRole")<3 ){?>  <!--условие для ограничения просмотров, полное условие-->
            <li class="nav-item ">
                    <div><i class="mdi mdi-currency-rub"><?php echo session()->get("balance") ?></i>
<!--                        <div><i class="mdi mdi-currency-rub">10000</i>-->
                       </div>
            </li>
            <?php } ?> <!--конец условия для ограничения просмотров-->

            <li class="nav-item dropdown">
                <a title="<?php echo $newItems?>"  class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                   data-toggle="dropdown">
                    <i class="mdi mdi-bell-outline"></i>
                    <?php if ($newItems): ?>
                    <span class="count-symbol bg-danger"></span>
                    <?php endif; ?>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                     aria-labelledby="notificationDropdown">
                    <h6 class="p-3 mb-0">Notifications</h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-success">
                                <i class="mdi mdi-calendar"></i>
                            </div>
                        </div>
                        <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                            <h6 class="preview-subject font-weight-normal mb-1">Event today</h6>
                            <p class="text-gray ellipsis mb-0"> Just a reminder that you have an event today </p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-warning">
                                <i class="mdi mdi-settings"></i>
                            </div>
                        </div>
                        <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                            <h6 class="preview-subject font-weight-normal mb-1">Settings</h6>
                            <p class="text-gray ellipsis mb-0"> Update dashboard </p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-info">
                                <i class="mdi mdi-link-variant"></i>
                            </div>
                        </div>
                        <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                            <h6 class="preview-subject font-weight-normal mb-1">Launch Admin</h6>
                            <p class="text-gray ellipsis mb-0"> New admin wow! </p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <h6 class="p-3 mb-0 text-center">See all notifications</h6>
                </div>
            </li>
            <li class="nav-item nav-logout d-none d-lg-block">
                <a class="nav-link" href="/logout">
                    <i class="mdi mdi-power"></i>
                </a>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
