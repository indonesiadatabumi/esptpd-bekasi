<?php
class Layouts extends Master_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('menu_m');
    }

    function loadview($data = NULL, $page = NULL)
    {
        $data['main_menu'] = $this->menu_m->menu_utama();
        $data['sub_menu'] = $this->menu_m->sub_menu();
        $data['sub_sub_menu'] = $this->menu_m->sub_sub_menu();
        $this->load->view('_layouts/head', $data);
        $this->load->view('_layouts/navbar', $data);
        $this->load->view('_layouts/sidebar', $data);
        if ($page != NULL) {
            
            $this->load->view($page, $data);
        } else {
            $data['sum_hotel_current'] = $this->menu_m->sum_tax_current(1);
            $data['sum_hotel_last'] = $this->menu_m->sum_tax_last(1);
            $data['sum_resto_current'] = $this->menu_m->sum_tax_current(2);
            $data['sum_resto_last'] = $this->menu_m->sum_tax_last(2);
            $data['sum_hiburan_current'] = $this->menu_m->sum_tax_current(3);
            $data['sum_hiburan_last'] = $this->menu_m->sum_tax_last(3);
            $data['sum_parkir_current'] = $this->menu_m->sum_tax_current(7);
            $data['sum_parkir_last'] = $this->menu_m->sum_tax_last(7);
            $data['sum_reklame_current'] = $this->menu_m->sum_tax_current(4);
            $data['sum_reklame_last'] = $this->menu_m->sum_tax_last(4);
            $data['sum_abt_current'] = $this->menu_m->sum_tax_current(8);
            $data['sum_abt_last'] = $this->menu_m->sum_tax_last(8);
            $this->load->view('_layouts/dashboard', $data);
        }
        $this->load->view('_layouts/footer', $data);
    }
}
