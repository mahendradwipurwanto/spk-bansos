<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_master extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getPenduduk($params = [])
    {
        $this->db->select('*')
        ->from('tb_penduduk')
        ->where(['is_deleted' => 0])
        ->order_by('created_at DESC')
        ;

        if (!empty($params) && isset($params['limit'])) {
            $this->db->limit($params['limit']);
        }

        return $this->db->get()->result();
    }

    public function tambahPenduduk()
    {
        $nama = $this->input->post('nama');
        $nik = $this->input->post('nik');
        $kk = $this->input->post('kk');
        $jenkel = $this->input->post('jenkel');
        $alamat = $this->input->post('alamat');

        $data = [
            'nama' => $nama,
            'nik' => $nik,
            'kk' => $kk,
            'jenkel' => $jenkel,
            'alamat' => $alamat,
            'created_at' => time(),
            'created_by' => $this->session->userdata('user_id')
        ];

        $this->db->insert('tb_penduduk', $data);
        return $this->db->affected_rows() == true;
    }

    public function editPenduduk()
    {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $nik = $this->input->post('nik');
        $kk = $this->input->post('kk');
        $jenkel = $this->input->post('jenkel');
        $alamat = $this->input->post('alamat');

        $data = [
            'nama' => $nama,
            'nik' => $nik,
            'kk' => $kk,
            'jenkel' => $jenkel,
            'alamat' => $alamat,
            'modified_at' => time(),
            'modified_by' => $this->session->userdata('user_id')
        ];

        $this->db->where('id', $id);
        $this->db->update('tb_penduduk', $data);
        return $this->db->affected_rows() == true;
    }

    public function hapusPenduduk()
    {
        $id = $this->input->post('id');

        $data = [
            'is_deleted' => 1,
            'modified_at' => time(),
            'modified_by' => $this->session->userdata('user_id')
        ];

        $this->db->where('id', $id);
        $this->db->update('tb_penduduk', $data);
        return $this->db->affected_rows() == true;
    }

    public function getKategori($params = [])
    {
        $this->db->select('*')
        ->from('tb_kategori')
        ->where(['is_deleted' => 0])
        ->order_by('created_at DESC')
        ;

        if (!empty($params) && isset($params['limit'])) {
            $this->db->limit($params['limit']);
        }

        return $this->db->get()->result();
    }

    public function tambahKategori()
    {
        $kode = $this->generate_code($this->input->post('kategori'), 'tb_kategori', 'C');
        $kategori = $this->input->post('kategori');
        $bobot = $this->input->post('bobot');
        $jenis = $this->input->post('jenis');
        $keterangan = $this->input->post('keterangan');

        $data = [
            'kode' => $kode,
            'kategori' => $kategori,
            'bobot' => $bobot,
            'jenis' => $jenis,
            'keterangan' => $keterangan,
            'created_at' => time(),
            'created_by' => $this->session->userdata('user_id')
        ];

        $this->db->insert('tb_kategori', $data);
        return $this->db->affected_rows() == true;
    }

    public function editKategori()
    {
        $id = $this->input->post('id');
        $kategori = $this->input->post('kategori');
        $bobot = $this->input->post('bobot');
        $jenis = $this->input->post('jenis');
        $keterangan = $this->input->post('keterangan');

        $data = [
            'kategori' => $kategori,
            'bobot' => $bobot,
            'jenis' => $jenis,
            'keterangan' => $keterangan,
            'modified_at' => time(),
            'modified_by' => $this->session->userdata('user_id')
        ];

        $this->db->where('id', $id);
        $this->db->update('tb_kategori', $data);
        return $this->db->affected_rows() == true;
    }

    public function hapusKategori()
    {
        $id = $this->input->post('id');

        $data = [
            'is_deleted' => 1,
            'modified_at' => time(),
            'modified_by' => $this->session->userdata('user_id')
        ];

        $this->db->where('id', $id);
        $this->db->update('tb_kategori', $data);
        return $this->db->affected_rows() == true;
    }

    public function getKategoriALl($params = [])
    {
        $this->db->select('a.*')
        ->from('tb_kategori a')
        ->where(['a.is_deleted' => 0])
        ->order_by('a.kode ASC');

        if (!empty($params) && isset($params['limit'])) {
            $this->db->limit($params['limit']);
        }

        $models = $this->db->get()->result();

        foreach ($models as $key => $val) {
            $val->kriteria = !empty($this->getKriteriaByKategori($val->id)) ? $this->getKriteriaByKategori($val->id) : null;
        }
        // ej($models);
        return $models;
    }

    public function getKriteriaByKategori($kategori_id)
    {
        $this->db->select('a.*, b.kategori')
        ->from('tb_kriteria a')
        ->join('tb_kategori b', 'a.kategori_id = b.id')
        ->where(['a.is_deleted' => 0, 'kategori_id' => $kategori_id])
        ->order_by('a.created_at DESC');

        if (!empty($params) && isset($params['limit'])) {
            $this->db->limit($params['limit']);
        }

        return $this->db->get()->result();
    }

    // public function getKriteria($params = [])
    // {
    //     $this->db->select('a.*, b.kategori')
    //     ->from('tb_kriteria a')
    //     ->join('tb_kategori b', 'a.kategori_id = b.id')
    //     ->where(['a.is_deleted' => 0])
    //     ->order_by('a.created_at DESC');

    //     if (!empty($params) && isset($params['limit'])) {
    //         $this->db->limit($params['limit']);
    //     }

    //     return $this->db->get()->result();
    // }

    public function tambahKriteria()
    {
        $kode = $this->generate_code($this->input->post('kriteria'), 'tb_kriteria', 'S');
        $kriteria = $this->input->post('kriteria');
        $kategori_id = $this->input->post('kategori_id');
        $nilai = $this->input->post('nilai');
        $keterangan = $this->input->post('keterangan');

        $data = [
            'kode' => $kode,
            'kriteria' => $kriteria,
            'kategori_id' => $kategori_id,
            'nilai' => $nilai,
            'keterangan' => $keterangan,
            'created_at' => time(),
            'created_by' => $this->session->userdata('user_id')
        ];

        $this->db->insert('tb_kriteria', $data);
        return $this->db->affected_rows() == true;
    }

    public function editKriteria()
    {
        $id = $this->input->post('id');
        $kriteria = $this->input->post('kriteria');
        $kategori_id = $this->input->post('kategori_id');
        $nilai = $this->input->post('nilai');
        $keterangan = $this->input->post('keterangan');

        $data = [
            'kriteria' => $kriteria,
            'kategori_id' => $kategori_id,
            'nilai' => $nilai,
            'keterangan' => $keterangan,
            'modified_at' => time(),
            'modified_by' => $this->session->userdata('user_id')
        ];

        $this->db->where('id', $id);
        $this->db->update('tb_kriteria', $data);
        return $this->db->affected_rows() == true;
    }

    public function hapusKriteria()
    {
        $id = $this->input->post('id');

        $data = [
            'is_deleted' => 1,
            'modified_at' => time(),
            'modified_by' => $this->session->userdata('user_id')
        ];

        $this->db->where('id', $id);
        $this->db->update('tb_kriteria', $data);
        return $this->db->affected_rows() == true;
    }

    public function generate_code($string = '', $table = '', $code = '')
    {
        $number = $this->db->get($table)->num_rows();
        // $string = preg_replace('/[^a-z]/i', '', $string);

        // $vocal = ["a", "e", "i", "o", "u", "A", "E", "I", "O", "U", " "];
        // $scrap = str_replace($vocal, "", $string);
        // $begin = substr($scrap, 0, 4);
        // $uniqid = strtoupper($begin);

        // CREATE KODE USER
        // $code = strtolower(rand_string(3).''.$uniqid . "".($number+1));
        $code = strtoupper($code . "".($number+1));

        return $code;
    }

    public function getPenilaian($bansos_id = null)
    {
        $this->db->select('a.*, b.id, b.nama, b.nik, c.bansos')
        ->from('tb_penilaian a')
        ->join('tb_penduduk b', 'a.penduduk_id = b.id')
        ->join('tb_bansos c', 'a.bansos_id = c.id', 'left')
        ->where(['a.is_deleted' => 0])
        ;

        $this->db->where('bansos_id', $bansos_id);

        $models = $this->db->get()->result();

        $models = array_reverse(array_values(array_column(
            array_reverse($models),
            null,
            'penduduk_id'
        )));

        foreach ($models as $key => $val) {
            $models[$key]->kategori_penduduk = $this->getKategoriByPenduduk($val->id);
        }
        // ej($models);
        // ej($models[0]->kategori[8]->kategori);
        return $models;
    }

    public function getKategoriByPenduduk($penduduk_id)
    {
        $this->db->select('a.*, b.kategori, b.bobot, c.kriteria, c.nilai')
        ->from('tb_penilaian a')
        ->join('tb_kategori b', 'a.kategori_id = b.id')
        ->join('tb_kriteria c', 'a.kriteria_id = c.id')
        ->where(['a.penduduk_id' => $penduduk_id, 'a.is_deleted' => 0])
        ;

        $models = $this->db->get()->result();

        $arr = [];
        foreach ($models as $key => $val) {
            $arr[$val->kategori_id] = $val;
        }

        return $arr;
    }

    public function getKriteriaById($kriteria_id)
    {
        $this->db->select('a.*')
        ->from('tb_kriteria a')
        ->where(['a.id' => $kriteria_id, 'a.is_deleted' => 0])
        ;

        $models = $this->db->get()->row();
        // ej($models);
        return $models;
    }

    public function tambahPenilaian()
    {
        $bansos_id = $this->input->post('bansos_id');
        $penduduk_id = $this->input->post('penduduk_id');
        $kategori_id = $this->input->post('kategori_id');
        $kriteria_id = $this->input->post('kriteria_id');

        $this->db->trans_begin();
        foreach ($kategori_id as $key => $val) {
            $data = [
                'bansos_id' => $bansos_id,
                'penduduk_id' => $penduduk_id,
                'kategori_id' => $kategori_id[$key],
                'kriteria_id' => $kriteria_id[$key],
                'created_at' => time(),
                'created_by' => $this->session->userdata('user_id')
            ];
            $this->db->insert('tb_penilaian', $data);
        }
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return [
                'status' => false,
                'data' => $this->db->error()

            ];
        } else {
            $this->db->trans_commit();
            return [
                'status' => true,
                'data' => 'Berhasil'
            ];
        }
    }

    public function editPenilaian()
    {
        $penduduk_id = $this->input->post('id');
        $bansos_id = $this->input->post('bansos_id');
        $kategori_id = $this->input->post('kategori_id');
        $kriteria_id = $this->input->post('kriteria_id');
        $this->db->trans_begin();
        foreach ($kategori_id as $key => $val) {
            $data = [
                'bansos_id' => $bansos_id,
                'penduduk_id' => $penduduk_id,
                'kategori_id' => $kategori_id[$key],
                'kriteria_id' => $kriteria_id[$key],
                'modified_at' => time(),
                'modified_by' => $this->session->userdata('user_id')
            ];
            $this->db->where(['penduduk_id' => $penduduk_id, 'kategori_id' => $kategori_id[$key]]);
            $this->db->update('tb_penilaian', $data);
        }
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return [
                'status' => false,
                'data' => $this->db->error()

            ];
        } else {
            $this->db->trans_commit();
            return [
                'status' => true,
                'data' => 'Berhasil'
            ];
        }
    }

    public function hapusPenilaian()
    {
        $id = $this->input->post('id');

        $data = [
            'is_deleted' => 1,
            'modified_at' => time(),
            'modified_by' => $this->session->userdata('user_id')
        ];

        $this->db->where('penduduk_id', $id);
        $this->db->update('tb_penilaian', $data);
        return $this->db->affected_rows() == true;
    }

    public function getBansos($params = [])
    {
        $this->db->select('*')
        ->from('tb_bansos')
        ->where(['is_deleted' => 0])
        ->order_by('created_at DESC')
        ;

        if (!empty($params) && isset($params['limit'])) {
            $this->db->limit($params['limit']);
        }

        return $this->db->get()->result();
    }

    public function getBansosById($bansos_id = null)
    {
        $this->db->select('*')
        ->from('tb_bansos')
        ->where(['is_deleted' => 0, 'id' => $bansos_id])
        ->order_by('created_at DESC')
        ;

        return $this->db->get()->row();
    }

    public function tambahBansos()
    {
        $bansos = $this->input->post('bansos');
        $keterangan = $this->input->post('keterangan');

        $data = [
            'bansos' => $bansos,
            'keterangan' => $keterangan,
            'created_at' => time(),
            'created_by' => $this->session->userdata('user_id')
        ];

        $this->db->insert('tb_bansos', $data);
        return $this->db->affected_rows() == true;
    }

    public function editBansos()
    {
        $id = $this->input->post('id');
        $bansos = $this->input->post('bansos');
        $keterangan = $this->input->post('keterangan');

        $data = [
            'bansos' => $bansos,
            'keterangan' => $keterangan,
            'modified_at' => time(),
            'modified_by' => $this->session->userdata('user_id')
        ];

        $this->db->where('id', $id);
        $this->db->update('tb_bansos', $data);
        return $this->db->affected_rows() == true;
    }

    public function hapusBansos()
    {
        $id = $this->input->post('id');

        $data = [
            'is_deleted' => 1,
            'modified_at' => time(),
            'modified_by' => $this->session->userdata('user_id')
        ];

        $this->db->where('id', $id);
        $this->db->update('tb_bansos', $data);
        return $this->db->affected_rows() == true;
    }
}
