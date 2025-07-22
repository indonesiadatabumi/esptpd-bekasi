<div class="app-main">
    <div class="app-sidebar bg-vicious-stance sidebar-text-light sidebar-shadow">
        <!-- <div class="app-header__logo">
            <div class="logo-src"></div>
            <div class="header__pane ml-auto">
                <div>
                    <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
        </div> -->
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
                    <li class="app-sidebar__heading">Dashboards</li>
                    <li>
                        <a href="index.html" class="mm-active">
                            <i class="metismenu-icon pe-7s-rocket"></i>
                            Analitic
                        </a>
                    </li>
                    <li class="app-sidebar__heading">e-Tax Menu</li>
                    <?php

                    if (!isset($i)) $i = 0;
                    if (!isset($j)) $j = 0;
                    ++$i;
                    $resultname = "result$i";
                    $resultcheck = "resultcheck$i";
                    $rowcheck = "rowcheck$i";

                    if ($men_level > 1) echo  PHP_EOL . "<ul>" . PHP_EOL;

                    foreach ($menu as $_menu) {
                        $men_id     = $_menu->men_id;
                        $title      = $_menu->title;
                        $image      = $_menu->image;
                        $men_level  = $_menu->menu_level;
                        $url        = $_menu->url;
                        $usr_type_id = $this->session->userdata('USER_JABATAN');

                        $sql    = "select read_priv from function_access where usr_type_id='" . $usr_type_id . "' and men_id='" . $men_id . "'";
                        $$resultcheck = $this->db->query($sql);
                        $row = $$resultcheck->row();

                        $fua_read = $row->read_priv;

                        if ($fua_read == '1') {
                            unset($_image, $_url_1, $_url_2);
                            $_image = "";
                            if ($image) $_image = "<i class=\"$image\"></i>";
                            $_arrow = "<i class='metismenu-state-icon pe-7s-angle-down caret-left'></i>";

                            $num_child = 0;
                            $strQuery = "select count(*) as num_child from menu where reference='$men_id' and SHOW='1' and COALESCE(is_delete,0)!='1'";
                            $query = $this->db->query($strQuery);
                            $_row = $query->row();

                            $num_child = $_row->num_child;

                            if (!empty($url)) {
                                $_url_1 = "<a href=\"$url\">";
                                $_url_2 = "</a>";
                            } else {
                                $_url_1 = "<a href=''>";
                                $_url_2 = "</a>";
                            }


                            if ($num_child > 0)
                                echo "<li $_has_sub>$_url_1 $_image <p>$title $_arrow </p> $_url_2";
                            else
                                echo "<li> $_url_1 $_image <p>$title</p> $_url_2";
                        }

                        ++$j;
                        $resultname2 = "result2level$j";
                        $checklevel  = $men_level + 1;

                        $sql    =    "SELECT * from menu WHERE menu_level='$checklevel' and reference='$men_id'";
                        $$resultname2 = $this->db->query($sql);

                        // var_dump($$resultname2);
                        // die();

                        if (count($$resultname2) > 0) {
                            $this->load->model('menu_m')->_parse_menu($checklevel, $men_id);
                        }
                        if ($fua_read == '1') echo "</li>" . PHP_EOL;
                    }
                    if ($men_level > 1) echo "</ul>" . PHP_EOL;
                    ?>


                    <!-- <li>
                        <a href="#">
                            <i class="metismenu-icon pe-7s-news-paper"></i>
                            Pendaftaran
                            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="<?= base_url('pendaftaran/wp_pribadi') ?>">
                                    <i class="metismenu-icon"></i>
                                    Rekam Master WP Pribadi
                                </a>
                            </li>
                            <li>
                                <a href="elements-dropdowns.html">
                                    <i class="metismenu-icon">
                                    </i>Rekam Master WP BU
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('pendaftaran/rekam_formulir') ?>">
                                    <i class="metismenu-icon">
                                    </i>Rekam Formulir Pendaftaran
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('pendaftaran/cetak_daftar_formulir') ?>">

                                    <i class="metismenu-icon">
                                    </i>Cetak Daftar Form. Pendaftaran
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('pendaftaran/cetak_kartu_npwpd') ?>">
                                    <i class="metismenu-icon">
                                    </i>Cetak Kartu NPWPD
                                </a>
                            </li>
                            <li>
                                <a href="elements-cards.html">
                                    <i class="metismenu-icon">
                                    </i>Dokumentasi&Pengolahan Data
                                </a>
                            </li>
                            <li>
                                <a href="elements-cards.html">
                                    <i class="metismenu-icon">
                                    </i>Penutupan WP/WR
                                </a>
                            </li>
                            <li>
                                <a href="elements-cards.html">
                                    <i class="metismenu-icon">
                                    </i>Pembukaan Kembali WP/WR
                                </a>
                            </li>
                        </ul>
                    </li> -->

                    <!-- <li class="app-sidebar__heading">e-TAX MENU</li>
                    <li>
                        <a href="#">
                            <i class="metismenu-icon pe-7s-news-paper"></i>
                            Pendaftaran
                            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="<?= base_url('pendaftaran/wp_pribadi') ?>">
                                    <i class="metismenu-icon"></i>
                                    Rekam Master WP Pribadi
                                </a>
                            </li>
                            <li>
                                <a href="elements-dropdowns.html">
                                    <i class="metismenu-icon">
                                    </i>Rekam Master WP BU
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('pendaftaran/rekam_formulir') ?>">
                                    <i class="metismenu-icon">
                                    </i>Rekam Formulir Pendaftaran
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('pendaftaran/cetak_daftar_formulir') ?>">

                                    <i class="metismenu-icon">
                                    </i>Cetak Daftar Form. Pendaftaran
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('pendaftaran/cetak_kartu_npwpd') ?>">
                                    <i class="metismenu-icon">
                                    </i>Cetak Kartu NPWPD
                                </a>
                            </li>
                            <li>
                                <a href="elements-cards.html">
                                    <i class="metismenu-icon">
                                    </i>Dokumentasi&Pengolahan Data
                                </a>
                            </li>
                            <li>
                                <a href="elements-cards.html">
                                    <i class="metismenu-icon">
                                    </i>Penutupan WP/WR
                                </a>
                            </li>
                            <li>
                                <a href="elements-cards.html">
                                    <i class="metismenu-icon">
                                    </i>Pembukaan Kembali WP/WR
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="metismenu-icon pe-7s-car"></i>
                            Components
                            <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="components-tabs.html">
                                    <i class="metismenu-icon">
                                    </i>Tabs
                                </a>
                            </li>
                            <li>
                                <a href="components-accordions.html">
                                    <i class="metismenu-icon">
                                    </i>Accordions
                                </a>
                            </li>
                            <li>
                                <a href="components-notifications.html">
                                    <i class="metismenu-icon">
                                    </i>Notifications
                                </a>
                            </li>
                            <li>
                                <a href="components-modals.html">
                                    <i class="metismenu-icon">
                                    </i>Modals
                                </a>
                            </li>
                            <li>
                                <a href="components-progress-bar.html">
                                    <i class="metismenu-icon">
                                    </i>Progress Bar
                                </a>
                            </li>
                            <li>
                                <a href="components-tooltips-popovers.html">
                                    <i class="metismenu-icon">
                                    </i>Tooltips &amp; Popovers
                                </a>
                            </li>
                            <li>
                                <a href="components-carousel.html">
                                    <i class="metismenu-icon">
                                    </i>Carousel
                                </a>
                            </li>
                            <li>
                                <a href="components-calendar.html">
                                    <i class="metismenu-icon">
                                    </i>Calendar
                                </a>
                            </li>
                            <li>
                                <a href="components-pagination.html">
                                    <i class="metismenu-icon">
                                    </i>Pagination
                                </a>
                            </li>
                            <li>
                                <a href="components-scrollable-elements.html">
                                    <i class="metismenu-icon">
                                    </i>Scrollable
                                </a>
                            </li>
                            <li>
                                <a href="components-maps.html">
                                    <i class="metismenu-icon">
                                    </i>Maps
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="tables-regular.html">
                            <i class="metismenu-icon pe-7s-display2"></i>
                            Tables
                        </a>
                    </li>
                    <li class="app-sidebar__heading">Widgets</li>
                    <li>
                        <a href="dashboard-boxes.html">
                            <i class="metismenu-icon pe-7s-display2"></i>
                            Dashboard Boxes
                        </a>
                    </li>
                    <li class="app-sidebar__heading">Forms</li>
                    <li>
                        <a href="forms-controls.html">
                            <i class="metismenu-icon pe-7s-mouse">
                            </i>Forms Controls
                        </a>
                    </li>
                    <li>
                        <a href="forms-layouts.html">
                            <i class="metismenu-icon pe-7s-eyedropper">
                            </i>Forms Layouts
                        </a>
                    </li>
                    <li>
                        <a href="forms-validation.html">
                            <i class="metismenu-icon pe-7s-pendrive">
                            </i>Forms Validation
                        </a>
                    </li>
                    <li class="app-sidebar__heading">Charts</li>
                    <li>
                        <a href="charts-chartjs.html">
                            <i class="metismenu-icon pe-7s-graph2">
                            </i>ChartJS
                        </a>
                    </li> -->
                </ul>
            </div>
        </div>
    </div>

    <div class="app-main__outer bg-heavy-rain">
        <div class="app-main__inner">
            <div class="app-page-title">
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
            </div>