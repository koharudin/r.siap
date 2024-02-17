<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedAlasanHukumanTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('alasan_hukuman')->delete();
        
        \DB::table('alasan_hukuman')->insert(array (
            0 => 
            array (
                'id_hukuman' => '11EC54D9B39457B1E050640A15026590',
                'nama_hukuman' => 'TIDAK MENGUCAPKAN SUMPAH/JANJI PNS',
                'keterangan_hukuman' => 'KEWAJIBAN',
            ),
            1 => 
            array (
                'id_hukuman' => '11EC54D9B39557B1E050640A15026590',
                'nama_hukuman' => 'TIDAK MENGUCAPKAN SUMPAH/JANJI JABATAN',
                'keterangan_hukuman' => 'KEWAJIBAN',
            ),
            2 => 
            array (
                'id_hukuman' => '11EC54D9B39657B1E050640A15026590',
                'nama_hukuman' => 'TIDAK SETIA DAN TAAT SEPENUHNYA KEPADA PANCASILA, UNDANG-UNDANG DASAR NEGARA REPUPLIK INDONESIA TAHUN 1945, NEGARA KESATUAN REPUBLIK INDONESIA, DAN PEMERINTAH',
                'keterangan_hukuman' => 'KEWAJIBAN',
            ),
            3 => 
            array (
                'id_hukuman' => '11EC54D9B39757B1E050640A15026590',
                'nama_hukuman' => 'TIDAK MENAATI SEGALA KETENTUAN PERATURAN PERUNDANG-UNDANGAN',
                'keterangan_hukuman' => 'KEWAJIBAN',
            ),
            4 => 
            array (
                'id_hukuman' => '11EC54D9B39857B1E050640A15026590',
                'nama_hukuman' => 'TIDAK MELAKSANAKAN TUGAS KEDINASAN YANG DIPERCAYAKAN KEPADA PNS DENGAN PENUH PENGABDIAN, KESADARAN, DAN TANGGUNG JAWAB',
                'keterangan_hukuman' => 'KEWAJIBAN',
            ),
            5 => 
            array (
                'id_hukuman' => '11EC54D9B39957B1E050640A15026590',
                'nama_hukuman' => 'TIDAK MENJUNJUNG TINGGI KEHORMATAN NEGARA, PEMERINTAH, DAN MARTABAT PNS',
                'keterangan_hukuman' => 'KEWAJIBAN',
            ),
            6 => 
            array (
                'id_hukuman' => '11EC54D9B39A57B1E050640A15026590',
                'nama_hukuman' => 'TIDAK MENGUTAMAKAN KEPENTINGAN NEGARA DARIPADA KEPENTINGAN SENDIRI, SESEORANG, DAN/ATAU GOLONGAN',
                'keterangan_hukuman' => 'KEWAJIBAN',
            ),
            7 => 
            array (
                'id_hukuman' => '11EC54D9B39B57B1E050640A15026590',
                'nama_hukuman' => 'TIDAK MEMEGANG RAHASIA JABATAN YANG MENURUT SIFATNYA ATAU MENURUT PERINTAH HARUS DIRAHASIAKAN',
                'keterangan_hukuman' => 'KEWAJIBAN',
            ),
            8 => 
            array (
                'id_hukuman' => '11EC54D9B39C57B1E050640A15026590',
                'nama_hukuman' => 'TIDAK BEKERJA DENGAN JUJUR, TERTIB, CERMAT, DAN BERSEMANGAT UNTUK KEPENTINGAN NEGARA',
                'keterangan_hukuman' => 'KEWAJIBAN',
            ),
            9 => 
            array (
                'id_hukuman' => '11EC54D9B39D57B1E050640A15026590',
                'nama_hukuman' => 'TIDAK MELAPORKAN DENGAN SEGERA KEPADA ATASANNYA APABILA MENGETAHUI ADA HAL YANG DAPAT MEMBAHAYAKAN ATAU MERUGIKAN NEGARA ATAU PEMERINTAH TERUTAMA DI BIDANG KEAMANAN, KEUANGAN, DAN MATERIIL',
                'keterangan_hukuman' => 'KEWAJIBAN',
            ),
            10 => 
            array (
                'id_hukuman' => '11EC54D9B39E57B1E050640A15026590',
                'nama_hukuman' => 'TIDAK MASUK KERJA DAN MENAATI KETENTUAN JAM KERJA',
                'keterangan_hukuman' => 'KEWAJIBAN',
            ),
            11 => 
            array (
                'id_hukuman' => '11EC54D9B39F57B1E050640A15026590',
                'nama_hukuman' => 'TIDAK MENCAPAI SASARAN KERJA PEGAWAI YANG DITETAPKAN',
                'keterangan_hukuman' => 'KEWAJIBAN',
            ),
            12 => 
            array (
                'id_hukuman' => '11EC54D9B3A057B1E050640A15026590',
                'nama_hukuman' => 'TIDAK MENGGUNAKAN DAN MEMELIHARA BARANG-BARANG MILIK NEGARA DENGAN SEBAIK-BAIKNYA',
                'keterangan_hukuman' => 'KEWAJIBAN',
            ),
            13 => 
            array (
                'id_hukuman' => '11EC54D9B3A157B1E050640A15026590',
                'nama_hukuman' => 'TIDAK MEMBERIKAN PELAYANAN SEBAIK-BAIKNYA KEPADA MASYARAKAT',
                'keterangan_hukuman' => 'KEWAJIBAN',
            ),
            14 => 
            array (
                'id_hukuman' => '11EC54D9B3A257B1E050640A15026590',
                'nama_hukuman' => 'TIDAK MEMBIMBING BAWAHAN DALAM MELAKSANAKAN TUGAS',
                'keterangan_hukuman' => 'KEWAJIBAN',
            ),
            15 => 
            array (
                'id_hukuman' => '11EC54D9B3A357B1E050640A15026590',
                'nama_hukuman' => 'TIDAK MEMBERIKAN KESEMPATAN KEPADA BAWAHAN UNTUK MENGEMBANGKAN KARIER',
                'keterangan_hukuman' => 'KEWAJIBAN',
            ),
            16 => 
            array (
                'id_hukuman' => '11EC54D9B3A457B1E050640A15026590',
                'nama_hukuman' => 'TIDAK MENAATI PERATURAN KEDINASAN YANG DITETAPKAN OLEH PEJABAT YANG BERWENANG',
                'keterangan_hukuman' => 'KEWAJIBAN',
            ),
            17 => 
            array (
                'id_hukuman' => '11EC54D9B3A557B1E050640A15026590',
                'nama_hukuman' => 'MENYALAHGUNAKAN WEWENANG',
                'keterangan_hukuman' => 'LARANGAN',
            ),
            18 => 
            array (
                'id_hukuman' => '11EC54D9B3A657B1E050640A15026590',
                'nama_hukuman' => 'MENJADI PERANTARA UNTUK MENDAPATKAN KEUNTUNGAN PRIBADI DAN/ ATAU ORANG LAIN DENGAN MENGGUNAKAN KEWENANGAN ORANG LAIN',
                'keterangan_hukuman' => 'LARANGAN',
            ),
            19 => 
            array (
                'id_hukuman' => '11EC54D9B3A757B1E050640A15026590',
                'nama_hukuman' => 'TANPA IZIN PEMERINTAH MENJADI PEGAWAI ATAU BEKERJA UNTUK NEGARA LAIN DAN/ ATAU LEMBAGA ATAU ORGANISASI INTERNASIONAL',
                'keterangan_hukuman' => 'LARANGAN',
            ),
            20 => 
            array (
                'id_hukuman' => '11EC54D9B3A857B1E050640A15026590',
                'nama_hukuman' => 'BEKERJA PADA PERUSAHAAN ASING, KONSULTAN ASING, ATAU LEMBAGA SWADAYA MASYARAKAT ASING',
                'keterangan_hukuman' => 'LARANGAN',
            ),
            21 => 
            array (
                'id_hukuman' => '11EC54D9B3A957B1E050640A15026590',
                'nama_hukuman' => 'MEMILIKI, MENJUAL, MEMBELI, MENGGADAIKAN, MENYEWAKAN, ATAU MEMINJAMKAN BARANG-BARANG BAIK BERGERAK ATAU TIDAK BERGERAK, DOKUMEN ATAU SURAT BERHARGA MILIK NEGARA SECARA TIDAK SAH',
                'keterangan_hukuman' => 'LARANGAN',
            ),
            22 => 
            array (
                'id_hukuman' => '11EC54D9B3AA57B1E050640A15026590',
                'nama_hukuman' => 'MELAKUKAN KEGIATAN BERSAMA DENGAN ATASAN, TEMAN SEJAWAT, BAWAHAN, ATAU ORANG LAIN DI DALAM MAUPUN DI LUAR LINGKUNGAN KERJANYA DENGAN TUJUAN UNTUK KEUNTUNGAN PRIBADI, GOLONGAN, ATAU PIHAK LAIN, YANG SECARA LANGSUNG ATAU TIDAK LANGSUNG MERUGIKAN NEGARA',
                'keterangan_hukuman' => 'LARANGAN',
            ),
            23 => 
            array (
                'id_hukuman' => '11EC54D9B3AB57B1E050640A15026590',
                'nama_hukuman' => 'MEMBERI ATAU MENYANGGUPI AKAN MEMBERI SESUATU KEPADA SIAPAPUN BAIK SECARA LANGSUNG ATAU TIDAK LANGSUNG DAN DENGAN DALIH APAPUN UNTUK DIANGKAT DALAM JABATAN',
                'keterangan_hukuman' => 'LARANGAN',
            ),
            24 => 
            array (
                'id_hukuman' => '11EC54D9B3AC57B1E050640A15026590',
                'nama_hukuman' => 'MENERIMA HADIAH ATAU SESUATU PEMBERIAN APA SAJA DARI SIAPAPUN JUGA YANG BERHUBUNGAN DENGAN JABATAN DAN/ATAU PEKERJAANNYA',
                'keterangan_hukuman' => 'LARANGAN',
            ),
            25 => 
            array (
                'id_hukuman' => '11EC54D9B3AD57B1E050640A15026590',
                'nama_hukuman' => 'BERTINDAK SEWENANG-WENANG TERHADAP BAWAHANNYA',
                'keterangan_hukuman' => 'LARANGAN',
            ),
            26 => 
            array (
                'id_hukuman' => '11EC54D9B3AE57B1E050640A15026590',
                'nama_hukuman' => 'MELAKUKAN SUATU TINDAKAN ATAU TIDAK MELAKUKAN SUATU TINDAKAN YANG DAPAT MENGHALANGI ATAU MEMPERSULIT SALAH SATU PIHAK YANG DILAYANI SEHINGGA MENGAKIBATKAN KERUGIAN BAGI YANG DILAYANI',
                'keterangan_hukuman' => 'LARANGAN',
            ),
            27 => 
            array (
                'id_hukuman' => '11EC54D9B3AF57B1E050640A15026590',
                'nama_hukuman' => 'MENGHALANGI BERJALANNYA TUGAS KEDINASAN',
                'keterangan_hukuman' => 'LARANGAN',
            ),
            28 => 
            array (
                'id_hukuman' => '11EC54D9B3B057B1E050640A15026590',
                'nama_hukuman' => 'IKUT SERTA SEBAGAI PELAKSANA KAMPANYE',
                'keterangan_hukuman' => 'LARANGAN',
            ),
            29 => 
            array (
                'id_hukuman' => '11EC54D9B3B157B1E050640A15026590',
                'nama_hukuman' => 'MENJADI PESERTA KAMPANYE DENGAN MENGGUNAKAN ATRIBUT PARTAI ATAU ATRIBUT PNS',
                'keterangan_hukuman' => 'LARANGAN',
            ),
            30 => 
            array (
                'id_hukuman' => '11EC54D9B3B257B1E050640A15026590',
                'nama_hukuman' => 'SEBAGAI PESERTA KAMPANYE DENGAN MENGERAHKAN PNS LAIN',
                'keterangan_hukuman' => 'LARANGAN',
            ),
            31 => 
            array (
                'id_hukuman' => '11EC54D9B3B357B1E050640A15026590',
                'nama_hukuman' => 'SEBAGAI PESERTA KAMPANYE DENGAN MENGGUNAKAN FASILITAS NEGARA',
                'keterangan_hukuman' => 'LARANGAN',
            ),
            32 => 
            array (
                'id_hukuman' => '11EC54D9B3B457B1E050640A15026590',
                'nama_hukuman' => 'MEMBUAT KEPUTUSAN DAN/ATAU TINDAKAN YANG MENGUNTUNGKAN ATAU MERUGIKAN SALAH SATU PASANGAN CALON SELAMA MASA KAMPANYE',
                'keterangan_hukuman' => 'LARANGAN',
            ),
            33 => 
            array (
                'id_hukuman' => '11EC54D9B3B557B1E050640A15026590',
                'nama_hukuman' => 'MENGADAKAN KEGIATAN YANG MENGARAH KEPADA KEPERPIHAKAN TERHADAP PASANGAN CALON YANG MENJADI PESERTA PEMILU SEBELUM, SELAMA, DAN SESUDAH MASA KAMPANYE MELIPUTI PERTEMUAN, AJAKAN, HIMBAUAN, SERUAN, ATAU PEMBERIAN BARANG KEPADA PNS DALAM LINGKUNGAN UNIT KERJANYA, ANGGOTA KELUARGA, DAN MASYARAKAT',
                'keterangan_hukuman' => 'LARANGAN',
            ),
            34 => 
            array (
                'id_hukuman' => '11EC54D9B3B657B1E050640A15026590',
                'nama_hukuman' => 'MEMBERIKAN DUKUNGAN KEPADA CALON ANGGOTA DEWAN PERWAKILAN DAERAH ATAU CALON KEPALA DAERAH/WAKIL KEPALA DAERAH DENGAN CARA MEMBERIKAN SURAT DUKUNGAN DISERTAI FOTO KOPI KARTU TANDA PENDUDUK ATAU SURAT KETERANGAN TANDA PENDUDUK SESUAI PERATURAN PERUNDANG-UNDANGAN',
                'keterangan_hukuman' => 'LARANGAN',
            ),
            35 => 
            array (
                'id_hukuman' => '11EC54D9B3B757B1E050640A15026590',
                'nama_hukuman' => 'TERLIBAT DALAM KEGIATAN KAMPANYE UNTUK MENDUKUNG CALON KEPALA DAERAH/WAKIL KEPALA DAERAH',
                'keterangan_hukuman' => 'LARANGAN',
            ),
            36 => 
            array (
                'id_hukuman' => '11EC54D9B3B857B1E050640A15026590',
                'nama_hukuman' => 'MENGGUNAKAN FASILITAS YANG TERKAIT DENGAN JABATAN DALAM KEGIATAN KAMPANYE',
                'keterangan_hukuman' => 'LARANGAN',
            ),
            37 => 
            array (
                'id_hukuman' => '11EC54D9B3B957B1E050640A15026590',
                'nama_hukuman' => 'MEMBUAT KEPUTUSAN DAN/ATAU TINDAKAN YANG MENGUNTUNGKAN ATAU MERUGIKAN SALAH SATU PASANGAN CALON SELAMA MASA KAMPANYE',
                'keterangan_hukuman' => 'LARANGAN',
            ),
            38 => 
            array (
                'id_hukuman' => '11EC54D9B3BA57B1E050640A15026590',
                'nama_hukuman' => 'MENGADAKAN KEGIATAN YANG MENGARAH KEPADA KEPERPIHAKAN TERHADAP PASANGAN CALON YANG MENJADI PESERTA PEMILU SEBELUM, SELAMA, DAN SESUDAH MASA KAMPANYE MELIPUTI PERTEMUAN, AJAKAN, HIMBAUAN, SERUAN, ATAU PEMBERIAN BARANG KEPADA PNS DALAM LINGKUNGAN UNIT KERJA LINGKUNGAN UNIT KERJANYA, ANGGOTA KELUARGA, DAN MASYARAKAT',
                'keterangan_hukuman' => 'LARANGAN',
            ),
            39 => 
            array (
                'id_hukuman' => 'C7730BC4BB20B892E050640AF2084D0C',
                'nama_hukuman' => 'MELAKUKAN TINDAK PIDANA',
                'keterangan_hukuman' => 'LARANGAN',
            ),
            40 => 
            array (
                'id_hukuman' => 'C7730BC4BB21B892E050640AF2084D0C',
                'nama_hukuman' => 'MENGGUNAKAN ATAU MENGEDARKAN NARKOBA',
                'keterangan_hukuman' => NULL,
            ),
        ));
        
        
    }
}