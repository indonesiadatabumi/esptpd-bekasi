<ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
    <!-- <li class="nav-item">
        <a role="tab" class="nav-link active" id="tab-0" data-toggle="tab" href="#tab-content-0" aria-selected="true">
            <span>Grid Menus</span>
        </a>
    </li> -->
    <?php if ($this->session->userdata('USER_JABATAN') == '200') : ?>

        <!-- <li class="nav-item">
            <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-1" aria-selected="false">
                <span>Vertical Menus</span>
            </a>
        </li> -->
    <?php endif; ?>
</ul>
<div class="tab-content">
    <div class="tab-pane tabs-animation fade active show" id="tab-content-0" role="tabpanel">
        <div class="row mb-5">
            <div class="col">
                <h2 class="text-center"><b>Jumlah Realisasi Pajak</b></h2>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3">
                <div class="main-card mb-3 card border" height="200">
                    <div class="card-body">
                        <h4 class="title">PBJT Hotel</h4>
                        <!-- <p><u>Realisasi sampai dengan bulan Agustus: 10%</u></p> -->
                        <p class="description">Target Realisasi: Rp. <?= number_format(44406219775) ?></p>
                        <p class="description">2024: Rp. <?= number_format($sum_hotel_current->total_pajak) ?></p>
                        <p class="description">2023: Rp. <?= number_format($sum_hotel_last->total_pajak) ?></p>
                    </div>
                </div>
                <div class="main-card card border">
                    <div class="card-body">
                        <h4 class="title">PBJT Restoran</h4>
                        <!-- <p><u>Realisasi sampai dengan bulan Agustus: 10%</u></p> -->
                        <p class="description">Target Realisasi: Rp. <?= number_format(504664141181) ?></p>
                        <p class="description">2024: Rp. <?= number_format($sum_resto_current->total_pajak) ?></p>
                        <p class="description">2023: Rp. <?= number_format($sum_resto_last->total_pajak) ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="main-card card border">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <select id="jenis_pajak" onchange="updateChart()">
                                    <option value="1" selected>PBJT Hotel</option>
                                    <option value="2">PBJT Restoran</option>
                                    <option value="3">PBJT Hiburan</option>
                                    <option value="7">PBJT Parkir</option>
                                    <option value="4">Pajak Reklame</option>
                                    <option value="8">Pajak Air Tanah</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <canvas id="myChart" height="400"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="main-card mb-3 card border">
                    <div class="card-body">
                        <h4 class="title">PBJT Hiburan</h4>
                        <!-- <p><u>Realisasi sampai dengan bulan Agustus: 10%</u></p> -->
                        <p class="description">Target Realisasi: Rp. <?= number_format(62650425292) ?></p>
                        <p class="description">2024: Rp. <?= number_format($sum_hiburan_current->total_pajak) ?></p>
                        <p class="description">2023: Rp. <?= number_format($sum_hiburan_last->total_pajak) ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="main-card mb-3 card border">
                    <div class="card-body">
                        <h4 class="title">PBJT Parkir</h4>
                        <!-- <p><u>Realisasi sampai dengan bulan Agustus: 10%</u></p> -->
                        <p class="description">Target Realisasi: Rp. <?= number_format(17627557662) ?></p>
                        <p class="description">2024: Rp. <?= number_format($sum_parkir_current->total_pajak) ?></p>
                        <p class="description">2023: Rp. <?= number_format($sum_parkir_last->total_pajak) ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="main-card mb-3 card border">
                    <div class="card-body">
                        <h4 class="title">PBJT Reklame</h4>
                        <!-- <p><u>Realisasi sampai dengan bulan Agustus: 10%</u></p> -->
                        <p class="description">Target Realisasi: Rp. <?= number_format(78376164629) ?></p>
                        <p class="description">2024: Rp. <?= number_format($sum_reklame_current->total_pajak) ?></p>
                        <p class="description">2023: Rp. <?= number_format($sum_reklame_last->total_pajak) ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="main-card mb-3 card border">
                    <div class="card-body">
                        <h4 class="title">PBJT Air Tanah</h4>
                        <!-- <p><u>Realisasi sampai dengan bulan Agustus: 10%</u></p> -->
                        <p class="description">Target Realisasi: Rp. <?= number_format(3732407060) ?></p>
                        <p class="description">2024: Rp. <?= number_format($sum_abt_current->total_pajak) ?></p>
                        <p class="description">2023: Rp. <?= number_format($sum_abt_last->total_pajak) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if ($this->session->userdata('USER_JABATAN') == '200') : ?>
        <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card border">
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
                    <div class="main-card mb-3 card border">
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
                    <div class="main-card mb-3 card border">
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