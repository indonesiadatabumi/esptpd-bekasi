<div class="app-main fixed-sidebar ">
    <div class="app-sidebar bg-color sidebar-text-light sidebar-shadow">
        <div class="app-header__mobile-menu">
            <div>
                <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
        <div class="app-header__menu">
            <span>
                <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                    <span class="btn-icon-wrapper">
                        <i class="fa fa-ellipsis-v fa-w-6"></i>
                    </span>
                </button>
            </span>
        </div>
        <div class="scrollbar-sidebar">
            <div class="app-sidebar__inner">
                <ul class="vertical-nav-menu">
                    <li class="app-sidebar__heading">Dashboard</li>
                    <li>
                        <a href="<?= base_url('/') ?>">
                            <i class="metismenu-icon pe-7s-display2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="app-sidebar__heading">Navigation Menu</li>
                    <li>
                        <a href="<?= base_url('/navigation') ?>">
                            <i class="metismenu-icon pe-7s-display2"></i>
                            Navigation Menu
                        </a>
                    </li>
                    <li class="app-sidebar__heading">e-Tax Menu</li>
                    <?php foreach ($main_menu as $mm) : ?>
                        <li>
                            <?php if (!empty($mm['url'])) : ?>
                                <a href="<?= base_url($sm['url']) ?>">
                                <?php else : ?>
                                    <a href="#">
                                    <?php endif; ?>
                                    <i class="<?= $mm['image']; ?>"></i>
                                    <?= $mm['title'] ?>
                                    <?php if (empty($mm['url'])) : ?>
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    <?php endif; ?>
                                    </a>
                                    <ul>
                                        <?php foreach ($sub_menu as $sm) :
                                            if ($sm['reference'] == $mm['men_id']) {
                                        ?>
                                                <li>
                                                    <a href="<?= base_url($sm['url']) ?>">
                                                        <i class="metismenu-icon"></i>
                                                        <?= $sm['title']; ?>
                                                    </a>
                                                </li>

                                        <?php }
                                        endforeach; ?>
                                    </ul>
                        </li>
                    <?php endforeach; ?>
                    <li class="app-sidebar__heading">Tools</li>
                    <li>
                        <a href="<?= base_url('login/out') ?>" class="mm-active">
                            <i class="metismenu-icon nav-icon fas fa-power-off"></i>
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="app-main__outer bg-heavy-rain fixed-sidebar">
        <div class="app-main__inner fixed-sidebar">
            <!-- <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="<?= $title_icon ?> icon-gradient bg-mean-fruit">
                            </i>
                        </div>
                        <div><?= strtoupper($content); ?>
                            <div class="page-title-subheading">
                                <?= $content_desc ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div id="content_panel">