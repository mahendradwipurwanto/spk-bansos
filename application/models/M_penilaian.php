<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_penilaian extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getSettingsValue($key)
    {
        $query = $this->db->get_where('tb_settings', ['key' => $key]);
        return $query->row()->value;
    }

    function getMatrixKeptusuan($bansos_id = null){
        $this->db->select('a.*, b.id, b.nama, b.nik')
        ->from('tb_penilaian a')
        ->join('tb_penduduk b', 'a.penduduk_id = b.id')
        ->where(['a.is_deleted' => 0, 'a.bansos_id' => $bansos_id])
        ;
        
        $models = $this->db->get()->result();
        
        $models = array_reverse(array_values(array_column(
            array_reverse($models),
            null,
            'penduduk_id'
        )));

        foreach($models as $key => $val){
            $models[$key]->kategori_penduduk = $this->getKategoriByPenduduk($val->id);
        }
        // ej($models);
        // ej($models[0]->kategori[8]->kategori);
        return $models;
    }

    function getKategoriByPenduduk($penduduk_id){
        $this->db->select('a.*, b.kode, b.kategori, b.bobot, c.kriteria, c.nilai')
        ->from('tb_penilaian a')
        ->join('tb_kategori b', 'a.kategori_id = b.id')
        ->join('tb_kriteria c', 'a.kriteria_id = c.id')
        ->where(['a.penduduk_id' => $penduduk_id, 'a.is_deleted' => 0])
        ;
        
        $models = $this->db->get()->result();

        $arr = [];
        foreach($models as $key => $val){
            $arr[$val->kategori_id] = $val;
        }

        return $arr;
    }

    function getBobotKriteria(){
        $this->db->select('*')
        ->from('tb_kategori')
        ->where('is_deleted', 0)
        ;

        $models = $this->db->get()->result();

        $arr = [];
        foreach($models as $key => $val){
            $arr[$val->id] = $val;
        }

        return $arr;
    }

    function getNormalisasiBobotKriteria(){
        $this->db->select('*')
        ->from('tb_kategori')
        ->where('is_deleted', 0)
        ;

        $models = $this->db->get()->result();

        $totalBobot = $this->db->select_sum('bobot', 'total')->get('tb_kategori')->row()->total;
        // ej($totalBobot);
        $arr = [];
        foreach($models as $key => $val){
            $arr[$val->id]['normalisasi'] = round($val->bobot/$totalBobot, 2);
        }

        return $arr;
    }

    function getNilaiVektorS($bansos_id = null){
        $this->db->select('a.*, b.id, b.nama, b.nik')
        ->from('tb_penilaian a')
        ->join('tb_penduduk b', 'a.penduduk_id = b.id')
        ->where(['a.is_deleted' => 0, 'a.bansos_id' => $bansos_id])
        ;
        
        $models = $this->db->get()->result();
        
        $models = array_reverse(array_values(array_column(
            array_reverse($models),
            null,
            'penduduk_id'
        )));

        $totalBobot = $this->db->select_sum('bobot', 'total')->get('tb_kategori')->row()->total;

        foreach($models as $key => $val){
            $models[$key]->kategori_penduduk = $this->getKategoriByPendudukVektor($val->id);
            $vektor_total = 1;
            foreach($models[$key]->kategori_penduduk as $k => $v){
                $vektor_total *= $v->vektor_hitung;
                $models[$key]->vektor_total = $vektor_total;
            }
        }
        // ej($models);
        // ej($models[0]->kategori[8]->kategori);
        return $models;
    }

    function getKategoriByPendudukVektor($penduduk_id){
        $this->db->select('a.*, b.kode, b.jenis, b.kategori, b.bobot, c.kriteria, c.nilai')
        ->from('tb_penilaian a')
        ->join('tb_kategori b', 'a.kategori_id = b.id')
        ->join('tb_kriteria c', 'a.kriteria_id = c.id')
        ->where(['a.penduduk_id' => $penduduk_id, 'a.is_deleted' => 0])
        ;
        
        $models = $this->db->get()->result();
        
        $totalBobot = $this->db->select_sum('bobot', 'total')->get('tb_kategori')->row()->total;

        $arr = [];
        foreach($models as $key => $val){
            $pangkat = round($val->bobot/$totalBobot, 2);
            $pangkat = $val->jenis == 1 ? $pangkat : $pangkat*-1;
            $val->vektor_hitung = (pow($val->nilai, $pangkat));
            $val->vektor_rumus = "{$val->nilai}*pangkat({$pangkat})";
            $arr[$val->kategori_id] = $val;
        }

        return $arr;
    }

    function getNilaiVektorV($bansos_id = null){
        $this->db->select('a.*, b.id, b.nama, b.nik')
        ->from('tb_penilaian a')
        ->join('tb_penduduk b', 'a.penduduk_id = b.id')
        ->where(['a.is_deleted' => 0, 'a.bansos_id' => $bansos_id])
        ;
        
        $models = $this->db->get()->result();
        
        $models = array_reverse(array_values(array_column(
            array_reverse($models),
            null,
            'id'
        )));

        $totalBobot = $this->db->select_sum('bobot', 'total')->get('tb_kategori')->row()->total;
        
        $vektor_total_hasil = 0;
        foreach($models as $key => $val){
            $models[$key]->kategori_penduduk = $this->getKategoriByPendudukVektor($val->id);
            $vektor_total = 1;
            foreach($models[$key]->kategori_penduduk as $k => $v){
                $vektor_total *= $v->vektor_hitung;
                $models[$key]->vektor_total = $vektor_total;
            }
            $vektor_total_hasil += $models[$key]->vektor_total;
            $arr[] = $models[$key]->vektor_total;
        }
        
        foreach($models as $key => $val){
            $models[$key]->vektor_hasil = ($val->vektor_total/$vektor_total_hasil);
            $models[$key]->vektor_hasil_rumus = "{$val->vektor_total} / {$vektor_total_hasil}";
        }
        
        // $models = array_reverse(array_values(array_column(
        //     array_reverse($models),
        //     null,
        //     'id'
        // )));

        usort($models, function($a, $b) {
            return $b->vektor_hasil <=> $a->vektor_hasil;
        });

        $no = 1;
        $arr = [];
        foreach($models as $key => $val){
            $arr[$val->id] = $val;
            $arr[$val->id]->peringkat = $no++;
        }

        // ej($models);
        // ej($models[0]->kategori[8]->kategori);
        return $arr;
    }
}
