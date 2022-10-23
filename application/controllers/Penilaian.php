<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Penilaian extends CI_Controller
{
    // construct
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_master', 'M_penilaian']);
    }

    public function perhitungan()
    {
        $data['kategori'] = $this->M_master->getKategoriALl();
        $data['matrix_keputusan'] = $this->M_penilaian->getMatrixKeptusuan();
        $data['bobot_kriteria'] = $this->M_penilaian->getBobotKriteria();
        $data['normalisasi_bobot_kriteria'] = $this->M_penilaian->getNormalisasiBobotKriteria();
        $data['nilai_vektor_s'] = $this->M_penilaian->getNilaiVektorS();
        $data['nilai_vektor_v'] = $this->M_penilaian->getNilaiVektorV();
        // ej($data);
        $this->templateback->view('penilaian/perhitungan', $data);
    }

    public function hasil_akhir()
    {
        $data['kategori'] = $this->M_master->getKategoriALl();
        $data['matrix_keputusan'] = $this->M_penilaian->getMatrixKeptusuan();
        $data['bobot_kriteria'] = $this->M_penilaian->getBobotKriteria();
        $data['normalisasi_bobot_kriteria'] = $this->M_penilaian->getNormalisasiBobotKriteria();
        $data['nilai_vektor_s'] = $this->M_penilaian->getNilaiVektorS();
        $data['nilai_vektor_v'] = $this->M_penilaian->getNilaiVektorV();
        // ej($data);
        $this->templateback->view('penilaian/hasil', $data);
    }

    function cetak_hasil(){
        
        $data['web_title'] = $this->M_penilaian->getSettingsValue('web_title');
        $data['web_desc'] = $this->M_penilaian->getSettingsValue('web_desc');
        $data['web_icon'] = $this->M_penilaian->getSettingsValue('web_icon');
        $data['web_logo'] = $this->M_penilaian->getSettingsValue('web_logo');
        $data['nilai_vektor_v'] = $this->M_penilaian->getNilaiVektorV();

        $this->load->view('template/backend/header', $data);
        $this->load->view('penilaian/print', $data);
        $this->load->view('template/backend/footer', $data);
    }
}