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

	 /*
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
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
 		return $data;
 	}
 	/*
    |--------------------------------------------------------------------------
    | Poli
    |--------------------------------------------------------------------------
    */
 	 public function poli($poli){

 		$url = config('app.baseUrl').config('app.serviceName')."referensi/poli/".$poli;
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
 		return $data;
 	}
 	/*
    |--------------------------------------------------------------------------
    | Faskes
    |--------------------------------------------------------------------------
    */
 	 public function faskes($faskes, $jnsFaskes){

 		$url = config('app.baseUrl').config('app.serviceName')."referensi/faskes/".$faskes."/".$jnsFaskes;
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
 		return $data;
 	}
 	/*
    |--------------------------------------------------------------------------
    | Dokter DPJP
    |--------------------------------------------------------------------------
    */
 	public function dokterDPJP($jnsPelayanan, $tglSep, $kdSpesialis){

 		$url = config('app.baseUrl').config('app.serviceName')."referensi/dokter/pelayanan/".$jnsPelayanan."/tglPelayanan/".$tglSep."/Spesialis/".$kdSpesialis;
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
 		return $data;
 	}
 	/*
    |--------------------------------------------------------------------------
    | Provinsi
    |--------------------------------------------------------------------------
    */
 	public function provinsi(){

 		$url = config('app.baseUrl').config('app.serviceName')."referensi/propinsi";
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
 		return $data;
 	}
 	/*
    |--------------------------------------------------------------------------
    | Kabupaten
    |--------------------------------------------------------------------------
    */
 	public function kabupaten($kdPropinsi){

 		$url = config('app.baseUrl').config('app.serviceName')."referensi/kabupaten/propinsi/".$kdPropinsi;
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
 		return $data;
 	}
 	/*
    |--------------------------------------------------------------------------
    | Kecamatan
    |--------------------------------------------------------------------------
    */
 	public function kecamatan($kdKabupaten){

 		$url = config('app.baseUrl').config('app.serviceName')."referensi/kecamatan/kabupaten/".$kdKabupaten;
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
 		return $data;
 	}
 	/*
    |--------------------------------------------------------------------------
    | Procedure / Tindakan (Hanya Untuk Lembar Pengajuan Klaim)
    |--------------------------------------------------------------------------
    */
 	public function prosedur($kdProsedur){

 		$url = config('app.baseUrl').config('app.serviceName')."referensi/procedure/".$kdProsedur;
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
 		return $data;
 	}

 	/*
    |--------------------------------------------------------------------------
    | Kelas Rawat (Hanya Untuk Lembar Pengajuan Klaim)
    |--------------------------------------------------------------------------
    */
 	public function kelasRawat(){

 		$url = config('app.baseUrl').config('app.serviceName')."referensi/kelasrawat";
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
 		return $data;
 	}
 	/*
    |--------------------------------------------------------------------------
    | Dokter (Hanya Untuk Lembar Pengajuan Klaim))
    |--------------------------------------------------------------------------
    */
 	public function dokter($dokter){

 		$url = config('app.baseUrl').config('app.serviceName')."referensi/dokter/".$dokter;
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
 		return $data;
 	}
 	/*
    |--------------------------------------------------------------------------
    | Spesialistik (Hanya Untuk Lembar Pengajuan Klaim)
    |--------------------------------------------------------------------------
    */
 	public function spesialistik(){

 		$url = config('app.baseUrl').config('app.serviceName')."referensi/spesialistik";
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
 		return $data;
 	}
 	/*
    |--------------------------------------------------------------------------
    | Ruang Rawat (Hanya Untuk Lembar Pengajuan Klaim)
    |--------------------------------------------------------------------------
    */
 	public function ruangRawat(){

 		$url = config('app.baseUrl').config('app.serviceName')."referensi/ruangrawat";
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
 		return $data;
 	}
 	/*
    |--------------------------------------------------------------------------
    | Cara Keluar (Hanya Untuk Lembar Pengajuan Klaim)
    |--------------------------------------------------------------------------
    */
 	public function caraKeluar(){

 		$url = config('app.baseUrl').config('app.serviceName')."referensi/carakeluar";
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
 		return $data;
 	}
 	/*
    |--------------------------------------------------------------------------
    | Pasca Pulang (Hanya Untuk Lembar Pengajuan Klaim)
    |--------------------------------------------------------------------------
    */
 	public function pascaPulang(){

 		$url = config('app.baseUrl').config('app.serviceName')."referensi/pascapulang";
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
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
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
 		return $data;
 	}
 	 /*
    |--------------------------------------------------------------------------
    | NIK
    |--------------------------------------------------------------------------
    */
 	public function getPesertaNik($nik, $tglSep){

 		$url = config('app.baseUrl').config('app.serviceName')."Peserta/nik/".$nik."/tglSEP/".$tglSep;
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
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
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount(),
 			'body' => $data
 			]);

 		$response = $client->request('POST',$url);
 		$data = $response->getBody();
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
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount(),
 			'body' => $data
 			]);

 		$response = $client->request('PUT',$url);
 		$data = $response->getBody();
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
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount(),
 			'body' => $data
 			]);

 		$response = $client->request('DELETE',$url);
 		$data = $response->getBody();
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
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount(),
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
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
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
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
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount(),
 			'body' => $data
 			]);

 		$response = $client->request('POST',$url);
 		$data = $response->getBody();
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
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount(),
 			'body' => $data
 			]);

 		$response = $client->request('POST',$url);
 		$data = $response->getBody();
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
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount(),
 			'body' => $data
 			]);

 		$response = $client->request('PUT',$url);
 		$data = $response->getBody();
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
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
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
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
 		return $data;
 	}
 	 /*
    |--------------------------------------------------------------------------
    | Rujukan Berdasarkan Nomor Kartu (1 Record) Pcare
    |--------------------------------------------------------------------------
    */
 	 public function getRujukanNoKartuSinglePcare($noKartu){

 		$url = config('app.baseUrl').config('app.serviceName')."Rujukan/Peserta/".$noKartu;
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
 		return $data;
 	}
 	 /*
    |--------------------------------------------------------------------------
    | Rujukan Berdasarkan Nomor Kartu (Multi Record) Pcare
    |--------------------------------------------------------------------------
    */
     public function getRujukanNoKartuMultiPcare($noKartu){

 		$url = config('app.baseUrl').config('app.serviceName')."Rujukan/List/Peserta/".$noKartu;
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
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
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
 		return $data;
 	}
 	 /*
    |--------------------------------------------------------------------------
    | Rujukan Berdasarkan Nomor Kartu (1 Record) Rumahsakit
    |--------------------------------------------------------------------------
    */
 	 public function getRujukanNoKartuSingleRS($noKartu){

 		$url = config('app.baseUrl').config('app.serviceName')."/Rujukan/RS/Peserta/".$noKartu;
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
 		return $data;
 	}
 	 /*
    |--------------------------------------------------------------------------
    | Rujukan Berdasarkan Nomor Kartu (Multi Record) Rumahsakit
    |--------------------------------------------------------------------------
    */
     public function getRujukanNoKartuMultiRS($noKartu){

 		$url = config('app.baseUrl').config('app.serviceName')."Rujukan/RS/Peserta/".$noKartu;
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
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
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount(),
 			'body' => $data
 			]);

 		$response = $client->request('POST',$url);
 		$data = $response->getBody();
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
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount(),
 			'body' => $data
 			]);

 		$response = $client->request('PUT',$url);
 		$data = $response->getBody();
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
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount(),
 			'body' => $data
 			]);

 		$response = $client->request('DELETE',$url);
 		$data = $response->getBody();
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
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount(),
 			'body' => $data
 			]);

 		$response = $client->request('POST',$url);
 		$data = $response->getBody();
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
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount(),
 			'body' => $data
 			]);

 		$response = $client->request('PUT',$url);
 		$data = $response->getBody();
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
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount(),
 			'body' => $data
 			]);

 		$response = $client->request('DELETE',$url);
 		$data = $response->getBody();
 		return $data;
 	}
 	/*
    |--------------------------------------------------------------------------
    | Data Lembar Pengajuan Klaim
    |--------------------------------------------------------------------------
    */ 
 	 public function getLPK($tglMasuk, $jnsPelayanan){

 		$url = config('app.baseUrl').config('app.serviceName')."LPK/TglMasuk/".$tglMasuk."/JnsPelayanan/".$jnsPelayanan;
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
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
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
 		return $data;
 	}
 	  /*
    |--------------------------------------------------------------------------
    | Data Klaim
    |--------------------------------------------------------------------------
    */ 
 	public function getDataKlaim($tglPulang, $jnsPelayanan, $statusKlaim){

 		$url = config('app.baseUrl').config('app.serviceName')."/Monitoring/Klaim/Tanggal/".$tglPulang."/JnsPelayanan/".$jnsPelayanan."/Status/".$statusKlaim;
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
 		return $data;
 	}
 	 /*
    |--------------------------------------------------------------------------
    | Data Histori Pelayanan Peserta
    |--------------------------------------------------------------------------
    */ 
 	public function getDataHistoriPelayanan($noKartu, $tglMulai, $tglAkhir){

 		$url = config('app.baseUrl').config('app.serviceName')."/monitoring/HistoriPelayanan/NoKartu/".$noKartu."/tglMulai/".$tglMulai."/tglAkhir/".$tglAkhir;
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
 		return $data;
 	}
 	 /*
    |--------------------------------------------------------------------------
    |Data Klaim Jaminan Jasa Raharja
    |--------------------------------------------------------------------------
    */ 
 	public function getDataKlaimJaminanJasaRaharja($tglMulai, $tglAkhir){

 		$url = config('app.baseUrl').config('app.serviceName')."monitoring/JasaRaharja/tglMulai/".$tglMulai."/tglAkhir/".$tglAkhir;
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
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
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
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
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount(),
 			'body' => $data
 			]);

 		$response = $client->request('POST',$url);
 		$data = $response->getBody();
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
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount(),
 			'body' => $data
 			]);

 		$response = $client->request('POST',$url);
 		$data = $response->getBody();
 		return $data;
 	}
 	/*
    |--------------------------------------------------------------------------
    |	Ketersediaan Kamar RS
    |--------------------------------------------------------------------------
    */ 
 	public function readRestBed($kodePPK, $start, $limit){

 		$url = config('app.baseUrl').config('app.serviceName')."/rest/bed/read/".$kodePPK."/".$start."/".$limit;
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
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
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount(),
 			'body' => $data
 			]);

 		$response = $client->request('POST',$url);
 		$data = $response->getBody();
 		return $data;
 	}
}