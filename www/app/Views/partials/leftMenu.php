<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="assets/images/faces/img.png" alt="profile">
                    <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2"><?php echo session()->get("userName")?></span>
                    <span class="text-secondary text-small"><?php echo session()->get("userRoleTitle")?></span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/profile">
                <span class="menu-title">Профиль</span>
                <i class="mdi mdi-animation menu-icon"></i>
            </a>
        </li>

        <?php if(session()->get("userRole")>1){?>  <!--условие для ограничения просмотров, разрешение-->
        <li class="nav-item">
            <a class="nav-link" href="/users">
                <span class="menu-title">Пользователи</span>
                <i class="mdi mdi-account-multiple menu-icon"></i>
            </a>
        </li>
        <?php } ?> <!--конец условия для ограничения просмотров-->

        <?php if(session()->get("userRole")>3){?>  <!--условие для ограничения просмотров, разрешение-->
        <li class="nav-item">
            <a class="nav-link" href="/roles">
                <span class="menu-title">Роли</span>
                <i class="mdi mdi-tag-faces menu-icon"></i>
            </a>
        </li>
        <?php } ?> <!--конец условия для ограничения просмотров-->

        <?php if(session()->get("userRole")>2){?>  <!--условие для ограничения просмотров-->
        <li class="nav-item">
            <a class="nav-link" href="/servers">
                <span class="menu-title">Список серверов</span>
                <i class=" mdi mdi-server menu-icon"></i>
            </a>
        </li>

        <?php } ?> <!--конец условия для ограничения просмотров-->

        <?php if(session()->get("userRole")>1){?>  <!--условие для ограничения просмотров, разрешение-->
        <li class="nav-item">
            <a class="nav-link" href="/invoices">
                <span class="menu-title">Оплата</span>
                <i class="mdi mdi-dns menu-icon"></i>
            </a>
        </li>
        <?php } ?> <!--конец условия для ограничения просмотров-->

        <?php if(session()->get("userRole")>2){?>  <!--условие для ограничения просмотров, разрешение-->
        <li class="nav-item">
            <a class="nav-link" href="/services">
                <span class="menu-title">Услуги</span>
                <i class="mdi mdi-view-headline menu-icon"></i>
            </a>
        </li>
        <?php } ?> <!--конец условия для ограничения просмотров-->

        <?php if(session()->get("userRole")>3){?>  <!--условие для ограничения просмотров, разрешение-->
        <li class="nav-item">
            <a class="nav-link" href="/companys">
                <span class="menu-title">Компании</span>
                <i class="mdi mdi-houzz-box menu-icon"></i>
            </a>
        </li
            <?php } ?> <!--конец условия для ограничения просмотров-->
            <?php if(session()->get("userRole")>2){?>  <!--условие для ограничения просмотров, разрешение-->
        <li class="nav-item">
            <a class="nav-link" href="/groupPolicy">
                <span class="menu-title">GPO</span>
                <i class="mdi mdi-houzz-box menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/gp">
                <span class="menu-title">Групповые политики</span>
                <i class="mdi mdi-houzz-box menu-icon"></i>
            </a>
        </li>
            <?php } ?> <!--конец условия для ограничения просмотров-->

<!--        --><?php //if (session()->get("userRole")=="admin"):?>
<!--            <li class="nav-item">-->
<!--                <a class="nav-link" href="/addproject">-->
<!--                    <span class="menu-title">Новый проект</span>-->
<!--                    <i class="mdi mdi-cart-plus menu-icon"></i>-->
<!--                </a>-->
<!--            </li>-->
<!--        --><?php //endif?>




    </ul>
</nav>
