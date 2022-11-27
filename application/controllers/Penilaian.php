<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Penilaian extends CI_Controller
{
    // construct
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in') == false || !$this->session->userdata('logged_in')) {
            if (!empty($_SERVER['QUERY_STRING'])) {
                $uri = uri_string() . '?' . $_SERVER['QUERY_STRING'];
            } else {
                $uri = uri_string();
            }
            $this->session->set_userdata('redirect', $uri);
            $this->session->set_flashdata('notif_warning', "Harap login, untuk melanjutkan");
            redirect('login');
        }
        $this->load->model(['M_master', 'M_penilaian']);
    }

    public function perhitungan()
    {
        $bansos_id = null;
        if ($this->input->post('bansos_id')) {
            $bansos_id = $this->input->post('bansos_id');
        }

        $data['bansos_id'] = $bansos_id;
        $data['detail_bansos'] = $this->M_master->getBansosById($bansos_id);
        $data['bansos'] = $this->M_master->getBansos();

        $data['kategori'] = $this->M_master->getKategoriALl();
        $data['matrix_keputusan'] = $this->M_penilaian->getMatrixKeptusuan($bansos_id);
        $data['bobot_kriteria'] = $this->M_penilaian->getBobotKriteria();
        $data['normalisasi_bobot_kriteria'] = $this->M_penilaian->getNormalisasiBobotKriteria();
        $data['nilai_vektor_s'] = $this->M_penilaian->getNilaiVektorS($bansos_id);
        $data['nilai_vektor_v'] = $this->M_penilaian->getNilaiVektorV($bansos_id);
        // ej($data);
        $this->templateback->view('penilaian/perhitungan', $data);
    }

    public function hasil_akhir()
    {
        $bansos_id = null;
        if ($this->input->post('bansos_id')) {
            $bansos_id = $this->input->post('bansos_id');
        }

        $data['bansos_id'] = $bansos_id;
        $data['detail_bansos'] = $this->M_master->getBansosById($bansos_id);
        $data['bansos'] = $this->M_master->getBansos();

        $data['kategori'] = $this->M_master->getKategoriALl();
        $data['matrix_keputusan'] = $this->M_penilaian->getMatrixKeptusuan($bansos_id);
        $data['bobot_kriteria'] = $this->M_penilaian->getBobotKriteria();
        $data['normalisasi_bobot_kriteria'] = $this->M_penilaian->getNormalisasiBobotKriteria();
        $data['nilai_vektor_s'] = $this->M_penilaian->getNilaiVektorS($bansos_id);
        $data['nilai_vektor_v'] = $this->M_penilaian->getNilaiVektorV($bansos_id);
        // ej($data);
        $this->templateback->view('penilaian/hasil', $data);
    }

    function cetak_hasil(){
        $bansos_id = null;
        if ($this->input->post('bansos_id')) {
            $bansos_id = $this->input->post('bansos_id');
        }

        $data['bansos_id'] = $bansos_id;
        $data['detail_bansos'] = $this->M_master->getBansosById($bansos_id);
        $data['bansos'] = $this->M_master->getBansos();
        
        $data['web_title'] = $this->M_penilaian->getSettingsValue('web_title');
        $data['web_desc'] = $this->M_penilaian->getSettingsValue('web_desc');
        $data['web_icon'] = $this->M_penilaian->getSettingsValue('web_icon');
        $data['web_logo'] = $this->M_penilaian->getSettingsValue('web_logo');
        $data['nilai_vektor_v'] = $this->M_penilaian->getNilaiVektorV($bansos_id);

        $this->load->view('template/backend/header', $data);
        $this->load->view('penilaian/print', $data);
        $this->load->view('template/backend/footer', $data);
    }

    function ekspor_hasil(){
        $bansos_id = null;
        if ($this->input->post('bansos_id')) {
            $bansos_id = $this->input->post('bansos_id');
        }

        $data['bansos_id'] = $bansos_id;
        $data['detail_bansos'] = $this->M_master->getBansosById($bansos_id);
        $data['bansos'] = $this->M_master->getBansos();

        $data['kategori'] = $this->M_master->getKategoriALl();
        $data['matrix_keputusan'] = $this->M_penilaian->getMatrixKeptusuan($bansos_id);
        $data['bobot_kriteria'] = $this->M_penilaian->getBobotKriteria();
        $data['normalisasi_bobot_kriteria'] = $this->M_penilaian->getNormalisasiBobotKriteria();
        $data['nilai_vektor_s'] = $this->M_penilaian->getNilaiVektorS($bansos_id);
        $data['nilai_vektor_v'] = $this->M_penilaian->getNilaiVektorV($bansos_id);

        $this->load->library('excel');

        $this->excel->export($data);
    }
}
