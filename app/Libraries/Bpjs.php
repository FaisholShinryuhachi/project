<?php

namespace App\Libraries;


use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class Bpjs
{	


	/*public function coba(){

	 $data = "17163";
   $secretKey = "4eVEB7D655";
         // Computes the timestamp
          date_default_timezone_set('UTC');
          $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
           // Computes the signature by hashing the salt with the secret key as the key
   $signature = hash_hmac('sha256', $data."&".$tStamp, $secretKey, true);
 
   // base64 encode…
   $encodedSignature = base64_encode($signature);
 
   // urlencode…
   // $encodedSignature = urlencode($encodedSignature);
 
   echo "X-cons-id: " .$data ."</br>";
   echo "X-timestamp:" .$tStamp ."</br>";
   echo "X-signature: " .$encodedSignature;


   $url = "https://dvlp.bpjs-kesehatan.go.id/VClaim-Rest/Peserta/nokartu/0000648275139/tglSEP/2018-10-09";

 		$client = new Client([
 			'headers'=>	[
 						'X-cons-id' => $data,
 						'X-timestamp'=> $tStamp,
 						'X-signature'=>  $encodedSignature
 						]
 			]);
 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
 		return $data;


}*/

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
    | Peserta
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
    | Pembuatan SEP
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
    |--------------------------------------------------------------------------
    | Potensi Suplesi Jasa Raharja
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
    |--------------------------------------------------------------------------
    | Aproval Pengajuan SEP
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
    |--------------------------------------------------------------------------
    | Aproval Pengajuan SEP
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
    | Referensi
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

 	 public function poli($poli){

 		$url = config('app.baseUrl').config('app.serviceName')."referensi/poli/".$poli;
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
 		return $data;
 	}

 	 public function faskes($faskes, $jnsFaskes){

 		$url = config('app.baseUrl').config('app.serviceName')."referensi/faskes/".$faskes."/".$jnsFaskes;
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
 		return $data;
 	}

 	public function dokterDPJP($jnsPelayanan, $tglSep, $kdSpesialis){

 		$url = config('app.baseUrl').config('app.serviceName')."referensi/dokter/pelayanan/".$jnsPelayanan."/tglPelayanan/".$tglSep."/Spesialis/".$kdSpesialis;
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
 		return $data;
 	}

 	public function provinsi(){

 		$url = config('app.baseUrl').config('app.serviceName')."referensi/propinsi";
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
 		return $data;
 	}

 	public function kabupaten($kdPropinsi){

 		$url = config('app.baseUrl').config('app.serviceName')."referensi/kabupaten/propinsi/".$kdPropinsi;
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
 		return $data;
 	}

 	public function kecamatan($kdKabupaten){

 		$url = config('app.baseUrl').config('app.serviceName')."referensi/kecamatan/kabupaten/".$kdKabupaten;
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
 		return $data;
 	}

 	public function prosedur($kdProsedur){

 		$url = config('app.baseUrl').config('app.serviceName')."referensi/procedure/".$kdProsedur;
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
 		return $data;
 	}


 	public function kelasRawat(){

 		$url = config('app.baseUrl').config('app.serviceName')."referensi/kelasrawat";
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
 		return $data;
 	}

 	public function dokter($dokter){

 		$url = config('app.baseUrl').config('app.serviceName')."referensi/dokter/".$dokter;
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
 		return $data;
 	}

 	public function spesialistik(){

 		$url = config('app.baseUrl').config('app.serviceName')."referensi/spesialistik";
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
 		return $data;
 	}

 	public function ruangRawat(){

 		$url = config('app.baseUrl').config('app.serviceName')."referensi/ruangrawat";
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
 		return $data;
 	}

 	public function caraKeluar(){

 		$url = config('app.baseUrl').config('app.serviceName')."referensi/carakeluar";
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
 		return $data;
 	}

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
    | Rujukan
    |--------------------------------------------------------------------------
    */

    public function getRujukanNoRujukan($noRujukan){

 		$url = config('app.baseUrl').config('app.serviceName')."Rujukan/".$noRujukan;
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
 		return $data;
 	}

 	 public function getRujukanNoKartuSingle($noKartu){

 		$url = config('app.baseUrl').config('app.serviceName')."Rujukan/Peserta/".$noKartu;
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
 		return $data;
 	}

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

 	public function getDataKlaim($tglPulang, $jnsPelayanan, $statusKlaim){

 		$url = config('app.baseUrl').config('app.serviceName')."/Monitoring/Klaim/Tanggal/".$tglPulang."/JnsPelayanan/".$jnsPelayanan."/Status/".$statusKlaim;
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
 		return $data;
 	}

 	public function getDataHistoriPelayanan($noKartu, $tglMulai, $tglAkhir){

 		$url = config('app.baseUrl').config('app.serviceName')."/monitoring/HistoriPelayanan/NoKartu/".$noKartu."/tglMulai/".$tglMulai."/tglAkhir/".$tglAkhir;
 		
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
 		return $data;
 	}

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

 	public function readRestBed($kodePPK, $start, $limit){

 		$url = config('app.baseUrl').config('app.serviceName')."/rest/bed/read/".$kodePPK."/".$start."/".$limit;
 		$client = new Client([
 			'headers'=>	$this->headerCount()
 			]);

 		$response = $client->request('GET',$url);
 		$data = $response->getBody();
 		return $data;
 	}

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