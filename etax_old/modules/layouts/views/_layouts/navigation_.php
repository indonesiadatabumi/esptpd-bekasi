<ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
    <li class="nav-item">
        <a role="tab" class="nav-link active" id="tab-0" data-toggle="tab" href="#tab-content-0" aria-selected="true">
            <span>Grid Menus</span>
        </a>
    </li>
    <?php if ($this->session->userdata('USER_JABATAN') == '200') : ?>

        <li class="nav-item">
            <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-1" aria-selected="false">
                <span>Vertical Menus</span>
            </a>
        </li>
    <?php endif; ?>
</ul>
<div class="tab-content">
    <div class="tab-pane tabs-animation fade active show" id="tab-content-0" role="tabpanel">
        <div class="row">
            <div class="col-lg-12 col-xl-6">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">e-TAX (Pajak Daerah Lain)</h5>
                        <div class="grid-menu grid-menu-3col">
                            <div class="no-gutters row">
                                <div class="col-sm-6 col-xl-4">
                                    <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-primary" onclick="window.location.href='navigation/pendaftaran';">
                                        <i class="btn-icon-wrapper pe-7s-news-paper"> </i>Pendaftaran
                                    </button>
                                </div>
                                <div class="col-sm-6 col-xl-4">
                                    <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-secondary" onclick="window.location.href='navigation/pendataan';">
                                        <i class="pe-7s-map-2 btn-icon-wrapper"> </i>Pendataan
                                    </button>
                                </div>
                                <div class="col-sm-6 col-xl-4">
                                    <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-success" onclick="window.location.href='navigation/penetapan';">
                                        <i class="pe-7s-hammer btn-icon-wrapper"> </i>Penetapan
                                    </button>
                                </div>
                                <div class="col-sm-6 col-xl-4">
                                    <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-info" onclick="window.location.href='navigation/pembayaran';">
                                        <i class="pe-7s-cash btn-icon-wrapper"> </i>Pembayaran
                                    </button>
                                </div>
                                <div class="col-sm-6 col-xl-4">
                                    <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-warning" onclick="window.location.href='navigation/pembukuan';">
                                        <i class="pe-7s-note2 btn-icon-wrapper"> </i>Pembukuan
                                    </button>
                                </div>
                                <div class="col-sm-6 col-xl-4">
                                    <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-danger" onclick="window.location.href='navigation/penagihan';">
                                        <i class="pe-7s-target btn-icon-wrapper"> </i>Penagihan
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="divider"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-xl-6">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">INTEGRATED</h5>
                        <div class="grid-menu grid-menu-2col">
                            <div class="no-gutters row">
                                <div class="col-sm-6">
                                    <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-primary" onclick="window.location.href='#';">
                                        <i class="btn-icon-wrapper pe-7s-map-marker "> </i> e-PBB
                                    </button>
                                </div>
                                <div class="col-sm-6">
                                    <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-secondary" onclick="window.location.href='https://ebphtb.bekasikota.go.id';">
                                        <i class="pe-7s-map btn-icon-wrapper"> </i>e-BPHTB
                                    </button>
                                </div>
                                <div class="col-sm-6">
                                    <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-success" onclick="window.location.href='http://sirida.bekasikota.go.id';">
                                        <i class="pe-7s-car btn-icon-wrapper"> </i>e-Retribusi
                                    </button>
                                </div>
                                <div class="col-sm-6">
                                    <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-info" onclick="window.location.href='#';">
                                        <i class="pe-7s-global btn-icon-wrapper"> </i>GeoMaps
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="divider"></div>

                    </div>
                </div>
            </div>
            <?php if ($this->session->userdata('USER_JABATAN') == '200' || $this->session->userdata('USER_JABATAN') == '98') : ?>

                <!-- Services -->
                <div class="col-lg-12 col-xl-6">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Services</h5>
                            <div class="grid-menu grid-menu-3col">
                                <div class="no-gutters row">
                                    <div class="col-sm-6 col-xl-4">
                                        <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link" onclick="window.location.href='http://36.66.115.131/esptpd';">
                                            <i class="pe-7s-browser btn-icon-wrapper btn-icon-lg mb-3"></i>e-SPTPD
                                        </button>
                                    </div>
                                    <div class="col-sm-6 col-xl-4">
                                        <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link" onclick="window.location.href='#';">
                                            <i class="pe-7s-display2 btn-icon-wrapper btn-icon-lg mb-3"></i>e-SPPT
                                        </button>
                                    </div>
                                    <div class="col-sm-6 col-xl-4">
                                        <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link" onclick="window.location.href='#';">
                                            <i class="pe-7s-phone btn-icon-wrapper btn-icon-lg mb-3"></i>e-POTENSI
                                        </button>
                                    </div>
                                    <div class="col-sm-6 col-xl-4">
                                        <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                            <i class="pe-7s-monitor btn-icon-wrapper btn-icon-lg mb-3"></i>e-Monev
                                        </button>
                                    </div>
                                    <div class="col-sm-6 col-xl-4">
                                        <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                            <i class="pe-7s-display1 btn-icon-wrapper btn-icon-lg mb-3"></i>e-Report
                                        </button>
                                    </div>
                                    <div class="col-sm-6 col-xl-4">
                                        <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                            <i class="pe-7s-network btn-icon-wrapper btn-icon-lg mb-3"></i>Bapenda-API
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="divider"></div>
                        </div>
                    </div>
                </div>
                <!-- tOOLS  -->
                <div class="col-lg-12 col-xl-6">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">TOOLs</h5>
                            <div class="grid-menu grid-menu-2col">
                                <div class="no-gutters row">
                                    <div class="col-sm-6">
                                        <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                            <i class="pe-7s-tools btn-icon-wrapper btn-icon-lg mb-3"></i>Setting
                                        </button>
                                    </div>
                                    <div class="col-sm-6">
                                        <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                            <i class="pe-7s-server btn-icon-wrapper btn-icon-lg mb-3"></i>Master Data
                                        </button>
                                    </div>
                                    <div class="col-sm-6">
                                        <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                            <i class="pe-7s-bookmarks btn-icon-wrapper btn-icon-lg mb-3"></i>References
                                        </button>
                                    </div>
                                    <div class="col-sm-6">
                                        <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                            <i class="pe-7s-pendrive btn-icon-wrapper btn-icon-lg mb-3"></i>Backup
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="divider"></div>

                        </div>
                    </div>
                </div>
        </div>
    <?php endif; ?>
    </div>

    <?php if ($this->session->userdata('USER_JABATAN') == '200') : ?>
        <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Vertical Menu</h5>
                            <div class="row">
                                <div class="col">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">Link</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">Link
                                                <div class="ml-auto badge badge-success">New</div>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">Another Link
                                                <div class="ml-auto badge badge-warning">512</div>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a disabled="" href="javascript:void(0);" class="nav-link disabled">Disabled
                                                Link</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">
                                                <i class="nav-link-icon lnr-inbox"> </i><span>Inbox</span>
                                                <div class="ml-auto badge badge-pill badge-secondary">86</div>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">
                                                <i class="nav-link-icon lnr-book"> </i><span>Book</span>
                                                <div class="ml-auto badge badge-pill badge-danger">5</div>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">
                                                <i class="nav-link-icon lnr-picture"> </i><span>Picture</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a disabled="" href="javascript:void(0);" class="nav-link disabled">
                                                <i class="nav-link-icon lnr-file-empty">
                                                </i><span>File Disabled</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="divider"></div>
                            <div class="text-center">
                                <div class="btn-group dropdown">
                                    <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle btn btn-primary">Dropdown Basic
                                    </button>
                                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a href="javascript:void(0);" class="nav-link">Link</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="javascript:void(0);" class="nav-link">Link
                                                    <div class="ml-auto badge badge-success">New</div>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="javascript:void(0);" class="nav-link">Another Link
                                                    <div class="ml-auto badge badge-warning">512</div>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a disabled="" href="javascript:void(0);" class="nav-link disabled">Disabled
                                                    Link</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="d-inline-block dropdown">
                                    <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle btn btn-primary">Dropdown Hover
                                    </button>
                                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a href="javascript:void(0);" class="nav-link">
                                                    <i class="nav-link-icon lnr-inbox"> </i><span>Inbox</span>
                                                    <div class="ml-auto badge badge-pill badge-secondary">86</div>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="javascript:void(0);" class="nav-link">
                                                    <i class="nav-link-icon lnr-book"> </i><span>Book</span>
                                                    <div class="ml-auto badge badge-pill badge-danger">5</div>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="javascript:void(0);" class="nav-link">
                                                    <i class="nav-link-icon lnr-picture">
                                                    </i><span>Picture</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a disabled="" href="javascript:void(0);" class="nav-link disabled">
                                                    <i class="nav-link-icon lnr-file-empty"> </i><span>File Disabled</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Separators &amp; Headers</h5>
                            <div class="row">
                                <div class="col">
                                    <ul class="nav flex-column">
                                        <li class="nav-item-header nav-item">Activity</li>
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">Chat
                                                <div class="ml-auto badge badge-pill badge-info">8</div>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">Recover Password</a>
                                        </li>
                                        <li class="nav-item-header nav-item">My Account</li>
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">Settings
                                                <div class="ml-auto badge badge-success">New</div>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">Messages
                                                <div class="ml-auto badge badge-warning">512</div>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">Logs</a>
                                        </li>
                                        <li class="nav-item-divider nav-item"></li>
                                        <li class="nav-item-btn nav-item">
                                            <button class="btn-wide btn-shadow btn btn-danger btn-sm">Cancel</button>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col">
                                    <ul class="nav flex-column">
                                        <li class="nav-item-header nav-item">Activity</li>
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">
                                                <i class="nav-link-icon pe-7s-chat"> </i><span>Chat</span>
                                                <div class="ml-auto badge badge-pill badge-info">8</div>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">
                                                <i class="nav-link-icon pe-7s-wallet"> </i>
                                                <span>Recover Password</span>
                                            </a>
                                        </li>
                                        <li class="nav-item-header nav-item">My Account</li>
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">
                                                <i class="nav-link-icon pe-7s-config"> </i><span>Settings</span>
                                                <div class="ml-auto badge badge-success">New</div>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">
                                                <i class="nav-link-icon pe-7s-coffee"> </i><span>Messages</span>
                                                <div class="ml-auto badge badge-warning">512</div>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">
                                                <i class="nav-link-icon pe-7s-box2"></i><span>Logs</span>
                                            </a>
                                        </li>
                                        <li class="nav-item-divider nav-item"></li>
                                        <li class="nav-item-btn nav-item">
                                            <button class="btn-pill btn btn-success btn-sm">Save</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="divider"></div>
                            <div class="text-center">
                                <div class="dropup btn-group">
                                    <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle btn btn-primary">Dropdown Basic
                                    </button>
                                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                                        <ul class="nav flex-column">
                                            <li class="nav-item-header nav-item">Activity</li>
                                            <li class="nav-item">
                                                <a href="javascript:void(0);" class="nav-link">Chat
                                                    <div class="ml-auto badge badge-pill badge-info">8</div>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="javascript:void(0);" class="nav-link">Recover Password</a>
                                            </li>
                                            <li class="nav-item-header nav-item">My Account</li>
                                            <li class="nav-item">
                                                <a href="javascript:void(0);" class="nav-link">Settings
                                                    <div class="ml-auto badge badge-success">New</div>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="javascript:void(0);" class="nav-link">Messages
                                                    <div class="ml-auto badge badge-warning">512</div>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="javascript:void(0);" class="nav-link">Logs</a>
                                            </li>
                                            <li class="nav-item-divider nav-item"></li>
                                            <li class="nav-item-btn nav-item">
                                                <button class="btn-wide btn-shadow btn btn-danger btn-sm">Cancel</button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="dropup btn-group">
                                    <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle btn btn-primary">Dropdown Example
                                    </button>
                                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                                        <ul class="nav flex-column">
                                            <li class="nav-item-header nav-item">Activity</li>
                                            <li class="nav-item">
                                                <a href="javascript:void(0);" class="nav-link">
                                                    <i class="nav-link-icon pe-7s-chat"> </i><span>Chat</span>
                                                    <div class="ml-auto badge badge-pill badge-info">8</div>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="javascript:void(0);" class="nav-link">
                                                    <i class="nav-link-icon pe-7s-wallet"> </i><span>Recover Password</span>
                                                </a>
                                            </li>
                                            <li class="nav-item-header nav-item">My Account</li>
                                            <li class="nav-item">
                                                <a href="javascript:void(0);" class="nav-link">
                                                    <i class="nav-link-icon pe-7s-config">
                                                    </i><span>Settings</span>
                                                    <div class="ml-auto badge badge-success">New</div>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="javascript:void(0);" class="nav-link">
                                                    <i class="nav-link-icon pe-7s-coffee"></i><span>Messages</span>
                                                    <div class="ml-auto badge badge-warning">512</div>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="javascript:void(0);" class="nav-link">
                                                    <i class="nav-link-icon pe-7s-box2"> </i><span>Logs</span>
                                                </a>
                                            </li>
                                            <li class="nav-item-divider nav-item"></li>
                                            <li class="nav-item-btn nav-item">
                                                <button class="btn-pill btn btn-success btn-sm">Save</button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Menu Hover Styles</h5>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="p-1 mb-2 card-border card">
                                        <div class="dropdown-menu dropdown-menu-inline">
                                            <h6 tabindex="-1" class="dropdown-header">Header</h6>
                                            <button type="button" tabindex="0" class="dropdown-item">Menus</button>
                                            <button type="button" tabindex="0" class="dropdown-item">Settings</button>
                                            <button type="button" tabindex="0" class="dropdown-item">Actions</button>
                                            <div tabindex="-1" class="dropdown-divider"></div>
                                            <button type="button" tabindex="0" class="dropdown-item">Dividers</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="p-1 mb-2 card-border card">
                                        <div class="dropdown-menu dropdown-menu-inline dropdown-menu-rounded">
                                            <h6 tabindex="-1" class="dropdown-header">Header</h6>
                                            <button type="button" tabindex="0" class="dropdown-item">Menus</button>
                                            <button type="button" tabindex="0" class="dropdown-item">Settings</button>
                                            <button type="button" tabindex="0" class="dropdown-item">Actions</button>
                                            <div tabindex="-1" class="dropdown-divider"></div>
                                            <button type="button" tabindex="0" class="dropdown-item">Dividers</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="p-1 mb-2 card-border card">
                                        <div class="dropdown-menu dropdown-menu-inline dropdown-menu-shadow">
                                            <h6 tabindex="-1" class="dropdown-header">Header</h6>
                                            <button type="button" tabindex="0" class="dropdown-item">Menus</button>
                                            <button type="button" tabindex="0" class="dropdown-item">Settings</button>
                                            <button type="button" tabindex="0" class="dropdown-item">Actions</button>
                                            <div tabindex="-1" class="dropdown-divider"></div>
                                            <button type="button" tabindex="0" class="dropdown-item">Dividers</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="p-1 mb-2 card-border card">
                                        <div class="dropdown-menu dropdown-menu-inline dropdown-menu-hover-link">
                                            <h6 tabindex="-1" class="dropdown-header">Header</h6>
                                            <button type="button" tabindex="0" class="dropdown-item">Menus</button>
                                            <button type="button" tabindex="0" class="dropdown-item">Settings</button>
                                            <button type="button" tabindex="0" class="dropdown-item">Actions</button>
                                            <div tabindex="-1" class="dropdown-divider"></div>
                                            <button type="button" tabindex="0" class="dropdown-item">Dividers</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="p-1 mb-2 card-border card">
                                        <div class="dropdown-menu dropdown-menu-inline dropdown-menu-hover-primary">
                                            <h6 tabindex="-1" class="dropdown-header">Header</h6>
                                            <button type="button" tabindex="0" class="dropdown-item">Menus</button>
                                            <button type="button" tabindex="0" class="dropdown-item">Settings</button>
                                            <button type="button" tabindex="0" class="dropdown-item">Actions</button>
                                            <div tabindex="-1" class="dropdown-divider"></div>
                                            <button type="button" tabindex="0" class="dropdown-item">Dividers</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="p-1 mb-2 card-border card">
                                        <div class="dropdown-menu dropdown-menu-inline dropdown-menu-hover-link">
                                            <h6 tabindex="-1" class="dropdown-header">Header</h6>
                                            <button type="button" tabindex="0" class="dropdown-item">
                                                <i class="dropdown-icon lnr-inbox"></i><span>Menus</span>
                                            </button>
                                            <button type="button" tabindex="0" class="dropdown-item">
                                                <i class="dropdown-icon lnr-file-empty"></i><span>Settings</span>
                                            </button>
                                            <button type="button" tabindex="0" class="dropdown-item">
                                                <i class="dropdown-icon lnr-book"></i><span>Actions</span>
                                            </button>
                                            <div tabindex="-1" class="dropdown-divider"></div>
                                            <button type="button" tabindex="0" class="dropdown-item">
                                                <i class="dropdown-icon lnr-picture">
                                                </i><span>Dividers</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="p-1 mb-2 card-border card">
                                        <div class="dropdown-menu dropdown-menu-inline dropdown-menu-rounded dropdown-menu-hover-primary">
                                            <h6 tabindex="-1" class="dropdown-header">Header</h6>
                                            <button type="button" tabindex="0" class="dropdown-item">Menus</button>
                                            <button type="button" tabindex="0" class="dropdown-item">Settings</button>
                                            <button type="button" tabindex="0" class="dropdown-item">Actions</button>
                                            <div tabindex="-1" class="dropdown-divider"></div>
                                            <button type="button" tabindex="0" class="dropdown-item">Dividers</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>