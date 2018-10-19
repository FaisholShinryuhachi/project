<?php

namespace App\Libraries;


use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class Bpjs
{	/*
	A.	Referensi

		1.	Diagnosa
				public function diagnosa($diagnosa)
		2.	Poli
				public function poli($poli)
		3.	Fasilitas Kesehatan
				public function faskes($faskes, $jnsFaskes)
		4.	Dokter DPJP
				public function dokterDPJP($jnsPelayanan, $tglSep, $kdSpesialis)
		5.	Propinsi
				public function provinsi()
		6.	Kabupaten
				public function kabupaten($kdPropinsi)
		7.	Kecamatan
				public function kecamatan($kdKabupaten)
		8.	Procedure / Tindakan (Hanya Untuk Lembar Pengajuan Klaim)
				public function prosedur($kdProsedur)
		9.	Kelas Rawat (Hanya Untuk Lembar Pengajuan Klaim)
				public function kelasRawat()
		10.	Dokter (Hanya Untuk Lembar Pengajuan Klaim)
				Public function dokter($dokter)
		11.	Spesialistik (Hanya Untuk Lembar Pengajuan Klaim)
				public function spesialistik()
		12.	Ruang Rawat (Hanya Untuk Lembar Pengajuan Klaim)
				public function ruangRawat()
		13.	Cara Keluar (Hanya Untuk Lembar Pengajuan Klaim)
				public function caraKeluar()
		14.	Pasca Pulang (Hanya Untuk Lembar Pengajuan Klaim)
				public function pascaPulang()

	B.	Peserta

		1.	No.Kartu BPJS
				public function getPesertaNoBpjs($noBpjs, $tglSep)
		2.	NIK
				public function getPesertaNik($nik, $tglSep)

	C.	SEP

		1.	Pembuatan SEP
			a.	Insert SEP
					public function insertSep(
				 		$noKartu, $tglSep, $ppkPelayanan, $jnsPelayanan, $klsRawat, $noMR,
				 		$asalRujukan, $tglRujukan, $noRujukan, $ppkRujukan, $catatan, $diagAwal, $tujuan, $eksekutif, $cob,
				 		$katarak, $lakaLantas, $penjamin, $tglKejadian, $keterangan, $suplesi, $noSepSuplesi, $kdPropinsi,
				 		$kdKabupaten, $kdKecamatan, $noSurat, $kodeDPJP, $noTelp, $user)
			b.	Update SEP
					public function updateSep(
				 		$noSep, $klsRawat, $noMR, $catatan, $diagAwal, $eksekutif, $cob, $katarak,
				 		$noSurat, $kodeDPJP, $lakaLantas, $penjamin, $tglKejadian, $keterangan, $suplesi, $noSepSuplesi,
				 		$kdPropinsi, $kdKabupaten, $kdKecamatan)
			c.	Hapus SEP
					public function hapusSep($noSep, $user)
			d.	Cari SEP
					public function cariSep($noSep)
		2.	Potensi Suplesi Jasa Raharja
			a.	Suplesi Jasa Raharja
					public function getSuplesiJasaRaharja($noKartu, $tglSep)
		3.	Approval Penjaminan SEP
			a.	Pengajuan
					public function pengajuan(
			    	$noKartu, $tglSep, $jnsPelayanan, $keterangan, $user)
			b.	Aproval Pengajuan SEP
					public function aprovalPengajuan(
			    	$noKartu, $tglSep, $jnsPelayanan, $keterangan, $user)
		4.	Update Tgl Pulang SEP
			a.	Update Tgl Pulang SEP
					public function updateTanggalPulang($noSep, $tglPulang, $ppkPelayanan)
		5.	Integrasi SEP dan Inacbg
			a.	Integrasi SEP dengan Inacbg
					public function interCBG($noKartu)

	D.	Rujukan

		1.	Cari Rujukan pCare
			a.	Rujukan Berdasarkan Nomor Rujukan
					public function getRujukanNoRujukanPcare($noRujukan)
			b.	Rujukan Berdasarkan Nomor Kartu (1 Record)
					public function getRujukanNoKartuSinglePcare($noKartu)
			c.	Rujukan Berdasarkan Nomor Kartu (Multi Record)
					public function getRujukanNoKartuMultiPcare($noKartu)
		2.	Cari Rujukan Rumah Sakit
			a.	Rujukan Berdasarkan Nomor Rujukan
					public function getRujukanNoRujukanRS($noRujukan)
			b.	Rujukan Berdasarkan Nomor Kartu (1 Record)
					public function getRujukanNoKartuSingleRS($noKartu)
			c.	Rujukan Berdasarkan Nomor Kartu (Multi Record)
					public function getRujukanNoKartuMultiRS($noKartu)
		3.	Pembuatan Rujukan
			a.	Insert Rujukan
					public function insertRujukan($noSep, $tglRujukan, $ppkPelayanan, $jnsPelayanan, $catatan, $diagRujukan, $tipeRujukan,
		 			$poliRujukan, $user)
			b.	Update Rujukan
					public function upadateRujukan($noRujukan, $ppkDirujuk, $tipe, $jnsPelayanan, $catatan, $diagRujukan, $tipeRujukan, 
		 			$poliRujukan, $user)
		c.	Delete Rujukan
					public function hapusRujukan($noRujukan, $user)

	E.	Lembar Pengajuan Klaim

		1.	Insert LPK
		  		public function insertLPK(
		    	$noSep, $tglMasuk, $tglKeluar, $jaminan, $poli, $ruangRawat, $kelasRawat, $spesialistik, $caraKeluar,
		    	$kondisiPulang, $kodeDiag1, $level1, $kodeDiag2, $level2, $kodePro1, $kodePro2, $tindakLanjut, $kodePPK, $tglKontrol, 
		    	$DPJP, $user)
		2.	Update LPK
					public function updateLPK(
		 		$noSep, $tglMasuk, $tglKeluar, $jaminan, $poli, $ruangRawat, $kelasRawat, $spesialistik, $caraKeluar,
		 		$kondisiPulang, $kodeDiag1, $level1, $kodeDiag2, $level2, $kodePro1, $kodePro2, $tindakLanjut, $kodePPK, $tglKontrol,
		 		$DPJP, $user)
		3.	Delete LPK
				public function hapusLPK($noSep)
		4.	Data Lembar Pengajuan Klaim
				public function getLPK($tglMasuk, $jnsPelayanan)

	F.	Monitoring

		1.	Data Kunjungan
				public function getDataKunjungan($tglSep, $jnsPelayanan)
		2.	Data Klaim
				public function getDataKlaim($tglPulang, $jnsPelayanan, $statusKlaim)
		3.	Data Histori Pelayanan Peserta
				public function getDataHistoriPelayanan($noKartu, $tglMulai, $tglAkhir)
		4.	Data Klaim Jaminan Jasa Raharja
				public function getDataKlaimJaminanJasaRaharja($tglMulai, $tglAkhir)

	G.	Ketersediaan Kamar

		1.	Referensi Kamar
				public function getReferensiKamar()
		2.	Update Ketersediaan Tempat Tidur
				public function updateRestBed($kodePPK, $kodekelas, $koderuang, $namaruang, $kapasitas, $tersedia, $tersediapria, 		$tersediawanita, $tersediapriawanita)
		3.	Ruangan Baru
				public function createRestBed($kodePPK, $kodekelas, $koderuang, $namaruang, $kapasitas, $tersedia, $tersediapria, 		$tersediawanita, $tersediapriawanita )
		4.	Ketersediaan Kamar RS
				public function readRestBed($kodePPK, $start, $limit)
		5.	Hapus Ruangan
				public function deleteRestBed($kodePPK, $kodekelas, $koderuang)


	*/
	protected static function headerCount(){

			//$consId = config('app.cons-id');
		  	//$secretKey = config('app.secretKey');
		    $data = config('app.cons-id');
   			$secretKey = config('app.secret');
			// Computes the timestamp
			date_default_timezone_set('UTC');
			$tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
			// Computes the signature by hashing the salt with the secret key as the key
			$signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
			 
			// base64 encode…
			$encodedSignature = base64_encode($signature);
			 
			// urlencode…
			// $encodedSignature = urlencode($encodedSignature);
			 
			return array(	'X-cons-id' => $data,
 							'X-timestamp'=> $tStamp,
 							'X-signature'=> $encodedSignature
 						);
	}

	public static function api($url, $method, $data = null){

		if ($data == null){

	 		$client = new Client([
	 			'headers'=>	self::headerCount()
	 			]);
 		}

 		else{
 			$client = new Client([
	 			'headers'=>	self::headerCount(),
	 			'body'	=> $data
	 			]);
 		}

 		$response = $client->request($method, $url);
 		$data = $response->getBody();
 		return $data;
	}
	 /*
	}
    |--------------------------------------------------------------------------
    | Referensi
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    */


     /*
    |--------------------------------------------------------------------------
    | Diagnosa
    |--------------------------------------------------------------------------
    */
    public function diagnosa($diagnosa){

 		$url = config('app.baseUrl').config('app.serviceName')."referensi/diagnosa/".$diagnosa;
 		$data = $this->api($url, 'GET');
 		return $data;
 	}
 	/*
    |--------------------------------------------------------------------------
    | Poli
    |--------------------------------------------------------------------------
    */
 	 public function poli($poli){

 		$url = config('app.baseUrl').config('app.serviceName')."referensi/poli/".$poli;
 		
 		$data = $this->api($url, 'GET');
 		return $data;
 	}
 	/*
    |--------------------------------------------------------------------------
    | Faskes
    |--------------------------------------------------------------------------
    */
 	 public function faskes($faskes, $jnsFaskes){

 		$url = config('app.baseUrl').config('app.serviceName')."referensi/faskes/".$faskes."/".$jnsFaskes;	
 		$data = $this->api($url, 'GET');
 		return $data;
 	}
 	/*
    |--------------------------------------------------------------------------
    | Dokter DPJP
    |--------------------------------------------------------------------------
    */
 	public function dokterDPJP($jnsPelayanan, $tglSep, $kdSpesialis){

 		$url = config('app.baseUrl').config('app.serviceName')."referensi/dokter/pelayanan/".$jnsPelayanan."/tglPelayanan/".$tglSep."/Spesialis/".$kdSpesialis;
 		$data = $this->api($url, 'GET');
 		return $data;
 	}
 	/*
    |--------------------------------------------------------------------------
    | Provinsi
    |--------------------------------------------------------------------------
    */
 	public function provinsi(){

 		$url = config('app.baseUrl').config('app.serviceName')."referensi/propinsi";
 		$data = $this->api($url, 'GET');
 		return $data;
 	}
 	/*
    |--------------------------------------------------------------------------
    | Kabupaten
    |--------------------------------------------------------------------------
    */
 	public function kabupaten($kdPropinsi){

 		$url = config('app.baseUrl').config('app.serviceName')."referensi/kabupaten/propinsi/".$kdPropinsi;
 		$data = $this->api($url, 'GET');
 		return $data;
 	}
 	/*
    |--------------------------------------------------------------------------
    | Kecamatan
    |--------------------------------------------------------------------------
    */
 	public function kecamatan($kdKabupaten){

 		$url = config('app.baseUrl').config('app.serviceName')."referensi/kecamatan/kabupaten/".$kdKabupaten;
		$data = $this->api($url, 'GET');
 		return $data;
 	}
 	/*
    |--------------------------------------------------------------------------
    | Procedure / Tindakan (Hanya Untuk Lembar Pengajuan Klaim)
    |--------------------------------------------------------------------------
    */
 	public function prosedur($kdProsedur){

 		$url = config('app.baseUrl').config('app.serviceName')."referensi/procedure/".$kdProsedur;
 		$data = $this->api($url, 'GET');
 		return $data;
 	}

 	/*
    |--------------------------------------------------------------------------
    | Kelas Rawat (Hanya Untuk Lembar Pengajuan Klaim)
    |--------------------------------------------------------------------------
    */
 	public function kelasRawat(){

 		$url = config('app.baseUrl').config('app.serviceName')."referensi/kelasrawat";
	 	$data = $this->api($url, 'GET');
 		return $data;
 	}
 	/*
    |--------------------------------------------------------------------------
    | Dokter (Hanya Untuk Lembar Pengajuan Klaim))
    |--------------------------------------------------------------------------
    */
 	public function dokter($dokter){

 		$url = config('app.baseUrl').config('app.serviceName')."referensi/dokter/".$dokter;
		$data = $this->api($url, 'GET');
 		return $data;
 	}
 	/*
    |--------------------------------------------------------------------------
    | Spesialistik (Hanya Untuk Lembar Pengajuan Klaim)
    |--------------------------------------------------------------------------
    */
 	public function spesialistik(){

 		$url = config('app.baseUrl').config('app.serviceName')."referensi/spesialistik";
 		$data = $this->api($url, 'GET');
 		return $data;
 	}
 	/*
    |--------------------------------------------------------------------------
    | Ruang Rawat (Hanya Untuk Lembar Pengajuan Klaim)
    |--------------------------------------------------------------------------
    */
 	public function ruangRawat(){

 		$url = config('app.baseUrl').config('app.serviceName')."referensi/ruangrawat";
 		$data = $this->api($url, 'GET');
 		return $data;
 	}
 	/*
    |--------------------------------------------------------------------------
    | Cara Keluar (Hanya Untuk Lembar Pengajuan Klaim)
    |--------------------------------------------------------------------------
    */
 	public function caraKeluar(){

 		$url = config('app.baseUrl').config('app.serviceName')."referensi/carakeluar";
 		$data = $this->api($url, 'GET');
 		return $data;
 	}
 	/*
    |--------------------------------------------------------------------------
    | Pasca Pulang (Hanya Untuk Lembar Pengajuan Klaim)
    |--------------------------------------------------------------------------
    */
 	public function pascaPulang(){

 		$url = config('app.baseUrl').config('app.serviceName')."referensi/pascapulang";
 		$data = $this->api($url, 'GET');
 		return $data;
 	}


	 /*
    |--------------------------------------------------------------------------
    | Peserta
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    */


    /*
    |--------------------------------------------------------------------------
    | No.Kartu BPJS
    |--------------------------------------------------------------------------
    */
 	public function getPesertaNoBpjs($noBpjs, $tglSep){

 		$url = config('app.baseUrl').config('app.serviceName')."Peserta/nokartu/".$noBpjs."/tglSEP/".$tglSep;
 		$data = $this->api($url, 'GET');
 		return $data;
 	}
 	 /*
    |--------------------------------------------------------------------------
    | NIK
    |--------------------------------------------------------------------------
    */
 	public function getPesertaNik($nik, $tglSep){

 		$url = config('app.baseUrl').config('app.serviceName')."Peserta/nik/".$nik."/tglSEP/".$tglSep;
 		$data = $this->api($url, 'GET');
 		return $data;
 	}

 	 /*
    |--------------------------------------------------------------------------
    | SEP
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    */

    /*
    ===========================================================================
    ==========================   Pembuatan SEP ================================
    ===========================================================================
    */


     /*
    |--------------------------------------------------------------------------
    | Insert SEP
    |--------------------------------------------------------------------------
    */

 	public function insertSep(
 		$noKartu, $tglSep, $ppkPelayanan, $jnsPelayanan, $klsRawat, $noMR,
 		$asalRujukan, $tglRujukan, $noRujukan, $ppkRujukan, $catatan, $diagAwal, $tujuan, $eksekutif, $cob,
 		$katarak, $lakaLantas, $penjamin, $tglKejadian, $keterangan, $suplesi, $noSepSuplesi, $kdPropinsi,
 		$kdKabupaten, $kdKecamatan, $noSurat, $kodeDPJP, $noTelp, $user)
 	{

 		$data =  [
           "request"=> [
              "t_sep"=> [
                 "noKartu"=> $noKartu,
                 "tglSep"=> $tglSep,
                 "ppkPelayanan"=> $ppkPelayanan,
                 "jnsPelayanan"=> $jnsPelayanan,
                 "klsRawat"=> $klsRawat,
                 "noMR"=> $noMR,
                 "rujukan"=> [
                    "asalRujukan"=> $asalRujukan,
                    "tglRujukan"=> $tglRujukan,
                    "noRujukan"=> $noRujukan,
                    "ppkRujukan"=> $ppkRujukan
                 ],
                 "catatan"=> $catatan,
                 "diagAwal"=> $diagAwal,
                 "poli"=> [
                    "tujuan"=> $tujuan,
                    "eksekutif"=> $eksekutif
                 ],
                 "cob"=> [
                    "cob"=> $cob
                 ],
                 "katarak"=> [
                    "katarak"=> $katarak
                 ],
                 "jaminan"=> [
                    "lakaLantas"=> $lakaLantas,
                    "penjamin"=> [
                        "penjamin"=> $penjamin,
                        "tglKejadian"=> $tglKejadian,
                        "keterangan"=> $keterangan,
                        "suplesi"=> [
                            "suplesi"=> $suplesi,
                            "noSepSuplesi"=> $noSepSuplesi,
                            "lokasiLaka"=> [
                                "kdPropinsi"=> $kdPropinsi,
                                "kdKabupaten"=> $kdKabupaten,
                                "kdKecamatan"=> $kdKecamatan
                                ]
                        ]
                    ]
                 ],
                 "skdp"=> [
                    "noSurat"=> $noSurat,
                    "kodeDPJP"=> $kodeDPJP
                 ],
                 "noTelp"=> $noTelp,
                 "user"=> $user
              ]
           ]
        ];
        $data = json_encode($data);

 		$url = config('app.baseUrl').config('app.serviceName')."SEP/1.1/insert";
 		
 		$data = $this->api($url, 'POST', $data);
 		return $data;
 	}
 	 /*
    |--------------------------------------------------------------------------
    | Update SEP
    |--------------------------------------------------------------------------
    */
 	public function updateSep(
 		$noSep, $klsRawat, $noMR, $catatan, $diagAwal, $eksekutif, $cob, $katarak,
 		$noSurat, $kodeDPJP, $lakaLantas, $penjamin, $tglKejadian, $keterangan, $suplesi, $noSepSuplesi,
 		$kdPropinsi, $kdKabupaten, $kdKecamatan)
 	{

		 		$data = [
		       "request"=> [
		          "t_sep"=> [
		             "noSep"=> $noSep,
		             "klsRawat"=> $klsRawat,
		             "noMR"=> $noMR,
		             "catatan"=> $catatan,
		             "diagAwal"=> $diagAwal,
		             "poli"=> [
		                "eksekutif"=> $eksekutif
		             ],
		             "cob"=> [
		                "cob"=> $cob
		             ],
		             "katarak"=>[
		                "katarak"=>$katarak
		             ],
		             "skdp"=>[
		                "noSurat"=>$noSurat,
		                "kodeDPJP"=>$kodeDPJP            
		             ],
		             "jaminan"=> [
		                "lakaLantas"=>$lakaLantas,
		                "penjamin"=>
		                [
		                    "penjamin"=>$penjamin,
		                    "tglKejadian"=>$tglKejadian,             
		                    "keterangan"=>$keterangan,
		                    "suplesi"=>
		                        [
		                            "suplesi"=>$suplesi,
		                            "noSepSuplesi"=>$noSepSuplesi,
		                            "lokasiLaka"=> 
		                                [
		                                "kdPropinsi"=>$kdPropinsi,
		                                "kdKabupaten"=>$kdKabupaten,
		                                "kdKecamatan"=>$kdKecamatan
		                                ]
		                        ]                   
		                ]
		             ],             
		             "noTelp"=> $noTelp,
		             "user"=> $user
		          ]
		       ]
		    ];               
                                 
        $data = json_encode($data);

 		$url = config('app.baseUrl').config('app.serviceName')."SEP/1.1/Update";
 		
 		$data = $this->api($url, 'PUT', $data);
 		return $data;
 	}
 	 /*
    |--------------------------------------------------------------------------
    | Hapus SEP
    |--------------------------------------------------------------------------
    */
 	public function hapusSep($noSep, $user)
 	{	
 		$data = [
       "request"=> [
          "t_sep"=> [
             "noSep"=> $noSep,
             "user"=> $user
          ]
       ]
    ];             
                                 
        $data = json_encode($data);

 		$url = config('app.baseUrl').config('app.serviceName')."SEP/Delete";
 		$data = $this->api($url, 'DELETE', $data);
 		return $data;
 	}
 	 /*
    |--------------------------------------------------------------------------
    | Cari SEP
    |--------------------------------------------------------------------------
    */
 	public function cariSep($noSep)
 	{	             

 		$url = config('app.baseUrl').config('app.serviceName')."SEP/".$noSep;
 		$data = $this->api($url, 'GET');
 		return $data;
 	}

 	 /*
    ===========================================================================
    ====================  Potensi Suplesi Jasa Raharja ========================
    ===========================================================================
    */

     /*
    |--------------------------------------------------------------------------
    | Suplesi Jasa Raharja
    |--------------------------------------------------------------------------
    */

    public function getSuplesiJasaRaharja($noKartu, $tglSep){

 		$url = config('app.baseUrl').config('app.serviceName')."sep/JasaRaharja/Suplesi/".$noKartu."/tglPelayanan/".$tglSep;
 		$data = $this->api($url, 'GET');
 		return $data;
 	}

 	 /*
    ===========================================================================
    ====================  Aproval Penjamin SEP======== ========================
    ===========================================================================
    */


     /*
    |--------------------------------------------------------------------------
    | Pengajuan
    |--------------------------------------------------------------------------
    */

    public function pengajuan(
    	$noKartu, $tglSep, $jnsPelayanan, $keterangan, $user)
 	{	
 		$data = [
	       "request"=> [
	          "t_sep"=> [
	             "noKartu"=> $noKartu,
	             "tglSep"=> $tglSep,
	             "jnsPelayanan"=> $jnsPelayanan,
	             "keterangan"=> $keterangan,
	             "user"=> $user
	          ]
	       ]
	    ];                    
                                 
        $data = json_encode($data);

 		$url = config('app.baseUrl').config('app.serviceName')."Sep/pengajuanSEP";
 		
 		$data = $this->api($url, 'POST', $data);
 		return $data;
 	}
 	/*
    |--------------------------------------------------------------------------
    | Aproval Pengajuan SEP
    |--------------------------------------------------------------------------
    */
 	 public function aprovalPengajuan(
    	$noKartu, $tglSep, $jnsPelayanan, $keterangan, $user)
 	{	
 		$data = [
		       "request"=> [
		          "t_sep"=> [
		             "noKartu"=> $noKartu,
		             "tglSep"=> $tglSep,
		             "jnsPelayanan"=> $jnsPelayanan,
		             "keterangan"=> $keterangan,
		             "user"=> $user
		          ]
		       ]
		    ];                    
                                 
        $data = json_encode($data);

 		$url = config('app.baseUrl').config('app.serviceName')."Sep/aprovalSEP";
 		
 		$data = $this->api($url, 'POST', $data);
 		return $data;
 	}

 	 /*
    ===========================================================================
    ====================  Update Tanggal Pulang================================
    ===========================================================================
    */

    /*
    |--------------------------------------------------------------------------
    | Update Tanggal Pulang
    |--------------------------------------------------------------------------
    */
 	public function updateTanggalPulang($noSep, $tglPulang, $ppkPelayanan)
 	{	
 		$data =  [  
            "request"=> 
                [    
                "t_sep"=>
                    [
                        "noSep"=>$noSep,
                        "tglPulang"=>$tglPulang,
                        "ppkPelayanan"=>$ppkPelayanan
                    ]
                ]
        	];                    
                                 
        $data = json_encode($data);

 		$url = config('app.baseUrl').config('app.serviceName')."Sep/updtglplg";
 		
 		$data = $this->api($url, 'PUT', $data);
 		return $data;
 	}


 	 /*
    ===========================================================================
    ====================  Integrasi SEP dan Inacbg ============================
    ===========================================================================
    */

 	 /*
    |--------------------------------------------------------------------------
    | Integrasi SEP dengan Inacbg
    |--------------------------------------------------------------------------
    */
     public function interCBG($noKartu){

 		$url = config('app.baseUrl').config('app.serviceName')."sep/cbg/".$noKartu;
 		$data = $this->api($url, 'GET');
 		return $data;
 	}
 	
 	/*
    |--------------------------------------------------------------------------
    | Rujukan
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    */

     /*
    ===========================================================================
    ==========================  Cari Rujukan Pcare ============================
    ===========================================================================
    */

    /*
    |--------------------------------------------------------------------------
    | Rujukan Berdasarkan Nomor Rujukan Pcare
    |--------------------------------------------------------------------------
    */

    public function getRujukanNoRujukanPcare($noRujukan){

 		$url = config('app.baseUrl').config('app.serviceName')."Rujukan/".$noRujukan;
 		$data = $this->api($url, 'GET');
 		return $data;
 	}
 	 /*
    |--------------------------------------------------------------------------
    | Rujukan Berdasarkan Nomor Kartu (1 Record) Pcare
    |--------------------------------------------------------------------------
    */
 	 public function getRujukanNoKartuSinglePcare($noKartu){

 		$url = config('app.baseUrl').config('app.serviceName')."Rujukan/Peserta/".$noKartu;
 		$data = $this->api($url, 'GET');
 		return $data;
 	}
 	 /*
    |--------------------------------------------------------------------------
    | Rujukan Berdasarkan Nomor Kartu (Multi Record) Pcare
    |--------------------------------------------------------------------------
    */
     public function getRujukanNoKartuMultiPcare($noKartu){

 		$url = config('app.baseUrl').config('app.serviceName')."Rujukan/List/Peserta/".$noKartu;
 		$data = $this->api($url, 'GET');
 		return $data;
 	}
 	 /*
    ===========================================================================
    ==========================  Cari Rujukan Rumahsakit =======================
    ===========================================================================
    */


     /*
    |--------------------------------------------------------------------------
    | Rujukan Berdasarkan Nomor Rujukan Rumahsakit
    |--------------------------------------------------------------------------
    */

    public function getRujukanNoRujukanRS($noRujukan){

 		$url = config('app.baseUrl').config('app.serviceName')."Rujukan/RS/".$noRujukan;
 		$data = $this->api($url, 'GET');
 	}
 	 /*
    |--------------------------------------------------------------------------
    | Rujukan Berdasarkan Nomor Kartu (1 Record) Rumahsakit
    |--------------------------------------------------------------------------
    */
 	 public function getRujukanNoKartuSingleRS($noKartu){

 		$url = config('app.baseUrl').config('app.serviceName')."/Rujukan/RS/Peserta/".$noKartu;
 		$data = $this->api($url, 'GET');
 		return $data;
 	}
 	 /*
    |--------------------------------------------------------------------------
    | Rujukan Berdasarkan Nomor Kartu (Multi Record) Rumahsakit
    |--------------------------------------------------------------------------
    */
     public function getRujukanNoKartuMultiRS($noKartu){

 		$url = config('app.baseUrl').config('app.serviceName')."Rujukan/RS/Peserta/".$noKartu;
 		$data = $this->api($url, 'GET');
 		return $data;
 	}


 	 /*
    ===========================================================================
    ========================  Pembuatan Rujukan ===============================
    ===========================================================================
    */


     /*
    |--------------------------------------------------------------------------
    | Insert Rujukan
    |--------------------------------------------------------------------------
    */

 	public function insertRujukan($noSep, $tglRujukan, $ppkPelayanan, $jnsPelayanan, $catatan, $diagRujukan, $tipeRujukan,
 		$poliRujukan, $user)
 	{	
 		$data =   [
		       "request"=> [
		          "t_rujukan"=> [
		             "noSep"=> $noSep,
		             "tglRujukan"=> $tglRujukan,
		             "ppkDirujuk"=> $ppkPelayanan,
		             "jnsPelayanan"=> $jnsPelayanan,
		             "catatan"=> $catatan,
		             "diagRujukan"=> $diagRujukan,
		             "tipeRujukan"=> $tipeRujukan,
		             "poliRujukan"=> $poliRujukan,
		             "user"=> $user
		          ]
		       ]
		    ];                    
                                 
        $data = json_encode($data);

 		$url = config('app.baseUrl').config('app.serviceName')."Rujukan/insert";
 		
 		$data = $this->api($url, 'POST', $data);
 		return $data;
 	}

 	/*
    |--------------------------------------------------------------------------
    | Update Rujukan
    |--------------------------------------------------------------------------
    */ 
 	public function upadateRujukan($noRujukan, $ppkDirujuk, $tipe, $jnsPelayanan, $catatan, $diagRujukan, $tipeRujukan, 
 		$poliRujukan, $user)
 	{	
		 $data =    [
		       "request"=> [
		          "t_rujukan"=> [
		             "noRujukan"=> $noRujukan,
		             "ppkDirujuk"=> $ppkDirujuk,
		             "tipe"=> $tipe,
		             "jnsPelayanan"=> $jnsPelayanan,
		             "catatan"=> $catatan,
		             "diagRujukan"=> $diagRujukan,
		             "tipeRujukan"=> $tipeRujukan,
		             "poliRujukan"=> $poliRujukan,
		             "user"=> $user
		          ]
		       ]
		    ];                    
                                 
        $data = json_encode($data);

 		$url = config('app.baseUrl').config('app.serviceName')."Rujukan/update";
 		
 		$data = $this->api($url, 'PUT', $data);
 		return $data;
 	}
 	/*
    |--------------------------------------------------------------------------
    | Delete Rujukan
    |--------------------------------------------------------------------------
    */ 
 	public function hapusRujukan($noRujukan, $user)
 	{	
	 	$data =  [
	        "request"=> [
	            "t_rujukan"=> [
	                "noRujukan"=> $noRujukan,
	                "user"=> $user
	            ]
	        ]
	    ];             
                                 
        $data = json_encode($data);

 		$url = config('app.baseUrl').config('app.serviceName')."Rujukan/delete";
 		$data = $this->api($url, 'DELETE', $data);
 		return $data;
 	}

 	/*
    |--------------------------------------------------------------------------
    | Lembar Pengajuan Klaim
    |--------------------------------------------------------------------------
	|--------------------------------------------------------------------------
	|--------------------------------------------------------------------------
	|--------------------------------------------------------------------------
    */

	/*
    |--------------------------------------------------------------------------
    | Insert LPK
    |--------------------------------------------------------------------------
    */ 

    public function insertLPK(
    	$noSep, $tglMasuk, $tglKeluar, $jaminan, $poli, $ruangRawat, $kelasRawat, $spesialistik, $caraKeluar,
    	$kondisiPulang, $kodeDiag1, $level1, $kodeDiag2, $level2, $kodePro1, $kodePro2, $tindakLanjut, $kodePPK, $tglKontrol, 
    	$DPJP, $user)
 	{	
	 	$data =   [
		       "request"=> [
		          "t_lpk"=> [
		             "noSep"=> $noSep,
		             "tglMasuk"=> $tglMasuk,
		             "tglKeluar"=> $tglKeluar,
		             "jaminan"=> $jaminan,
		             "poli"=> [
		                "poli"=> $poli
		             ],
		             "perawatan"=> [
		                "ruangRawat"=> $ruangRawat,
		                "kelasRawat"=> $kelasRawat,
		                "spesialistik"=> $spesialistik,
		                "caraKeluar"=> $caraKeluar,
		                "kondisiPulang"=> $kondisiPulang
		             ],
		             "diagnosa"=> [
		                [
		                   "kode"=> $kodeDiag1,
		                   "level"=> $level1
		                ],
		                [
		                   "kode"=> $kodeDiag2,
		                   "level"=> $level2
		                ]
		             ],
		             "procedure"=> [
		                [
		                   "kode"=> $kodePro1
		                ],
		                [
		                   "kode"=> $kodePro2
		                ]
		             ],
		             "rencanaTL"=> [
		                "tindakLanjut"=> $tindakLanjut,
		                "dirujukKe"=> [
		                   "kodePPK"=> $kodePPK
		                ],
		                "kontrolKembali"=> [
		                   "tglKontrol"=> $tglKontrol,
		                   "poli"=> $poli
		                ]
		             ],
		             "DPJP"=> $DPJP,
		             "user"=> $user
		          ]
		       ]
		    ];             
                                 
        $data = json_encode($data);

 		$url = config('app.baseUrl').config('app.serviceName')."LPK/insert";
 		
 		$data = $this->api($url, 'POST', $data);
 		return $data;
 	}
 	/*
    |--------------------------------------------------------------------------
    | Update LPK
    |--------------------------------------------------------------------------
    */ 
 	public function updateLPK(
 		$noSep, $tglMasuk, $tglKeluar, $jaminan, $poli, $ruangRawat, $kelasRawat, $spesialistik, $caraKeluar,
 		$kondisiPulang, $kodeDiag1, $level1, $kodeDiag2, $level2, $kodePro1, $kodePro2, $tindakLanjut, $kodePPK, $tglKontrol,
 		$DPJP, $user)
 	{	
	 	$data =    [
		       "request"=> [
		          "t_lpk"=> [
		             "noSep"=> $noSep,
		             "tglMasuk"=> $tglMasuk,
		             "tglKeluar"=> $tglKeluar,
		             "jaminan"=> $jaminan,
		             "poli"=> [
		                "poli"=> $poli
		             ],
		             "perawatan"=> [
		                "ruangRawat"=> $ruangRawat,
		                "kelasRawat"=> $kelasRawat,
		                "spesialistik"=> $spesialistik,
		                "caraKeluar"=> $caraKeluar,
		                "kondisiPulang"=> $kondisiPulang
		             ],
		             "diagnosa"=> [
		                [
		                   "kode"=> $kodeDiag1,
		                   "level"=> $level1
		                ],
		                [
		                   "kode"=> $kodeDiag2,
		                   "level"=> $level2
		                ]
		             ],
		             "procedure"=> [
		                [
		                   "kode"=> $kodePro1
		                ],
		                [
		                   "kode"=> $kodePro2
		                ]
		             ],
		             "rencanaTL"=> [
		                "tindakLanjut"=> $tindakLanjut,
		                "dirujukKe"=> [
		                   "kodePPK"=> $kodePPK
		                ],
		                "kontrolKembali"=> [
		                   "tglKontrol"=> $tglKontrol,
		                   "poli"=> $poli
		                ]
		             ],
		             "DPJP"=> $DPJP,
		             "user"=> $user
		          ]
		       ]
		    ];             
                                 
        $data = json_encode($data);

 		$url = config('app.baseUrl').config('app.serviceName')."LPK/insert";
 		
 		$data = $this->api($url, 'PUT', $data);
 		return $data;
 	}
 	/*
    |--------------------------------------------------------------------------
    | Delete LPK
    |--------------------------------------------------------------------------
    */ 
 	public function hapusLPK($noSep)
 	{	
 		$data = [
		       "request"=> [
		          "t_lpk"=> [
		             "noSep"=> $noSep            
		          ]
		       ]
		    ];             
                                 
        $data = json_encode($data);

 		$url = config('app.baseUrl').config('app.serviceName')."LPK/delete";
 		
 		$data = $this->api($url, 'DELETE', $data);
 		return $data;
 	}
 	/*
    |--------------------------------------------------------------------------
    | Data Lembar Pengajuan Klaim
    |--------------------------------------------------------------------------
    */ 
 	 public function getLPK($tglMasuk, $jnsPelayanan){

 		$url = config('app.baseUrl').config('app.serviceName')."LPK/TglMasuk/".$tglMasuk."/JnsPelayanan/".$jnsPelayanan;
 		$data = $this->api($url, 'GET');
 		return $data;
 	}

 	/*
    |--------------------------------------------------------------------------
    | Monitoring
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Data Kunjungan
    |--------------------------------------------------------------------------
    */ 
     public function getDataKunjungan($tglSep, $jnsPelayanan){

 		$url = config('app.baseUrl').config('app.serviceName')."Monitoring/Kunjungan/Tanggal/".$tglSEP."/JnsPelayanan/".$jnsPelayanan;
 		$data = $this->api($url, 'GET');;
 		return $data;
 	}
 	  /*
    |--------------------------------------------------------------------------
    | Data Klaim
    |--------------------------------------------------------------------------
    */ 
 	public function getDataKlaim($tglPulang, $jnsPelayanan, $statusKlaim){

 		$url = config('app.baseUrl').config('app.serviceName')."/Monitoring/Klaim/Tanggal/".$tglPulang."/JnsPelayanan/".$jnsPelayanan."/Status/".$statusKlaim;
 		$data = $this->api($url, 'GET');
 		return $data;
 	}
 	 /*
    |--------------------------------------------------------------------------
    | Data Histori Pelayanan Peserta
    |--------------------------------------------------------------------------
    */ 
 	public function getDataHistoriPelayanan($noKartu, $tglMulai, $tglAkhir){

 		$url = config('app.baseUrl').config('app.serviceName')."/monitoring/HistoriPelayanan/NoKartu/".$noKartu."/tglMulai/".$tglMulai."/tglAkhir/".$tglAkhir;
 		$data = $this->api($url, 'GET');
 		return $data;
 	}
 	 /*
    |--------------------------------------------------------------------------
    |Data Klaim Jaminan Jasa Raharja
    |--------------------------------------------------------------------------
    */ 
 	public function getDataKlaimJaminanJasaRaharja($tglMulai, $tglAkhir){

 		$url = config('app.baseUrl').config('app.serviceName')."monitoring/JasaRaharja/tglMulai/".$tglMulai."/tglAkhir/".$tglAkhir;
 		$data = $this->api($url, 'GET');
 		return $data;
 	}

 	/*
    |--------------------------------------------------------------------------
    | Ketersedian Kamar
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    */
     /*
    |--------------------------------------------------------------------------
    |	Referensi Kamar
    |--------------------------------------------------------------------------
    */ 
    public function getReferensiKamar(){

 		$url = config('app.baseUrl').config('app.serviceName')."aplicaresws/rest/ref/kelas";
 		$data = $this->api($url, 'GET');
 		return $data;
 	}
 	/*
    |--------------------------------------------------------------------------
    |	Update Ketersediaan Tempat Tidur
    |--------------------------------------------------------------------------
    */ 
 	public function updateRestBed($kodePPK, $kodekelas, $koderuang, $namaruang, $kapasitas, $tersedia, $tersediapria, $tersediawanita, $tersediapriawanita)
 	{	
 		$data =  [
		    "kodekelas"=>$kodekelas, 
		    "koderuang"=>$koderuang, 
		    "namaruang"=>$namaruang, 
		    "kapasitas"=>$kapasitas, 
		    "tersedia"=>$tersedia,
		    "tersediapria"=>$tersediapria, 
		    "tersediawanita"=>$tersediawanita, 
		    "tersediapriawanita"=>$tersediapriawanita
		   ];             
                                 
        $data = json_encode($data);

 		$url = config('app.baseUrl').config('app.serviceName')."aplicaresws/rest/bed/update/".$kodePPK;
 		
 		$data = $this->api($url, 'POST', $data);
 		return $data;
 	}
 	/*
    |--------------------------------------------------------------------------
    |	Ruangan Baru
    |--------------------------------------------------------------------------
    */ 
 	public function createRestBed($kodePPK, $kodekelas, $koderuang, $namaruang, $kapasitas, $tersedia, $tersediapria, $tersediawanita, $tersediapriawanita )
 	{	
 		$data =   [ 
 			"kodekelas"=>$kodekelas, 
		    "koderuang"=>$koderuang, 
		    "namaruang"=>$namaruang, 
		    "kapasitas"=>$kapasitas, 
		    "tersedia"=>$tersedia,
		     "tersediapria"=>$tersediapria, 
		    "tersediawanita"=>$tersediawanita, 
		    "tersediapriawanita"=>$tersediapriawanita
		   ];             
                                 
        $data = json_encode($data);

 		$url = config('app.baseUrl').config('app.serviceName')."rest/bed/create/".$kodePPK;
 		
 		$data = $this->api($url, 'POST', $data);
 		return $data;
 	}
 	/*
    |--------------------------------------------------------------------------
    |	Ketersediaan Kamar RS
    |--------------------------------------------------------------------------
    */ 
 	public function readRestBed($kodePPK, $start, $limit){

 		$url = config('app.baseUrl').config('app.serviceName')."/rest/bed/read/".$kodePPK."/".$start."/".$limit;
 		$data = $this->api($url, 'GET');
 		return $data;
 	}
 	/*
    |--------------------------------------------------------------------------
    |	Hapus Ruangan
    |--------------------------------------------------------------------------
    */ 
 	public function deleteRestBed($kodePPK, $kodekelas, $koderuang)
 	{	
 		$data =   [ "kodekelas"=>$kodekelas, 
				    "koderuang"=>$koderuang
				  ];             
                                 
        $data = json_encode($data);

 		$url = config('app.baseUrl').config('app.serviceName')."aplicaresws/rest/bed/delete/".$kodePPK;
 		
 		$data = $this->api($url, 'POST', $data);
 		return $data;
 	}
}