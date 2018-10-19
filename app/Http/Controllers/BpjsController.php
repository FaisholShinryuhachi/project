<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\Bpjs;

class BpjsController extends Controller

{	public function index(){
	    $coba = new Bpjs();

	    //echo $coba->diagnosa("A04");
	    //echo $coba->poli("INT");
	    //echo $coba->faskes("00161001", 1);
	    //echo $coba->dokterDPJP(1, "2018-01-01", "31486");
	    //echo $coba->provinsi();
	   	//echo $coba->kabupaten('13');
	    //echo $coba->kecamatan('0177');
	    //echo $coba->prosedur("21.05");
	    //echo $coba->kelasRawat();
	    //echo $coba->dokter("agus");
	    //echo $coba->spesialistik();
	    //echo $coba->ruangRawat();
	    //echo $coba->caraKeluar();
	    //echo $coba->pascaPulang();

	    //echo $coba->getPesertaNoBpjs($noBpjs, $tglSep);
	    //echo $coba->getPesertaNik($nik, $tglSep);

	    /*echo $coba->Insert SEP
					public function insertSep(
				 		$noKartu, $tglSep, $ppkPelayanan, $jnsPelayanan, $klsRawat, $noMR,
				 		$asalRujukan, $tglRujukan, $noRujukan, $ppkRujukan, $catatan, $diagAwal, $tujuan, $eksekutif, $cob,
				 		$katarak, $lakaLantas, $penjamin, $tglKejadian, $keterangan, $suplesi, $noSepSuplesi, $kdPropinsi,
				 		$kdKabupaten, $kdKecamatan, $noSurat, $kodeDPJP, $noTelp, $user);
		*/
		/*echo $coba->updateSep(
				 		$noSep, $klsRawat, $noMR, $catatan, $diagAwal, $eksekutif, $cob, $katarak,
				 		$noSurat, $kodeDPJP, $lakaLantas, $penjamin, $tglKejadian, $keterangan, $suplesi, $noSepSuplesi,
				 		$kdPropinsi, $kdKabupaten, $kdKecamatan); */

		//echo $coba->hapusSep($noSep, $user);
		//echo $coba->cariSep($noSep);

		//echo $coba->getSuplesiJasaRaharja($noKartu, $tglSep);
		//echo $coba->pengajuan(
			    	$noKartu, $tglSep, $jnsPelayanan, $keterangan, $user);
		//echo $coba->aprovalPengajuan(
			    	$noKartu, $tglSep, $jnsPelayanan, $keterangan, $user);
		//echo $coba->updateTanggalPulang($noSep, $tglPulang, $ppkPelayanan)

	    /*
	    echo $coba->insertSep("0001112230666","2017-10-18","0301R001","2","3","123456","1","2017-10-17",
	    	"1234567","00010001","test","A00.1","INT","0","0","0","0","1","2018-08-06","kll","0",
	    	"0301R0010718V000001","03","0050","0574","000002","31661","081919999","Coba Ws");
	    	*/

	    //echo $coba->updateSep();
	    //echo $coba->hapusSep();
	    //echo $coba->cariSep("0301R0011017V000015");
	    //echo $coba->getSuplesiJasaRaharja("0301R0110818V000008", "2018-08-08");
	   	//echo $coba->pengajuan();
	   	//echo $coba->aprovalPengajuan();
	   	//echo $coba->updateTanggalPulang();
	   	//echo $coba->interCBG("0000001112958");
	   	//echo $coba->diagnosa("Influenza");
	   	//echo $coba->poli("ICU");
	   	//echo $coba->faskes("00161001", "1. Faskes 1");
	}
}
