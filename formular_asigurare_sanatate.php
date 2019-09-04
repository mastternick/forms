<link rel="stylesheet" href="css/global.css">


<script language="javascript">
    $().ready(function() {



        OwlCarousel.initOwlCarousel();

                jQuery.validator.addMethod("phoneStart0", function(telefon, element) {
                    telefon = telefon.replace(/\s+/g, "");
                    return this.optional(element) || telefon.match(/^0\d{8,}$/);
                }, "Phone number should start with 0");
                jQuery.validator.addMethod("roCNP", function(value, element) {
                    var check = false;
                    var re = /^\d{1}\d{2}(0[1-9]|1[0-2])(0[1-9]|[12]\d|3[01])(0[1-9]|[1-4]\d| 5[0-2]|99)\d{4}$/;
                    if (re.test(value)) {
                        var bigSum = 0,
                            rest = 0,
                            ctrlDigit = 0;
                        var control = '279146358279';
                        for (var i = 0; i < 12; i++) {
                            bigSum += value[i] * control[i];
                        }
                        ctrlDigit = bigSum % 11;
                        if (ctrlDigit == 10) ctrlDigit = 1;
                        if (ctrlDigit != value[12]) return false;
                        else return true;
                    }
                    return false;
                }, "CNP invalid");
                $('#formular_calatorii').validate({
                            highlight: function(element, errorClass) {
                                parent_div = (element.id + "-div");
                                tip_div = (element.id + "-tip");
                                $("#" + tip_div).css("display", "block");
                                $("#" + parent_div).addClass("form_error_el");
                            },
                            unhighlight: function(element, errorClass) {
                                    parent_div = (element.id + "-div");
                                    tip_div = (element.id + "-tip");
                                    $("#" + tip_div).css("display", "none");
                                    $("#" + parent_div).removeClass("form_error_el"); //$("#"+parent_div).addClass("form_out_el");
									},
									rules:
									{
								//	data: {
							//		required: true,
								//	date: true
							//		},
								//	"localitate_livrare": {required: true, minlength: 3},
								//	"judet_livrare": { required: true, minlength: 3},
								//	"strada_livrare": { required: true, minlength: 3},
								//	"nume": { required: true,  minlength: 5 },
									"email": {  required: true, email: true},
									"telefon": {  required: true, minlength: 10,number:true,phoneStart0: true },
									cnp: { required: true, roCNP: true }
									},
									errorPlacement: function(error, element) {$(element).parent('div').addClass('error');}
									});
								});
</script>
<script language="javascript">
     //AFISARE AN NASTERE SI VARSTA DUPA CNP
	// $input   = $('#nrCopii');
	 
		window.onload = function(){
		document.getElementById('cnp').addEventListener("keyup", data_nasterii_asigurat, false);		
		document.getElementById('cnp_copil_1').addEventListener("keyup", f_data_nasterii_copil_1, false);
	//	document.getElementById('cnp_copil_2').addEventListener("keyup", f_data_nasterii_copil_2, false);

		}

		function data_nasterii_asigurat()
        {
				
			var cnp = document.getElementById('cnp').value;
				
				var current_date = new Date($('input[name="current_date"]').val());

                var pre = '';
                if (cnp.substring(0, 1) == '1' || cnp.substring(0, 1) == '2') {
                    
                    pre = '19';
                } else {
                    if (cnp.substring(0, 1) == '5' || cnp.substring(0, 1) == '6') {
                       
                        pre = '20';
                    }
                }

                var an_nastere      = parseInt(pre + cnp.substring(1, 2) + cnp.substring(2, 3));
                var luna_nastere    = cnp.substring(3, 4) + cnp.substring(4, 5);
                var zi_nastere      = cnp.substring(5, 6) + cnp.substring(6, 7);
                var date_of_birth   = new Date(parseInt(an_nastere), parseInt(luna_nastere) - 1, parseInt(zi_nastere), 0, 0, 0, 0);
                var diff            = new Date(current_date.valueOf() - date_of_birth.valueOf());
			//	var varsta_ani 			= diff.getFullYear() - 1970;

				var today = new Date();
				var age = Math.floor((today-date_of_birth) / (365.25 * 24 * 60 * 60 * 1000)); 

				///////////////////////////
				var data_nastere	= zi_nastere + "/" + luna_nastere + "/" + an_nastere;
		
	
		  //aici apare data_nasterii in camp			
			
			$(data_nasterii).val(data_nastere);	
			$(varsta_asigurat_test).val(age);	
			
		if (age < 18)
		{
			$('#hide_show_reprezentant').show( "blind", { direction: "up" },  400  )
		}

		else
		{
			$('#hide_show_reprezentant').hide( "blind", { direction: "up" },  400  )
		}
			
		}   

		/////////////////////////// 1 //////////////////////////
		
		function f_data_nasterii_copil_1()
        {
				
			var cnp_copil_1 = document.getElementById('cnp_copil_1').value;				
			var current_date = new Date($('input[name="current_date"]').val());
            var pre_copil_1 = '';
            if (cnp_copil_1.substring(0, 1) == '1' || cnp_copil_1.substring(0, 1) == '2') {                 
                pre_copil_1 = '19';
                } else {
                    if (cnp_copil_1.substring(0, 1) == '5' || cnp_copil_1.substring(0, 1) == '6') {                    
                        pre_copil_1 = '20';
                    }
                }

            var an_nastere_copil_1      = parseInt(pre_copil_1 + cnp_copil_1.substring(1, 2) + cnp_copil_1.substring(2, 3));
            var luna_nastere_copil_1    = cnp_copil_1.substring(3, 4) + cnp_copil_1.substring(4, 5);
            var zi_nastere_copil_1      = cnp_copil_1.substring(5, 6) + cnp_copil_1.substring(6, 7);
        
			var data_nastere_copil_1	= zi_nastere_copil_1 + "/" + luna_nastere_copil_1 + "/" + an_nastere_copil_1;
          		  
		  //aici apare data_nasterii in camp			
			
			$(data_nasterii_copil_1).val(data_nastere_copil_1);			
		}   
		/////////////////////// 2 ///////////////////////
		
		// function f_data_nasterii_copil_2()
        // {
				
			// var cnp_copil_2 = document.getElementById('cnp_copil_2').value;				
			// var current_date = new Date($('input[name="current_date"]').val());
            // var pre_copil_2 = '';
            // if (cnp_copil_2.substring(0, 1) == '1' || cnp_copil_2.substring(0, 1) == '2') {                 
                // pre_copil_2 = '19';
                // } else {
                    // if (cnp_copil_2.substring(0, 1) == '5' || cnp_copil_2.substring(0, 1) == '6') {                    
                        // pre_copil_2 = '20';
                    // }
                // }

            // var an_nastere_copil_2      = parseInt(pre_copil_2 + cnp_copil_2.substring(1, 2) + cnp_copil_2.substring(2, 3));
            // var luna_nastere_copil_2    = cnp_copil_2.substring(3, 4) + cnp_copil_2.substring(4, 5);
            // var zi_nastere_copil_2      = cnp_copil_2.substring(5, 6) + cnp_copil_2.substring(6, 7);
        
			// var data_nastere_copil_2	= zi_nastere_copil_2 + "/" + luna_nastere_copil_2 + "/" + an_nastere_copil_2;
          		  
		  // //aici apare data_nasterii in camp			
			
			// $(data_nasterii_copil_2).val(data_nastere_copil_2);			
		// }   
		

	  		
	
</script>



<?php

//	$zi_n = $_COOKIE["zi_n"];
//	$luna_n = $_COOKIE["luna_n"];
//	$an_n = $_COOKIE["an_n"];
//	$d_n =  $zi_n."/".$luna_n."/".$an_n; 
	
///////////////////////////////////////////
$notificare 		= "";
$send               = "";
$message_error      = "";
$asigurat_afectiuni_preexistente_text="";
$nume = "";
$prenume = "";
$cnp = "";
//$data_nasterii="";
$judet_asigurat     = "";
$localitate_asigurat = $strada_asigurat = $nr_strada_asigurat = $bloc_asigurat = $scara_asigurat = $etaj_adresa_asigurat = $apartament_asigurat = $cod_postal_asigurat = "";
$telefon_asigurat = $email_asigurat = "";

$tara_corespondenta_asigurat = $judet_corespondenta_asigurat = $localitate_corespondenta_asigurat = $strada = $nr_strada = $bloc = $scara = $etaj_adresa = $apartament = $cod_postal ="";
///////////////----go
$ocupatie_asigurat = "";

//$cui_contractant = $cnp_contractant = ""; // trebuie doar unu si schimbam textul sau lasam ambele si ascundem unu tot cu camp
$nume_contractant = $prenume_contractant = "";
$tara_contaractant = $judet_contaractant = $localitate_contaractant = $strada_contaractant = "";
$nr_strada_contaractant = $bloc_contaractant = $scara_contaractant = $etaj_adresa_contaractant = "";
$apartament_contaractant = $cod_postal_contaractant = $telefon_contaractant = $email_contaractant = "";

$nume_reprezentant = $prenume_reprezentant = $cnp_reprezentant = "";

////////////////////////

$perioada_de_asigurare = "";
$frecventa_plata = "";
$moneda = "";

$data_valabilitate_start = "";
/////////////////////////
$varsta_asigurat_test = "";

////////////
$acoperire_de_baza = "";
//$clauza_spitalizare = "";

////////////
$text_nr = count($_POST["flajok"]);

		for($i=1; $i<=$text_nr; $i++){

$nume_copil[$i] = "";
$prenume_copil[$i] = "";
$cnp_copil[$i] = "";
$data_nasterii_copil[$i] = "";
	}

////////
$nr_tigari ="";

////

////////////////////////$nr_copii_inclusi = "";



if (verifyFormToken('formular_calatorii')) {
    if (isset($_POST['send_data'])) {

		// POST

/////////////////////////////////////////////

$text_nr = count($_POST["flajok"]);


		for($i=1; $i<=$text_nr; $i++){

				//copii inclusi
$nume_copil[$i]=stripcleantohtml($_POST['nume_copil_'.$i]);
$prenume_copil[$i]=stripcleantohtml($_POST['prenume_copil_'.$i]);
$cnp_copil[$i]=stripcleantohtml($_POST['cnp_copil_'.$i]);
$data_nasterii_copil[$i]=stripcleantohtml($_POST['data_nasterii_copil_'.$i]);




				////////////////////////////


//1//
if ($_POST['copii_defect_congenital_'.$i]=="copii_defect_congenital_da_".$i) $copii_defect_congenital_[$i]="DA"; else $copii_defect_congenital_[$i]="NU";
//2////
if ($_POST['copii_insuficienta_respiratorie_'.$i]=="copii_insuficienta_respiratorie_da_".$i) $copii_insuficienta_respiratorie_[$i]="DA"; else $copii_insuficienta_respiratorie_[$i]="NU";
//3////
if ($_POST['copii_afectiuni_digestive_'.$i]=="copii_afectiuni_digestive_da_".$i) $copii_afectiuni_digestive_[$i]="DA"; else $copii_afectiuni_digestive_[$i]="NU";

if ($_POST['copii_ciroza_hepatica_'.$i]=="copii_ciroza_hepatica_da_".$i) $copii_ciroza_hepatica_[$i]="DA"; else $copii_ciroza_hepatica_[$i]="NU";

if ($_POST['copii_atrezie_esofagiana_'.$i]=="copii_atrezie_esofagiana_da_".$i) $copii_atrezie_esofagiana_[$i]="DA"; else $copii_atrezie_esofagiana_[$i]="NU";

if ($_POST['copii_atrezie_intestinala_'.$i]=="copii_atrezie_intestinala_da_".$i) $copii_atrezie_intestinala_[$i]="DA"; else $copii_atrezie_intestinala_[$i]="NU";

if ($_POST['copii_megacolon_congenital_'.$i]=="copii_megacolon_congenital_da_".$i) $copii_megacolon_congenital_[$i]="DA"; else $copii_megacolon_congenital_[$i]="NU";

//4////
if ($_POST['copii_boli_metabolice_'.$i]=="copii_boli_metabolice_da_".$i) $copii_boli_metabolice_[$i]="DA"; else $copii_boli_metabolice_[$i]="NU";

//5///
if ($_POST['copii_afectiuni_ereditale_'.$i]=="copii_afectiuni_ereditale_da_".$i) $copii_afectiuni_ereditale_[$i]="DA"; else $copii_afectiuni_ereditale_[$i]="NU";

//////////////////-------------//
if ($_POST['copii_fibroza_chistica_'.$i]=="copii_fibroza_chistica_da_".$i) $copii_fibroza_chistica_[$i]="DA"; else $copii_fibroza_chistica_[$i]="NU";

if ($_POST['copii_sidromul_down_'.$i]=="copii_sidromul_down_da_".$i) $copii_sidromul_down_[$i]="DA"; else $copii_sidromul_down_[$i]="NU";
//-------------//////////////////

//6/////////////////
if ($_POST['copii_afectiuni_hematologice_'.$i]=="copii_afectiuni_hematologice_da_".$i) $copii_afectiuni_hematologice_[$i]="DA"; else $copii_afectiuni_hematologice_[$i]="NU";

//////////////////-------------//
if ($_POST['copii_hernofilie_'.$i]=="copii_hernofilie_da_".$i) $copii_hernofilie_[$i]="DA"; else $copii_hernofilie_[$i]="NU";

if ($_POST['copii_leucemie_'.$i]=="copii_leucemie_da_".$i) $copii_leucemie_[$i]="DA"; else $copii_leucemie_[$i]="NU";
//-----------------////////////////

//7/////////
if ($_POST['copii_afectiuni_tumori_'.$i]=="copii_afectiuni_tumori_da_".$i) $copii_afectiuni_tumori_[$i]="DA"; else $copii_afectiuni_tumori_[$i]="NU";

//////////////////-------------//
if ($_POST['copii_limfom_non_holdgkin_'.$i]=="copii_limfom_non_holdgkin_da_".$i) $copii_limfom_non_holdgkin_[$i]="DA"; else $copii_limfom_non_holdgkin_[$i]="NU";

if ($_POST['copii_boala_holdgkin_'.$i]=="copii_boala_holdgkin_da_".$i) $copii_boala_holdgkin_[$i]="DA"; else $copii_boala_holdgkin_[$i]="NU";

if ($_POST['copii_tumori_maligne_'.$i]=="copii_tumori_maligne_da_".$i) $copii_tumori_maligne_[$i]="DA"; else $copii_tumori_maligne_[$i]="NU";
//-----------------////////////////

//8///////////////
if ($_POST['copii_afectiuni_infectioase_'.$i]=="copii_afectiuni_infectioase_da_".$i) $copii_afectiuni_infectioase_[$i]="DA"; else $copii_afectiuni_infectioase_[$i]="NU";

//////////////////-------------//
if ($_POST['copii_hiv_sida_'.$i]=="copii_hiv_sida_da_".$i) $copii_hiv_sida_[$i]="DA"; else $copii_hiv_sida_[$i]="NU";

if ($_POST['copii_tuberculoza_activa_'.$i]=="copii_tuberculoza_activa_da_".$i) $copii_tuberculoza_activa_[$i]="DA"; else $copii_tuberculoza_activa_[$i]="NU";

//-----------------////////////////
//9///////////////
if ($_POST['copii_afectiuni_neurologice_'.$i]=="copii_afectiuni_neurologice_da_".$i) $copii_afectiuni_neurologice_[$i]="DA"; else $copii_afectiuni_neurologice_[$i]="NU";

//////////////////-------------//
if ($_POST['copii_ecefalopatie_cronica_infantila_'.$i]=="copii_ecefalopatie_cronica_infantila_da_".$i) $copii_ecefalopatie_cronica_infantila_[$i]="DA"; else $copii_ecefalopatie_cronica_infantila_[$i]="NU";

if ($_POST['copii_tetrapareza_'.$i]=="copii_tetrapareza_da_".$i) $copii_tetrapareza_[$i]="DA"; else $copii_tetrapareza_[$i]="NU";

if ($_POST['copii_epilepsie_'.$i]=="copii_epilepsie_da_".$i) $copii_epilepsie_[$i]="DA"; else $copii_epilepsie_[$i]="NU";
//-----------------////////////////

//10///////////////////
if ($_POST['copii_afectiuni_osteoarticulare_'.$i]=="copii_afectiuni_osteoarticulare_da_".$i) $copii_afectiuni_osteoarticulare_[$i]="DA"; else $copii_afectiuni_osteoarticulare_[$i]="NU";

//////////////////-------------//
if ($_POST['copii_artrita_reumatoida_juvenila_'.$i]=="copii_artrita_reumatoida_juvenila_da_".$i) $copii_artrita_reumatoida_juvenila_[$i]="DA"; else $copii_artrita_reumatoida_juvenila_[$i]="NU";

if ($_POST['copii_boala_lobstein_'.$i]=="copii_boala_lobstein_da_".$i) $copii_boala_lobstein_[$i]="DA"; else $copii_boala_lobstein_[$i]="NU";
//-----------------////////////////

//11///////////////
if ($_POST['copii_afectiuni_renale_'.$i]=="copii_afectiuni_renale_da_".$i) $copii_afectiuni_renale_[$i]="DA"; else $copii_afectiuni_renale_[$i]="NU";

////////////////////////////////



		}




/////////////////////////////////////////////
$strada=stripcleantohtml($_POST['strada']);
$nume=stripcleantohtml($_POST['nume']);
$prenume=stripcleantohtml($_POST['prenume']);
$cnp=stripcleantohtml($_POST['cnp']);
$data_nasterii=stripcleantohtml($_POST['data_nasterii']);
$judet_asigurat=stripcleantohtml($_POST['judet_asigurat']);
$localitate_asigurat=stripcleantohtml($_POST['localitate_asigurat']);
$strada_asigurat=stripcleantohtml($_POST['strada_asigurat']);
$nr_strada_asigurat=stripcleantohtml($_POST['nr_strada_asigurat']);
$bloc_asigurat=stripcleantohtml($_POST['bloc_asigurat']);
$scara_asigurat=stripcleantohtml($_POST['scara_asigurat']);
$etaj_adresa_asigurat=stripcleantohtml($_POST['etaj_adresa_asigurat']);
$apartament_asigurat=stripcleantohtml($_POST['apartament_asigurat']);
$cod_postal_asigurat=stripcleantohtml($_POST['cod_postal_asigurat']);
$telefon_asigurat=stripcleantohtml($_POST['telefon_asigurat']);
$email_asigurat=stripcleantohtml($_POST['email_asigurat']);
$tara_corespondenta_asigurat=stripcleantohtml($_POST['tara_corespondenta_asigurat']);
$judet_corespondenta_asigurat=stripcleantohtml($_POST['judet_corespondenta_asigurat']);
$localitate_corespondenta_asigurat=stripcleantohtml($_POST['localitate_corespondenta_asigurat']);
$nr_strada=stripcleantohtml($_POST['nr_strada']);
$bloc=stripcleantohtml($_POST['bloc']);
$scara=stripcleantohtml($_POST['scara']);
$etaj_adresa=stripcleantohtml($_POST['etaj_adresa']);
$apartament=stripcleantohtml($_POST['apartament']);
$cod_postal=stripcleantohtml($_POST['cod_postal']);
//////////--end adresa corespondenta
$ocupatie_asigurat=stripcleantohtml($_POST['ocupatie_asigurat']);
//date contractant
$cui_contractant=stripcleantohtml($_POST['cui_contractant']);
$cnp_contractant=stripcleantohtml($_POST['cnp_contractant']);
$nume_contractant=stripcleantohtml($_POST['nume_contractant']);
$prenume_contractant=stripcleantohtml($_POST['prenume_contractant']);
$tara_contaractant=stripcleantohtml($_POST['tara_contaractant']);
$judet_contaractant=stripcleantohtml($_POST['judet_contaractant']);
$localitate_contaractant=stripcleantohtml($_POST['localitate_contaractant']);
$strada_contaractant=stripcleantohtml($_POST['strada_contaractant']);
$nr_strada_contaractant=stripcleantohtml($_POST['nr_strada_contaractant']);
$bloc_contaractant=stripcleantohtml($_POST['bloc_contaractant']);
$scara_contaractant=stripcleantohtml($_POST['scara_contaractant']);
$etaj_adresa_contaractant=stripcleantohtml($_POST['etaj_adresa_contaractant']);
$apartament_contaractant=stripcleantohtml($_POST['apartament_contaractant']);
$cod_postal_contaractant=stripcleantohtml($_POST['cod_postal_contaractant']);
$telefon_contaractant=stripcleantohtml($_POST['telefon_contaractant']);
$email_contaractant=stripcleantohtml($_POST['email_contaractant']);
//end date contractant
$nume_reprezentant=stripcleantohtml($_POST['nume_reprezentant']);
$prenume_reprezentant=stripcleantohtml($_POST['prenume_reprezentant']);
$cnp_reprezentant=stripcleantohtml($_POST['cnp_reprezentant']);
//informatii privind starea de asigurare a asiguratului
$nr_tigari=stripcleantohtml($_POST['nr_tigari']);
////////
$perioada_de_asigurare=stripcleantohtml($_POST['perioada_de_asigurare']);
$frecventa_plata=stripcleantohtml($_POST['frecventa_plata']);
$moneda=stripcleantohtml($_POST['moneda']);
$data_valabilitate_start=stripcleantohtml($_POST['data_valabilitate_start']);
$acoperire_de_baza=stripcleantohtml($_POST['acoperire_de_baza']);
//$clauza_spitalizare=stripcleantohtml($_POST['clauza_spitalizare']);

//copii inclusi
$asigurat_afectiuni_preexistente_text=htmlspecialchars($_POST['asigurat_afectiuni_preexistente_text']);

$nr_copii_inclusi=stripcleantohtml($_POST['nr_copii_inclusi']);



if ($_POST['asigurat_fumator']=="asigurat_fumator_da") $asigurat_fumator="DA"; else $asigurat_fumator="NU";
//$asigurat_fumator.

if ($_POST['asigurat_narcotice']=="asigurat_narcotice_da") $asigurat_narcotice="DA"; else $asigurat_narcotice="NU";
//$asigurat_narcotice.

if ($_POST['asigurat_consum_cronic_alcool']=="asigurat_consum_cronic_alcool_da") $asigurat_consum_cronic_alcool="DA"; else $asigurat_consum_cronic_alcool="NU";
//$asigurat_consum_cronic_alcool.

if ($_POST['asigurat_infarct']=="asigurat_infarct_da") $asigurat_infarct="DA"; else $asigurat_infarct="NU";
//$asigurat_infarct.


if ($_POST['asigurat_diagnostic_infarct_ultimul_an']=="asigurat_diagnostic_infarct_ultimul_an_da") $asigurat_diagnostic_infarct_ultimul_an="DA"; else $asigurat_diagnostic_infarct_ultimul_an="NU";
//$asigurat_diagnostic_infarct_ultimul_an.

if ($_POST['asigurat_infarct_multiple']=="asigurat_infarct_multiple_da") $asigurat_infarct_multiple="DA"; else $asigurat_infarct_multiple="NU";

if ($_POST['asigurat_diabet']=="asigurat_diabet_da") $asigurat_diabet="DA"; else $asigurat_diabet="NU";
//$asigurat_diabet.

if ($_POST['asigurat_angioplastie']=="asigurat_angioplastie_da") $asigurat_angioplastie="DA"; else $asigurat_angioplastie="NU";
//$asigurat_angioplastie.

if ($_POST['asigurat_alte_afectiuni_cardiace']=="asigurat_alte_afectiuni_cardiace_da") $asigurat_alte_afectiuni_cardiace="DA"; else $asigurat_alte_afectiuni_cardiace="NU";
//$asigurat_alte_afectiuni_cardiace.

if ($_POST['asigurat_insuficienta_cardiaca']=="asigurat_insuficienta_cardiaca_da") $asigurat_insuficienta_cardiaca="DA"; else $asigurat_insuficienta_cardiaca="NU";
//$asigurat_insuficienta_cardiaca.

if ($_POST['asigurat_sidrom_adam_stokes']=="asigurat_sidrom_adam_stokes_da") $asigurat_sidrom_adam_stokes="DA"; else $asigurat_sidrom_adam_stokes="NU";
//$asigurat_sidrom_adam_stokes.

if ($_POST['asigurat_cardiopatie']=="asigurat_cardiopatie_da") $asigurat_cardiopatie="DA"; else $asigurat_cardiopatie="NU";
//$asigurat_cardiopatie.

if ($_POST['asigurat_afectiuni_valvulare']=="asigurat_afectiuni_valvulare_da") $asigurat_afectiuni_valvulare="DA"; else $asigurat_afectiuni_valvulare="NU";
//$asigurat_afectiuni_valvulare.

if ($_POST['asigurat_hipertensiune']=="asigurat_hipertensiune_da") $asigurat_hipertensiune="DA"; else $asigurat_hipertensiune="NU";
//$asigurat_hipertensiune.

if ($_POST['asigurat_miocardita']=="asigurat_miocardita_da") $asigurat_miocardita="DA"; else $asigurat_miocardita="NU";
//$asigurat_miocardita.

if ($_POST['asigurat_pericardita']=="asigurat_pericardita_da") $asigurat_pericardita="DA"; else $asigurat_pericardita="NU";
//$asigurat_pericardita.

if ($_POST['asigurat_fabriatie']=="asigurat_fabriatie_da") $asigurat_fabriatie="DA"; else $asigurat_fabriatie="NU";
//$asigurat_fabriatie.

if ($_POST['asigurat_tehicardie']=="asigurat_tehicardie_da") $asigurat_tehicardie="DA"; else $asigurat_tehicardie="NU";
//$asigurat_tehicardie.

if ($_POST['asigurat_bradicardie']=="asigurat_bradicardie_da") $asigurat_bradicardie="DA"; else $asigurat_bradicardie="NU";
//$asigurat_bradicardie.

if ($_POST['asigurat_bloc_ramura_stanta']=="asigurat_bloc_ramura_stanta_da") $asigurat_bloc_ramura_stanta="DA"; else $asigurat_bloc_ramura_stanta="NU";
//$asigurat_bloc_ramura_stanta.

if ($_POST['asigurat_bloc_atrio_venticular']=="asigurat_bloc_atrio_venticular_da") $asigurat_bloc_atrio_venticular="DA"; else $asigurat_bloc_atrio_venticular="NU";
//$asigurat_bloc_atrio_venticular.

if ($_POST['asigurat_hipertrofie']=="asigurat_hipertrofie_da") $asigurat_hipertrofie="DA"; else $asigurat_hipertrofie="NU";
//$asigurat_hipertrofie.

if ($_POST['asigurat_arterita']=="asigurat_arterita_da") $asigurat_arterita="DA"; else $asigurat_arterita="NU";
//$asigurat_arterita.

if ($_POST['asigurat_tromboflebita']=="asigurat_tromboflebita_da") $asigurat_tromboflebita="DA"; else $asigurat_tromboflebita="NU";
//$asigurat_tromboflebita.

if ($_POST['asigurat_malformatie_alteriovenoasa']=="asigurat_malformatie_alteriovenoasa_da") $asigurat_malformatie_alteriovenoasa="DA"; else $asigurat_malformatie_alteriovenoasa="NU";
//$asigurat_malformatie_alteriovenoasa.

if ($_POST['asigurat_anevrism_arterial']=="asigurat_anevrism_arterial_da") $asigurat_anevrism_arterial="DA"; else $asigurat_anevrism_arterial="NU";
//$asigurat_anevrism_arterial.
//2//////////////////////
if ($_POST['asigurat_afectiuni_respiratorii']=="asigurat_afectiuni_respiratorii_da") $asigurat_afectiuni_respiratorii="DA"; else $asigurat_afectiuni_respiratorii="NU";
//$asigurat_afectiuni_respiratorii.

if ($_POST['asigurat_tuberculoza_activa']=="asigurat_tuberculoza_activa_da") $asigurat_tuberculoza_activa="DA"; else $asigurat_tuberculoza_activa="NU";
//$asigurat_tuberculoza_activa.

if ($_POST['asigurat_insuficienta_respiratorie']=="asigurat_insuficienta_respiratorie_da") $asigurat_insuficienta_respiratorie="DA"; else $asigurat_insuficienta_respiratorie="NU";
//$asigurat_insuficienta_respiratorie.

if ($_POST['asigurat_astm_bronsic']=="asigurat_astm_bronsic_da") $asigurat_astm_bronsic="DA"; else $asigurat_astm_bronsic="NU";
//$asigurat_astm_bronsic.

if ($_POST['asigurat_emfizem_pulmonar']=="asigurat_emfizem_pulmonar_da") $asigurat_emfizem_pulmonar="DA"; else $asigurat_emfizem_pulmonar="NU";
//$asigurat_emfizem_pulmonar.

if ($_POST['asigurat_bronsita_cronica']=="asigurat_bronsita_cronica_da") $asigurat_bronsita_cronica="DA"; else $asigurat_bronsita_cronica="NU";
//$asigurat_bronsita_cronica.
//3//////////////
if ($_POST['asigurat_afectiuni_digestive']=="asigurat_afectiuni_digestive_da") $asigurat_afectiuni_digestive="DA"; else $asigurat_afectiuni_digestive="NU";
//$asigurat_afectiuni_digestive.

if ($_POST['asigurat_ciroza_hepatica']=="asigurat_ciroza_hepatica_da") $asigurat_ciroza_hepatica="DA"; else $asigurat_ciroza_hepatica="NU";
//$asigurat_ciroza_hepatica.

if ($_POST['asigurat_hepatita_cronica']=="asigurat_hepatita_cronica_da") $asigurat_hepatita_cronica="DA"; else $asigurat_hepatita_cronica="NU";
//$asigurat_hepatita_cronica.

if ($_POST['asigurat_reflux_gastroesofagian']=="asigurat_reflux_gastroesofagian_da") $asigurat_reflux_gastroesofagian="DA"; else $asigurat_reflux_gastroesofagian="NU";
//$asigurat_reflux_gastroesofagian.

if ($_POST['asigurat_ulcer_gastric']=="asigurat_ulcer_gastric_da") $asigurat_ulcer_gastric="DA"; else $asigurat_ulcer_gastric="NU";
//$asigurat_ulcer_gastric.

if ($_POST['asigurat_ulcer_duodenal']=="asigurat_ulcer_duodenal_da") $asigurat_ulcer_duodenal="DA"; else $asigurat_ulcer_duodenal="NU";
//$asigurat_ulcer_duodenal.

if ($_POST['asigurat_litiza_biliara']=="asigurat_litiza_biliara_da") $asigurat_litiza_biliara="DA"; else $asigurat_litiza_biliara="NU";
//$asigurat_litiza_biliara.

if ($_POST['asigurat_pancreatita_cronica']=="asigurat_pancreatita_cronica_da") $asigurat_pancreatita_cronica="DA"; else $asigurat_pancreatita_cronica="NU";
//$asigurat_pancreatita_cronica.

if ($_POST['asigurat_rectocolita_ulcero_hemoragiga']=="asigurat_rectocolita_ulcero_hemoragiga_da") $asigurat_rectocolita_ulcero_hemoragiga="DA"; else $asigurat_rectocolita_ulcero_hemoragiga="NU";
//$asigurat_rectocolita_ulcero_hemoragiga.

if ($_POST['asigurat_boala_crohn']=="asigurat_boala_crohn_da") $asigurat_boala_crohn="DA"; else $asigurat_boala_crohn="NU";
//$asigurat_boala_crohn.

if ($_POST['asigurat_diverticuloza_colonica']=="asigurat_diverticuloza_colonica_da") $asigurat_diverticuloza_colonica="DA"; else $asigurat_diverticuloza_colonica="NU";
//$asigurat_diverticuloza_colonica.

//4////////////////


if ($_POST['asigurat_boli_metabolice']=="asigurat_boli_metabolice_da") $asigurat_boli_metabolice="DA"; else $asigurat_boli_metabolice="NU";
//asigurat_boli_metabolice.

if ($_POST['asigurat_diabet_zaharat_complicat']=="asigurat_diabet_zaharat_complicat_da") $asigurat_diabet_zaharat_complicat="DA"; else $asigurat_diabet_zaharat_complicat="NU";
//$asigurat_diabet_zaharat_complicat.

if ($_POST['asigurat_retinopatie_diabetica']=="asigurat_retinopatie_diabetica_da") $asigurat_retinopatie_diabetica="DA"; else $asigurat_retinopatie_diabetica="NU";
//$asigurat_retinopatie_diabetica.

if ($_POST['asigurat_nefropatie']=="asigurat_nefropatie_da") $asigurat_nefropatie="DA"; else $asigurat_nefropatie="NU";
//$asigurat_nefropatie.

if ($_POST['asigurat_neuropatie']=="asigurat_neuropatie_da") $asigurat_neuropatie="DA"; else $asigurat_neuropatie="NU";
//$asigurat_neuropatie.

if ($_POST['asigurat_cardiopatie_ischemica']=="asigurat_cardiopatie_ischemica_da") $asigurat_cardiopatie_ischemica="DA"; else $asigurat_cardiopatie_ischemica="NU";
//$asigurat_cardiopatie_ischemica.

if ($_POST['asigurat_hipertensiune_arteriala']=="asigurat_hipertensiune_arteriala_da") $asigurat_hipertensiune_arteriala="DA"; else $asigurat_hipertensiune_arteriala="NU";
//$asigurat_hipertensiune_arteriala.

if ($_POST['asigurat_metabolice_infarct_miocardic']=="asigurat_metabolice_infarct_miocardic_da") $asigurat_metabolice_infarct_miocardic="DA"; else $asigurat_metabolice_infarct_miocardic="NU";
//$asigurat_metabolice_infarct_miocardic.

if ($_POST['asigurat_metabolice_accident_vascular']=="asigurat_metabolice_accident_vascular_da") $asigurat_metabolice_accident_vascular="DA"; else $asigurat_metabolice_accident_vascular="NU";
//$asigurat_metabolice_accident_vascular.

if ($_POST['asigurat_proteinurie']=="asigurat_proteinurie_da") $asigurat_proteinurie="DA"; else $asigurat_proteinurie="NU";
//$asigurat_proteinurie.

if ($_POST['asigurat_metabolice_insuficienta_renala']=="asigurat_metabolice_insuficienta_renala_da") $asigurat_metabolice_insuficienta_renala="DA"; else $asigurat_metabolice_insuficienta_renala="NU";
//$asigurat_metabolice_insuficienta_renala.

if ($_POST['asigurat_obezitatea']=="asigurat_obezitatea_da") $asigurat_obezitatea="DA"; else $asigurat_obezitatea="NU";
//$asigurat_obezitatea.

if ($_POST['asigurat_guta']=="asigurat_guta_da") $asigurat_guta="DA"; else $asigurat_guta="NU";
//$asigurat_guta.

if ($_POST['asigurat_sidrom_metabolic']=="asigurat_sidrom_metabolic_da") $asigurat_sidrom_metabolic="DA"; else $asigurat_sidrom_metabolic="NU";
//$asigurat_sidrom_metabolic.

//5////////

if ($_POST['asigurat_afectiuni_endocrine']=="asigurat_afectiuni_endocrine_da") $asigurat_afectiuni_endocrine="DA"; else $asigurat_afectiuni_endocrine="NU";
//$asigurat_afectiuni_endocrine.

if ($_POST['asigurat_hipertiroidie']=="asigurat_hipertiroidie_da") $asigurat_hipertiroidie="DA"; else $asigurat_hipertiroidie="NU";
//$asigurat_hipertiroidie.

if ($_POST['asigurat_tiroidita_cronica']=="asigurat_tiroidita_cronica_da") $asigurat_tiroidita_cronica="DA"; else $asigurat_tiroidita_cronica="NU";
//$asigurat_tiroidita_cronica.

if ($_POST['asigurat_gusa_nodulara']=="asigurat_gusa_nodulara_da") $asigurat_gusa_nodulara="DA"; else $asigurat_gusa_nodulara="NU";
//$asigurat_gusa_nodulara.

if ($_POST['asigurat_sindrom_cushing']=="asigurat_sindrom_cushing_da") $asigurat_sindrom_cushing="DA"; else $asigurat_sindrom_cushing="NU";
//$asigurat_sindrom_cushing.

if ($_POST['asigurat_boala_addison']=="asigurat_boala_addison_da") $asigurat_boala_addison="DA"; else $asigurat_boala_addison="NU";
//$asigurat_boala_addison.

//6//////////

if ($_POST['asigurat_afectiuni_ereditare']=="asigurat_afectiuni_ereditare_da") $asigurat_afectiuni_ereditare="DA"; else $asigurat_afectiuni_ereditare="NU";
//$asigurat_afectiuni_ereditare.

if ($_POST['asigurat_fobroza_chistica']=="asigurat_fobroza_chistica_da") $asigurat_fobroza_chistica="DA"; else $asigurat_fobroza_chistica="NU";
//$asigurat_fobroza_chistica.

if ($_POST['asigurat_boala_wilson']=="asigurat_boala_wilson_da") $asigurat_boala_wilson="DA"; else $asigurat_boala_wilson="NU";
//$asigurat_boala_wilson.

//7/////////

if ($_POST['asigurat_afectiuni_hematologice']=="asigurat_afectiuni_hematologice_da") $asigurat_afectiuni_hematologice="DA"; else $asigurat_afectiuni_hematologice="NU";
//$asigurat_afectiuni_hematologice.

if ($_POST['asigurat_hemofilie']=="asigurat_hemofilie_da") $asigurat_hemofilie="DA"; else $asigurat_hemofilie="NU";
//$asigurat_hemofilie.

if ($_POST['asigurat_leucemie']=="asigurat_leucemie_da") $asigurat_leucemie="DA"; else $asigurat_leucemie="NU";
//$asigurat_leucemie.

if ($_POST['asigurat_anemie_hemolitica']=="asigurat_anemie_hemolitica_da") $asigurat_anemie_hemolitica="DA"; else $asigurat_anemie_hemolitica="NU";
//$asigurat_anemie_hemolitica.

if ($_POST['asigurat_trombofilie']=="asigurat_trombofilie_da") $asigurat_trombofilie="DA"; else $asigurat_trombofilie="NU";
//$asigurat_trombofilie.

//8/////////

if ($_POST['asigurat_tumori_cancer']=="asigurat_tumori_cancer_da") $asigurat_tumori_cancer="DA"; else $asigurat_tumori_cancer="NU";
//$asigurat_tumori_cancer.

if ($_POST['asigurat_limfom']=="asigurat_limfom_da") $asigurat_limfom="DA"; else $asigurat_limfom="NU";
//$asigurat_limfom.

if ($_POST['asigurat_boala_hodgkin']=="asigurat_boala_hodgkin_da") $asigurat_boala_hodgkin="DA"; else $asigurat_boala_hodgkin="NU";
//$asigurat_boala_hodgkin.

if ($_POST['asigurat_tumori_maligne']=="asigurat_tumori_maligne_da") $asigurat_tumori_maligne="DA"; else $asigurat_tumori_maligne="NU";
//$asigurat_tumori_maligne.

//9///////////

if ($_POST['asigurat_boli_infectioase']=="asigurat_boli_infectioase_da") $asigurat_boli_infectioase="DA"; else $asigurat_boli_infectioase="NU";
//$asigurat_boli_infectioase.

if ($_POST['asigurat_hiv_sida']=="asigurat_hiv_sida_da") $asigurat_hiv_sida="DA"; else $asigurat_hiv_sida="NU";
//$asigurat_hiv_sida.

if ($_POST['asigurat_infectioase_tuberculoza_activa']=="asigurat_infectioase_tuberculoza_activa_da") $asigurat_infectioase_tuberculoza_activa="DA"; else $asigurat_infectioase_tuberculoza_activa="NU";
//$asigurat_infectioase_tuberculoza_activa.

//10///////////

if ($_POST['asigurat_afectiuni_neurologice']=="asigurat_afectiuni_neurologice_da") $asigurat_afectiuni_neurologice="DA"; else $asigurat_afectiuni_neurologice="NU";
//$asigurat_afectiuni_neurologice.

if ($_POST['asigurat_encefalopatia']=="asigurat_encefalopatia_da") $asigurat_encefalopatia="DA"; else $asigurat_encefalopatia="NU";
//$asigurat_encefalopatia.

if ($_POST['asigurat_tetrapareza']=="asigurat_tetrapareza_da") $asigurat_tetrapareza="DA"; else $asigurat_tetrapareza="NU";
//$asigurat_tetrapareza.

if ($_POST['asigurat_epilepsie']=="asigurat_epilepsie_da") $asigurat_epilepsie="DA"; else $asigurat_epilepsie="NU";
//$asigurat_epilepsie.

if ($_POST['asigurat_parapareza']=="asigurat_parapareza_da") $asigurat_parapareza="DA"; else $asigurat_parapareza="NU";
//$asigurat_parapareza.

if ($_POST['asigurat_migrena']=="asigurat_migrena_da") $asigurat_migrena="DA"; else $asigurat_migrena="NU";
//$asigurat_migrena.

if ($_POST['asigurat_parkinson']=="asigurat_parkinson_da") $asigurat_parkinson="DA"; else $asigurat_parkinson="NU";
//$asigurat_parkinson.

if ($_POST['asigurat_scleroza_multipla']=="asigurat_scleroza_multipla_da") $asigurat_scleroza_multipla="DA"; else $asigurat_scleroza_multipla="NU";
//$asigurat_scleroza_multipla.

//11////////

if ($_POST['asigurat_afectiuni_psihice']=="asigurat_afectiuni_psihice_da") $asigurat_afectiuni_psihice="DA"; else $asigurat_afectiuni_psihice="NU";
//$asigurat_afectiuni_psihice.

if ($_POST['asigurat_schizofrenia']=="asigurat_schizofrenia_da") $asigurat_schizofrenia="DA"; else $asigurat_schizofrenia="NU";
//$asigurat_schizofrenia.

if ($_POST['asigurat_tulburare_afectiva_bipolare']=="asigurat_tulburare_afectiva_bipolare_da") $asigurat_tulburare_afectiva_bipolare="DA"; else $asigurat_tulburare_afectiva_bipolare="NU";
//$asigurat_tulburare_afectiva_bipolare.

if ($_POST['asigurat_tulburare_somatofoma']=="asigurat_tulburare_somatofoma_da") $asigurat_tulburare_somatofoma="DA"; else $asigurat_tulburare_somatofoma="NU";
//$asigurat_tulburare_somatofoma.

if ($_POST['asigurat_depresie']=="asigurat_depresie_da") $asigurat_depresie="DA"; else $asigurat_depresie="NU";
//$asigurat_depresie.

//12///////////

if ($_POST['asigurat_afectiuni_orl']=="asigurat_afectiuni_orl_da") $asigurat_afectiuni_orl="DA"; else $asigurat_afectiuni_orl="NU";
//$asigurat_afectiuni_orl.

if ($_POST['asigurat_otita_cronica']=="asigurat_otita_cronica_da") $asigurat_otita_cronica="DA"; else $asigurat_otita_cronica="NU";
//$asigurat_otita_cronica.

if ($_POST['asigurat_sinuzita_cronica']=="asigurat_sinuzita_cronica_da") $asigurat_sinuzita_cronica="DA"; else $asigurat_sinuzita_cronica="NU";
//$asigurat_sinuzita_cronica.

//13/////

if ($_POST['asigurat_afectiuni_oftalmologice']=="asigurat_afectiuni_oftalmologice_da") $asigurat_afectiuni_oftalmologice="DA"; else $asigurat_afectiuni_oftalmologice="NU";
//$asigurat_afectiuni_oftalmologice.

if ($_POST['asigurat_glaucom']=="asigurat_glaucom_da") $asigurat_glaucom="DA"; else $asigurat_glaucom="NU";
//$asigurat_glaucom.

if ($_POST['asigurat_retinopatie_pigmentara']=="asigurat_retinopatie_pigmentara_da") $asigurat_retinopatie_pigmentara="DA"; else $asigurat_retinopatie_pigmentara="NU";
//$asigurat_retinopatie_pigmentara.

if ($_POST['asigurat_cataracta']=="asigurat_cataracta_da") $asigurat_cataracta="DA"; else $asigurat_cataracta="NU";
//$asigurat_cataracta.

//14/////

if ($_POST['asigurat_afectiuni_reumatica']=="asigurat_afectiuni_reumatica_da") $asigurat_afectiuni_reumatica="DA"; else $asigurat_afectiuni_reumatica="NU";
//$asigurat_afectiuni_reumatica.

if ($_POST['asigurat_polialtrita_reumatoida']=="asigurat_polialtrita_reumatoida_da") $asigurat_polialtrita_reumatoida="DA"; else $asigurat_polialtrita_reumatoida="NU";
//$asigurat_polialtrita_reumatoida.

if ($_POST['asigurat_lupus_eritamatos_sistematic']=="asigurat_lupus_eritamatos_sistematic_da") $asigurat_lupus_eritamatos_sistematic="DA"; else $asigurat_lupus_eritamatos_sistematic="NU";
//$asigurat_lupus_eritamatos_sistematic.

if ($_POST['asigurat_reumatice_artrita_cronica']=="asigurat_reumatice_artrita_cronica_da") $asigurat_reumatice_artrita_cronica="DA"; else $asigurat_reumatice_artrita_cronica="NU";
//$asigurat_reumatice_artrita_cronica.

if ($_POST['asigurat_osteopenie_osteoporoza']=="asigurat_osteopenie_osteoporoza_da") $asigurat_osteopenie_osteoporoza="DA"; else $asigurat_osteopenie_osteoporoza="NU";
//$asigurat_osteopenie_osteoporoza.

if ($_POST['asigurat_spondilodiscopatia']=="asigurat_spondilodiscopatia_da") $asigurat_spondilodiscopatia="DA"; else $asigurat_spondilodiscopatia="NU";
//$asigurat_spondilodiscopatia.

if ($_POST['asigurat_hernie_de_disc']=="asigurat_hernie_de_disc_da") $asigurat_hernie_de_disc ="DA"; else $asigurat_hernie_de_disc="NU";
//$asigurat_hernie_de_disc.

if ($_POST['asigurat_osterioartrita']=="asigurat_osterioartrita_da") $asigurat_osterioartrita="DA"; else $asigurat_osterioartrita="NU";
//$asigurat_osterioartrita.

//15///////////////

if ($_POST['asigurat_afectiuni_renala']=="asigurat_afectiuni_renala_da") $asigurat_afectiuni_renala="DA"; else $asigurat_afectiuni_renala="NU";
//$asigurat_afectiuni_renala.

if ($_POST['asigurat_insuficienta_renala_cronica']=="asigurat_insuficienta_renala_cronica_da") $asigurat_insuficienta_renala_cronica="DA"; else $asigurat_insuficienta_renala_cronica="NU";
//$asigurat_insuficienta_renala_cronica.

if ($_POST['asigurat_litiza_renala']=="asigurat_litiza_renala_da") $asigurat_litiza_renala="DA"; else $asigurat_litiza_renala="NU";
//$asigurat_litiza_renala.

if ($_POST['asigurat_pielonefrita_cronica']=="asigurat_pielonefrita_cronica_da") $asigurat_pielonefrita_cronica="DA"; else $asigurat_pielonefrita_cronica="NU";
//$asigurat_pielonefrita_cronica.

if ($_POST['asigurat_glomerulonefrita']=="asigurat_glomerulonefrita_da") $asigurat_glomerulonefrita="DA"; else $asigurat_glomerulonefrita="NU";
//$asigurat_glomerulonefrita.

if ($_POST['asigurat_sindrom_nefrotic']=="asigurat_sindrom_nefrotic_da") $asigurat_sindrom_nefrotic="DA"; else $asigurat_sindrom_nefrotic="NU";
//$asigurat_sindrom_nefrotic.

if ($_POST['asigurat_ureterohidronefroza']=="asigurat_ureterohidronefroza_da") $asigurat_ureterohidronefroza="DA"; else $asigurat_ureterohidronefroza="NU";
//$asigurat_ureterohidronefroza.

if ($_POST['asigurat_sitenoza_uretrala']=="asigurat_sitenoza_uretrala_da") $asigurat_sitenoza_uretrala="DA"; else $asigurat_sitenoza_uretrala="NU";
//$asigurat_sitenoza_uretrala.

//16///////

if ($_POST['asigurat_afectiuni_prostata']=="asigurat_afectiuni_prostata_da") $asigurat_afectiuni_prostata="DA"; else $asigurat_afectiuni_prostata="NU";
//$asigurat_afectiuni_prostata.

//17//////////

if ($_POST['asigurat_afectiuni_ginecologice']=="asigurat_afectiuni_ginecologice_da") $asigurat_afectiuni_ginecologice="DA"; else $asigurat_afectiuni_ginecologice="NU";
//$asigurat_afectiuni_ginecologice.

if ($_POST['asigurat_infectie_hpv']=="asigurat_infectie_hpv_da") $asigurat_infectie_hpv="DA"; else $asigurat_infectie_hpv="NU";
//$asigurat_infectie_hpv.

if ($_POST['asigurat_cervicita_cronica']=="asigurat_cervicita_cronica_da") $asigurat_cervicita_cronica="DA"; else $asigurat_cervicita_cronica="NU";
//$asigurat_cervicita_cronica.

if ($_POST['asigurat_fibromatoza_uterina']=="asigurat_fibromatoza_uterina_da") $asigurat_fibromatoza_uterina="DA"; else $asigurat_fibromatoza_uterina="NU";
//$asigurat_fibromatoza_uterina.

if ($_POST['asigurat_endometrioza']=="asigurat_endometrioza_da") $asigurat_endometrioza="DA"; else $asigurat_endometrioza="NU";
//$asigurat_endometrioza.

if ($_POST['asigurat_mastopatia_fibrochistica']=="asigurat_mastopatia_fibrochistica_da") $asigurat_mastopatia_fibrochistica="DA"; else $asigurat_mastopatia_fibrochistica="NU";
//$asigurat_mastopatia_fibrochistica.

if ($_POST['asigurat_boala_inflamatorie_pelvina']=="asigurat_boala_inflamatorie_pelvina_da") $asigurat_boala_inflamatorie_pelvina="DA"; else $asigurat_boala_inflamatorie_pelvina="NU";
//$asigurat_boala_inflamatorie_pelvina.

if ($_POST['asigurat_anexita_cronica']=="asigurat_anexita_cronica_da") $asigurat_anexita_cronica="DA"; else $asigurat_anexita_cronica="NU";
//$asigurat_anexita_cronica.

if ($_POST['asigurat_nodul_mamar']=="asigurat_nodul_mamar_da") $asigurat_nodul_mamar="DA"; else $asigurat_nodul_mamar="NU";
//$asigurat_nodul_mamar.



if ($_POST['asigurat_afectiuni_preexistente']=="asigurat_afectiuni_preexistente_da") $asigurat_afectiuni_preexistente="DA"; else $asigurat_afectiuni_preexistente="NU";
//$asigurat_afectiuni_preexistente.


if ($_POST['asigurare_sot_sotie']=="asigurare_sot_sotie_da") $asigurare_sot_sotie="DA"; else $asigurare_sot_sotie="NU";
//$asigurare_sot_sotie.


if ($_POST['acoperire_internationala']=="acoperire_internationala_da") $acoperire_internationala="DA"; else $acoperire_internationala="NU";
//$acoperire_internationala.


if ($_POST['clauza_spitalizare']=="clauza_spitalizare_da") $clauza_preventie="DA"; else $clauza_spitalizare="NU";
//$clauza_spitalizare.


if ($_POST['clauza_preventie']=="clauza_preventie_da") $clauza_preventie="DA"; else $clauza_preventie="NU";
//$clauza_preventie.

if ($_POST['clauza_ambulatorie_pentru_copii']=="clauza_ambulatorie_pentru_copii_da") $clauza_ambulatorie_pentru_copii="DA"; else $clauza_ambulatorie_pentru_copii="NU";
//$clauza_ambulatorie_pentru_copii.

if ($_POST['clauza_chirurgicale_pentru_copii']=="clauza_chirurgicale_pentru_copii_da") $clauza_chirurgicale_pentru_copii="DA"; else $clauza_chirurgicale_pentru_copii="NU";
//$clauza_chirurgicale_pentru_copii.
//------------------//
if ($_POST['copii_inclusi']=="copii_inclusi_da") $copii_inclusi="DA"; else $copii_inclusi="NU";
//$copii_inclusi.
//------------------//









$sql="select * from colaboratori where activ=1 and idcolaborator=20  ";
$rows = $db->query($sql);
    while ($record = $db->fetch_array($rows))
	 	{
			$destinatar = $record['email'];
		}

		
		if (empty($strada)) $message_error.='Nr strada este incorect sau lipseste.<br>'; 
		if (empty($nume)) $message_error.='Numele este incorect sau lipseste.<br>'; 
		if (empty($prenume)) $message_error.='Prenumele este incorect sau lipseste.<br>';
		if (empty($data_nasterii)) $message_error.='Data nasterii este incorect sau lipseste.<br>';
		if (empty($judet_asigurat)) $message_error.='Judetul asigurat este incorect sau lipseste.<br>';
		if (empty($localitate_asigurat)) $message_error.='Localitatea asigurat este incorect sau lipseste.<br>';
		if (empty($strada_asigurat)) $message_error.='Strada asigurat este incorect sau lipseste.<br>';
		if (empty($nr_strada_asigurat)) $message_error.='Nr strada asigurat este incorect sau lipseste.<br>';
		if (empty($bloc_asigurat)) $message_error.='Bloc asigurat este incorect sau lipseste.<br>';
		if (empty($scara_asigurat)) $message_error.='Scara asigurat este incorect sau lipseste.<br>';
		if (empty($etaj_adresa_asigurat)) $message_error.='Etaj adresa asigurat este incorect sau lipseste.<br>';
		if (empty($apartament_asigurat)) $message_error.='Apartament asigurat este incorect sau lipseste.<br>';
		if (empty($cod_postal_asigurat)) $message_error.='Cod postal asigurat este incorect sau lipseste.<br>';
		if (empty($telefon_asigurat)) $message_error.='Telefon asigurat este incorect sau lipseste.<br>';
		if (empty($email_asigurat)) $message_error.='Email asigurat este incorect sau lipseste.<br>';
		if (empty($tara_corespondenta_asigurat)) $message_error.='Tara corespondenta asigurat este incorect sau lipseste.<br>';
		if (empty($judet_corespondenta_asigurat)) $message_error.='Judet corespondenta asigurat este incorect sau lipseste.<br>';
		if (empty($localitate_corespondenta_asigurat)) $message_error.='Localitate corespondenta asigurat este incorect sau lipseste.<br>';
		if (empty($nr_strada)) $message_error.='Nr strada este incorect sau lipseste.<br>';
		if (empty($bloc)) $message_error.='Nr bloc este incorect sau lipseste.<br>';
		if (empty($scara)) $message_error.='Nr scara este incorect sau lipseste.<br>';
		if (empty($etaj_adresa)) $message_error.='Etaj adresa este incorect sau lipseste.<br>';
		if (empty($apartament)) $message_error.='Nr apartament este incorect sau lipseste.<br>';
		if (empty($cod_postal)) $message_error.='Codul postal este incorect sau lipseste.<br>';
		if (empty($ocupatie_asigurat)) $message_error.='Ocupatie asigurat este incorect sau lipseste.<br>';
	//	if (empty($cui_contractant)) $message_error.='Cui contractant este incorect sau lipseste.<br>';
	//	if (empty($cnp_contractant)) $message_error.='Cnp contractant este incorect sau lipseste.<br>';
	//	if (empty($nume_contractant)) $message_error.='Nume contractant este incorect sau lipseste.<br>';
	//	if (empty($prenume_contractant)) $message_error.='Prenume contractant este incorect sau lipseste.<br>';
	//	if (empty($tara_contaractant)) $message_error.='Tara contaractant este incorect sau lipseste.<br>';
	//	if (empty($judet_contaractant)) $message_error.='Judet contaractant este incorect sau lipseste.<br>';
	//	if (empty($localitate_contaractant)) $message_error.='Localitate contaractant este incorect sau lipseste.<br>';
	//	if (empty($strada_contaractant)) $message_error.='Strada contaractant este incorect sau lipseste.<br>';
	//	if (empty($nr_strada_contaractant)) $message_error.='Nr strada contaractant este incorect sau lipseste.<br>';
	///	if (empty($bloc_contaractant)) $message_error.='Nr bloc contaractant este incorect sau lipseste.<br>';
	//	if (empty($scara_contaractant)) $message_error.='Scara contaractant este incorect sau lipseste.<br>';
	//	if (empty($etaj_adresa_contaractant)) $message_error.='Nr etaj adresa contaractant este incorect sau lipseste.<br>';
	//	if (empty($apartament_contaractant)) $message_error.='Nr apartament contaractant este incorect sau lipseste.<br>';
	//	if (empty($cod_postal_contaractant)) $message_error.='Cod postal contaractant este incorect sau lipseste.<br>';
	//	if (empty($telefon_contaractant)) $message_error.='Telefon contaractant este incorect sau lipseste.<br>';
	//	if (empty($email_contaractant)) $message_error.='Email contaractant este incorect sau lipseste.<br>';
		if (empty($nume_reprezentant)) $message_error.='Nume reprezentant este incorect sau lipseste.<br>';
		if (empty($prenume_reprezentant)) $message_error.='Prenume reprezentant este incorect sau lipseste.<br>';
		if (empty($cnp_reprezentant)) $message_error.='Cnp reprezentant este incorect sau lipseste.<br>';
		if (empty($perioada_de_asigurare)) $message_error.='Perioada de asigurare este incorect sau lipseste.<br>';
		if (empty($frecventa_plata)) $message_error.='Frecventa plata este incorect sau lipseste.<br>';
		if (empty($moneda)) $message_error.='Moneda este incorect sau lipseste.<br>';
		if (empty($data_valabilitate_start)) $message_error.='Data valabilitate start  este incorect sau lipseste.<br>';
		if (empty($acoperire_de_baza)) $message_error.='Acoperire de baza este incorect sau lipseste.<br>';
		if (empty($nr_tigari)) $message_error.='Nr tigari este incorect sau lipseste.<br>';
		
		
		
		
		
		
      //  if (empty($data_nasterii)) $message_error.='Data nasterii este incorect sau lipseste.<br>';
      //  if (empty($localitate_asigurat))
      //      $message_error .= 'Localitatea asigurat este incorect sau lipseste.<br>';
      //   if (empty($judet_asigurat))
      //      $message_error .= 'Judetul este incorect sau lipseste.<br>';
      //  if (empty($strada))
      //      $message_error .= 'Strada este incorect sau lipseste.<br>';
      //  if (!valName($nume))
      //      $message_error .= 'Numele este incorect sau lipseste.<br>';
       if (!valideazacnp($cnp))
           $message_error .= 'Cnp invalid.<br>';
       if (empty($telefon_asigurat))
            $message_error .= 'Telefonul asigurat este incorect sau lipseste.<br>';
       if (!isValidEmail($email_asigurat))
            $message_error .= 'Email invalid.<br>';

        if ($message_error == '') {
	//
			//		if ($tip_asig_viata=="Pentru Copil")
	//		{
	//
	//				$cp_np="<th>Nume complet copil</th>";
	//				$cp_cnp="<th>CNP copil</th>";

					//$v_sp=$serie_pad;
				//	$v_np=$nr_pad;

	//				$c_nume="<td>".$nume_prenume_copil."</td>";
		//			$c_cnp="<td>".$cnp_copil."</td>";

		//	}

			////////////Date despre Asigurat
			$table_date_asigurat.= " <br><br><br>";
 $table_date_asigurat.= "<table border='2' style='border: 2px solid #c1d72a;' cellpadding='6' cellspacing='3' width='70%' >";
			$table_date_asigurat.= "
       <tr><td colspan='2' style='font-weight: bold; background: #c1d72a; color: #363c39;'><h2>1. Date asigurat</h2></td></tr>
			 <tr><td style='font-weight: bold;    width:70%;'>Nume</td><td>".$nume."</td></tr>
			 <tr><td style='font-weight: bold;'>Prenume</td><td>".$prenume."</td></tr>
			 <tr><td style='font-weight: bold;'>CNP</td><td>".$cnp."</td></tr>
			 <tr><td style='font-weight: bold;'>Data nasterii</td><td>".$data_nasterii."</td></tr>
			 <tr><td style='font-weight: bold;'>Judet</td><td>".$judet_asigurat."</td></tr>
			 <tr><td style='font-weight: bold;'>Localitate</td><td>".$localitate_asigurat."</td></tr>
			 <tr><td style='font-weight: bold;'>Strada</td><td>".$strada_asigurat."</td></tr>
			 <tr><td style='font-weight: bold;'>Nr. Strada</td><td>".$nr_strada_asigurat."</td></tr>
			 <tr><td style='font-weight: bold;'>Bloc</td><td>".$bloc_asigurat."</td></tr>
			 <tr><td style='font-weight: bold;'>Scara</td><td>".$scara_asigurat."</td></tr>
			 <tr><td style='font-weight: bold;'>Etaj</td><td>".$etaj_adresa_asigurat."</td></tr>
			 <tr><td style='font-weight: bold;'>Apartament</td><td>".$apartament_asigurat."</td></tr>
			 <tr><td style='font-weight: bold;'>Cod Postal</td><td>".$cod_postal_asigurat."</td></tr>
			 <tr><td style='font-weight: bold;'>Telefon</td><td>".$telefon_asigurat."</td></tr>
			 <tr><td style='font-weight: bold;'>Email</td><td>".$email_asigurat."</td></tr>
			 ";
			 $table_date_asigurat.="</table>";
			 ////////////////////////////////////////////////////////////////////


				////////////Adresa de corespondenta asigurat

        $table_date_asigurat.= " <br><br><br>";
   $table_date_asigurat.= "<table border='2' style='border: 2px solid #c1d72a;' cellpadding='6' cellspacing='3' width='70%' >";



 	if ($_POST['corespondeta_identica_asigurat']=="corespondeta_identica_asigurat_da") $corespondeta_asigurat="identic"; else $corespondeta_asigurat="diferit";

				if($corespondeta_asigurat == "diferit"){

          $table_date_asigurat.= "
           <tr><td colspan='2' style='font-weight: bold; background: #c1d72a; color: #363c39;'><h2>2. Adresa de corespondenta a persoanei asigurate</h2></td></tr>

			 <tr><td style='font-weight: bold;    width:70%;'>Tara</td><td>".$tara_corespondenta_asigurat."</td></tr>
			 <tr><td style='font-weight: bold;'>Judet</td><td>".$judet_corespondenta_asigurat."</td></tr>
			 <tr><td style='font-weight: bold;'>Localitate</td><td>".$localitate_corespondenta_asigurat."</td></tr>
			 <tr><td style='font-weight: bold;'>Strada</td><td>".$strada."</td></tr>
			 <tr><td style='font-weight: bold;'>Nr. Strada</td><td>".$nr_strada."</td></tr>
			 <tr><td style='font-weight: bold;'>Bloc</td><td>".$bloc."</td></tr>
			 <tr><td style='font-weight: bold;'>Scara</td><td>".$scara."</td></tr>
			 <tr><td style='font-weight: bold;'>Etaj</td><td>".$etaj_adresa."</td></tr>
			 <tr><td style='font-weight: bold;'>Apartament</td><td>".$apartament."</td></tr>
			 <tr><td style='font-weight: bold;'>Cod Postal</td><td>".$cod_postal."</td></tr>
			 <tr><td style='font-weight: bold;'>Ocupatie</td><td>".$ocupatie_asigurat."</td></tr>
			 ";
				$table_date_asigurat.="</table>"; }

			if($corespondeta_asigurat == "identic"){

        $table_date_asigurat.= "
         <tr><td colspan='2' style='font-weight: bold; background: #c1d72a; color: #363c39;'><h3>2. Adresa de corespondenta a persoanei asigurate este identica cu adresa asiguratului</h3></td></tr>
			 ";
			$table_date_asigurat.="</table>";
			}

			 ////////////////////////////////////////////////////////////////////

if ($_POST['contractantul_identica_asigurat']=="contractantul_identica_asigurat_da") $contractantul_asigurat="identic"; else $contractantul_asigurat="diferit";

				if($contractantul_asigurat == "diferit"){

         //////////////////Date despre Contractant
				if ($_POST['pj_contractant']=="pj_contractant_da") $tip_persoana1="CUI"; else $tip_persoana1="CNP";

				if($tip_persoana1=="CNP style='font-weight: bold;'"){
				//	$pre="<tr><td>Prenume</td><td>";
				//	$pre_d="<td>" . $prenume_contractant . "</td>";
					$prenume_contractant_tabel="<tr><td style='font-weight: bold;'>Prenume</td><td>".$prenume_contractant."</td></tr>";
				}
				else
				//	$pre="";
				//	$pre_d="";
					$prenume_contractant_tabel="";
					/////////////////////////////////////////////
          $table_date_asigurat.= " <br><br><br>";
      $table_date_asigurat.= "<table border='2' style='border: 2px solid #c1d72a;' cellpadding='6' cellspacing='3' width='70%' >";
 $table_date_asigurat.= "
  <tr><td colspan='2' style='font-weight: bold; background: #c1d72a; color: #363c39;'><h2>3. Date despre Contractant</h2></td></tr>
			 <tr><td style='font-weight: bold;    width:70%;'>".$tip_persoana1."</td><td>".$cnp_contractant."</td></tr>
			 <tr><td style='font-weight: bold;'>Nume</td><td>".$nume_contractant."</td></tr>
			 ".$prenume_contractant_tabel."
			 <tr><td style='font-weight: bold;'>Tara</td><td>".$tara_contaractant."</td></tr>
			 <tr><td style='font-weight: bold;'>Judet</td><td>".$judet_contaractant."</td></tr>
			 <tr><td style='font-weight: bold;'>Localitate</td><td>".$localitate_contaractant."</td></tr>
			 <tr><td style='font-weight: bold;'>Strada</td><td>".$strada_contaractant."</td></tr>
			 <tr><td style='font-weight: bold;'>Nr. Strada</td><td>".$nr_strada_contaractant."</td></tr>
			 <tr><td style='font-weight: bold;'>Bloc</td><td>".$bloc_contaractant."</td></tr>
			 <tr><td style='font-weight: bold;'>Scara</td><td>".$scara_contaractant."</td></tr>
			 <tr><td style='font-weight: bold;'>Etaj</td><td>".$etaj_adresa_contaractant."</td></tr>
			 <tr><td style='font-weight: bold;'>Apartament</td><td>".$apartament_contaractant."</td></tr>
			 <tr><td style='font-weight: bold;'>Cod Postal</td><td>".$cod_postal_contaractant."</td></tr>
			 <tr><td style='font-weight: bold;'>Telefon</td><td>".$telefon_contaractant."</td></tr>
			 <tr><td style='font-weight: bold;'>Email</td><td>".$email_contaractant."</td></tr>
			 ";
				$table_date_asigurat.="</table>";}

			if($contractantul_asigurat == "identic"){

       $table_date_asigurat.= " <br><br><br>";
	   
 $table_date_asigurat.= "<table border='2' style='border: 2px solid #c1d72a;' cellpadding='6' cellspacing='3' width='70%' >";
			$table_date_asigurat.= "
       <tr><td colspan='2' style='font-weight: bold; background: #c1d72a; color: #363c39;'><h3>3. Datele despre contractant sunt la fel ca datele asiguratului</h3></td></tr>
			 ";
			 $table_date_asigurat.="</table>";
			
			  }

			


			///////////////////////////////////////////////////






			//////////////////////Reprezentant legal

$varsta_asigurat_test=stripcleantohtml($_POST['varsta_asigurat_test']);

	if ($varsta_asigurat_test < 18) {
//////////////////////////////////////
$table_date_asigurat.= " <br><br><br>";
$table_date_asigurat.= "<table border='2' style='border: 2px solid #c1d72a;' cellpadding='6' cellspacing='3' width='70%' >";
$table_date_asigurat.= "
<tr><td colspan='2' style='font-weight: bold; background: #c1d72a; color: #363c39;'><h2>4. Date despre reprezentantul legal</h2></td></tr>
<tr><td style='font-weight: bold;    width:70%;'>Nume</td><td>".$nume_reprezentant."</td></tr>
<tr><td style='font-weight: bold;'>Prenume</td><td>".$prenume_reprezentant."</td></tr>
<tr><td style='font-weight: bold;'>CNP</td><td>".$cnp_reprezentant."</td></tr>
";
	$table_date_asigurat.="</table>"; }
			//////////Starea de sanatate

			//-----------------------------------------//


			if ($asigurat_fumator=="DA")
			{

					// $t_nr_tigari="<th>Nr tigari</th>";
					// $ts_nr_tigari="<td>".$nr_tigari."</td>";

          $t_nr_tigari="<tr><td style='font-weight: bold;    width:70%;'>Nr tigari</td><td  >".$nr_tigari."</td></tr>";


			}

			if ($asigurat_fumator=="NU")
			{
				$asigurat_fumator = "NU";
			}


			//-----------------------------------------//
// 			$table_sanatate_asigurat .= "<h1>5. Informatii privind starea de sanatate a Asiguratului</h1>";
// 			$table_sanatate_asigurat .= "<table border='1' cellpadding='1' cellspacing='1' width='100%'><tr><th>Fumator</th>".$t_nr_tigari."<th>Narcotice</th><th>Consum_cronic alcool</th></tr>";
//             $table_sanatate_asigurat .= "<tr><td>" . $asigurat_fumator . "</td>" . $ts_nr_tigari . "<td>" . $asigurat_narcotice . "</td><td>" . $asigurat_consum_cronic_alcool . "</td></tr></table>";
// /////////////////////
$table_sanatate_asigurat.= "<br><br><br>";
 $table_sanatate_asigurat.= "<table border='2' style='border: 2px solid #c1d72a;' cellpadding='6' cellspacing='3' width='70%' >";
 $table_sanatate_asigurat.= "
 <tr><td colspan='2' style='font-weight: bold; background: #c1d72a; color: #363c39;'><h3>5. Informatii privind starea de sanatate a Asiguratului</h3></td></tr>
 <tr><td style='font-weight: bold;    width:70%;'>Fumator</td><td  >".$asigurat_fumator."</td></tr>
 ".$t_nr_tigari."
  <tr><td style='font-weight: bold;    width:70%;'>Narcotice</td><td  >".$asigurat_narcotice."</td></tr>
 <tr><td style='font-weight: bold;'>Consum_cronic alcool</td><td  >".$asigurat_consum_cronic_alcool."</td></tr>
  ";

///////////////////////

			//1//
			//  $table_sanatate_asigurat .= "<table border='1' cellpadding='1' cellspacing='1' width='100%' style ='margin-top:30px'>

			  // $table_sanatate_asigurat.= "<br><br><br>";
        // $table_sanatate_asigurat.= "<table border='2' style='border: 2px solid #c1d72a;' cellpadding='6' cellspacing='3' width='70%' >";
         $table_sanatate_asigurat.= "<tr><td style='font-weight: bold;    width:70%;'> 1.  Afectiuni cardiovascualre: infarct miocardic/ accident vascular cerebral </td><td>".$asigurat_infarct."</td></tr>";

				if($asigurat_infarct == "DA") {

			 $table_sanatate_asigurat .= "<tr><td style='      width:70%;'>Infarct multiplu</td><td>".$asigurat_infarct_multiple."</td></tr>
			  <tr><td style='      width:70%;'>Diagnostic infarct ultimul an</td><td>".$asigurat_diagnostic_infarct_ultimul_an."</td></tr>
			 <tr><td style='  '>Diabet</td><td>".$asigurat_diabet."</td></tr>
			 <tr><td style='  '>Angioplastie</td><td>".$asigurat_angioplastie."</td></tr>
			 <tr><td style='  '>Alte afectiuni cardiace</td><td>".$asigurat_alte_afectiuni_cardiace."</td></tr>
			 <tr><td style='  '>Insuficienta cardiaca</td><td>".$asigurat_insuficienta_cardiaca."</td></tr>
			 <tr><td style='  '>Sidrom adam stokes</td><td>".$asigurat_sidrom_adam_stokes."</td></tr>
			 <tr><td style='  '>Cardiopatie</td><td>".$asigurat_cardiopatie."</td></tr>
			 <tr><td style='  '>Afectiuni valvulare</td><td>".$asigurat_afectiuni_valvulare."</td></tr>
			 <tr><td style='  '>Hipertensiune</td><td>".$asigurat_hipertensiune."</td></tr>
			 <tr><td style='  '>Miocardita</td><td>".$asigurat_miocardita."</td></tr>
			 <tr><td style='  '>Pericardita</td><td>".$asigurat_pericardita."</td></tr>
			 <tr><td style='  '>Fabriatie</td><td>".$asigurat_fabriatie."</td></tr>
			 <tr><td style='  '>Tehicardie</td><td>".$asigurat_tehicardie."</td></tr>
			 <tr><td style='  '>Bradicardie</td><td>".$asigurat_bradicardie."</td></tr>
			 <tr><td style='  '>Bloc ramura stanta</td><td>".$asigurat_bloc_ramura_stanta."</td></tr>
			 <tr><td style='  '>Bloc atrio venticular</td><td>".$asigurat_bloc_atrio_venticular."</td></tr>
			 <tr><td style='  '>Hipertrofie</td><td>".$asigurat_hipertrofie."</td></tr>
			 <tr><td style='  '>Arterita</td><td>".$asigurat_arterita."</td></tr>
			 <tr><td style='  '>Cardiopatie</td><td>".$asigurat_cardiopatie."</td></tr>
			 <tr><td style='  '>Tromboflebita</td><td>".$asigurat_tromboflebita."</td></tr>
			 <tr><td style='  '>Malformatie alteriovenoasa</td><td>".$asigurat_malformatie_alteriovenoasa."</td></tr>
			 <tr><td style='  '>Anevrism arterial</td><td>".$asigurat_anevrism_arterial."</td></tr>";

				}



			 //2//


			 $table_sanatate_asigurat.= "<tr><td style='font-weight: bold;    width:70%;'> 2.  Afectiuni respiratorii: tuberculoza activa, astm bronsic, insuficienta respiratorie, bronsita cronica, emfizem pulmonar </td><td>".$asigurat_afectiuni_respiratorii."</td></tr>";

				if($asigurat_afectiuni_respiratorii == "DA") {

			 $table_sanatate_asigurat .= "<td style='      width:70%;'>Tuberculoza activa</td><td>".$asigurat_tuberculoza_activa."</td></tr>
			 <tr><td style='  '>Insuficienta respiratorie</td><td>".$asigurat_insuficienta_respiratorie."</td></tr>
			 <tr><td style='  '>Astm bronsic</td><td>".$asigurat_astm_bronsic."</td></tr>
			 <tr><td style='  '>Emfizem pulmonar</td><td>".$asigurat_emfizem_pulmonar."</td></tr>
			 <tr><td style='  '>Bronsita cronica</td><td>".$asigurat_bronsita_cronica."</td></tr>";
				}



				 //3//



			 $table_sanatate_asigurat.= "<tr><td style='font-weight: bold;    width:70%;'> 3.  Afectiuni digestive: ciroza hepatica, hepatita cronica, reflux gastroesofagian, ulcer gastric, ulcer duodenal, litiaza biliara, pancreatita cronica, rectocolita ulcero-hemoragica, boala Crohn, diverticuloza colonica </td><td>".$asigurat_afectiuni_digestive."</td></tr>";

				if($asigurat_afectiuni_digestive == "DA") {

			 $table_sanatate_asigurat .= "<td style='      width:70%;'>Ciroza hepatica</td><td>".$asigurat_ciroza_hepatica."</td></tr>
			 <tr><td style='  '>Hepatita cronica</td><td>".$asigurat_hepatita_cronica."</td></tr>
			 <tr><td style='  '>Reflux gastroesofagian</td><td>".$asigurat_reflux_gastroesofagian."</td></tr>
			 <tr><td style='  '>Ulcer gastric</td><td>".$asigurat_ulcer_gastric."</td></tr>
			 <tr><td style='  '>Ulcer duodenal</td><td>".$asigurat_ulcer_duodenal."</td></tr>
			 <tr><td style='  '>Litiza biliara</td><td>".$asigurat_litiza_biliara."</td></tr>
			 <tr><td style='  '>Pancreatita cronica</td><td>".$asigurat_pancreatita_cronica."</td></tr>
			 <tr><td style='  '>Rectocolita ulcero hemoragiga</td><td>".$asigurat_rectocolita_ulcero_hemoragiga."</td></tr>
			 <tr><td style='  '>Boala crohn</td><td>".$asigurat_boala_crohn."</td></tr>
			 <tr><td style='  '>Diverticuloza colonica</td><td>".$asigurat_diverticuloza_colonica."</td></tr>";

				}



			 //4//



			 $table_sanatate_asigurat.= "<tr><td style='font-weight: bold;    width:70%;'> 4.  Boli metabolice si de nutritie </td><td>".$asigurat_boli_metabolice."</td></tr>";

				if($asigurat_boli_metabolice == "DA") {

			 $table_sanatate_asigurat .= "<td style='     width:70%;'>Diabet zaharat complicat</td><td>".$asigurat_diabet_zaharat_complicat."</td></tr>";

				if($asigurat_diabet_zaharat_complicat == "DA") {

			 $table_sanatate_asigurat .= "   <tr><td style='      width:70%;'>Retinopatie diabetica</td><td>".$asigurat_retinopatie_diabetica."</td></tr>
			 <tr><td style='  '>Nefropatie</td><td>".$asigurat_nefropatie."</td></tr>
			 <tr><td style='  '>Neuropatie</td><td>".$asigurat_neuropatie."</td></tr>
			 <tr><td style='  '>Cardiopatie ischemica</td><td>".$asigurat_cardiopatie_ischemica."</td></tr>
			 <tr><td style='  '>Hipertensiune arteriala</td><td>".$asigurat_hipertensiune_arteriala."</td></tr>
			 <tr><td style='  '>Metabolice infarct miocardic</td><td>".$asigurat_metabolice_infarct_miocardic."</td></tr>
			 <tr><td style='  '>Metabolice accident vascular</td><td>".$asigurat_metabolice_accident_vascular."</td></tr>
			 <tr><td style='  '>Proteinurie</td><td>".$asigurat_proteinurie."</td></tr>
			 <tr><td style='  '>Metabolice insuficienta renala</td><td>".$asigurat_metabolice_insuficienta_renala."</td></tr>";
				}

			 $table_sanatate_asigurat .= "<td style='      width:70%;'>Obezitatea</td><td>".$asigurat_obezitatea."</td></tr>
			 <tr><td style='  '>Guta</td><td>".$asigurat_guta."</td></tr>
			 <tr><td style='  '>Sidrom metabolic</td><td>".$asigurat_sidrom_metabolic."</td></tr>";

				}




			  //5//



			 $table_sanatate_asigurat.= "<tr><td style='font-weight: bold;    width:70%;'> 5.  Afectiuni endocrine : hipertiroidie (boala Basadow-Graves), tiroidita cronica, gusa nodulara, sindrom Cushing, boala Addison  </td><td>".$asigurat_afectiuni_digestive."</td></tr>";

				if($asigurat_afectiuni_digestive == "DA") {

			 $table_sanatate_asigurat .= "<td style='      width:70%;'>Afectiuni endocrine</td><td>".$asigurat_afectiuni_endocrine."</td></tr>
			 <tr><td style='  '>Hipertiroidie</td><td>".$asigurat_hipertiroidie."</td></tr>
			 <tr><td style='  '>Tiroidita cronica</td><td>".$asigurat_tiroidita_cronica."</td></tr>
			 <tr><td style='  '>Gusa nodulara</td><td>".$asigurat_gusa_nodulara."</td></tr>
			 <tr><td style='  '>Sindrom cushing</td><td>".$asigurat_sindrom_cushing."</td></tr>
			 <tr><td style='  '>Boala addison</td><td>".$asigurat_boala_addison."</td></tr>";

				}





			  //6//



			 $table_sanatate_asigurat.= "<tr><td style='font-weight: bold;    width:70%;'> 6.  Afectiuni ereditare : fibroza chistica, boala Wilson  </td><td>".$asigurat_afectiuni_ereditare."</td></tr>";

				if($asigurat_afectiuni_ereditare == "DA") {

			 $table_sanatate_asigurat.= " <tr><td style='      width:70%;'>Fobroza chistica</td><td>".$asigurat_fobroza_chistica."</td></tr>
			 <tr><td style='  '>Boala wilson</td><td>".$asigurat_boala_wilson."</td></tr>";

				}



			 //7//



			 $table_sanatate_asigurat.= "<tr><td style='font-weight: bold;    width:70%;'> 7.  Afectiuni hematologice/ ale sangelui : hemofilie, anemie hemolitica, trombofilie, leucemie  </td><td>".$asigurat_afectiuni_hematologice."</td></tr>";

				if($asigurat_afectiuni_hematologice == "DA") {

			 $table_sanatate_asigurat.= " <tr><td style='      width:70%;'>Hemofilie</td><td>".$asigurat_hemofilie."</td></tr>
			 <tr><td style='  '>Leucemie</td><td>".$asigurat_leucemie."</td></tr>
			 <tr><td style='  '>Anemie hemolitica</td><td>".$asigurat_anemie_hemolitica."</td></tr>
			 <tr><td style='  '>Trombofilie</td><td>".$asigurat_trombofilie."</td></tr>";

				}



			//8//



			 $table_sanatate_asigurat.= "<tr><td style='font-weight: bold;    width:70%;'> 8.  Tumori maligne/cancer(diagnosticat in ultimi 5 ani) </td><td>".$asigurat_tumori_cancer."</td></tr>";

				if($asigurat_tumori_cancer == "DA") {

			 $table_sanatate_asigurat .= "
			  <tr><td style='      width:70%;'>Hiv/Sida</td><td>".$asigurat_limfom."</td></tr>
			 <tr><td style='  '>Boala hodgkin</td><td>".$asigurat_boala_hodgkin."</td></tr>
			 <tr><td style='  '>Tumori maligne</td><td>".$asigurat_tumori_maligne."</td></tr>
			";

				}



			 //9//



			 $table_sanatate_asigurat.= "<tr><td style='font-weight: bold;    width:70%;'> 9.  Boli infectioase: infectie HIV/SIDA, tuberculoza activa </td><td>".$asigurat_boli_infectioase."</td></tr>";

				if($asigurat_boli_infectioase == "DA") {

			 $table_sanatate_asigurat .= "
			  <tr><td style='      width:70%;'>Hiv/Sida</td><td>".$asigurat_hiv_sida."</td></tr>
			 <tr><td style='  '>Infectioase tuberculoza activa</td><td>".$asigurat_infectioase_tuberculoza_activa."</td></tr>
			 ";

				}



			  //10//



			 $table_sanatate_asigurat.= "<tr><td style='font-weight: bold;    width:70%;'> 10.  Afectiuni neurologice: encefalopatia cronica infantila, parapareza, tetrapareza, epilepsie, migrena, boala Parkinson, scleroza multipla </td><td>".$asigurat_afectiuni_neurologice."</td></tr>";

				if($asigurat_afectiuni_neurologice == "DA") {

			 $table_sanatate_asigurat .= "
			  <tr><td style='      width:70%;'>Encefalopatia</td><td>".$asigurat_encefalopatia."</td></tr>
			 <tr><td style='  '>Tetrapareza</td><td>".$asigurat_tetrapareza."</td></tr>
			 <tr><td style='  '>Epilepsie</td><td>".$asigurat_epilepsie."</td></tr>
			 <tr><td style='  '>Parapareza</td><td>".$asigurat_parapareza."</td></tr>
			 <tr><td style='  '>Migrena</td><td>".$asigurat_migrena."</td></tr>
			 <tr><td style='  '>Parkinson</td><td>".$asigurat_parkinson."</td></tr>
			 <tr><td style='  '>Scleroza multipla</td><td>".$asigurat_scleroza_multipla."</td></tr>
			 ";

				}



			//11//



			 $table_sanatate_asigurat.= "<tr><td style='font-weight: bold;    width:70%;'> 11.  Afectiuni psihice: schizofrenia, tulburare afectiva bipolare, tulburare somatofoma, depresie </td><td>".$asigurat_afectiuni_psihice."</td></tr>";

				if($asigurat_afectiuni_psihice == "DA") {

			 $table_sanatate_asigurat .= "
			   <tr><td style='      width:70%;'>Schizofrenia</td><td>".$asigurat_schizofrenia."</td></tr>
			 <tr><td style='  '>Tulburare afectiva bipolare</td><td>".$asigurat_tulburare_afectiva_bipolare."</td></tr>
			 <tr><td style='  '>Tulburare somatofoma</td><td>".$asigurat_tulburare_somatofoma."</td></tr>
			 <tr><td style='  '>Depresie</td><td>".$asigurat_depresie."</td></tr>
			 ";

				}



			//12//



			 $table_sanatate_asigurat.= "<tr><td style='font-weight: bold;    width:70%;'> 12.  Afectiuni O.R.L.: otita cronica, sinuzita cronica </td><td>".$asigurat_afectiuni_orl."</td></tr>";

				if($asigurat_afectiuni_orl == "DA") {

			 $table_sanatate_asigurat .= "
			   <tr><td style='      width:70%;'>Otita cronica</td><td>".$asigurat_otita_cronica."</td></tr>
			 <tr><td style='  '>Sinuzita cronica</td><td>".$asigurat_sinuzita_cronica."</td></tr>
			 ";

				}



			//13//



			 $table_sanatate_asigurat.= "<tr><td style='font-weight: bold;    width:70%;'> 13.  Afectiuni oftalmologice: glaucom, retinopatie pigmentara, cataracta </td><td>".$asigurat_afectiuni_oftalmologice."</td></tr>";

				if($asigurat_afectiuni_oftalmologice == "DA") {

			 $table_sanatate_asigurat .= "
			   <tr><td style='      width:70%;'>Glaucom</td><td>".$asigurat_glaucom."</td></tr>
			 <tr><td style='  '>Retinopatie pigmentara</td><td>".$asigurat_retinopatie_pigmentara."</td></tr>
			 <tr><td style='  '>Cataracta</td><td>".$asigurat_cataracta."</td></tr>
			 ";

				}



			//14//



			 $table_sanatate_asigurat.= "<tr><td style='font-weight: bold;    width:70%;'> 14.  Afectiuni reumatica si osteoarticulare: polialtrita reumatoida, lupus eritamatos sistematic, spondilodiscopatia, hernie de disc, osteoartrita, osteopenie / osteoporoza </td><td>".$asigurat_afectiuni_reumatica."</td></tr>";

				if($asigurat_afectiuni_reumatica == "DA") {

			 $table_sanatate_asigurat .= "
			   <tr><td style='      width:70%;'>Polialtrita reumatoida</td><td>".$asigurat_polialtrita_reumatoida."</td></tr>
			 <tr><td style='  '>Lupus eritamatos sistematic</td><td>".$asigurat_lupus_eritamatos_sistematic."</td></tr>
			 <tr><td style='  '>Reumatice artrita cronica</td><td>".$asigurat_reumatice_artrita_cronica."</td></tr>
			 <tr><td style='  '>Osteopenie osteoporoza</td><td>".$asigurat_osteopenie_osteoporoza."</td></tr>
			 <tr><td style='  '>Spondilodiscopatia</td><td>".$asigurat_spondilodiscopatia."</td></tr>
			 <tr><td style='  '>Hernie de disc</td><td>".$asigurat_hernie_de_disc."</td></tr>
			 <tr><td style='  '>Osterioartrita</td><td>".$asigurat_osterioartrita."</td></tr>
			 ";

				}



			//15//



			 $table_sanatate_asigurat.= "<tr><td style='font-weight: bold;    width:70%;'> 15.  Afectiuni renale si ale cailor urinare: insuficienta renala cronica, litiza renala, pielonefrita cronica, glomerulonefrita, sindrom nefrotic, ureterohidronefroza, sitenoza uretrala </td><td>".$asigurat_afectiuni_renala."</td></tr>";

				if($asigurat_afectiuni_renala == "DA") {

			 $table_sanatate_asigurat .= "
			   <tr><td style='      width:70%;'>Insuficienta renala cronica</td><td>".$asigurat_insuficienta_renala_cronica."</td></tr>
			 <tr><td style='  '>Litiza renala</td><td>".$asigurat_litiza_renala."</td></tr>
			 <tr><td style='  '>Pielonefrita cronica</td><td>".$asigurat_pielonefrita_cronica."</td></tr>
			 <tr><td style='  '>Glomerulonefrita</td><td>".$asigurat_glomerulonefrita."</td></tr>
			 <tr><td style='  '>Sindrom nefrotic</td><td>".$asigurat_sindrom_nefrotic."</td></tr>
			 <tr><td style='  '>Ureterohidronefroza</td><td>".$asigurat_ureterohidronefroza."</td></tr>
			 <tr><td style='  '>Sitenoza uretrala</td><td>".$asigurat_sitenoza_uretrala."</td></tr>
			 ";

				}



			//16//



			 $table_sanatate_asigurat.= "<tr><td style='font-weight: bold;    width:70%;'> 16.  Afectiuni ale prostatei adenom al prostatei. </td><td>".$asigurat_afectiuni_prostata."</td></tr>";



			//17//



			 $table_sanatate_asigurat.= "<tr><td style='font-weight: bold;    width:70%;'> 17.  Afectiuni ginecologice infectie HPV, cervicita cronica, fibromatoza uterina, endometrioza, mastopatia fibrochistica, nodul mamar, boala inflamatorie pelvina, anexita cronica </td><td>".$asigurat_afectiuni_ginecologice."</td></tr>";

				if($asigurat_afectiuni_ginecologice == "DA") {

			 $table_sanatate_asigurat .= "
			   <tr><td style='      width:70%;'>Infectie hpv</td><td>".$asigurat_infectie_hpv."</td></tr>
			 <tr><td style='  '>Cervicita cronica</td><td>".$asigurat_cervicita_cronica."</td></tr>
			 <tr><td style='  '>Fibromatoza uterina</td><td>".$asigurat_fibromatoza_uterina."</td></tr>
			 <tr><td style='  '>Endometrioza</td><td>".$asigurat_endometrioza."</td></tr>
			 <tr><td style='  '>Mastopatia fibrochistica</td><td>".$asigurat_mastopatia_fibrochistica."</td></tr>
			 <tr><td style='  '>Boala inflamatorie pelvina</td><td>".$asigurat_boala_inflamatorie_pelvina."</td></tr>
			 <tr><td style='  '>Anexita cronica</td><td>".$asigurat_anexita_cronica."</td></tr>
			 <tr><td style='  '>Nodul mamar</td><td>".$asigurat_nodul_mamar."</td></tr>
			 ";

				}

			
			 
			 //18 Afetiuni pre-existente//



			 $table_sanatate_asigurat.= "<tr><td style='font-weight: bold;    width:70%;'> Afecțiuni Pre-existente </td><td>".$asigurat_afectiuni_preexistente."</td></tr>";

				if($asigurat_afectiuni_preexistente == "DA") {

			 $table_sanatate_asigurat .= "<tr><td style='width:70%;'>Afectiuni</td><td>".$asigurat_afectiuni_preexistente_text."</td></tr>";

				}

			 $table_sanatate_asigurat.="</table>";

			/////////////////////////////////////////////////////////////
			//Date despre asigurare//

			 $table_sanatate_asigurat.= "<br><br><br>";
$table_sanatate_asigurat.= "<table border='2' style='border: 2px solid #c1d72a;' cellpadding='6' cellspacing='3' width='70%' >";



 $table_sanatate_asigurat.= "<tr><td colspan='2' style='font-weight: bold; background: #c1d72a; color: #363c39;'><h3>Date despre asigurare</h3></td></tr>";

			 $table_sanatate_asigurat .= "
			   <tr><td style='font-weight: bold;    width:70%;'>Perioada de asigurare</td><td>".$perioada_de_asigurare."</td></tr>
			 <tr><td style='font-weight: bold;'>Frecventa de plata a primei</td><td>".$frecventa_plata."</td></tr>
			 <tr><td style='font-weight: bold;'>Moneda</td><td>".$moneda."</td></tr>
			 <tr><td style='font-weight: bold;'>Data valabilitate start</td><td>".$data_valabilitate_start."</td></tr>
			 <tr><td style='font-weight: bold;'>Acoperire internationala</td><td>".$acoperire_internationala."</td></tr>
			 <tr><td style='font-weight: bold;'>Clauza Spitalizare si interventii chirurgicale</td><td>".$clauza_spitalizare."</td></tr>
			 <tr><td style='font-weight: bold;'>Clauza preventie</td><td>".$clauza_preventie."</td></tr>
			 <tr><td style='font-weight: bold;'>Clauza ambulatorie pentru copii</td><td>".$clauza_ambulatorie_pentru_copii."</td></tr>
			 <tr><td style='font-weight: bold;'>Clauza specializare si interventii chirurgicale pentru copii</td><td>".$asigurat_nodul_mamar."</td></tr>
			 ";

			 $table_sanatate_asigurat.="</table>";
			//////////////////////////////////////////////
			// Copii //

      $table_sanatate_asigurat_copil.= "<br><br><br>";
$table_sanatate_asigurat_copil.= "<table border='2' style='border: 2px solid #c1d72a;' cellpadding='6' cellspacing='3' width='70%' >";




			$table_sanatate_asigurat_copil .= " <tr><td style='font-weight: bold; background: #c1d72a; color: #363c39; width:70%;'><h3>Doriti sa includeti si copii in asigurare?</h3></td><td>".$copii_inclusi."</td></tr>";

			if($copii_inclusi == "DA") {

		//	if ($nr_copii_inclusi == 1){

					  for($i=1; $i<=$text_nr; $i++){


			 $table_sanatate_asigurat_copil .= "
			 <tr><h3>Copil ".$i."</h3></tr>";

			 $table_sanatate_asigurat_copil .= "
			  <tr><td style='font-weight: bold;    width:70%;'>Nume</td><td>".$nume_copil[$i]."</td></tr>
			 <tr><td style='font-weight: bold;'>Prenume</td><td>".$prenume_copil[$i]."</td></tr>
			 <tr><td style='font-weight: bold;'>CNP</td><td>".$cnp_copil[$i]."</td></tr>
			 <tr><td style='font-weight: bold;'>Data nasterii</td><td>".$data_nasterii_copil[$i]."</td></tr>

			  <tr><td style='font-weight: bold;    width:70%;'> 1. Defecte congenitale ale cordonului: tetralogie/ trilogie/ pentalogie/ heaxalogie Fallot, transpozitie a vaselor mari,anomalie Ebstein, defect septal atrial de tip ostium primum, coarctatie de aorta, persistenta a canalului arterial, defect septal venticular. </td><td>".$copii_defect_congenital_[$i]."</td></tr>
			  <tr><td style='font-weight: bold;    width:70%;'> 2. Afectiuni respiratorii: insuficienta respiratorie</td><td>".$copii_insuficienta_respiratorie_[$i]."</td></tr>
			  <tr><td style='font-weight: bold;    width:70%;'> 3. Afectiuni digestive: ciroza hepatica, atrezie esofagiana, atrezie intestinala, megacolon congenital
			 </td><td>".$copii_afectiuni_digestive_[$i]."</td></tr>";

				if ($copii_afectiuni_digestive_[$i] == "DA"){

					 $table_sanatate_asigurat_copil .= "
			   <tr><td style='     width:70%;'>Ciroza hepatica</td><td>".$copii_ciroza_hepatica_[$i]."</td></tr>
			 <tr><td style=' '> Atrezie esofagiana</td><td>".$copii_atrezie_esofagiana_[$i]."</td></tr>
			 <tr><td style=' '>Atrezie intestinala</td><td>".$copii_atrezie_intestinala_da_[$i]."</td></tr>
			 <tr><td style=' '>Megacolon congenital</td><td>".$copii_megacolon_congenital_[$i]."</td></tr>";

			}

		      $table_sanatate_asigurat_copil .= "<tr><td style='font-weight: bold;    width:70%;'> 4. Boli metabolice si de nutritie: diabet zaharat
			 </td><td>".$copii_boli_metabolice_[$i]."</td></tr>";
			  $table_sanatate_asigurat_copil .= "<tr><td style='font-weight: bold;    width:70%;'> 5. Afectiuni ereditare si anomalii cromozomiale: fibroza chistica, sidromul Down.
			 </td><td>".$copii_afectiuni_ereditale_[$i]."</td></tr>";

			if ($copii_afectiuni_ereditale_[$i] == "DA"){

					 $table_sanatate_asigurat_copil .= "
			   <tr><td style='     width:70%;'>Fibroza chistica</td><td>".$copii_fibroza_chistica_[$i]."</td></tr>
			 <tr><td style=' '> Sidromul Down</td><td>".$copii_sidromul_down_[$i]."</td></tr>";

			}

			 $table_sanatate_asigurat_copil .= "<tr><td style='font-weight: bold;    width:70%;'> 6. Afectiuni hematologice/ale sangelui: hernofilie, leucemie.
			 </td><td>".$copii_afectiuni_hematologice_[$i]."</td></tr>";

			 if ($copii_afectiuni_hematologice_[$i] == "DA"){

					 $table_sanatate_asigurat_copil .= "
			   <tr><td style='     width:70%;'>Hernofilie</td><td>".$copii_hernofilie_[$i]."</td></tr>
			  <tr><td style='     width:70%;'>Leucemie</td><td>".$copii_leucemie_[$i]."</td></tr>";

			}

			 $table_sanatate_asigurat_copil .= "<tr><td style='font-weight: bold;    width:70%;'>7. Tumori maligne/cancer: limfom non-Holdgkin, boala Holdgkin, tumori maligne (retinoblasom, nefroblastom, neuroblastom, hepatobastom, teratom, adenocarcinom, sarcom, melanom)
			 </td><td>".$copii_afectiuni_tumori_[$i]."</td></tr>";

			 if ($copii_afectiuni_tumori_[$i] == "DA"){

					 $table_sanatate_asigurat_copil .= "
			  <tr><td style='     width:70%;'>Limfom non-Holdgkin</td><td>".$copii_limfom_non_holdgkin_[$i]."</td></tr>
			 <tr><td style=' '>Boala Holdgkin</td><td>".$copii_boala_holdgkin_[$i]."</td></tr>
			 <tr><td style=' '>Tumori maligne</td><td>".$copii_tumori_maligne_[$i]."</td></tr>";

			}

			  $table_sanatate_asigurat_copil .= "<tr><td style='font-weight: bold;    width:70%;'>8. Boli infectioase: infectie HIV/SIDA, tuberculoza activa
			 </td><td>".$copii_afectiuni_infectioase_[$i]."</td></tr>";

			 if ($copii_afectiuni_infectioase_[$i] == "DA"){

					 $table_sanatate_asigurat_copil .= "
			  <tr><td style='     width:70%;'>Infectie HIV/SIDA</td><td>".$copii_hiv_sida_[$i]."</td></tr>
			 <tr><td style=' '>Tuberculoza activa</td><td>".$copii_tuberculoza_activa_[$i]."</td></tr>
			 ";

			}

			  $table_sanatate_asigurat_copil .= "<tr><td style='font-weight: bold;    width:70%;'>9. Afectiuni neurologice: ecefalopatie cronica infantila, tetrapareza, epilepsie
			 </td><td>".$copii_afectiuni_neurologice_[$i]."</td></tr>";

			 if ($copii_afectiuni_neurologice_[$i] == "DA"){

					 $table_sanatate_asigurat_copil .= "
			  <tr><td style='     width:70%;'>Ecefalopatie cronica infantila</td><td>".$copii_ecefalopatie_cronica_infantila_[$i]."</td></tr>
			 <tr><td style=' '>Tetrapareza</td><td>".$copii_tetrapareza_[$i]."</td></tr>
			 <tr><td style=' '>Epilepsie</td><td>".$copii_epilepsie_[$i]."</td></tr>";

			}

			   $table_sanatate_asigurat_copil .= "<tr><td style='font-weight: bold;    width:70%;'>10. Afectiuni osteoarticulare: artrita reumatoida juvenila, boala Lobstein.
			 </td><td>".$copii_afectiuni_osteoarticulare_[$i]."</td></tr>";

			 if ($copii_afectiuni_osteoarticulare_[$i] == "DA"){

					 $table_sanatate_asigurat_copil .= "
			  <tr><td style='     width:70%;'>Artrita reumatoida juvenila</td><td>".$copii_artrita_reumatoida_juvenila_[$i]."</td></tr>
			 <tr><td style=' '>Boala Lobstein</td><td>".$copii_boala_lobstein_[$i]."</td></tr>
			 ";

			}

			  $table_sanatate_asigurat_copil .= "<tr><td style='font-weight: bold;    width:70%;'>11. Afectiuni renale: insuficienta renala cronica.
			 </td><td>".$copii_afectiuni_renale_[$i]."</td></tr>";

				}



}
	 $table_sanatate_asigurat_copil.="</table>";





















			 /////////////////////////


			$nume_companie = "Transilvania Broker Sibiu";


$mesaj = "<div style='font-size:22px;color:#c1d72a;'><h1>Comanda dumneavoastra pentru Oferta de Asigurare Sanatate a fost inregistrata!<u></u><u></u></h1></div>
<span class='im' style='font-size:14px; font-style: italic;'><p>Pentru comenzile plasate dupa ora 18:00 pana la ora 07:00 a celei de a doua zi, personalul nostru o sa va contacteze in dimineata urmatoare incepand cu ora 07:00<u></u><u></u></p><p>In cazul in care constatati ca datele introduse sunt incorecte, va rugam sa ne instiintati pe e-mail la adresa <a href='mailto:sibiu@transilvaniabroker.ro' target='_blank'>sibiu@transilvaniabroker.ro</a> <u></u><u></u></p></span><?php echo $notificare; ?><br> ";


            include("class.phpmailer.php");

			$contacts = array($destinatar,$email);
			foreach($contacts as $contact) {

            $mail    = new PHPMailer();
		//	$mail->IsSMTP();

			$subject = "Comanda dumneavoastra pentru Oferta de Asigurare Sanatate a fost inregistrata!";

			if (!isValidEmail($destinatar))
                $email_to = $contact_email;
            else
                $email_to = $contact;


	$mail->Host = "mail.transilvaniabroker.ro";
			$email_from="sibiu@transilvaniabroker.ro";
            $mail->From     = $email_from;
            $mail->FromName = $nume_companie;
            $mail->AddReplyTo($email_from, 'Reply to ' . $nume_companie);
            $mail->AddAddress($email_to, "Transilvania Broker Sibiu");


            $mail->Subject = $subject;
            $mail->Body    =  $mesaj . $table_date_asigurat . $table_sanatate_asigurat .$table_sanatate_asigurat_copil;
            $mail->IsHTML(true);
            $mail->Send();
            $send = 1;
			}
        }
    }
} else {
    if (!isset($_SESSION[@$form . '_token'])) {
    } else {
        echo "Hack-Attempt detected. Got ya!.";
        writeLog('Formtoken');
    }
}
$newToken = generateFormToken('formular_calatorii');
if ($message_error != '')
    echo '<div class="rowElem form_error_el" style="padding:10px;">' . $message_error . '</div>';
if (@$send == 1){
  //  echo "<p style='padding-top:5px; font-weight:bold; color:#e30000;'>Datele au fost trimise. Va vom contacta in cel mai scurt timp posibil.</p>";
	include("parts/popup.php");

	   ?>
<script type="text/javascript">
$(document).ready(function () {
    window.setTimeout(function () {
        location.href = "https://www.transilvaniabrokersibiu.ro";
    }, 2000);
});
</script>
    <?php
}

?>


<form action="" method="POST" id="formular_calatorii">
    <div class="bullet">
            Date despre Asigurat
          </div>
   <div class="clear"></div>
        <div class="rowElem" id="nume-div" style="float:left;width:49%;">
            <span>Nume</span><?php echo $notificare; ?><br>
            <input id="nume" type="text" name="nume" value="<?php echo $nume; ?>" />
		    <div id="nume-tip" class="jFormerTip">
				
		    </div>
    </div>

    <div class="rowElem" id="prenume-div" style="float:right;width:49%;">
            <span>Prenume</span><?php echo $notificare; ?><br>
            <input id="Prenume" type="text" name="prenume" value="<?php echo $prenume; ?>" />
		    <div id="prenume-tip" class="jFormerTip">
				
		    </div>
    </div>

    <div class="rowElem" id="cnp-div" style="float:left;width:49%;">
            <span>CNP</span><?php echo $notificare; ?><br>
            <input id="cnp" type="text" name="cnp" value="<?php echo $cnp; ?>" />
		    <div id="cnp-tip" class="jFormerTip">
				
		    </div>
    </div>



   <div class="rowElem" id="data_nasterii-div" style="float:right;width:49%;">
			<span>Data nasterii:</span><?php echo $notificare; ?><br>
			<input id="data_nasterii" type="text" name="data_nasterii" value="<?php echo $data_nasterii; ?>" readonly="readonly"/>
			<div id="data_nasterii-tip" class="jFormerTip" style="margin-top:0px;">
				
			</div>
		</div>
  <div class="clear"></div>

    <div class="bullet">
            Adresa de domiciliu asigurat
          </div>
<div class="clear"></div>

   <div class="rowElem" id="judet_asigurat-div" style="float:left;width:49%;">
			<span>Judet:</span><?php echo $notificare; ?><br>
			<input id="judet_asigurat" type="text" name="judet_asigurat" value="<?php echo $judet_asigurat; ?>" />
			<div id="judet_asigurat-tip" class="jFormerTip">
				
			</div>
		</div>

   <div class="rowElem" id="localitate_asigurat-div" style="float:right;width:49%;">
			<span>Localitate:</span><?php echo $notificare; ?><br>
			<input id="localitate_asigurat" type="text" name="localitate_asigurat" value="<?php echo $localitate_asigurat; ?>" />
			<div id="localitate_asigurat-tip" class="jFormerTip">
				
			</div>
		</div>
   <div class="clear"></div>
   <div class="rowElem" id="strada_asigurat-div" style="float:left;width:49%;">
            <span>Strada</span><?php echo $notificare; ?><br>
            <input id="strada_asigurat" type="text" name="strada_asigurat" value="<?php echo $strada_asigurat; ?>" />
		    <div id="strada_asigurat-tip" class="jFormerTip">
				
		    </div>
    </div>


   <div class="rowElem" id="nr_strada_asigurat-div" style="float:right;width:49%;">
            <span>Numar strada</span><?php echo $notificare; ?><br>
            <input id="nr_strada_asigurat" type="text" name="nr_strada_asigurat" value="<?php echo $nr_strada_asigurat; ?>" />
		    <div id="nr_strada_asigurat-tip" class="jFormerTip">
				
		    </div>
    </div>
	<div class="clear"></div>
		<div class="rowElem" id="bloc_asigurat-div" style="float:left;width:18%;">
			<span>Bloc:</span><?php echo $notificare; ?><br>
			<input id="bloc_asigurat" type="text" name="bloc_asigurat" style="width:30px;" value="<?php echo $bloc_asigurat; ?>" />
			<div id="bloc_asigurat-tip" class="jFormerTip">
				
			</div>
		</div>
		<div class="rowElem" id="scara_asigurat-div" style="float:left;width:18%;">
			<span>Scara:</span><?php echo $notificare; ?><br>
			<input id="scara_asigurat" type="text" name="scara_asigurat" style="width:30px;" value="<?php echo $scara_asigurat; ?>" />
			<div id="scara_asigurat-tip" class="jFormerTip">
				
			</div>
		</div>
		<div class="rowElem" id="etaj_adresa_asigurat-div" style="float:left;width:18%;">
			<span>Etaj:</span><?php echo $notificare; ?><br>
			<input id="etaj_adresa_asigurat" type="text" name="etaj_adresa_asigurat" style="width:30px;" value="<?php echo $etaj_adresa_asigurat; ?>" />
			<div id="etaj_adresa_asigurat-tip" class="jFormerTip">
				
			</div>
		</div>
		<div class="rowElem" id="apartament_asigurat-div" style="float:left;width:18%;">
			<span>Apart:</span><?php echo $notificare; ?><br>
			<input id="apartament_asigurat" type="text" name="apartament_asigurat" style="width:30px;" value="<?php echo $apartament_asigurat; ?>" />
			<div id="apartament_asigurat-tip" class="jFormerTip">
				
			</div>
		</div>

   <div class="rowElem" id="cod_postal_asigurat-div" style="float:left;width:18%;">
			<span>Cod postal:</span><?php echo $notificare; ?><br>
			<input id="cod_postal_asigurat" type="text" name="cod_postal_asigurat" style="width:60px;" value="<?php echo $cod_postal_asigurat; ?>" />
			<div id="cod_postal_asigurat-tip" class="jFormerTip">
				
			</div>
		</div>
		<div class="clear"></div>
   <div class="rowElem" id="telefon_asigurat-div" style="float:left;width:49%;">
			<span>Telefon:</span><?php echo $notificare; ?><br>
			<input id="telefon_asigurat" type="text" name="telefon_asigurat" value="<?php echo $telefon_asigurat; ?>" />
			<div id="telefon_asigurat-tip" class="jFormerTip">
					
			</div>
		</div>

    <div class="rowElem" id="email_asigurat-div" style="float:left;width:49%;">
			<span>Email:</span><?php echo $notificare; ?><br>
			<input id="email_asigurat" type="text" name="email_asigurat" value="<?php echo $email_asigurat; ?>" />
			<div id="email_asigurat-tip" class="jFormerTip">
					
			</div>
		</div>
		<div class="clear"></div>


		 <div class="bullet">
            Adresa de corespondenta asigurat
          </div>

		  <div class="rowElem" id="asigurat_infarct" style="float:left;width:77%">
			            <i>Adresa de corespondenta este identica cu domiciliul asiguratului?</i>
		</div>


   <div class="rowElem" id="adresa_coresponenta" style="float:right;width:21%">


			Da<input type="radio" onclick="show_hide(this.value);"  id="corespondeta_identica_asigurat_da" name="corespondeta_identica_asigurat" value="corespondeta_identica_asigurat_da" checked>

			Nu<input type="radio" onclick="show_hide(this.value);"  id="corespondeta_identica_asigurat_nu" name="corespondeta_identica_asigurat" value="corespondeta_identica_asigurat_nu" >


    </div>

<div id="hide_show_adresa_c" style="display:none;">
 <!------------------------start adresa corespondenta--------------------------->

    <div class="rowElem" id="tara_corespondenta_asigurat-div" style="float:left;width:49%;">
			<span>Tara:</span><?php echo $notificare; ?><br>
			<input id="tara_corespondenta_asigurat" type="text" name="tara_corespondenta_asigurat" value="<?php echo $tara_corespondenta_asigurat; ?>" />
			<div id="tara_corespondenta_asigurat-tip" class="jFormerTip">
				
			</div>
	</div>
    <div class="rowElem" id="judet_corespondenta_asigurat-div" style="float:left;width:49%;">
			<span>Judet:</span><?php echo $notificare; ?><br>
			<input id="judet_corespondenta_asigurat" type="text" name="judet_corespondenta_asigurat" value="<?php echo $judet_corespondenta_asigurat; ?>" />
			<div id="judet_corespondenta_asigurat-tip" class="jFormerTip">
				
			</div>
	</div>
    <div class="rowElem" id="localitate_corespondenta_asigurat-div" style="float:left;width:49%;">
			<span>Localitate:</span><?php echo $notificare; ?><br>
			<input id="localitate_corespondenta_asigurat" type="text" name="localitate_corespondenta_asigurat" value="<?php echo $localitate_corespondenta_asigurat; ?>" />
			<div id="localitate_corespondenta_asigurat-tip" class="jFormerTip">
				
			</div>
	</div>
	<div class="rowElem" id="strada-div" style="float:left;width:49%;">
            <span>Strada</span><?php echo $notificare; ?><br>
            <input id="strada" type="text" name="strada" value="<?php echo $strada; ?>" />
		    <div id="strada-tip" class="jFormerTip">
				
		    </div>
		</div>
	<div class="clear"></div>
		<div class="rowElem" id="nr_strada-div" style="float:left;width:49%;">
            <span>Numar strada</span><?php echo $notificare; ?><br>
            <input id="nr_strada" type="text" name="nr_strada" value="<?php echo $nr_strada; ?>" />
		    <div id="nr_strada-tip" class="jFormerTip">
				
		    </div>
		</div>
	<div class="clear"></div>
		<div class="rowElem" id="bloc-div" style="float:left;width:18%;">
			<span>Bloc:</span><?php echo $notificare; ?><br>
			<input id="bloc" type="text" name="bloc" style="width:30px;" value="<?php echo $bloc; ?>" />
			<div id="bloc-tip" class="jFormerTip">
				
			</div>
		</div>
		<div class="rowElem" id="scara-div" style="float:left;width:18%;">
			<span>Scara:</span><?php echo $notificare; ?><br>
			<input id="scara" type="text" name="scara" style="width:30px;" value="<?php echo $scara; ?>" />
			<div id="scara-tip" class="jFormerTip">
				
			</div>
		</div>
		<div class="rowElem" id="etaj_adresa-div" style="float:left;width:18%;">
			<span>Etaj:</span><?php echo $notificare; ?><br>
			<input id="etaj_adresa" type="text" name="etaj_adresa" style="width:30px;" value="<?php echo $etaj_adresa; ?>" />
			<div id="etaj_adresa-tip" class="jFormerTip">
				
			</div>
		</div>
		<div class="rowElem" id="apartament-div" style="float:left;width:18%;">
			<span>Apart:</span><?php echo $notificare; ?><br>
			<input id="apartament" type="text" name="apartament" style="width:30px;" value="<?php echo $apartament; ?>" />
			<div id="apartament-tip" class="jFormerTip">
				
			</div>
		</div>

   <div class="rowElem" id="cod_postal-div" style="float:left;width:18%;">
			<span>Cod postal:</span><?php echo $notificare; ?><br>
			<input id="cod_postal" type="text" name="cod_postal" style="width:60px;" value="<?php echo $cod_postal; ?>" />
			<div id="cod_postal-tip" class="jFormerTip">
				
			</div>
		</div>
		<div class="clear"></div>
</div>
    <!------------------------end adresa corespondenta--------------------------->
	 <div class="rowElem" id="ocupatie_asigurat-div" style="float:left;width:49%;">
            <span>Ocupatie:</span><?php echo $notificare; ?><br>
            <div class="clear"></div>
            <select name="ocupatie_asigurat" id="ocupatie_asigurat">
                <option <?php if ($ocupatie_asigurat=='Alegeti' ) echo "selected"; ?> value="Alegeti">Alegeti</option>
                <option <?php if ($ocupatie_asigurat=='Profesii liberale' ) echo "selected"; ?> value="Profesii liberale">Profesii liberale</option>
                <option <?php if ($ocupatie_asigurat=='Personal administrativ (functionari)' ) echo "selected"; ?> value="Personal administrativ (functionari)">Personal administrativ (functionari)</option>
				<option <?php if ($ocupatie_asigurat=='Personal de executie (calificat)' ) echo "selected"; ?> value="Personal de executie (calificat)">Personal de executie (calificat)</option>
				<option <?php if ($ocupatie_asigurat=='Personal necalificat' ) echo "selected"; ?> value="Personal necalificat">Personal necalificat</option>
				<option <?php if ($ocupatie_asigurat=='Personal ce activeaza in conditii de munca speciala' ) echo "selected"; ?> value="Personal ce activeaza in conditii de munca speciala">Personal ce activeaza in conditii de munca speciala</option>
				<option <?php if ($ocupatie_asigurat=='Somer' ) echo "selected"; ?> value="Somer">Somer</option>
            </select>
            <div id="ocupatie_asigurat-tip" class="jFormerTip">  </div>
        </div>
        <div class="clear"></div>
        <div class="despartitor">&nbsp;</div>

 <div class="bullet">
            Date despre Contractant
          </div>

<div class="rowElem" id="asigurat_infarct" style="float:left;width:77%">
			            <i>Contractantul este același cu asiguratul?</i>
		</div>


   <div class="rowElem" id="adresa_coresponenta" style="float:right;width:21%">


			Da<input type="radio" onclick="show_hide(this.value);"  id="contractantul_identica_asigurat_da" name="contractantul_identica_asigurat" value="contractantul_identica_asigurat_da" checked>

			Nu<input type="radio" onclick="show_hide(this.value);"  id="contractantul_identica_asigurat_nu" name="contractantul_identica_asigurat" value="contractantul_identica_asigurat_nu" >


    </div>
<div id="hide_show_adresa_dc" style="display:none;">
	





<!-------------------------DATE CONTRACTANT--------------------------------------->
<div class="rowElem" id="asigurat_infarct" style="float:left;width:77%">
			           <span>Contractantul este persoana juridica?</span><?php echo $notificare; ?><br>
		</div>


           <div class="rowElem" id="tip_persoana" style="float:right;width:21%">
			Da<input type="radio" onclick="show_hide(this.value);" id="pj_contractant_da" name="pj_contractant" value="pj_contractant_da">

			Nu<input type="radio" onclick="show_hide(this.value);" id="pj_contractant_nu" name="pj_contractant" value="pj_contractant_nu" checked>
		</div>



            <!----------------contractant este PJ----------------------
             <div class="rowElem" id="cui_contractant-div" style="float:left;width:49%;">
			<span>CUI:</span><?php echo $notificare; ?><br>
			<input id="cui_contractant" type="text" name="cui_contractant" style="width:90px;" value="" />
			<div id="cui_contractant-tip" class="jFormerTip">
				
			</div>
		</div>
		<div class="clear"></div>
            <!----------------end contractant este PJ----------------------->
            <!----------------contractant este PF----------------------->
        <div class="rowElem" id="cnp_contractant-div" style="float:left;width:49%;">
			<span>CNP:</span><?php echo $notificare; ?><br>
			<input id="cnp_contractant" type="text" name="cnp_contractant" style="width:90px;" value="<?php echo $cnp_contractant; ?>" />
			<div id="cnp_contractant-tip" class="jFormerTip">
				
			</div>
		</div>
		<div class="clear"></div>
             <div class="rowElem" id="nume_contractant-div" style="float:left;width:49%;">
			<span>Nume:</span><?php echo $notificare; ?><br>
			<input id="nume_contractant" type="text" name="nume_contractant" style="width:90px;" value="<?php echo $nume_contractant; ?>" />
			<div id="nume_contractant-tip" class="jFormerTip">
				
			</div>
		</div>
	<div id="hide_show_per_juridica" style="display:block;">
               <div class="rowElem" id="prenume_contractant-div" style="float:left;width:49%;">
			<span>Prenume:</span><?php echo $notificare; ?><br>
			<input id="prenume_contractant" type="text" name="prenume_contractant" style="width:90px;" value="<?php echo $prenume_contractant; ?>" />
			<div id="prenume_contractant-tip" class="jFormerTip">
				
			</div>
		</div>
		</div>
		<div class="clear"></div>
            <!----------------end contractant este PF----------------------->
             <div class="rowElem" id="tara_contaractant-div" style="float:left;width:49%;">
			<span>Tara:</span><?php echo $notificare; ?><br>
			<input id="tara_contaractant" type="text" name="tara_contaractant" value="<?php echo $tara_contaractant; ?>" />
			<div id="tara_contaractant-tip" class="jFormerTip">
				
			</div>
	</div>
    <div class="rowElem" id="judet_contaractant-div" style="float:left;width:49%;">
			<span>Judet:</span><?php echo $notificare; ?><br>
			<input id="judet_contaractant" type="text" name="judet_contaractant" value="<?php echo $judet_contaractant; ?>" />
			<div id="judet_contaractant-tip" class="jFormerTip">
				
			</div>
	</div>
    <div class="rowElem" id="localitate_contaractant-div" style="float:left;width:49%;">
			<span>Localitate:</span><?php echo $notificare; ?><br>
			<input id="localitate_contaractant" type="text" name="localitate_contaractant" value="<?php echo $localitate_contaractant; ?>" />
			<div id="localitate_contaractant-tip" class="jFormerTip">
				
			</div>
	</div>


           <div class="rowElem" id="strada_contaractant-div" style="float:left;width:49%;">
            <span>Strada</span><?php echo $notificare; ?><br>
            <input id="strada_contaractant" type="text" name="strada_contaractant" value="<?php echo $strada_contaractant; ?>" />
		    <div id="strada_contaractant-tip" class="jFormerTip">
				
		    </div>
    </div>
	<div class="clear"></div>
   <div class="rowElem" id="nr_strada_contaractant-div" style="float:left;width:49%;">
            <span>Numar strada</span><?php echo $notificare; ?><br>
            <input id="nr_strada_contaractant" type="text" name="nr_strada_contaractant" value="<?php echo $nr_strada_contaractant; ?>" />
		    <div id="nr_strada_contaractant-tip" class="jFormerTip">
				
		    </div>
    </div>
	<div class="clear"></div>
		<div class="rowElem" id="bloc_contaractant-div" style="float:left;width:18%;">
			<span>Bloc:</span><?php echo $notificare; ?><br>
			<input id="bloc_contaractant" type="text" name="bloc_contaractant" style="width:30px;" value="<?php echo $bloc_contaractant; ?>" />
			<div id="bloc_contaractant-tip" class="jFormerTip">
				
			</div>
		</div>
		<div class="rowElem" id="scara_contaractant-div" style="float:left;width:18%;">
			<span>Scara:</span><?php echo $notificare; ?><br>
			<input id="scara_contaractant" type="text" name="scara_contaractant" style="width:30px;" value="<?php echo $scara_contaractant; ?>" />
			<div id="scara_contaractant-tip" class="jFormerTip">
				
			</div>
		</div>
		<div class="rowElem" id="etaj_adresa_contaractant-div" style="float:left;width:18%;">
			<span>Etaj:</span><?php echo $notificare; ?><br>
			<input id="etaj_adresa_contaractant" type="text" name="etaj_adresa_contaractant" style="width:30px;" value="<?php echo $etaj_adresa_contaractant; ?>" />
			<div id="etaj_adresa_contaractant-tip" class="jFormerTip">
				
			</div>
		</div>
		<div class="rowElem" id="apartament_contaractant-div" style="float:left;width:18%;">
			<span>Apart:</span><?php echo $notificare; ?><br>
			<input id="apartament_contaractant" type="text" name="apartament_contaractant" style="width:30px;" value="<?php echo $apartament_contaractant; ?>" />
			<div id="apartament_contaractant-tip" class="jFormerTip">
				
			</div>
		</div>

   <div class="rowElem" id="cod_postal_contaractant-div" style="float:left;width:18%;">
			<span>Cod postal:</span><?php echo $notificare; ?><br>
			<input id="cod_postal_contaractant" type="text" name="cod_postal_contaractant" style="width:60px;" value="<?php echo $cod_postal_contaractant; ?>" />
			<div id="cod_postal_contaractant-tip" class="jFormerTip">
				
			</div>
		</div>
		<div class="clear"></div>
   <div class="rowElem" id="telefon_contaractant-div" style="float:left;width:49%;">
			<span>Telefon:</span><?php echo $notificare; ?><br>
			<input id="telefon_contaractant" type="text" name="telefon_contaractant" value="<?php echo $telefon_contaractant; ?>" />
			<div id="telefon_contaractant-tip" class="jFormerTip">
					
			</div>
		</div>

    <div class="rowElem" id="email_contaractant-div" style="float:left;width:49%;">
			<span>Email:</span><?php echo $notificare; ?><br>
			<input id="email_contaractant" type="text" name="email_contaractant" value="<?php echo $email_contaractant; ?>" />
			<div id="email_contaractant-tip" class="jFormerTip">
					
			</div>
		</div>
		<div class="clear"></div>
</div>
<input id="varsta_asigurat_test" type="text" name="varsta_asigurat_test" value="<?php echo $varsta_asigurat_test; ?>" style="display:none;" />
<!-------------------------END DATE CONTRACTANT--------------------------------------->
<div id="hide_show_reprezentant" style="display:none;">

    <div class="bullet">
            Reprezentant legal
       </div>

             <div class="rowElem" id="nume_reprezentant-div" style="float:left;width:49%;">
			<span>Nume:</span><?php echo $notificare; ?><br>
			<input id="nume_reprezentant" type="text" name="nume_reprezentant" style="width:90px;" value="<?php echo $nume_reprezentant; ?>" />
			<div id="nume_reprezentant-tip" class="jFormerTip">
				
			</div>
		</div>

               <div class="rowElem" id="prenume_reprezentant-div" style="float:left;width:49%;">
			<span>Prenume:</span><?php echo $notificare; ?><br>
			<input id="prenume_reprezentant" type="text" name="prenume_reprezentant" style="width:90px;" value="<?php echo $prenume_reprezentant; ?>" />
			<div id="prenume_reprezentant-tip" class="jFormerTip"> 
				
			</div>
		</div>
		<div class="clear"></div>

    <div class="rowElem" id="cnp_reprezentant-div" style="float:left;width:49%;">
			<span>CNP:</span><?php echo $notificare; ?><br>
			<input id="cnp_reprezentant" type="text" name="cnp_reprezentant" style="width:90px;" value="<?php echo $cnp_reprezentant; ?>" />
			<div id="cnp_reprezentant-tip" class="jFormerTip">
				
			</div>
		</div>
	
<div class="clear"></div>

</div>


 <div class="bullet"> Informatii privind starea de sanatate a Asiguratului</div>

    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>

         <div class="rowElem" id="asigurat_fumator1" style="float:left;width:77%;">
			<b>Sunteti fumator?</b>
			</div>

		<div class="rowElem" id="asigurat_fumator1" style="float:right;width:21%;" >
			 Da<input type="radio" onclick="show_hide(this.value);" id="asigurat_fumator_da" name="asigurat_fumator" value="asigurat_fumator_da" >

			  Nu<input type="radio" onclick="show_hide(this.value);" id="asigurat_fumator_nu" name="asigurat_fumator" value="asigurat_fumator_nu" checked>
		</div>

        <div class="clear"></div>

   <div class="rowElem" id="nr_tigari-div" style="float:left;width:77%;display:none;">
    <span>In caz afiramtiv, va rugam sa precizati numarul tigarilor consumate zilnic.</span><?php echo $notificare; ?><br>
	 </div>
		<div class="rowElem" id="nr_tigari_s-div" style="float:right;width:21%;display:none;">
            <input id="nr_tigari" type="text" name="nr_tigari" value="<?php echo $nr_tigari; ?>" />
          <!--  <div id="nr_tigari-tip" class="jFormerTip">  </div>  -->
        </div>


		 <div class="clear"></div>
	 <div class="rowElem" id="asigurat_consum_cronic_alcool" style="float:left;width:77%">
		<b>Consumati/ati consumat substante narcotice/droguri?</b>
		</div>
		<div class="rowElem" id="asigurat_narcotice" style="float:right;width:21%">
			Da<input type="radio" id="asigurat_narcotice_da" name="asigurat_narcotice" value="asigurat_narcotice_da" >

			Nu<input type="radio" id="asigurat_narcotice_nu" name="asigurat_narcotice" value="asigurat_narcotice_nu" checked>
		</div>




   <div class="clear"></div>

        <div class="rowElem" id="asigurat_consum_cronic_alcool" style="float:left;width:77%">
		<b>Ati fost consiliat medical ca urmare a consumului cronic de alcool/etilismului cronic?</b>
		</div>
		<div class="rowElem" id="asigurat_consum_cronic_alcool" style="float:right;width:21%">
			Da<input type="radio" id="asigurat_consum_cronic_alcool_da" name="asigurat_consum_cronic_alcool" value="asigurat_consum_cronic_alcool_da" >

			Nu<input type="radio" id="asigurat_consum_cronic_alcool_nu" name="asigurat_consum_cronic_alcool" value="asigurat_consum_cronic_alcool_nu" checked>
		</div>


<div class="clear"></div>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2">
            <p class="text-decoration-underline-sanapro">
                In ultimii 5 ani, ati fost diagnosticat/ tratat/ investigat sau supravegheat medical cu/ pentru una din urmatoarele afectiuni medicale?
            </p>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>

        <div class="rowElem" id="asigurat_infarct" style="float:left;width:77%">
			            <b>1. Afectiuni cardiovascualre: infarct miocardic/ accident vascular cerebral?</b>
		</div>

		<div class="rowElem" id="asigurat_infarct" style="float:right;width:21%">
			Da<input type="radio" onclick="show_hide(this.value);" id="asigurat_infarct_da" name="asigurat_infarct" value="asigurat_infarct_da" >

			Nu<input type="radio" onclick="show_hide(this.value);" id="asigurat_infarct_nu" name="asigurat_infarct" value="asigurat_infarct_nu" checked>
		</div>
       <div class="clear"></div>
      <!----------------------------------------->


	 <div id="hide_show_1" style="display: none;">


<div class="rowElem" id="afectiuni-cardiovascualre" style="float:left;width:77%">
	<i>In cazul diagnosticarii cu infarct miocardic/accident vascular cerebral, precizati:</i>
		</div>
		      <!----------------------------------------->
		<div class="rowElem" id="asigurat_diagnostic_infarct_ultimul_an_f" style="float:left;width:77%">
	    * Diagnosticul de infarct miocardic/ accident vascular cerebral a fost stabilit in ultimul an
        	</div>
       	<div class="rowElem" id="asigurat_diagnostic_infarct_ultimul_an" style="float:right;width:21%">
			Da<input type="radio" id="asigurat_diagnostic_infarct_ultimul_an_da" name="asigurat_diagnostic_infarct_ultimul_an" value="asigurat_diagnostic_infarct_ultimul_an_da" >

			Nu<input type="radio" id="asigurat_diagnostic_infarct_ultimul_an_nu" name="asigurat_diagnostic_infarct_ultimul_an" value="asigurat_diagnostic_infarct_ultimul_an_nu" checked>
		</div>
               <!----------------------------------------->
   <div class="clear"></div>

		<div class="rowElem" id="asigurat_infarct_multiple" style="float:left;width:77%">
			<p>* Ati avut mai mult de un eveniment care a determinat diagnosticul de infarct miocardic si/ sau accident vascular.</p>
		</div>

		<div class="rowElem" id="asigurat_infarct_multiple" style="float:right;width:21%">
			Da<input type="radio" id="asigurat_infarct_multiple_da" name="asigurat_infarct_multiple" value="asigurat_infarct_multiple_da" >

			Nu<input type="radio" id="asigurat_infarct_multiple_nu" name="asigurat_infarct_multiple" value="asigurat_infarct_multiple_nu" checked>
		</div>
    <!----------------------------------------->
   <div class="clear"></div>
   <div class="rowElem" id="asigurat_diabet" style="float:left;width:77%;">
		 <p>* Suferi de diabet zaharat.</p>
		 </div>
    <tr class="afectiuni-cardiovascualre hide-this">

		<div class="rowElem" id="asigurat_diabet"style="float:right;width:21%">
			Da<input type="radio" id="asigurat_diabet_da" name="asigurat_diabet" value="asigurat_diabet_da">

			Nu<input type="radio" id="asigurat_diabet_nu" name="asigurat_diabet" value="asigurat_diabet_nu" checked>
		</div>

    </tr>
	<div class="clear"></div>
    <tr class="afectiuni-cardiovascualre hide-this">
	<div class="rowElem" id="asigurat_angioplastie" style="float:left;width:77%">
			  <p>* Ati efectuat in ultimul an interventie de angioplastie/by-pass/embolizare arteriala.</p>
       </div>

		<div class="rowElem" id="asigurat_angioplastie" style="float:right;width:21%">
			Da<input type="radio" id="asigurat_angioplastie_da" name="asigurat_angioplastie" value="asigurat_angioplastie_da">

			Nu<input type="radio" id="asigurat_angioplastie_nu" name="asigurat_angioplastie" value="asigurat_angioplastie_nu" checked>
		</div>

    </tr>
	<div class="clear"></div>



	<div class="rowElem" id="asigurat_alte_afectiuni_cardiace" style="float:left;width:77%">
		 <p>
                <b>Alte afectiuni cardiovasculare:</b> insuficienta cardiaca, hibertensiune arteriala, cardiopatie ischemica,
                afectiuni valvulare, miocardita, pericardita cronica, fibrilatie atriala cronica, tahicardie supraventiculare,
                badicardie, bloc complet de ramura stanga, bloc atrio-venticular, sindrom Adam-Stokes, hipertrofie cardiaca,
                arterita obliteranta, tomoboflebita, malformatie arteriovenoasa, anevrism arterial?
            </p>
		</div>



		<div class="rowElem" id="asigurat_alte_afectiuni_cardiace" style="float:right;width:21%">
			Da<input type="radio" onclick="show_hide(this.value);" id="asigurat_alte_afectiuni_cardiace_da" name="asigurat_alte_afectiuni_cardiace" value="asigurat_alte_afectiuni_cardiace_da" >

			Nu<input type="radio" onclick="show_hide(this.value);" id="asigurat_alte_afectiuni_cardiace_nu" name="asigurat_alte_afectiuni_cardiace" value="asigurat_alte_afectiuni_cardiace_nu" checked>
		</div>
            <div class="clear"></div>

	<div id="hide_show_1_1" style="display:none;">


		  <div class="rowElem" id="asigurat_insuficienta_cardiaca" style="float:left;width:77%">
					<p>
                            * Insuficienta cardiaca
                        </p>
						</div>

						<div class="rowElem" id="asigurat_insuficienta_cardiaca" style="float:right;width:21%">

							Da<input type="radio" id="asigurat_insuficienta_cardiaca_da" name="asigurat_insuficienta_cardiaca" value="asigurat_insuficienta_cardiaca_da">

							Nu<input type="radio" id="asigurat_insuficienta_cardiaca_nu" name="asigurat_insuficienta_cardiaca" value="asigurat_insuficienta_cardiaca_nu" checked>
						</div>
             <div class="clear"></div>
               <div class="rowElem" id="asigurat_sidrom_adam_stokes" style="float:left;width:77%">
						<p>
                            * Sindromul Adam-Stokes
                        </p>
						</div>

					<div class="rowElem" id="asigurat_sidrom_adam_stokes" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_sidrom_adam_stokes_da" name="asigurat_sidrom_adam_stokes" value="asigurat_sidrom_adam_stokes_da">

							Nu<input type="radio" id="asigurat_sidrom_adam_stokes_nu" name="asigurat_sidrom_adam_stokes" value="asigurat_sidrom_adam_stokes_nu" checked>
						</div>
                      <div class="clear"></div>

               <div class="rowElem" id="asigurat_cardiopatie" style="float:left;width:77%">
						<p>
                            * Cardiopatie ischemica
                        </p></div>


					<div class="rowElem" id="asigurat_cardiopatie" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_cardiopatie_da" name="asigurat_cardiopatie" value="asigurat_cardiopatie_da">

							Nu<input type="radio" id="asigurat_cardiopatie_nu" name="asigurat_cardiopatie" value="asigurat_cardiopatie_nu" checked>
						</div>

                <div class="clear"></div>
                <div class="rowElem" id="asigurat_afectiuni_valvulare" style="float:left;width:77%">
						 <p>
                            * Afectiuni valvulare
                        </p>
						</div>


					<div class="rowElem" id="asigurat_afectiuni_valvulare" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_afectiuni_valvulare_da" name="asigurat_afectiuni_valvulare" value="asigurat_afectiuni_valvulare_da">

							Nu<input type="radio" id="asigurat_afectiuni_valvulare_nu" name="asigurat_afectiuni_valvulare" value="asigurat_afectiuni_valvulare_nu" checked>
						</div>
                  <div class="clear"></div>
               <div class="rowElem" id="asigurat_hipertensiune" style="float:left;width:77%">
							<p>
                            * Hipertensiune arteriala
                        </p></div>

					<div class="rowElem" id="asigurat_hipertensiune" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_hipertensiune_da" name="asigurat_hipertensiune" value="asigurat_hipertensiune_da">

							Nu<input type="radio" id="asigurat_hipertensiune_nu" name="asigurat_hipertensiune" value="asigurat_hipertensiune_nu" checked>
						</div>
                <div class="clear"></div>
					<div class="rowElem" id="asigurat_miocardita" style="float:left;width:77%">
					 <p>
                            * Miocardita
                        </p></div>


					<div class="rowElem" id="asigurat_miocardita" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_miocardita_da" name="asigurat_miocardita" value="asigurat_miocardita_da">

							Nu<input type="radio" id="asigurat_miocardita_nu" name="asigurat_miocardita" value="asigurat_miocardita_nu" checked>
						</div>
                        <div class="clear"></div>
            <div class="rowElem" id="asigurat_pericardita" style="float:left;width:77%">
					 <p>
                            * Pericardita cronica
                        </p></div>

					<div class="rowElem" id="asigurat_pericardita" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_pericardita_da" name="asigurat_pericardita" value="asigurat_pericardita_da">

							Nu<input type="radio" id="asigurat_pericardita_nu" name="asigurat_pericardita" value="asigurat_pericardita_nu" checked>
						</div>
                        <div class="clear"></div>
               <div class="rowElem" id="asigurat_fabriatie" style="float:left;width:77%">
							 <p>
                            * Fibrilatie atriala cronica
                        </p></div>


						<div class="rowElem" id="asigurat_fabriatie" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_fabriatie_da" name="asigurat_fabriatie" value="asigurat_fabriatie_da">

							Nu<input type="radio" id="asigurat_fabriatie_nu" name="asigurat_fabriatie" value="asigurat_fabriatie_nu" checked>
						</div>
                 <div class="clear"></div>
				<div class="rowElem" id="asigurat_tehicardie" style="float:left;width:77%">
						 <p>
                            * Tehicardie supraventiculara
                        </p></div>


					<div class="rowElem" id="asigurat_tehicardie" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_tehicardie_da" name="asigurat_tehicardie" value="asigurat_tehicardie_da">

							Nu<input type="radio" id="asigurat_tehicardie_nu" name="asigurat_tehicardie" value="asigurat_tehicardie_nu" checked>
						</div>

                 <div class="clear"></div>
               <div class="rowElem" id="asigurat_bradicardie" style="float:left;width:77%">
						 <p>
                            * Bradicardie
                        </p></div>


					<div class="rowElem" id="asigurat_bradicardie" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_bradicardie_da" name="asigurat_bradicardie" value="asigurat_bradicardie_da">

							Nu<input type="radio" id="asigurat_bradicardie_nu" name="asigurat_bradicardie" value="asigurat_bradicardie_nu" checked>
						</div>
                         <div class="clear"></div>
              <div class="rowElem" id="asigurat_bloc_ramura_stanta" style="float:left;width:77%">
						  <p>
                            * Bloc complet de ramura stanga
                        </p>	</div>

                    </td>
					<div class="rowElem" id="asigurat_bloc_ramura_stanta" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_bloc_ramura_stanta_da" name="asigurat_bloc_ramura_stanta" value="asigurat_bloc_ramura_stanta_da">

							Nu<input type="radio" id="asigurat_bloc_ramura_stanta_nu" name="asigurat_bloc_ramura_stanta" value="asigurat_bloc_ramura_stanta_nu" checked>
						</div>
						 <div class="clear"></div>
                <div class="rowElem" id="asigurat_bloc_atrio_venticular" style="float:left;width:77%">
						 <p>
                            * Bloc atrio-venticular
                        </p>	</div>


					<div class="rowElem" id="asigurat_bloc_atrio_venticular" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_bloc_atrio_venticular_da" name="asigurat_bloc_atrio_venticular" value="asigurat_bloc_atrio_venticular_da">

							Nu<input type="radio" id="asigurat_bloc_atrio_venticular_nu" name="asigurat_bloc_atrio_venticular" value="asigurat_bloc_atrio_venticular_nu" checked>
						</div>
                        <div class="clear"></div>
               <div class="rowElem" id="asigurat_hipertrofie" style="float:left;width:77%">
						 <p>
                            * Hipertrofie cardiaca
                        </p></div>


					<div class="rowElem" id="asigurat_hipertrofie" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_hipertrofie_da" name="asigurat_hipertrofie" value="asigurat_hipertrofie_da">

							Nu<input type="radio" id="asigurat_hipertrofie_nu" name="asigurat_hipertrofie" value="asigurat_hipertrofie_nu" checked>
						</div>
                         <div class="clear"></div>
               <div class="rowElem" id="asigurat_arterita" style="float:left;width:77%">
							 <p>
                            * Arterita obliteranta
                        </p></div>


					<div class="rowElem" id="asigurat_arterita" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_arterita_da" name="asigurat_arterita" value="asigurat_arterita_da">

							Nu<input type="radio" id="asigurat_arterita_nu" name="asigurat_arterita" value="asigurat_arterita_nu" checked>
						</div>
                         <div class="clear"></div>
              <div class="rowElem" id="asigurat_tromboflebita" style="float:left;width:77%">
						 <p>
                            * Tromboflebita
                        </p></div>

					<div class="rowElem" id="asigurat_tromboflebita" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_tromboflebita_da" name="asigurat_tromboflebita" value="asigurat_tromboflebita_da">

							Nu<input type="radio" id="asigurat_tromboflebita_nu" name="asigurat_tromboflebita" value="asigurat_tromboflebita_nu" checked>
						</div>
                         <div class="clear"></div>
               <div class="rowElem" id="asigurat_malformatie_alteriovenoasa" style="float:left;width:77%">
							 <p>
                            * Malformatie arteriovenoasa
                        </p></div>


					<div class="rowElem" id="asigurat_malformatie_alteriovenoasa" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_malformatie_alteriovenoasa_da" name="asigurat_malformatie_alteriovenoasa" value="asigurat_malformatie_alteriovenoasa_da">

							Nu<input type="radio" id="asigurat_malformatie_alteriovenoasa_nu" name="asigurat_malformatie_alteriovenoasa" value="asigurat_malformatie_alteriovenoasa_nu" checked>
						</div>
						 <div class="clear"></div>
              <div class="rowElem" id="asigurat_anevrism_arterial" style="float:left;width:77%">
							 <p>
                            * Anevrism arterial
                        </p></div>


					<div class="rowElem" id="asigurat_anevrism_arterial" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_anevrism_arterial_da" name="asigurat_anevrism_arterial" value="asigurat_anevrism_arterial_da">

							Nu<input type="radio" id="asigurat_anevrism_arterial_nu" name="asigurat_anevrism_arterial" value="asigurat_anevrism_arterial_nu" checked>
						</div>
						 <div class="clear"></div>

  </div>

  </div>

   <div class="rowElem" id="asigurat_afectiuni_respiratorii" style="float:left;width:77%">
					<b>2. Afectiuni respiratorii:</b> tuberculoza activa, astm bronsic, insuficienta respiratorie, bronsita cronica, emfizem pulmonar?
       </div>

		<div class="rowElem" id="asigurat_afectiuni_respiratorii" style="float:right;width:21%">
							Da<input type="radio" onclick="show_hide(this.value);" id="asigurat_afectiuni_respiratorii_da" name="asigurat_afectiuni_respiratorii" value="asigurat_afectiuni_respiratorii_da">

							Nu<input type="radio" onclick="show_hide(this.value);" id="asigurat_afectiuni_respiratorii_nu" name="asigurat_afectiuni_respiratorii" value="asigurat_afectiuni_respiratorii_nu" checked>
						</div>

     <div class="clear"></div>

   <div id="hide_show_2" style="display:none;">

            <div class="rowElem" id="asigurat_tuberculoza_activa" style="float:left;width:77%">
						<p>
                            * Tuberculoza activa
                        </p></div>

					<div class="rowElem" id="asigurat_tuberculoza_activa" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_tuberculoza_activa_da" name="asigurat_tuberculoza_activa" value="asigurat_tuberculoza_activa_da">

							Nu<input type="radio" id="asigurat_tuberculoza_activa_nu" name="asigurat_tuberculoza_activa" value="asigurat_tuberculoza_activa_nu" checked>
						</div>
                         <div class="clear"></div>
               <div class="rowElem" id="asigurat_insuficienta_respiratorie" style="float:left;width:77%">
						<p>
                            * Insuficienta respiratorie
                        </p></div>

					<div class="rowElem" id="asigurat_insuficienta_respiratorie" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_insuficienta_respiratorie_da" name="asigurat_insuficienta_respiratorie" value="asigurat_insuficienta_respiratorie_da">

							Nu<input type="radio" id="asigurat_insuficienta_respiratorie_nu" name="asigurat_insuficienta_respiratorie" value="asigurat_insuficienta_respiratorie_nu" checked>
						</div>
                         <div class="clear"></div>
              <div class="rowElem" id="asigurat_astm_bronsic" style="float:left;width:77%">
						 <p>
                            * Astm bronsic
                        </p></div>

					<div class="rowElem" id="asigurat_astm_bronsic" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_astm_bronsic_da" name="asigurat_astm_bronsic" value="asigurat_astm_bronsic_da" >

							Nu<input type="radio" id="asigurat_astm_bronsic_nu" name="asigurat_astm_bronsic" value="asigurat_astm_bronsic_nu" checked>
						</div>
                         <div class="clear"></div>
               <div class="rowElem" id="asigurat_emfizem_pulmonar" style="float:left;width:77%">
						 <p>
                            * Emfizem pulmonar
                        </p></div>

					<div class="rowElem" id="asigurat_emfizem_pulmonar" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_emfizem_pulmonar_da" name="asigurat_emfizem_pulmonar" value="asigurat_emfizem_pulmonar_da">

							Nu<input type="radio" id="asigurat_emfizem_pulmonar_nu" name="asigurat_emfizem_pulmonar" value="asigurat_emfizem_pulmonar_nu" checked>
						</div>
                          <div class="clear"></div>
              <div class="rowElem" id="asigurat_bronsita_cronica" style="float:left;width:77%">
							 <p>
                            * Bronsita cronica
                        </p></div>


					<div class="rowElem" id="asigurat_bronsita_cronica" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_bronsita_cronica_da" name="asigurat_bronsita_cronica" value="asigurat_bronsita_cronica_da">

							Nu<input type="radio" id="asigurat_bronsita_cronica_nu" name="asigurat_bronsita_cronica" value="asigurat_bronsita_cronica_nu" checked>
						</div>
          </div>
              <div class="clear"></div>


  <div class="rowElem" id="asigurat_afectiuni_digestive" style="float:left;width:77%">
		 <b>3. Afectiuni digestive:</b> ciroza hepatica, hepatita cronica, reflux gastroesofagian, ulcer gastric, ulcer duodenal, litiaza biliara, pancreatita cronica, rectocolita ulcero-hemoragica, boala Crohn, diverticuloza colonica?
       	</div>

        <div class="rowElem" id="asigurat_afectiuni_digestive" style="float:right;width:21%">
							Da<input type="radio" onclick="show_hide(this.value);" id="asigurat_afectiuni_digestive_da" name="asigurat_afectiuni_digestive" value="asigurat_afectiuni_digestive_da">

							Nu<input type="radio" onclick="show_hide(this.value);" id="asigurat_afectiuni_digestive_nu" name="asigurat_afectiuni_digestive" value="asigurat_afectiuni_digestive_nu" checked></div>
	<div class="clear"></div>

 <div id="hide_show_3" style="display:none;">


                <div class="rowElem" id="asigurat_ciroza_hepatica" style="float:left;width:77%">
						 <p>
                            * Ciroza hepatica
                        </p>	</div>


                      <div class="rowElem" id="asigurat_ciroza_hepatica" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_ciroza_hepatica_da" name="asigurat_ciroza_hepatica" value="asigurat_ciroza_hepatica_da">

							Nu<input type="radio" id="asigurat_ciroza_hepatica_nu" name="asigurat_ciroza_hepatica" value="asigurat_ciroza_hepatica_nu" checked>
						</div>
<div class="clear"></div>

                 <div class="rowElem" id="asigurat_hepatita_cronica" style="float:left;width:77%">
							<p>
                            * Hepatita cronica
                        </p></div>


                    <div class="rowElem" id="asigurat_hepatita_cronica" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_hepatita_cronica_da" name="asigurat_hepatita_cronica" value="asigurat_hepatita_cronica_da">

							Nu<input type="radio" id="asigurat_hepatita_cronica_nu" name="asigurat_hepatita_cronica" value="asigurat_hepatita_cronica_nu" checked>
						</div>
<div class="clear"></div>

               <div class="rowElem" id="asigurat_reflux_gastroesofagian" style="float:left;width:77%">
						  <p>
                            * Reflux gastroesofagian
                        </p></div>


                   <div class="rowElem" id="asigurat_reflux_gastroesofagian" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_reflux_gastroesofagian_da" name="asigurat_reflux_gastroesofagian" value="asigurat_reflux_gastroesofagian_da">

							Nu<input type="radio" id="asigurat_reflux_gastroesofagian_nu" name="asigurat_reflux_gastroesofagian" value="asigurat_reflux_gastroesofagian_nu" checked>
						</div>
						<div class="clear"></div>
               <div class="rowElem" id="asigurat_ulcer_gastric" style="float:left;width:77%">
						  <p>
                            * Ulcer gastric
                        </p></div>

                <div class="rowElem" id="asigurat_ulcer_gastric" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_ulcer_gastric_da" name="asigurat_ulcer_gastric" value="asigurat_ulcer_gastric_da">

							Nu<input type="radio" id="asigurat_ulcer_gastric_nu" name="asigurat_ulcer_gastric" value="asigurat_ulcer_gastric_nu" checked>
						</div>
<div class="clear"></div>
                <div class="rowElem" id="asigurat_ulcer_duodenal" style="float:left;width:77%">
						 <p>
                            * Ulcer duodenal
                        </p>	</div>


                   <div class="rowElem" id="asigurat_ulcer_duodenal" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_ulcer_duodenal_da" name="asigurat_ulcer_duodenal" value="asigurat_ulcer_duodenal_da">

							Nu<input type="radio" id="asigurat_ulcer_duodenal_nu" name="asigurat_ulcer_duodenal" value="asigurat_ulcer_duodenal_nu" checked>
						</div>
<div class="clear"></div>
                <div class="rowElem" id="asigurat_litiza_biliara" style="float:left;width:77%">
						<p>
                            * Litiaza biliara
                        </p>	</div>


                 <div class="rowElem" id="asigurat_litiza_biliara" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_litiza_biliara_da" name="asigurat_litiza_biliara" value="asigurat_litiza_biliara_da">

							Nu<input type="radio" id="asigurat_litiza_biliara_nu" name="asigurat_litiza_biliara" value="asigurat_litiza_biliara_nu" checked>
						</div>
<div class="clear"></div>
               <div class="rowElem" id="asigurat_pancreatita_cronica" style="float:left;width:77%">
						 <p>
                            * Pancreatita cronica
                        </p>	</div>

                 <div class="rowElem" id="asigurat_pancreatita_cronica" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_pancreatita_cronica_da" name="asigurat_pancreatita_cronica" value="asigurat_pancreatita_cronica_da">

							Nu<input type="radio" id="asigurat_pancreatita_cronica_nu" name="asigurat_pancreatita_cronica" value="asigurat_pancreatita_cronica_nu" checked>
						</div>
<div class="clear"></div>
              <div class="rowElem" id="asigurat_rectocolita_ulcero_hemoragiga" style="float:left;width:77%">
						 <p>
                            * Rectocolita ulcero-hemoragica
                        </p>	</div>

                <div class="rowElem" id="asigurat_rectocolita_ulcero_hemoragiga" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_rectocolita_ulcero_hemoragiga_da" name="asigurat_rectocolita_ulcero_hemoragiga" value="asigurat_rectocolita_ulcero_hemoragiga_da">

							Nu<input type="radio" id="asigurat_rectocolita_ulcero_hemoragiga_nu" name="asigurat_rectocolita_ulcero_hemoragiga" value="asigurat_rectocolita_ulcero_hemoragiga_nu" checked>
						</div>
<div class="clear"></div>
                <div class="rowElem" id="asigurat_boala_crohn" style="float:left;width:77%">
						  <p>
                            * Boala Crohn
                        </p></div>


                <div class="rowElem" id="asigurat_boala_crohn" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_boala_crohn_da" name="asigurat_boala_crohn" value="asigurat_boala_crohn_da">

							Nu<input type="radio" id="asigurat_boala_crohn_nu" name="asigurat_boala_crohn" value="asigurat_boala_crohn_nu" checked>
						</div>
<div class="clear"></div>
               <div class="rowElem" id="asigurat_diverticuloza_colonica" style="float:left;width:77%">
						 <p>
                            * Diverticuloza colonica
                        </p>	</div>


                <div class="rowElem" id="asigurat_diverticuloza_colonica" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_diverticuloza_colonica_da" name="asigurat_diverticuloza_colonica" value="asigurat_diverticuloza_colonica_da">

							Nu<input type="radio" id="asigurat_diverticuloza_colonica_nu" name="asigurat_diverticuloza_colonica" value="asigurat_diverticuloza_colonica_nu" checked>
						</div>
</div>
<div class="clear"></div>


<!---------------------------------->



 <div class="rowElem" id="boli_metabolice" style="float:left;width:77%">
						<b>4. Boli metabolice si de nutritie :</b></div>

  <div class="rowElem" id="asigurat_boli_metabolice" style="float:right;width:21%">
							Da<input type="radio" onclick="show_hide(this.value);" id="asigurat_boli_metabolice_da" name="asigurat_boli_metabolice" value="asigurat_boli_metabolice_da">

							Nu<input type="radio" onclick="show_hide(this.value);" id="asigurat_boli_metabolice_nu" name="asigurat_boli_metabolice" value="asigurat_boli_metabolice_nu" checked>
						</div>
<div class="clear"></div>

            <div id="hide_show_4" style="display:none;">


    <div class="rowElem" id="asigurat_diabet_zaharat_complicat" style="float:left;width:77%">
						  <p>
                * Diabet zaharat complicat
            </p></div>


     <div class="rowElem" id="asigurat_diabet_zaharat_complicat" style="float:right;width:21%">
							Da<input type="radio" onclick="show_hide(this.value);" id="asigurat_diabet_zaharat_complicat_da" name="asigurat_diabet_zaharat_complicat" value="asigurat_diabet_zaharat_complicat_da">

							Nu<input type="radio" onclick="show_hide(this.value);" id="asigurat_diabet_zaharat_complicat_nu" name="asigurat_diabet_zaharat_complicat" value="asigurat_diabet_zaharat_complicat_nu" checked>
						</div>
<div class="clear"></div>

<div id="hide_show_4_1" style="display:none;">

   <!---0 hide-->
    <div class="rowElem" id="diabet-zaharat-complicat" style="float:left;width:77%">
						 <p class="text-decoration-underline-sanapro">
                In cazul in care suferiti de diabet zaharat, va rugam precizati daca ati fost diagnosticat cu una din urmatoarele afectiuni asociate diabetului zaharat:
            </p></div>


    <tr class="diabet-zaharat-complicat hide-this">

            <div class="rowElem" id="asigurat_retinopatie_diabetica" style="float:left;width:77%">
						  <p>
                            * Retinopatie diabetica
                        </p>	</div>


              <div class="rowElem" id="asigurat_retinopatie_diabetica" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_retinopatie_diabetica_da" name="asigurat_retinopatie_diabetica" value="asigurat_retinopatie_diabetica_da">

							Nu<input type="radio" id="asigurat_retinopatie_diabetica_nu" name="asigurat_retinopatie_diabetica" value="asigurat_retinopatie_diabetica_nu" checked>
						</div>
						<div class="clear"></div>
                 <div class="rowElem" id="asigurat_nefropatie" style="float:left;width:77%">
						  <p>
                            * Nefropatie
                        </p></div>

                    </td>
                <div class="rowElem" id="asigurat_nefropatie" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_nefropatie_da" name="asigurat_nefropatie" value="asigurat_nefropatie_da">

							Nu<input type="radio" id="asigurat_nefropatie_nu" name="asigurat_nefropatie" value="asigurat_nefropatie_nu" checked>
						</div>
<div class="clear"></div>

                <div class="rowElem" id="asigurat_neuropatie" style="float:left;width:77%">
							   <p>
                            * Neuropatie
                        </p>	</div>

                  <div class="rowElem" id="asigurat_neuropatie" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_neuropatie_da" name="asigurat_neuropatie" value="asigurat_neuropatie_da">

							Nu<input type="radio" id="asigurat_neuropatie_nu" name="asigurat_neuropatie" value="asigurat_neuropatie_nu" checked>
						</div>
<div class="clear"></div>
                <div class="rowElem" id="asigurat_cardiopatie_ischemica" style="float:left;width:77%">
						 <p>
                            * Cardiopatie ischemica
                        </p>	</div>


                 <div class="rowElem" id="asigurat_cardiopatie_ischemica" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_cardiopatie_ischemica_da" name="asigurat_cardiopatie_ischemica" value="asigurat_cardiopatie_ischemica_da">

							Nu<input type="radio" id="asigurat_cardiopatie_ischemica_nu" name="asigurat_cardiopatie_ischemica" value="asigurat_cardiopatie_ischemica_nu" checked>
						</div>
						<div class="clear"></div>
               <div class="rowElem" id="asigurat_hipertensiune_arteriala" style="float:left;width:77%">
						 <p>
                            * Hipertensiune arteriala
                        </p></div>


                  <div class="rowElem" id="asigurat_hipertensiune_arteriala" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_hipertensiune_arteriala_da" name="asigurat_hipertensiune_arteriala" value="asigurat_hipertensiune_arteriala_da">

							Nu<input type="radio" id="asigurat_hipertensiune_arteriala_nu" name="asigurat_hipertensiune_arteriala" value="asigurat_hipertensiune_arteriala_nu" checked>
						</div>
<div class="clear"></div>
               <div class="rowElem" id="asigurat_metabolice_infarct_miocardic" style="float:left;width:77%">
						 <p>
                            * Infarct miocardic
                        </p></div>


               <div class="rowElem" id="asigurat_metabolice_infarct_miocardic" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_metabolice_infarct_miocardic_da" name="asigurat_metabolice_infarct_miocardic" value="asigurat_metabolice_infarct_miocardic_da">

							Nu<input type="radio" id="asigurat_metabolice_infarct_miocardic_nu" name="asigurat_metabolice_infarct_miocardic" value="asigurat_metabolice_infarct_miocardic_nu" checked>
						</div>
               <div class="clear"></div>
                <div class="rowElem" id="asigurat_metabolice_accident_vascular" style="float:left;width:77%">
						  <p>
                            * Accident vascular cerebral
                        </p></div>


              <div class="rowElem" id="asigurat_metabolice_accident_vascular" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_metabolice_accident_vascular_da" name="asigurat_metabolice_accident_vascular" value="asigurat_metabolice_accident_vascular_da">

							Nu<input type="radio" id="asigurat_metabolice_accident_vascular_nu" name="asigurat_metabolice_accident_vascular" value="asigurat_metabolice_accident_vascular_nu" checked>
						</div>
<div class="clear"></div>
               <div class="rowElem" id="asigurat_proteinurie" style="float:left;width:77%">
						 <p>
                            * Proteinurie
                        </p></div>


                 <div class="rowElem" id="asigurat_proteinurie" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_proteinurie_da" name="asigurat_proteinurie" value="asigurat_proteinurie_da">

							Nu<input type="radio" id="asigurat_proteinurie_nu" name="asigurat_proteinurie" value="asigurat_proteinurie_nu" checked>
						</div>
<div class="clear"></div>
                 <div class="rowElem" id="asigurat_metabolice_insuficienta_renala" style="float:left;width:77%">
						<div class="clear"></div>
						<p>
                            * Insuficienta renala
                        </p></div>

                 <div class="rowElem" id="asigurat_metabolice_insuficienta_renala" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_metabolice_insuficienta_renala_da" name="asigurat_metabolice_insuficienta_renala" value="asigurat_metabolice_insuficienta_renala_da">

							Nu<input type="radio" id="asigurat_metabolice_insuficienta_renala_nu" name="asigurat_metabolice_insuficienta_renala" value="asigurat_metabolice_insuficienta_renala_nu" checked>
</div>
<div class="clear"></div>
</div>
         <!---1 hide-->

    <div class="rowElem" id="asigurat_obezitatea" style="float:left;width:77%">
						                        <p>
                            * Obezitate gradul II sau III(BMI > 35)
                        </p>	</div>


               <div class="rowElem" id="asigurat_obezitatea" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_obezitatea_da" name="asigurat_obezitatea" value="asigurat_obezitatea_da">

							Nu<input type="radio" id="asigurat_obezitatea_nu" name="asigurat_obezitatea" value="asigurat_obezitatea_nu" checked>
						</div>
<div class="clear"></div>
              <div class="rowElem" id="asigurat_guta" style="float:left;width:77%">
					 <p>
                            * Guta
                        </p></div>


               <div class="rowElem" id="asigurat_guta" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_guta_da" name="asigurat_guta" value="asigurat_guta_da">

							Nu<input type="radio" id="asigurat_guta_nu" name="asigurat_guta" value="asigurat_guta_nu" checked>
						</div>
						<div class="clear"></div>
               <div class="rowElem" id="asigurat_sidrom_metabolic" style="float:left;width:77%">
					 <p>
                            * Sidrom metabolic
                        </p></div>


                  <div class="rowElem" id="asigurat_sidrom_metabolic" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_sidrom_metabolic_da" name="asigurat_sidrom_metabolic" value="asigurat_sidrom_metabolic_da">

							Nu<input type="radio" id="asigurat_sidrom_metabolic_nu" name="asigurat_sidrom_metabolic" value="asigurat_sidrom_metabolic_nu" checked>
						</div>
</div>
             <div class="clear"></div>

     <div class="rowElem" id="asigurat_afectiuni_endocrine" style="float:left;width:77%">
						  <b>5. Afectiuni endocrine :</b> hipertiroidie (boala Basadow-Graves), tiroidita cronica, gusa nodulara, sindrom Cushing, boala Addison?
      </div>

       <div class="rowElem" id="asigurat_afectiuni_endocrine" style="float:right;width:21%">
							Da<input type="radio" onclick="show_hide(this.value);" id="asigurat_afectiuni_endocrine_da" name="asigurat_afectiuni_endocrine" value="asigurat_afectiuni_endocrine_da">

							Nu<input type="radio" onclick="show_hide(this.value);" id="asigurat_afectiuni_endocrine_nu" name="asigurat_afectiuni_endocrine" value="asigurat_afectiuni_endocrine_nu" checked>
						</div>
   <div class="clear"></div>
   <!-- hide this -->

   <div id="hide_show_5" style="display:none;">

     <div class="rowElem" id="asigurat_hipertiroidie" style="float:left;width:77%">
							   <p>
                            * Hipertiroidie (boala Basadow-Graves)
                        </p>	</div>


              <div class="rowElem" id="asigurat_hipertiroidie" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_hipertiroidie_da" name="asigurat_hipertiroidie" value="asigurat_hipertiroidie_da">

							Nu<input type="radio" id="asigurat_hipertiroidie_nu" name="asigurat_hipertiroidie" value="asigurat_hipertiroidie_nu" checked>
						</div>
   <div class="clear"></div>
                <div class="rowElem" id="asigurat_tiroidita_cronica" style="float:left;width:77%">
							  <p>
                            * Tiroidita cronica
                        </p>	</div>


                <div class="rowElem" id="asigurat_tiroidita_cronica" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_tiroidita_cronica_da" name="asigurat_tiroidita_cronica" value="asigurat_tiroidita_cronica_da">

							Nu<input type="radio" id="asigurat_tiroidita_cronica_nu" name="asigurat_tiroidita_cronica" value="asigurat_tiroidita_cronica_nu" checked>
							</div>
							   <div class="clear"></div>
				<div class="rowElem" id="asigurat_gusa_nodulara" style="float:left;width:77%">
						 <p>
                            * Gusa nodulara
                        </p></div>


                  <div class="rowElem" id="asigurat_gusa_nodulara" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_gusa_nodulara_da" name="asigurat_gusa_nodulara" value="asigurat_gusa_nodulara_da">

							Nu<input type="radio" id="asigurat_gusa_nodulara_nu" name="asigurat_gusa_nodulara" value="asigurat_gusa_nodulara_nu" checked>
						</div>
						   <div class="clear"></div>
              <div class="rowElem" id="asigurat_sindrom_cushing" style="float:left;width:77%">
					  <p>
                            * Sindrom Cushing
                        </p>	</div>


               <div class="rowElem" id="asigurat_sindrom_cushing" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_sindrom_cushing_da" name="asigurat_sindrom_cushing" value="asigurat_sindrom_cushing_da">

							Nu<input type="radio" id="asigurat_sindrom_cushing_nu" name="asigurat_sindrom_cushing" value="asigurat_sindrom_cushing_nu" checked>
						</div>
   <div class="clear"></div>
               <div class="rowElem" id="asigurat_boala_addison" style="float:left;width:77%">
						  <p>
                            * Boala Addison
                        </p></div>


                <div class="rowElem" id="asigurat_boala_addison" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_boala_addison_da" name="asigurat_boala_addison" value="asigurat_boala_addison_da">

							Nu<input type="radio" id="asigurat_boala_addison_nu" name="asigurat_boala_addison" value="asigurat_boala_addison_nu" checked>
						</div>
                 <div class="clear"></div>
				 <!--1 hide-->
		</div>
    <div class="rowElem" id="asigurat_afectiuni_ereditare" style="float:left;width:77%">
						  <b>6. Afectiuni ereditare :</b> fibroza chistica, boala Wilson?
     	</div>

       <div class="rowElem" id="asigurat_afectiuni_ereditare" style="float:right;width:21%">
							Da<input type="radio" onclick="show_hide(this.value);" id="asigurat_afectiuni_ereditare_da" name="asigurat_afectiuni_ereditare" value="asigurat_afectiuni_ereditare_da">

							Nu<input type="radio" onclick="show_hide(this.value);" id="asigurat_afectiuni_ereditare_nu" name="asigurat_afectiuni_ereditare" value="asigurat_afectiuni_ereditare_nu" checked>
						</div>
   <div class="clear"></div>
  <!-- 0 hide -->
  <div id="hide_show_6" style="display:none;">

       <div class="rowElem" id="asigurat_fobroza_chistica" style="float:left;width:77%">
						   <p>
                            * Fobroza chistica
                        </p>	</div>


                <div class="rowElem" id="asigurat_fobroza_chistica" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_fobroza_chistica_da" name="asigurat_fobroza_chistica" value="asigurat_fobroza_chistica_da">

							Nu<input type="radio" id="asigurat_fobroza_chistica_nu" name="asigurat_fobroza_chistica" value="asigurat_fobroza_chistica_nu" checked>
						</div> <div class="clear"></div>
             <div class="rowElem" id="asigurat_boala_wilson" style="float:left;width:77%">
						  <p>
                            * Boala Wilson
                        </p>	</div>


                   <div class="rowElem" id="asigurat_boala_wilson" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_boala_wilson_da" name="asigurat_boala_wilson" value="asigurat_boala_wilson_da">

							Nu<input type="radio" id="asigurat_boala_wilson_nu" name="asigurat_boala_wilson" value="asigurat_boala_wilson_nu" checked>
						</div>
</div>
               <div class="clear"></div>

     <div class="rowElem" id="asigurat_afectiuni_hematologice" style="float:left;width:77%">
						   <b>7. Afectiuni hematologice/ ale sangelui :</b> hemofilie, anemie hemolitica, trombofilie, leucemie?
      		</div>

       <div class="rowElem" id="asigurat_afectiuni_hematologice" style="float:right;width:21%">
							Da<input type="radio" onclick="show_hide(this.value);" id="asigurat_afectiuni_hematologice_da" name="asigurat_afectiuni_hematologice" value="asigurat_afectiuni_hematologice_da">

							Nu<input type="radio" onclick="show_hide(this.value);" id="asigurat_afectiuni_hematologice_nu" name="asigurat_afectiuni_hematologice" value="asigurat_afectiuni_hematologice_nu" checked>
						</div>

   <!--hide-->
   <div id="hide_show_7" style="display:none;">

     <div class="rowElem" id="asigurat_hemofilie" style="float:left;width:77%">
						<p>
                            * Hemofilie
                        </p></div>


                  <div class="rowElem" id="asigurat_hemofilie" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_hemofilie_da" name="asigurat_hemofilie" value="asigurat_hemofilie_da">

							Nu<input type="radio" id="asigurat_hemofilie_nu" name="asigurat_hemofilie" value="asigurat_hemofilie_nu" checked>
						</div>  <div class="clear"></div>
              <div class="rowElem" id="asigurat_leucemie" style="float:left;width:77%">
					 <p>
                            * Leucemie
                        </p>	</div>


                 <div class="rowElem" id="asigurat_leucemie" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_leucemie_da" name="asigurat_leucemie" value="asigurat_leucemie_da">

							Nu<input type="radio" id="asigurat_leucemie_nu" name="asigurat_leucemie" value="asigurat_leucemie_nu" checked>
						</div>      <div class="clear"></div>
               <div class="rowElem" id="asigurat_anemie_hemolitica" style="float:left;width:77%">
					 <p>
                            * Anemie hemolitica
                        </p>	</div>

                  <div class="rowElem" id="asigurat_anemie_hemolitica" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_anemie_hemolitica_da" name="asigurat_anemie_hemolitica" value="asigurat_anemie_hemolitica_da">

							Nu<input type="radio" id="asigurat_anemie_hemolitica_nu" name="asigurat_anemie_hemolitica" value="asigurat_anemie_hemolitica_nu" checked>
						</div>   <div class="clear"></div>
                <div class="rowElem" id="asigurat_trombofilie" style="float:left;width:77%">
					  <p>
                            * Trombofilie
                        </p>	</div>

                 <div class="rowElem" id="asigurat_trombofilie" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_trombofilie_da" name="asigurat_trombofilie" value="asigurat_trombofilie_da">

							Nu<input type="radio" id="asigurat_trombofilie_nu" name="asigurat_trombofilie" value="asigurat_trombofilie_nu" checked>
						</div> </div>   <div class="clear"></div>
<!--1hide-->


   <div class="rowElem" id="asigurat_tumori_cancer" style="float:left;width:77%">
						  <b>8. Tumori maligne/cancer(diagnosticat in ultimi 5 ani)?</b>
      	</div>

      <div class="rowElem" id="asigurat_tumori_cancer" style="float:right;width:21%">
							Da<input type="radio" onclick="show_hide(this.value);" id="asigurat_tumori_cancer_da" name="asigurat_tumori_cancer" value="asigurat_tumori_cancer_da">

							Nu<input type="radio" onclick="show_hide(this.value);" id="asigurat_tumori_cancer_nu" name="asigurat_tumori_cancer" value="asigurat_tumori_cancer_nu" checked>
						</div>  <div class="clear"></div>

						<!--0hide-->
						<div id="hide_show_8" style="display:none;">

    <div class="rowElem" id="asigurat_limfom" style="float:left;width:77%">
						 <p>
                            * Limfom non-Hodgkin
                        </p>	</div>


                 <div class="rowElem" id="asigurat_limfom" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_limfom_da" name="asigurat_limfom" value="asigurat_limfom_da">

							Nu<input type="radio" id="asigurat_limfom_nu" name="asigurat_limfom" value="asigurat_limfom_nu" checked>
						</div>    <div class="clear"></div>
                <div class="rowElem" id="asigurat_boala_hodgkin" style="float:left;width:77%">
					   <p>
                            * Boala Hodgkin
                        </p>	</div>


                    <div class="rowElem" id="asigurat_boala_hodgkin" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_boala_hodgkin_da" name="asigurat_boala_hodgkin" value="asigurat_boala_hodgkin_da">

							Nu<input type="radio" id="asigurat_boala_hodgkin_nu" name="asigurat_boala_hodgkin" value="asigurat_boala_hodgkin_nu" checked>
						</div>   <div class="clear"></div>
                <div class="rowElem" id="asigurat_tumori_maligne" style="float:left;width:77%">
					 <p>
                            * Tumori maligne<br /> (carcinom, adenocarcinom, sarcom, <br />seminom, melanom, astrocitom, <br />nefroblastom, neuroblastom, heapatoblastom, <br />mezoteliom, tumora Krukenberg)
                        </p>	</div>


                  <div class="rowElem" id="asigurat_tumori_maligne" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_tumori_maligne_da" name="asigurat_tumori_maligne" value="asigurat_tumori_maligne_da">

							Nu<input type="radio" id="asigurat_tumori_maligne_nu" name="asigurat_tumori_maligne" value="asigurat_tumori_maligne_nu" checked>
						</div>  <div class="clear"></div>
             <div class="clear"></div>
			 </div>
    <div class="rowElem" id="asigurat_boli_infectioase" style="float:left;width:77%">
						 <b>9. Boli infectioase:</b> infectie HIV/SIDA, tuberculoza activa.
      	</div>

     <div class="rowElem" id="asigurat_boli_infectioase" style="float:right;width:21%">
							Da<input type="radio" onclick="show_hide(this.value);" id="asigurat_boli_infectioase_da" name="asigurat_boli_infectioase" value="asigurat_boli_infectioase_da">

							Nu<input type="radio" onclick="show_hide(this.value);" id="asigurat_boli_infectioase_nu" name="asigurat_boli_infectioase" value="asigurat_boli_infectioase_nu" checked>
						</div>  <div class="clear"></div>
   <!-- hide0-->
   <div id="hide_show_9" style="display:none;">

  <div class="rowElem" id="asigurat_hiv_sida" style="float:left;width:77%">
						   <p>
                            * Infectie HIV/SIDA
                        </p></div>


                <div class="rowElem" id="asigurat_hiv_sida" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_hiv_sida_da" name="asigurat_hiv_sida" value="asigurat_hiv_sida_da">

							Nu<input type="radio" id="asigurat_hiv_sida_nu" name="asigurat_hiv_sida" value="asigurat_hiv_sida_nu" checked>
						</div> <div class="clear"></div>
               <div class="rowElem" id="asigurat_infectioase_tuberculoza_activa" style="float:left;width:77%">
						 <p>
                            * Tuberculoza activa
                        </p></div>


               <div class="rowElem" id="asigurat_infectioase_tuberculoza_activa" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_infectioase_tuberculoza_activa_da" name="asigurat_infectioase_tuberculoza_activa" value="asigurat_infectioase_tuberculoza_activa_da">

							Nu<input type="radio" id="asigurat_infectioase_tuberculoza_activa_nu" name="asigurat_infectioase_tuberculoza_activa" value="asigurat_infectioase_tuberculoza_activa_nu" checked>
						</div>
               <div class="clear"></div>
			   <!--hide1-->	</div>
    <div class="rowElem" id="asigurat_afectiuni_neurologice" style="float:left;width:77%">
						 <b>10. Afectiuni neurologice:</b> encefalopatia cronica infantila, parapareza, tetrapareza, epilepsie, migrena, boala Parkinson, scleroza multipla.
     	</div>

      <div class="rowElem" id="asigurat_afectiuni_neurologice" style="float:right;width:21%">
							Da<input type="radio" onclick="show_hide(this.value);" id="asigurat_afectiuni_neurologice_da" name="asigurat_afectiuni_neurologice" value="asigurat_afectiuni_neurologice_da">

							Nu<input type="radio" onclick="show_hide(this.value);" id="asigurat_afectiuni_neurologice_nu" name="asigurat_afectiuni_neurologice" value="asigurat_afectiuni_neurologice_nu" checked>
						</div>
<!--hide0-->				<div class="clear"></div>
<div id="hide_show_10" style="display:none;">
     <div class="rowElem" id="asigurat_encefalopatia" style="float:left;width:77%">
						 <p>
                            * Encefalopatia cronica infantila
                        </p></div>

                    </td>
                <div class="rowElem" id="asigurat_encefalopatia" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_encefalopatia_da" name="asigurat_encefalopatia" value="asigurat_encefalopatia_da">

							Nu<input type="radio" id="asigurat_encefalopatia_nu" name="asigurat_encefalopatia" value="asigurat_encefalopatia_nu" checked>
							</div>
							<div class="clear"></div>
			  <div class="rowElem" id="asigurat_tetrapareza" style="float:left;width:77%">
						  <p>
                            * Tetrapareza
                        </p></div>


                 <div class="rowElem" id="asigurat_tetrapareza" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_tetrapareza_da" name="asigurat_tetrapareza" value="asigurat_tetrapareza_da">

							Nu<input type="radio" id="asigurat_tetrapareza_nu" name="asigurat_tetrapareza" value="asigurat_tetrapareza_nu" checked>
						</div>    <div class="clear"></div>
               <div class="rowElem" id="asigurat_epilepsie" style="float:left;width:77%">
							 <p>
                            * Epilepsie
                        </p></div>

                  <div class="rowElem" id="asigurat_epilepsie" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_epilepsie_da" name="asigurat_epilepsie" value="asigurat_epilepsie_da">

							Nu<input type="radio" id="asigurat_epilepsie_nu" name="asigurat_epilepsie" value="asigurat_epilepsie_nu" checked>
						</div>           <div class="clear"></div>
                <div class="rowElem" id="asigurat_parapareza" style="float:left;width:77%">
						 <p>
                            * Parapareza
                        </p>	</div>


                 <div class="rowElem" id="asigurat_parapareza" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_parapareza_da" name="asigurat_parapareza" value="asigurat_parapareza_da">

							Nu<input type="radio" id="asigurat_parapareza_nu" name="asigurat_parapareza" value="asigurat_parapareza_nu" checked>
						</div>       <div class="clear"></div>
                <div class="rowElem" id="asigurat_migrena" style="float:left;width:77%">
						   <p>
                            * Migrena
                        </p></div>


                   <div class="rowElem" id="asigurat_migrena" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_migrena_da" name="asigurat_migrena" value="asigurat_migrena_da">

							Nu<input type="radio" id="asigurat_migrena_nu" name="asigurat_migrena" value="asigurat_migrena_nu" checked>
						</div>      <div class="clear"></div>
               <div class="rowElem" id="asigurat_parkinson" style="float:left;width:77%">
						  <p>
                            * Boala Parkinson
                        </p></div>


                  <div class="rowElem" id="asigurat_parkinson" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_parkinson_da" name="asigurat_parkinson" value="asigurat_parkinson_da">

							Nu<input type="radio" id="asigurat_parkinson_nu" name="asigurat_parkinson" value="asigurat_parkinson_nu" checked>
						</div>    <div class="clear"></div>
               <div class="rowElem" id="asigurat_scleroza_multipla" style="float:left;width:77%">
							 <p>
                            * Scleroza multipla
                        </p></div>

                <div class="rowElem" id="asigurat_scleroza_multipla" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_scleroza_multipla_da" name="asigurat_scleroza_multipla" value="asigurat_scleroza_multipla_da">

							Nu<input type="radio" id="asigurat_scleroza_multipla_nu" name="asigurat_scleroza_multipla" value="asigurat_scleroza_multipla_nu" checked>
						</div>
               <div class="clear"></div>
			   </div>
   <div class="rowElem" id="asigurat_afectiuni_psihice" style="float:left;width:77%">
				  <b>11. Afectiuni psihice:</b> schizofrenia, tulburare afectiva bipolare, tulburare somatofoma, depresie.
     		</div>

      <div class="rowElem" id="asigurat_afectiuni_psihice" style="float:right;width:21%">
							Da<input type="radio" onclick="show_hide(this.value);" id="asigurat_afectiuni_psihice_da" name="asigurat_afectiuni_psihice" value="asigurat_afectiuni_psihice_da">

							Nu<input type="radio" onclick="show_hide(this.value);" id="asigurat_afectiuni_psihice_nu" name="asigurat_afectiuni_psihice" value="asigurat_afectiuni_psihice_nu" checked>
						</div>    <div class="clear"></div>
  <!--hide0-->
  <div id="hide_show_11" style="display:none;">
     <div class="rowElem" id="asigurat_schizofrenia" style="float:left;width:77%">
					   <p>
                            * Schizofrenia
                        </p>	</div>

                    </td>
              <div class="rowElem" id="asigurat_schizofrenia" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_schizofrenia_da" name="asigurat_schizofrenia" value="asigurat_schizofrenia_da">

							Nu<input type="radio" id="asigurat_schizofrenia_nu" name="asigurat_schizofrenia" value="asigurat_schizofrenia_nu" checked>
						</div>     <div class="clear"></div>
                <div class="rowElem" id="asigurat_tulburare_afectiva_bipolare" style="float:left;width:77%">
						 <p>
                            * Tulburare afectiva bipolare
                        </p></div>

                  <div class="rowElem" id="asigurat_tulburare_afectiva_bipolare" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_tulburare_afectiva_bipolare_da" name="asigurat_tulburare_afectiva_bipolare" value="asigurat_tulburare_afectiva_bipolare_da">

							Nu<input type="radio" id="asigurat_tulburare_afectiva_bipolare_nu" name="asigurat_tulburare_afectiva_bipolare" value="asigurat_tulburare_afectiva_bipolare_nu" checked>
						</div>   <div class="clear"></div>
                <div class="rowElem" id="asigurat_tulburare_somatofoma" style="float:left;width:77%">
						<p>
                            * Tulburare somatofoma
                        </p>	</div>


                <div class="rowElem" id="asigurat_tulburare_somatofoma" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_tulburare_somatofoma_da" name="asigurat_tulburare_somatofoma" value="asigurat_tulburare_somatofoma_da">

							Nu<input type="radio" id="asigurat_tulburare_somatofoma_nu" name="asigurat_tulburare_somatofoma" value="asigurat_tulburare_somatofoma_nu" checked>
						</div>       <div class="clear"></div>
               <div class="rowElem" id="asigurat_depresie" style="float:left;width:77%">
  <p>
                            * Depresie
                        </p></div>


                <div class="rowElem" id="asigurat_depresie" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_depresie_da" name="asigurat_depresie" value="asigurat_depresie_da">

							Nu<input type="radio" id="asigurat_depresie_nu" name="asigurat_depresie" value="asigurat_depresie_nu" checked>
						</div>
               <div class="clear"></div>
			   </div>
    <div class="rowElem" id="asigurat_afectiuni_orl" style="float:left;width:77%">
						<b>12. Afectiuni O.R.L.:</b> otita cronica, sinuzita cronica?
      		</div>

       <div class="rowElem" id="asigurat_afectiuni_orl" style="float:right;width:21%">
							Da<input type="radio" onclick="show_hide(this.value);" id="asigurat_afectiuni_orl_da" name="asigurat_afectiuni_orl" value="asigurat_afectiuni_orl_da">

							Nu<input type="radio" onclick="show_hide(this.value);" id="asigurat_afectiuni_orl_nu" name="asigurat_afectiuni_orl" value="asigurat_afectiuni_orl_nu" checked>
						</div>
						<div class="clear"></div>
<div id="hide_show_12" style="display:none;">
    <div class="rowElem" id="asigurat_otita_cronica" style="float:left;width:77%">
						  <p>
                            * Otita cronica
                        </p></div>


                  <div class="rowElem" id="asigurat_otita_cronica" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_otita_cronica_da" name="asigurat_otita_cronica" value="asigurat_otita_cronica_da">

							Nu<input type="radio" id="asigurat_otita_cronica_nu" name="asigurat_otita_cronica" value="asigurat_otita_cronica_nu" checked>
						</div>   <div class="clear"></div>
               <div class="rowElem" id="asigurat_sinuzita_cronica" style="float:left;width:77%">
					 <p>
                            * Sinuzita cronica
                        </p></div>


                  <div class="rowElem" id="asigurat_sinuzita_cronica" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_sinuzita_cronica_da" name="asigurat_sinuzita_cronica" value="asigurat_sinuzita_cronica_da">

							Nu<input type="radio" id="asigurat_sinuzita_cronica_nu" name="asigurat_sinuzita_cronica" value="asigurat_sinuzita_cronica_nu" checked>
						</div>
               <div class="clear"></div>
</div>
  <div class="rowElem" id="asigurat_afectiuni_oftalmologice" style="float:left;width:77%">
						 <b>13. Afectiuni oftalmologice:</b> glaucom, retinopatie pigmentara, cataracta?
      	</div>

     <div class="rowElem" id="asigurat_afectiuni_oftalmologice" style="float:right;width:21%">
							Da<input type="radio" onclick="show_hide(this.value);" id="asigurat_afectiuni_oftalmologice_da" name="asigurat_afectiuni_oftalmologice" value="asigurat_afectiuni_oftalmologice_da">

							Nu<input type="radio" onclick="show_hide(this.value);" id="asigurat_afectiuni_oftalmologice_nu" name="asigurat_afectiuni_oftalmologice" value="asigurat_afectiuni_oftalmologice_nu" checked>
						</div>
    <div class="clear"></div>
	<div id="hide_show_13" style="display:none;">
  <div class="rowElem" id="asigurat_glaucom" style="float:left;width:77%">
						 <p>
                            * Glaucom
                        </p>	</div>

                <div class="rowElem" id="asigurat_glaucom" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_glaucom_da" name="asigurat_glaucom" value="asigurat_glaucom_da">

							Nu<input type="radio" id="asigurat_glaucom_nu" name="asigurat_glaucom" value="asigurat_glaucom_nu" checked>
						</div>     <div class="clear"></div>
                <div class="rowElem" id="asigurat_retinopatie_pigmentara" style="float:left;width:77%">
						<p>
                            * Retinopatie pigmentara
                        </p>	</div>


                <div class="rowElem" id="asigurat_retinopatie_pigmentara" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_retinopatie_pigmentara_da" name="asigurat_retinopatie_pigmentara" value="asigurat_retinopatie_pigmentara_da">

							Nu<input type="radio" id="asigurat_retinopatie_pigmentara_nu" name="asigurat_retinopatie_pigmentara" value="asigurat_retinopatie_pigmentara_nu" checked>
						</div>   <div class="clear"></div>
               <div class="rowElem" id="asigurat_cataracta" style="float:left;width:77%">
					 <p>
                            * Cataracta
                        </p>		</div>



                 <div class="rowElem" id="asigurat_cataracta" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_cataracta_da" name="asigurat_cataracta" value="asigurat_cataracta_da">

							Nu<input type="radio" id="asigurat_cataracta_nu" name="asigurat_cataracta" value="asigurat_cataracta_nu" checked>
						</div>

              <div class="clear"></div>
			  </div>
    <div class="rowElem" id="asigurat_afectiuni_reumatica" style="float:left;width:77%">
						 <b>14. Afectiuni reumatica si osteoarticulare:</b> polialtrita reumatoida, lupus eritamatos sistematic, spondilodiscopatia, hernie de disc, osteoartrita, osteopenie / osteoporoza?</div>


         <div class="rowElem" id="asigurat_afectiuni_reumatica" style="float:right;width:21%">
							Da<input type="radio" onclick="show_hide(this.value);" id="asigurat_afectiuni_reumatica_da" name="asigurat_afectiuni_reumatica" value="asigurat_afectiuni_reumatica_da">

							Nu<input type="radio" onclick="show_hide(this.value);" id="asigurat_afectiuni_reumatica_nu" name="asigurat_afectiuni_reumatica" value="asigurat_afectiuni_reumatica_nu" checked>
						</div>
						<div class="clear"></div>
						<div id="hide_show_14" style="display:none;">
   <div class="rowElem" id="asigurat_polialtrita_reumatoida" style="float:left;width:77%">
						  <p>
                            * Polialtrita reumatoida
                        </p>	</div>

                    </td>
               <div class="rowElem" id="asigurat_polialtrita_reumatoida" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_polialtrita_reumatoida_da" name="asigurat_polialtrita_reumatoida" value="asigurat_polialtrita_reumatoida_da">

							Nu<input type="radio" id="asigurat_polialtrita_reumatoida_nu" name="asigurat_polialtrita_reumatoida" value="asigurat_polialtrita_reumatoida_nu" checked>
						</div>      <div class="clear"></div>
              <div class="rowElem" id="asigurat_lupus_eritamatos_sistematic" style="float:left;width:77%">
							  <p>
                            * Lupus eritamatos sistematic
                        </p>	</div>


                <div class="rowElem" id="asigurat_lupus_eritamatos_sistematic" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_lupus_eritamatos_sistematic_da" name="asigurat_lupus_eritamatos_sistematic" value="asigurat_lupus_eritamatos_sistematic_da">

							Nu<input type="radio" id="asigurat_lupus_eritamatos_sistematic_nu" name="asigurat_lupus_eritamatos_sistematic" value="asigurat_lupus_eritamatos_sistematic_nu" checked>
						</div>     <div class="clear"></div>
                <div class="rowElem" id="asigurat_reumatice_artrita_cronica" style="float:left;width:77%">
						  <p>
                            * Artrita cronica
                        </p></div>


                 <div class="rowElem" id="asigurat_reumatice_artrita_cronica" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_reumatice_artrita_cronica_da" name="asigurat_reumatice_artrita_cronica" value="asigurat_reumatice_artrita_cronica_da">

							Nu<input type="radio" id="asigurat_reumatice_artrita_cronica_nu" name="asigurat_reumatice_artrita_cronica" value="asigurat_reumatice_artrita_cronica_nu" checked>
						</div>     <div class="clear"></div>
               <div class="rowElem" id="asigurat_osteopenie_osteoporoza" style="float:left;width:77%">
						<p>
                            * Osteopenie/Osteoporoza
                        </p>	</div>


                  <div class="rowElem" id="asigurat_osteopenie_osteoporoza" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_osteopenie_osteoporoza_da" name="asigurat_osteopenie_osteoporoza" value="asigurat_osteopenie_osteoporoza_da">

							Nu<input type="radio" id="asigurat_osteopenie_osteoporoza_nu" name="asigurat_osteopenie_osteoporoza" value="asigurat_osteopenie_osteoporoza_nu" checked>
						</div>  <div class="clear"></div>
                <div class="rowElem" id="asigurat_spondilodiscopatia" style="float:left;width:77%">
					<p>
                            * Spondilodiscopatia
                        </p>	</div>


                 <div class="rowElem" id="asigurat_spondilodiscopatia" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_spondilodiscopatia_da" name="asigurat_spondilodiscopatia" value="asigurat_spondilodiscopatia_da">

							Nu<input type="radio" id="asigurat_spondilodiscopatia_nu" name="asigurat_spondilodiscopatia" value="asigurat_spondilodiscopatia_nu" checked>
						</div>    <div class="clear"></div>
               <div class="rowElem" id="asigurat_hernie_de_disc" style="float:left;width:77%">
						 <p>
                            * Hernie de disc
                        </p>	</div>


                  <div class="rowElem" id="asigurat_hernie_de_disc" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_hernie_de_disc_da" name="asigurat_hernie_de_disc" value="asigurat_hernie_de_disc_da">

							Nu<input type="radio" id="asigurat_hernie_de_disc_nu" name="asigurat_hernie_de_disc" value="asigurat_hernie_de_disc_nu" checked>
						</div>     <div class="clear"></div>
                <div class="rowElem" id="asigurat_osterioartrita" style="float:left;width:77%">
						 <p>
                            * Osteoartrita
                        </p>	</div>


                <div class="rowElem" id="asigurat_osterioartrita" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_osterioartrita_da" name="asigurat_osterioartrita" value="asigurat_osterioartrita_da">

							Nu<input type="radio" id="asigurat_osterioartrita_nu" name="asigurat_osterioartrita" value="asigurat_osterioartrita_nu" checked>
				</div><div class="clear"></div>
				</div>
   <div class="rowElem" id="asigurat_afectiuni_renala" style="float:left;width:77%">
						 <b>15. Afectiuni renale si ale cailor urinare:</b> insuficienta renala cronica, litiza renala, pielonefrita cronica, glomerulonefrita, sindrom nefrotic, ureterohidronefroza, sitenoza uretrala?
      	</div>

      <div class="rowElem" id="asigurat_afectiuni_renala" style="float:right;width:21%">
							Da<input type="radio" onclick="show_hide(this.value);" id="asigurat_afectiuni_renala_da" name="asigurat_afectiuni_renala" value="asigurat_afectiuni_renala_da">

							Nu<input type="radio" onclick="show_hide(this.value);" id="asigurat_afectiuni_renala_nu" name="asigurat_afectiuni_renala" value="asigurat_afectiuni_renala_nu" checked>
						</div>  <div class="clear"></div>
   <!--0hide-->
   <div id="hide_show_15" style="display:none;">
    <div class="rowElem" id="asigurat_insuficienta_renala_cronica" style="float:left;width:77%">
						 <p>
                            * Insuficienta renala cronica
                        </p>	</div>


             <div class="rowElem" id="asigurat_insuficienta_renala_cronica" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_insuficienta_renala_cronica_da" name="asigurat_insuficienta_renala_cronica" value="asigurat_afectiuni_renala_da">

							Nu<input type="radio" id="asigurat_insuficienta_renala_cronica_nu" name="asigurat_insuficienta_renala_cronica" value="asigurat_insuficienta_renala_cronica_nu" checked>
						</div>     <div class="clear"></div>
                <div class="rowElem" id="asigurat_litiza_renala" style="float:left;width:77%">
						  <p>
                            * Litiza renala
                        </p>		</div>


               <div class="rowElem" id="asigurat_litiza_renala" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_litiza_renala_da" name="asigurat_litiza_renala" value="asigurat_litiza_renala_da">

							Nu<input type="radio" id="asigurat_litiza_renala_nu" name="asigurat_litiza_renala" value="asigurat_litiza_renala_nu" checked>
						</div>    <div class="clear"></div>
                <div class="rowElem" id="asigurat_pielonefrita_cronica" style="float:left;width:77%">
						 <p>
                            * Pielonefrita cronica
                        </p>	</div>


                    <div class="rowElem" id="asigurat_pielonefrita_cronica" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_pielonefrita_cronica_da" name="asigurat_pielonefrita_cronica" value="asigurat_pielonefrita_cronica_da">

							Nu<input type="radio" id="asigurat_pielonefrita_cronica_nu" name="asigurat_pielonefrita_cronica" value="asigurat_pielonefrita_cronica_nu" checked>
						</div>     <div class="clear"></div>
               <div class="rowElem" id="asigurat_glomerulonefrita" style="float:left;width:77%">
						 <p>
                            * Glomerulonefrita
                        </p>	</div>


                <div class="rowElem" id="asigurat_glomerulonefrita" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_glomerulonefrita_da" name="asigurat_glomerulonefrita" value="asigurat_glomerulonefrita_da">

							Nu<input type="radio" id="asigurat_glomerulonefrita_nu" name="asigurat_glomerulonefrita" value="asigurat_glomerulonefrita_nu" checked>
						</div>       <div class="clear"></div>
                <div class="rowElem" id="asigurat_sindrom_nefrotic" style="float:left;width:77%">
						 <p>
                            * Sindrom nefrotic
                        </p>	</div>


                  <div class="rowElem" id="asigurat_sindrom_nefrotic" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_sindrom_nefrotic_da" name="asigurat_sindrom_nefrotic" value="asigurat_sindrom_nefrotic_da">

							Nu<input type="radio" id="asigurat_sindrom_nefrotic_nu" name="asigurat_sindrom_nefrotic" value="asigurat_sindrom_nefrotic_nu" checked>
						</div>    <div class="clear"></div>
               <div class="rowElem" id="asigurat_ureterohidronefroza" style="float:left;width:77%">
						 <p>
                            * Ureterohidronefroza
                        </p>	</div>


                   <div class="rowElem" id="asigurat_ureterohidronefroza" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_ureterohidronefroza_da" name="asigurat_ureterohidronefroza" value="asigurat_ureterohidronefroza_da">

							Nu<input type="radio" id="asigurat_ureterohidronefroza_nu" name="asigurat_ureterohidronefroza" value="asigurat_ureterohidronefroza_nu" checked>
						</div>   <div class="clear"></div>
                <div class="rowElem" id="asigurat_sitenoza_uretrala" style="float:left;width:77%">
						<p>
                            * Sitenoza uretrala
                        </p>	</div>


               <div class="rowElem" id="asigurat_sitenoza_uretrala" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_sitenoza_uretrala_da" name="asigurat_sitenoza_uretrala" value="asigurat_sitenoza_uretrala_da">

							Nu<input type="radio" id="asigurat_sitenoza_uretrala_nu" name="asigurat_sitenoza_uretrala" value="asigurat_sitenoza_uretrala_nu" checked>
						</div>
               <div class="clear"></div>
</div>
    <div class="rowElem" id="asigurat_afectiuni_prostata" style="float:left;width:77%">
						   <b>16. Afectiuni ale prostatei</b> adenom al prostatei.
    		</div>

      <div class="rowElem" id="asigurat_afectiuni_prostata" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_afectiuni_prostata_da" name="asigurat_afectiuni_prostata" value="asigurat_afectiuni_prostata_da">

							Nu<input type="radio" id="asigurat_afectiuni_prostata_nu" name="asigurat_afectiuni_prostata" value="asigurat_afectiuni_prostata_nu" checked>
						</div>     <div class="clear"></div>


     <div class="rowElem" id="asigurat_afectiuni_ginecologice" style="float:left;width:77%">
						  <b>17. Afectiuni ginecologice</b> infectie HPV, cervicita cronica, fibromatoza uterina, endometrioza, mastopatia fibrochistica, nodul mamar, boala inflamatorie pelvina, anexita cronica?
      	</div>

      <div class="rowElem" id="asigurat_afectiuni_ginecologice" style="float:right;width:21%">
							Da<input type="radio" onclick="show_hide(this.value);" id="asigurat_afectiuni_ginecologice_da" name="asigurat_afectiuni_ginecologice" value="asigurat_afectiuni_ginecologice_da">

							Nu<input type="radio" onclick="show_hide(this.value);" id="asigurat_afectiuni_ginecologice_nu" name="asigurat_afectiuni_ginecologice" value="asigurat_afectiuni_ginecologice_nu" checked>
						</div>
    <div class="clear"></div>
	<div id="hide_show_17" style="display:none;">
	<!--0hide-->
   <div class="rowElem" id="asigurat_infectie_hpv" style="float:left;width:77%">
						   <p>
                            * Infectie HPV
                        </p></div>

              <div class="rowElem" id="asigurat_infectie_hpv" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_infectie_hpv_da" name="asigurat_infectie_hpv" value="asigurat_infectie_hpv_da">

							Nu<input type="radio" id="asigurat_infectie_hpv_nu" name="asigurat_infectie_hpv" value="asigurat_infectie_hpv_nu" checked>
						</div>        <div class="clear"></div>
                <div class="rowElem" id="asigurat_cervicita_cronica" style="float:left;width:77%">
					 <p>
                            * Cervicita cronica
                        </p>	</div>


                  <div class="rowElem" id="asigurat_cervicita_cronica" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_cervicita_cronica_da" name="asigurat_cervicita_cronica" value="asigurat_cervicita_cronica_da">

							Nu<input type="radio" id="asigurat_cervicita_cronica_nu" name="asigurat_cervicita_cronica" value="asigurat_cervicita_cronica_nu" checked>
						</div>   <div class="clear"></div>
                 <div class="rowElem" id="asigurat_fibromatoza_uterina" style="float:left;width:77%">
						  <p>
                            * Fibromatoza uterina
                        </p>	</div>

                <div class="rowElem" id="asigurat_fibromatoza_uterina" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_fibromatoza_uterina_da" name="asigurat_fibromatoza_uterina" value="asigurat_fibromatoza_uterina_da">

							Nu<input type="radio" id="asigurat_fibromatoza_uterina_nu" name="asigurat_fibromatoza_uterina" value="asigurat_fibromatoza_uterina_nu" checked>
						</div>   <div class="clear"></div>
                 <div class="rowElem" id="asigurat_endometrioza" style="float:left;width:77%">
							 <p>
                            * Endometrioza
                        </p>	</div>


                <div class="rowElem" id="asigurat_endometrioza" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_endometrioza_da" name="asigurat_endometrioza" value="asigurat_endometrioza_da">

							Nu<input type="radio" id="asigurat_endometrioza_nu" name="asigurat_endometrioza" value="asigurat_endometrioza_nu" checked>
						</div>  <div class="clear"></div>
                <div class="rowElem" id="asigurat_mastopatia_fibrochistica" style="float:left;width:77%">
						 <p>
                            * Mastopatia fibrochistica
                        </p>	</div>


                <div class="rowElem" id="asigurat_mastopatia_fibrochistica" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_mastopatia_fibrochistica_da" name="asigurat_mastopatia_fibrochistica" value="asigurat_mastopatia_fibrochistica_da">

							Nu<input type="radio" id="asigurat_mastopatia_fibrochistica_nu" name="asigurat_mastopatia_fibrochistica" value="asigurat_mastopatia_fibrochistica_nu" checked>
						</div> <div class="clear"></div>
                 <div class="rowElem" id="asigurat_boala_inflamatorie_pelvina" style="float:left;width:77%">
						  <p>
                            * Boala inflamatorie pelvina
                        </p>	</div>


               <div class="rowElem" id="asigurat_boala_inflamatorie_pelvina" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_boala_inflamatorie_pelvina_da" name="asigurat_boala_inflamatorie_pelvina" value="asigurat_boala_inflamatorie_pelvina_da">

							Nu<input type="radio" id="asigurat_boala_inflamatorie_pelvina_nu" name="asigurat_boala_inflamatorie_pelvina" value="asigurat_boala_inflamatorie_pelvina_nu" checked>
						</div>    <div class="clear"></div>
               <div class="rowElem" id="asigurat_anexita_cronica" style="float:left;width:77%">
						 <p>
                            * Anexita cronica
                        </p>	</div>


                   <div class="rowElem" id="asigurat_anexita_cronica" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_anexita_cronica_da" name="asigurat_anexita_cronica" value="asigurat_anexita_cronica_da">

							Nu<input type="radio" id="asigurat_anexita_cronica_nu" name="asigurat_anexita_cronica" value="asigurat_anexita_cronica_nu" checked>
						</div>   <div class="clear"></div>
                 <div class="rowElem" id="asigurat_nodul_mamar" style="float:left;width:77%">
					 <p>
                            * Nodul mamar
                        </p></div>


                 <div class="rowElem" id="asigurat_nodul_mamar" style="float:right;width:21%">
							Da<input type="radio" id="asigurat_nodul_mamar_da" name="asigurat_nodul_mamar" value="asigurat_nodul_mamar_da">

							Nu<input type="radio" id="asigurat_nodul_mamar_nu" name="asigurat_nodul_mamar" value="asigurat_nodul_mamar_nu" checked>
						</div>  <div class="clear"></div>
                    </div>
				
				
				

     <div class="rowElem" id="asigurat_afectiuni_preexistente" style="float:left;width:77%">
						  <b>Afecțiuni Pre-existente</b>
      	</div>

      <div class="rowElem" id="asigurat_afectiuni_preexistente" style="float:right;width:21%">
							Da<input type="radio" onclick="show_hide(this.value);" id="asigurat_afectiuni_preexistente_da" name="asigurat_afectiuni_preexistente" value="asigurat_afectiuni_preexistente_da">

							Nu<input type="radio" onclick="show_hide(this.value);" id="asigurat_afectiuni_preexistente_nu" name="asigurat_afectiuni_preexistente" value="asigurat_afectiuni_preexistente_nu" checked>
						</div>
    <div class="clear"></div>
	<div id="hide_show_18" style="display:none;">
	<!--0hide-->
  
                <textarea id="asigurat_afectiuni_preexistente_text" name="asigurat_afectiuni_preexistente_text" rows="4" cols="50" placeholder="Va rugam sa detaliati afectiunile pre-existente de care suferiti" value="<?php echo $asigurat_afectiuni_preexistente_text; ?>"></textarea>




                  <div class="clear"></div>
                    </div>				



    <div class="clear"></div>
					
					
<div class="bullet">
            Date despre Asigurare
          </div>
    <div class="clear"></div>

	<div class="rowElem" id="perioada_de_asigurare-div" style="float:left;width:49%">
            <span>Perioada de asigurare</span><?php echo $notificare; ?><br>
			 <div class="clear"></div>

            <select name="perioada_de_asigurare" id="perioada_de_asigurare" >
                <option <?php if ($perioada_de_asigurare=='Alegeti' ) echo "selected"; ?> value="Alegeti">Alegeti</option>
                <option <?php if ($perioada_de_asigurare=='1 an' ) echo "selected"; ?> value="1 an">1 an</option>
                <option <?php if ($perioada_de_asigurare=='2 ani' ) echo "selected"; ?> value="2 ani">2 ani</option>
				<option <?php if ($perioada_de_asigurare=='3 ani' ) echo "selected"; ?> value="3 ani">3 ani</option>
				<option <?php if ($perioada_de_asigurare=='4 ani' ) echo "selected"; ?> value="4 ani">4 ani</option>
				<option <?php if ($perioada_de_asigurare=='5 ani' ) echo "selected"; ?> value="5 ani">5 ani</option>
		    </select>

		    <div id="perioada_de_asigurare-tip" class="jFormerTip">
				
		    </div>
    </div>
	<div class="clear"></div>

    <div class="rowElem" id="frecventa_plata-div" style="float:left;width:49%">
            <span>Frecventa de plata a primei:</span><?php echo $notificare; ?><br>
            <div class="clear"></div>

            <select name="frecventa_plata" id="frecventa_plata" >
                <option <?php if ($frecventa_plata=='Alegeti' ) echo "selected"; ?> value="Alegeti">Alegeti</option>
                <option <?php if ($frecventa_plata=='Integrala' ) echo "selected"; ?> value="Integrala">Integrala</option>
                <option <?php if ($frecventa_plata=='Semestriala' ) echo "selected"; ?> value="Semestriala">Semestriala</option>
				<option <?php if ($frecventa_plata=='Trimestriala' ) echo "selected"; ?> value="Trimestriala">Trimestriala</option>
		    </select>

            <div id="frecventa_plata-tip" class="jFormerTip">  </div>
        </div>


    <div class="rowElem" id="moneda-div" style="float:left;width:49%;">
			<span>Moneda:</span><?php echo $notificare; ?><br>
			<select name="moneda" id="moneda">
				<option <?php if ($moneda=='Ron') echo "selected"; ?> value="Ron">Ron</option>
			</select>
			<div id="moneda-tip" class="jFormerTip">
				
			</div>
	</div>

		 <div class="clear"></div>


   <div class="rowElem" id="data_valabilitate_start-div" style="float:left;width:49%;">
			<span>Data valabilitate start</span><?php echo $notificare; ?><br>
			<input id="data_valabilitate_start" type="text" name="data_valabilitate_start" value="<?php echo $data_valabilitate_start; ?>" />
			<div id="data_valabilitate_start-tip" class="jFormerTip" style="margin-top:0px;">
				<div class="tipContent"><p>Data intrarii in vigoare a politei</p></div>
			</div>
		</div>
		 <div class="clear"></div>
		 
		 
		 
		 	<div class="rowElem" id="acoperire_internationala-div" style="float:left;width:77%">
           <b>Acoperire internationala</b>   </div>       
            <div class="rowElem" id="acoperire_internationala" style="float:right;width:21%">
							Da<input type="radio" id="acoperire_internationala_da" name="acoperire_internationala" value="acoperire_internationala_da">

							Nu<input type="radio" id="acoperire_internationala_nu" name="acoperire_internationala" value="acoperire_internationala_nu" checked>
						</div>				
    <div class="clear"></div>
	
	
	
	 	<div class="rowElem" id="clauza_spitalizare-div" style="float:left;width:77%">
           <b>Clauza Spitalizare si interventii chirurgicale</b>   </div>       
            <div class="rowElem" id="clauza_spitalizare" style="float:right;width:21%">
							Da<input type="radio" id="clauza_spitalizare_da" name="clauza_spitalizare" value="clauza_spitalizare_da">

							Nu<input type="radio" id="clauza_spitalizare_nu" name="clauza_spitalizare" value="clauza_spitalizare_nu" checked>
						</div>				
    <div class="clear"></div>




	
	
     <div class="rowElem" id="clauza_preventie" style="float:left;width:77%">
							  <b>Clauza preventie</b>	</div>
    <div class="rowElem" id="clauza_preventie" style="float:right;width:21%">
							Da<input type="radio" id="clauza_preventie_da" name="clauza_preventie" value="clauza_preventie_da">

							Nu<input type="radio" id="clauza_preventie_nu" name="clauza_preventie" value="clauza_preventie_nu" checked>
						</div>
        <div class="clear"></div>



    <div class="rowElem" id="clauza_ambulatorie_pentru_copii" style="float:left;width:77%">
							  <b>Clauza ambulatorie pentru copii</b>	</div>

    <div class="rowElem" id="clauza_ambulatorie_pentru_copii" style="float:right;width:21%">
							Da<input type="radio" id="clauza_ambulatorie_pentru_copii_da" name="clauza_ambulatorie_pentru_copii" value="clauza_ambulatorie_pentru_copii_da">

							Nu<input type="radio" id="clauza_ambulatorie_pentru_copii_nu" name="clauza_ambulatorie_pentru_copii" value="clauza_ambulatorie_pentru_copii_nu" checked>
						</div>
        <div class="clear"></div>


   <div class="rowElem" id="clauza_chirurgicale_pentru_copii" style="float:left;width:77%">
							 <b>Clauza specializare si interventii chirurgicale pentru copii</b>	</div>

    <div class="rowElem" id="clauza_chirurgicale_pentru_copii" style="float:right;width:21%">
							Da<input type="radio" id="clauza_chirurgicale_pentru_copii_da" name="clauza_chirurgicale_pentru_copii" value="clauza_chirurgicale_pentru_copii_da">

							Nu<input type="radio" id="clauza_chirurgicale_pentru_copii_nu" name="clauza_chirurgicale_pentru_copii" value="clauza_chirurgicale_pentru_copii_nu" checked>
						</div>
        <div class="clear"></div>


	<div class="clear"></div>

  <div class="rowElem" id="copii_inclusi" style="float:left;width:77%">
							  <b>Doriti sa includeti si copii in asigurare?</b>	</div>

    <div class="rowElem" id="copii_inclusi" style="float:right;width:21%">
							Da<input type="radio" onclick="show_hide(this.value);" id="copii_inclusi_da" name="copii_inclusi" value="copii_inclusi_da">

							Nu<input type="radio" onclick="show_hide(this.value);" id="copii_inclusi_nu" name="copii_inclusi" value="copii_inclusi_nu" checked>
						</div>
        <div class="clear"></div>



    <div id="c_hide_show" style="display:none;">
       <!--hide////////////////////////	-->







     <div class="rowElem" id="copii_inclusi" style="float:left;width:49%">
							  <b>Cati copii doriti sa includeti in asigurare?</b>	</div>

   <div class="input-group" style="width:30%;float:left;">
   	<span class="input-group-btn">
   <button class="btn btn-red btn-pluss" type="button"  id="btnDel" disabled>-</button>
     	</span><?php echo $notificare; ?><br>
   	<input type="text" class="form-control no-padding add-color text-center height-20" maxlength="3" value="1" id="nrCopii" name="flajok" disabled>
   	 	<span class="input-group-btn">
   <button class="btn btn-white btn-minuse" type="button"  id="btnAdd">+</button>
   	</span><?php echo $notificare; ?><br>
   </div>


     <div class="clear"></div>

    <div class="exemplu" id="exemplu_1" name="exemplu">

      <div style="display:none">
       <input type="text" name="flajok[]" value="" />
       </div>

      <div class="rowElem" id="copil_1" style="float:left;width:77%">
                <p><h4>Copil 1</h4></p></div>

    <div class="rowElem" id="nume_copil-div_1" style="float:left;width:49%;">
               <span>Nume</span><?php echo $notificare; ?><br>
               <input class="kid" id="nume_copil_1" type="text" name="nume_copil_1" value="" />

    </div>




     <div class="rowElem" id="prenume_copil_1-div" style="float:right;width:49%;">
  <span>Prenume</span><?php echo $notificare; ?><br>
  <input id="prenume_copil_1" type="text" name="prenume_copil_1" value="<?php echo $prenume_copil_1; ?>" />
  <div id="prenume_copil_1-tip" class="jFormerTip">
  
  </div>
  </div>
   <div class="clear"></div>
  <div class="rowElem" id="cnp_copil_1-div" style="float:left;width:49%;">
  <span>CNP</span><?php echo $notificare; ?><br>
  <input id="cnp_copil_1" type="text" name="cnp_copil_1" value="<?php echo $cnp_copil_1; ?>" />
  <div id="cnp_copil_1-tip" class="jFormerTip">
  
  </div>
  </div>

     <div class="rowElem" id="data_nasterii_copil_1-div" style="float:right;width:49%;">
    <span>Data nasterii:</span><?php echo $notificare; ?><br>
    <input id="data_nasterii_copil_1" type="text" name="data_nasterii_copil_1" value="<?php echo $data_nasterii_copil_1; ?>" />
    <div id="data_nasterii_copil_1-tip" class="jFormerTip" style="margin-top:0px;">
    
    </div>
    </div>


  


     <div class="clear"></div>

               <div class="bullet">
            Date Asigurare copil
     </div>

     <div class="rowElem" id="copil_diagnostic_1" style="float:left;width:77%">
               <b>Copilul dumneavoastra a fost diagnosticat/ tratat/ investigat sau supravegheat medical cu/ pentru una din urmatoarele afectiuni medicale?</b>
                 </div>
                      <div class="clear"></div>

                  <div class="rowElem" id="copii_defect_congenital_1" style="float:left;width:77%">
                <b>
                                         1. Defecte congenitale ale cordonului: tetralogie/ trilogie/ pentalogie/ heaxalogie Fallot, transpozitie a vaselor mari,
                                         anomalie Ebstein, defect septal atrial de tip ostium primum, coarctatie de aorta, persistenta a canalului arterial, defect septal venticular.
                                     </b>	</div>

     <div class="rowElem" id="copii_defect_congenital_1" style="float:right;width:21%">
               Da<input type="radio" id="copii_defect_congenital_da_1" name="copii_defect_congenital_1" value="copii_defect_congenital_da_1"  >

               Nu<input type="radio" id="copii_defect_congenital_nu_1" name="copii_defect_congenital_1" value="copii_defect_congenital_nu_1" checked>
             </div>
         <div class="clear"></div>


                               <div class="rowElem" id="asigurare_reinnoire" style="float:left;width:77%">
                 <b>
                                         2. Afectiuni respiratorii: insuficienta respiratorie
                                     </b>	</div>

     <div class="rowElem" id="copii_insuficienta_respiratorie_1" style="float:right;width:21%">
               Da<input type="radio" id="copii_insuficienta_respiratorie_da_1" name="copii_insuficienta_respiratorie_1" value="copii_insuficienta_respiratorie_da_1"  >

               Nu<input type="radio" id="copii_insuficienta_respiratorie_nu_1" name="copii_insuficienta_respiratorie_1" value="copii_insuficienta_respiratorie_nu_1" checked>
             </div>
         <div class="clear"></div>


                              <div class="rowElem" id="asigurare_reinnoire" style="float:left;width:77%">
                 <b>
                                         3. Afectiuni digestive: ciroza hepatica, atrezie esofagiana, atrezie intestinala, megacolon congenital
                                     </b>	</div>

     <div class="rowElem" id="copii_afectiuni_digestive_1" style="float:right;width:21%">
               Da<input type="radio" onclick="show_hide(this.value);" id="copii_afectiuni_digestive_da_1"  name="copii_afectiuni_digestive_1" value="copii_afectiuni_digestive_da_1"  >

               Nu<input type="radio" onclick="show_hide(this.value);" id="copii_afectiuni_digestive_nu_1" name="copii_afectiuni_digestive_1" value="copii_afectiuni_digestive_nu_1" checked>
             </div>
         <div class="clear"></div>
                          <!-- hide0-->

	<div id="hide_show_c_3-1" style="display:none;">

                            <div class="rowElem" id="asigurare_reinnoire" style="float:left;width:77%">
                 <b>
                                          Ciroza hepatica
                                     </b>	</div>

     <div class="rowElem" id="copii_ciroza_hepatica_1" style="float:right;width:21%">
               Da<input type="radio" id="copii_ciroza_hepatica_da_1" name="copii_ciroza_hepatica_1" value="copii_ciroza_hepatica_da_1"  >

               Nu<input type="radio" id="copii_ciroza_hepatica_nu_1" name="copii_ciroza_hepatica_1" value="copii_ciroza_hepatica_nu_1" checked>
             </div>
         <div class="clear"></div>

                                     <div class="rowElem" id="asigurare_reinnoire" style="float:left;width:77%">
                 <b>
                                         Atrezie esofagiana
                                     </b>	</div>

     <div class="rowElem" id="copii_atrezie_esofagiana_1" style="float:right;width:21%">
               Da<input type="radio" id="copii_atrezie_esofagiana_da_1" name="copii_atrezie_esofagiana_1" value="copii_atrezie_esofagiana_da_1"  >

               Nu<input type="radio" id="copii_atrezie_esofagiana_nu_1" name="copii_atrezie_esofagiana_1" value="copii_atrezie_esofagiana_nu_1" checked>
             </div>
         <div class="clear"></div>

                               <div class="rowElem" id="asigurare_reinnoire" style="float:left;width:77%">
                 <b>
                                         Atrezie intestinala
                                     </b>	</div>

     <div class="rowElem" id="copii_atrezie_intestinala_1" style="float:right;width:21%">
               Da<input type="radio" id="copii_atrezie_intestinala_da_1" name="copii_atrezie_intestinala_1" value="copii_atrezie_intestinala_da_1"  >

               Nu<input type="radio" id="copii_atrezie_intestinala_nu_1" name="copii_atrezie_intestinala_1" value="copii_atrezie_intestinala_nu_1" checked>
             </div>
         <div class="clear"></div>


                            <div class="rowElem" id="asigurare_reinnoire" style="float:left;width:77%">
                 <b>
                                          Megacolon congenital
                                     </b>	</div>

     <div class="rowElem" id="copii_megacolon_congenital_1" style="float:right;width:21%">
               Da<input type="radio" id="copii_megacolon_congenital_da_1" name="copii_megacolon_congenital_1" value="copii_megacolon_congenital_da_1"  >

               Nu<input type="radio" id="copii_megacolon_congenital_nu_1" name="copii_megacolon_congenital_1" value="copii_megacolon_congenital_nu_1" checked>
             </div>
         <div class="clear"></div>

		 </div>
                                 <!--hide1-->

                              <div class="rowElem" id="asigurare_reinnoire" style="float:left;width:77%">
                  <b>
                                         4. Boli metabolice si de nutritie: diabet zaharat
                                     </b></div>

     <div class="rowElem" id="copii_boli_metabolice_1" style="float:right;width:21%">
               Da<input type="radio" id="copii_boli_metabolice_da_1" name="copii_boli_metabolice_1" value="copii_boli_metabolice_da_1"  >

               Nu<input type="radio" id="copii_boli_metabolice_nu_1" name="copii_boli_metabolice_1" value="copii_boli_metabolice_nu_1" checked>
             </div>
         <div class="clear"></div>


                             <div class="rowElem" id="copii_afectiuni_ereditale" style="float:left;width:77%">
                  <b>
                                         5. Afectiuni ereditare si anomalii cromozomiale: fibroza chistica, sidromul Down.
                                     </b></div>

     <div class="rowElem" id="copii_afectiuni_ereditale_1" style="float:right;width:21%">
               Da<input type="radio" onclick="show_hide(this.value);" id="copii_afectiuni_ereditale_da_1" name="copii_afectiuni_ereditale_1" value="copii_afectiuni_ereditale_da_1"  >

               Nu<input type="radio" onclick="show_hide(this.value);" id="copii_afectiuni_ereditale_nu_1" name="copii_afectiuni_ereditale_1" value="copii_afectiuni_ereditale_nu_1" checked>
             </div>
         <div class="clear"></div>

                                <!--hide0-->
									<div id="hide_show_c_5-1" style="display:none;">

                            <div class="rowElem" id="copii_fibroza_chistica_1" style="float:left;width:77%">
                  <b>
                                        Fibroza chistica
                                     </b></div>

     <div class="rowElem" id="copii_fibroza_chistica_1" style="float:right;width:21%">
               Da<input type="radio" id="copii_fibroza_chistica_da_1" name="copii_fibroza_chistica_1" value="copii_fibroza_chistica_da_1"  >

               Nu<input type="radio" id="copii_fibroza_chistica_nu_1" name="copii_fibroza_chistica_1" value="copii_fibroza_chistica_nu_1" checked>
             </div>
         <div class="clear"></div>


                            <div class="rowElem" id="copii_sidromul_down_1" style="float:left;width:77%">
                  <b>
                                        Sidromul Down
                                     </b></div>

     <div class="rowElem" id="copii_sidromul_down_1" style="float:right;width:21%">
               Da<input type="radio" id="copii_sidromul_down_da_1" name="copii_sidromul_down_1" value="copii_sidromul_down_da_1"  >

               Nu<input type="radio" id="copii_sidromul_down_nu_1" name="copii_sidromul_down_1" value="copii_sidromul_down_nu_1" checked>
             </div>
         <div class="clear"></div>

     <!--hide1-->
</div>
                              <div class="rowElem" id="asigurare_reinnoire" style="float:left;width:77%">
                  <b>
                                         6. Afectiuni hematologice/ale sangelui: hernofilie, leucemie.
                                     </b></div>

     <div class="rowElem" id="copii_afectiuni_hematologice_1" style= 	"float:right;width:21%">
               Da<input type="radio" onclick="show_hide(this.value);" id="copii_afectiuni_hematologice_da_1" name="copii_afectiuni_hematologice_1" value="copii_afectiuni_hematologice_da_1"  >

               Nu<input type="radio" onclick="show_hide(this.value);" id="copii_afectiuni_hematologice_nu_1" name="copii_afectiuni_hematologice_1" value="copii_afectiuni_hematologice_nu_1" checked>
             </div>
         <div class="clear"></div>


                            <!--hide0-->
								<div id="hide_show_c_6-1" style="display:none;">
                             <div class="rowElem" id="asigurare_reinnoire" style="float:left;width:77%">
                  <b>
                                          Hernofilie
                                     </b></div>

     <div class="rowElem" id="copii_hernofilie_1" style="float:right;width:21%">
               Da<input type="radio" id="copii_hernofilie_da_1" name="copii_hernofilie_1" value="copii_hernofilie_da_1"  >

               Nu<input type="radio" id="copii_hernofilie_nu_1" name="copii_hernofilie_1" value="copii_hernofilie_nu_1" checked>
             </div>
         <div class="clear"></div>



                            <div class="rowElem" id="asigurare_reinnoire" style="float:left;width:77%">

                                          *Leucemie
                                     </div>

     <div class="rowElem" id="copii_leucemie_1" style="float:right;width:21%">
               Da<input type="radio" id="copii_leucemie_da_1" name="copii_leucemie_1" value="copii_leucemie_da_1"  >

               Nu<input type="radio" id="copii_leucemie_nu_1" name="copii_leucemie_1" value="copii_leucemie_nu_1" checked>
             </div>
         <div class="clear"></div>
                                     <!--hide1-->
									 </div>

                            <div class="rowElem" id="asigurare_reinnoire" style="float:left;width:77%">

                                         <b>
                                         7. Tumori maligne/cancer: limfom non-Holdgkin, boala Holdgkin, tumori maligne (retinoblasom, nefroblastom, neuroblastom, hepatobastom, teratom, adenocarcinom, sarcom, melanom)
                                     </b>
                                     </div>

     <div class="rowElem" id="copii_afectiuni_tumori_1" style="float:right;width:21%">
               Da<input type="radio" onclick="show_hide(this.value);" id="copii_afectiuni_tumori_da_1" name="copii_afectiuni_tumori_1" value="copii_afectiuni_tumori_da_1"  >

               Nu<input type="radio" onclick="show_hide(this.value);" id="copii_afectiuni_tumori_nu_1" name="copii_afectiuni_tumori_1" value="copii_afectiuni_tumori_nu_1" checked>
             </div>
         <div class="clear"></div>

                                <!--hide0-->
									<div id="hide_show_c_7-1" style="display:none;">

     <div class="rowElem" id="asigurare_reinnoire" style="float:left;width:77%">

                                        Limfom non-Holdgkin
                                     </div>

     <div class="rowElem" id="copii_limfom_non_holdgkin_1" style="float:right;width:21%">
               Da<input type="radio" id="copii_limfom_non_holdgkin_da_1" name="copii_limfom_non_holdgkin_1" value="copii_limfom_non_holdgkin_da_1"  >

               Nu<input type="radio" id="copii_limfom_non_holdgkin_nu_1" name="copii_limfom_non_holdgkin_1" value="copii_limfom_non_holdgkin_nu_1" checked>
             </div>
         <div class="clear"></div>


                              <div class="rowElem" id="asigurare_reinnoire" style="float:left;width:77%">

                                        Boala Holdgkin
                                     </div>

     <div class="rowElem" id="copii_boala_holdgkin_1" style="float:right;width:21%">
               Da<input type="radio" id="copii_boala_holdgkin_da_1" name="copii_boala_holdgkin_1" value="copii_boala_holdgkin_da_1"  >

               Nu<input type="radio" id="copii_boala_holdgkin_nu_1" name="copii_boala_holdgkin_1" value="copii_boala_holdgkin_nu_1" checked>
             </div>
         <div class="clear"></div>


                                <div class="rowElem" id="asigurare_reinnoire" style="float:left;width:77%">

                                         Tumori maligne
                                     </div>

     <div class="rowElem" id="copii_tumori_maligne_1" style="float:right;width:21%">
               Da<input type="radio" id="copii_tumori_maligne_da_1" name="copii_tumori_maligne_1" value="copii_tumori_maligne_da_1"  >

               Nu<input type="radio" id="copii_tumori_maligne_nu_1" name="copii_tumori_maligne_1" value="copii_tumori_maligne_nu_1" checked>
             </div>
         <div class="clear"></div>
                            <!--hide1-->
							</div>


                              <div class="rowElem" id="asigurare_reinnoire" style="float:left;width:77%">

                                         <b>
                                         8. Boli infectioase: infectie HIV/SIDA, tuberculoza activa
                                     </b>
                                     </div>

     <div class="rowElem" id="copii_afectiuni_infectioase_1" style="float:right;width:21%">
               Da<input type="radio" onclick="show_hide(this.value);" id="copii_afectiuni_infectioase_da_1" name="copii_afectiuni_infectioase_1" value="copii_afectiuni_infectioase_da_1"  >

               Nu<input type="radio" onclick="show_hide(this.value);" id="copii_afectiuni_infectioase_nu_1" name="copii_afectiuni_infectioase_1" value="copii_afectiuni_infectioase_nu_1" checked>
             </div>
         <div class="clear"></div>


                                <!--hide0-->
									<div id="hide_show_c_8-1" style="display:none;">
                            <div class="rowElem" id="asigurare_reinnoire" style="float:left;width:77%">

                                        Infectie HIV/SIDA
                                     </div>

     <div class="rowElem" id="copii_hiv_sida_1" style="float:right;width:21%">
               Da<input type="radio" id="copii_hiv_sida_da_1" name="copii_hiv_sida_1" value="copii_hiv_sida_da_1"  >

               Nu<input type="radio" id="copii_hiv_sida_nu_1" name="copii_hiv_sida_1" value="copii_hiv_sida_nu_1" checked>
             </div>
         <div class="clear"></div>


                               <div class="rowElem" id="asigurare_reinnoire" style="float:left;width:77%">

                                         Tuberculoza activa
                                     </div>

     <div class="rowElem" id="copii_tuberculoza_activa_1" style="float:right;width:21%">
               Da<input type="radio" id="copii_tuberculoza_activa_da_1" name="copii_tuberculoza_activa_1" value="copii_tuberculoza_activa_da_1"  >

               Nu<input type="radio" id="copii_tuberculoza_activa_nu_1" name="copii_tuberculoza_activa_1" value="copii_tuberculoza_activa_nu_1" checked>
             </div>
         <div class="clear"></div>

                             <!--hide1-->
							 </div>


                            <div class="rowElem" id="asigurare_reinnoire" style="float:left;width:77%">
                 <b>9. Afectiuni neurologice: ecefalopatie cronica infantila, tetrapareza, epilepsie
                                     </b>
                                     </div>

     <div class="rowElem" id="copii_afectiuni_neurologice_1" style="float:right;width:21%">
               Da<input type="radio" onclick="show_hide(this.value);" id="copii_afectiuni_neurologice_da_1" name="copii_afectiuni_neurologice_1" value="copii_afectiuni_neurologice_da_1"  >

               Nu<input type="radio" onclick="show_hide(this.value);" id="copii_afectiuni_neurologice_nu_1" name="copii_afectiuni_neurologice_1" value="copii_afectiuni_neurologice_nu_1" checked>
             </div>
         <div class="clear"></div>


                                <!--hide0-->
									<div id="hide_show_c_9-1" style="display:none;">
                           <div class="rowElem" id="asigurare_reinnoire" style="float:left;width:77%">
                 Ecefalopatie cronica infantila
                                     </div>

     <div class="rowElem" id="copii_ecefalopatie_cronica_infantila_1" style="float:right;width:21%">
               Da<input type="radio" id="copii_ecefalopatie_cronica_infantila_da_1" name="copii_ecefalopatie_cronica_infantila_1" value="copii_ecefalopatie_cronica_infantila_da_1"  >

               Nu<input type="radio" id="copii_ecefalopatie_cronica_infantila_nu_1" name="copii_ecefalopatie_cronica_infantila_1" value="copii_ecefalopatie_cronica_infantila_nu_1" checked>
             </div>
         <div class="clear"></div>



                             <div class="rowElem" id="asigurare_reinnoire" style="float:left;width:77%">
                    Tetrapareza
                                     </div>

     <div class="rowElem" id="copii_tetrapareza_1" style="float:right;width:21%">
               Da<input type="radio" id="copii_tetrapareza_da_1" name="copii_tetrapareza_1" value="copii_tetrapareza_da_1"  >

               Nu<input type="radio" id="copii_tetrapareza_nu_1" name="copii_tetrapareza_1" value="copii_tetrapareza_nu_1" checked>
             </div>
         <div class="clear"></div>



                             <div class="rowElem" id="asigurare_reinnoire" style="float:left;width:77%">
                      Epilepsie
                                     </div>

     <div class="rowElem" id="copii_epilepsie_1" style="float:right;width:21%">
               Da<input type="radio" id="copii_epilepsie_da_1" name="copii_epilepsie_1" value="copii_epilepsie_da_1"  >

               Nu<input type="radio" id="copii_epilepsie_nu_1" name="copii_epilepsie_1" value="copii_epilepsie_nu_1" checked>
             </div>
         <div class="clear"></div>
                             <!--hide1-->
							 </div>

                             <div class="rowElem" id="asigurare_reinnoire" style="float:left;width:77%">
                       <b>10. Afectiuni osteoarticulare: artrita reumatoida juvenila, boala Lobstein.
                                     </b>
                                     </div>

     <div class="rowElem" id="copii_afectiuni_osteoarticulare_1" style="float:right;width:21%">
               Da<input type="radio" onclick="show_hide(this.value);" id="copii_afectiuni_osteoarticulare_da_1" name="copii_afectiuni_osteoarticulare_1" value="copii_afectiuni_osteoarticulare_da_1"  >

               Nu<input type="radio" onclick="show_hide(this.value);" id="copii_afectiuni_osteoarticulare_nu_1" name="copii_afectiuni_osteoarticulare_1" value="copii_afectiuni_osteoarticulare_nu_1" checked>
             </div>
         <div class="clear"></div>

                                 <!--hide0-->
								 <div id="hide_show_c_10-1" style="display:none;">

                             <div class="rowElem" id="asigurare_reinnoire" style="float:left;width:77%">
                       Artrita reumatoida juvenila
                                     </div>

     <div class="rowElem" id="copii_artrita_reumatoida_juvenila_1" style="float:right;width:21%">
               Da<input type="radio" id="copii_artrita_reumatoida_juvenila_da_1" name="copii_artrita_reumatoida_juvenila_1" value="copii_artrita_reumatoida_juvenila_da_1"  >

               Nu<input type="radio" id="copii_artrita_reumatoida_juvenila_nu_1" name="copii_artrita_reumatoida_juvenila_1" value="copii_artrita_reumatoida_juvenila_nu_1" checked>
             </div>
         <div class="clear"></div>



                              <div class="rowElem" id="asigurare_reinnoire" style="float:left;width:77%">
                         Boala Lobstein
                                     </div>

     <div class="rowElem" id="copii_boala_lobstein_1" style="float:right;width:21%">
               Da<input type="radio" id="copii_boala_lobstein_da_1" name="copii_boala_lobstein_1" value="copii_boala_lobstein_da_1"  >

               Nu<input type="radio" id="copii_boala_lobstein_nu_1" name="copii_boala_lobstein_1" value="copii_boala_lobstein_nu_1" checked>
             </div>
         <div class="clear"></div>

                                 <!--hide1-->
								 </div>

                               <div class="rowElem" id="asigurare_reinnoire" style="float:left;width:77%">
                        <b>11. Afectiuni renale: insuficienta renala cronica.
                                     </b>
                                     </div>

     <div class="rowElem" id="copii_afectiuni_renale_1" style="float:right;width:21%">
               Da<input type="radio" id="copii_afectiuni_renale_da_1" name="copii_afectiuni_renale_1" value="copii_afectiuni_renale_da_1"  >

               Nu<input type="radio" id="copii_afectiuni_renale_nu_1" name="copii_afectiuni_renale_1" value="copii_afectiuni_renale_nu_1" checked>
             </div>
         <div class="clear"></div>
     </div><!--	END FORM COPIL-->


		</div><!--	END HIDE-->

     <div class="clear"></div>





		<input type="hidden" name="token" value="<?php echo $newToken; ?>">
			<div class="rowElem">
			<span>Trimite datele introduse:</span>
		<input class="submit" type="submit" name="send_data" value="Trimite" /></div>


</form>


<script language="javascript">

$().ready(function() {

	$('#data_nasterii').datepicker({
	changeMonth: true,
	yearRange: "-100:+0",
	changeYear: true
});


$('#data_valabilitate_start').datepicker({
	changeMonth: true,
	yearRange: "-100:+0",
	changeYear: true
});


$('#data_nasterii_copil_1').datepicker({
  changeMonth: true,
  yearRange: "-100:+0",
  changeYear: true
});

$('#data_nasterii_copil_2').datepicker({
  changeMonth: true,
  yearRange: "-100:+0",
  changeYear: true

});

$('#data_nasterii_copil_3').datepicker({
  changeMonth: true,
  yearRange: "-100:+0",
  changeYear: true

});

$('#data_nasterii_copil_4').datepicker({
  changeMonth: true,
  yearRange: "-100:+0",
  changeYear: true

});

$('#data_nasterii_copil_5').datepicker({
  changeMonth: true,
  yearRange: "-100:+0",
  changeYear: true

});

$('#data_nasterii_copil_6').datepicker({
  changeMonth: true,
  yearRange: "-100:+0",
  changeYear: true

});

$('#data_nasterii_copil_7').datepicker({
  changeMonth: true,
  yearRange: "-100:+0",
  changeYear: true

});

$('#data_nasterii_copil_8').datepicker({
  changeMonth: true,
  yearRange: "-100:+0",
  changeYear: true

});

$('#data_nasterii_copil_9').datepicker({
  changeMonth: true,
  yearRange: "-100:+0",
  changeYear: true

});

$('#data_nasterii_copil_10').datepicker({
  changeMonth: true,
  yearRange: "-100:+0",
  changeYear: true

});
 
})


$(document).ready(function () {

      var counter = 2;
      $input   = $('#nrCopii');

    $('#btnAdd').click(function () {


      $val    = $input.val();
      $input.val(parseInt($val)+1);
      counter++;

      if (counter - 1 > 1)

              $('#btnDel').attr("disabled", false);

      var num = $('.exemplu').length;

      var newNum = num + 1;

      var newElem2 = $('#exemplu_1').clone().attr('id', 'exemplu_' + newNum);

newElem2.find('#copil_1').attr('id','copil_'+newNum).html('<div class="rowElem" id="copil_1" style="float:left;width:77%"><p><h4>Copil '+ newNum +'</h4></p></div>');

      newElem2.find('#nume_copil_1').attr('id','nume_copil_'+newNum).attr('name','nume_copil_'+newNum);

      newElem2.find('#prenume_copil_1').attr('id', 'prenume_copil_' + newNum).attr('name','prenume_copil_'+newNum);

        newElem2.find('#cnp_copil_1').attr('id', 'cnp_copil_' + newNum).attr('name','cnp_copil_'+newNum);

      newElem2.find('#data_nasterii_copil_1').attr('id', 'data_nasterii_copil_' + newNum).attr('name','data_nasterii_copil_'+newNum).removeClass('hasDatepicker').removeData('datepicker').unbind().datepicker({
        changeMonth: true,
        changeYear: true,
      });
///////////////////////////
//  1 ////
      newElem2.find('#copii_defect_congenital_da_1').attr('id', 'copii_defect_congenital_da_' + newNum).attr('name','copii_defect_congenital_'+newNum).val('copii_defect_congenital_da_'+newNum);

      newElem2.find('#copii_defect_congenital_nu_1').attr('id', 'copii_defect_congenital_nu_' + newNum).attr('name','copii_defect_congenital_'+newNum).val('copii_defect_congenital_nu_'+newNum);

      //  2 ////
            newElem2.find('#copii_insuficienta_respiratorie_da_1').attr('id', 'copii_insuficienta_respiratorie_da_' + newNum).attr('name','copii_insuficienta_respiratorie_'+newNum).val('copii_insuficienta_respiratorie_da_'+newNum);

            newElem2.find('#copii_insuficienta_respiratorie_nu_1').attr('id', 'copii_insuficienta_respiratorie_nu_' + newNum).attr('name','copii_insuficienta_respiratorie_'+newNum).val('copii_insuficienta_respiratorie_nu_'+newNum);

			//  3 ////
      newElem2.find('#copii_afectiuni_digestive_da_1').attr('id', 'copii_afectiuni_digestive_da_' + newNum).attr('name','copii_afectiuni_digestive_'+newNum).val('copii_afectiuni_digestive_da_'+newNum);

      newElem2.find('#copii_afectiuni_digestive_nu_1').attr('id', 'copii_afectiuni_digestive_nu_' + newNum).attr('name','copii_afectiuni_digestive_'+newNum).val('copii_afectiuni_digestive_nu_'+newNum);

	  	//////
      newElem2.find('#copii_ciroza_hepatica_da_1').attr('id', 'copii_ciroza_hepatica_da_' + newNum).attr('name','copii_ciroza_hepatica_'+newNum).val('copii_ciroza_hepatica_da_'+newNum);

      newElem2.find('#copii_ciroza_hepatica_nu_1').attr('id', 'copii_ciroza_hepatica_nu_' + newNum).attr('name','copii_ciroza_hepatica_'+newNum).val('copii_ciroza_hepatica_nu_'+newNum);

	   	//////
      newElem2.find('#copii_atrezie_esofagiana_da_1').attr('id', 'copii_atrezie_esofagiana_da_' + newNum).attr('name','copii_atrezie_esofagiana_'+newNum).val('copii_atrezie_esofagiana_da_'+newNum);

      newElem2.find('#copii_atrezie_esofagiana_nu_1').attr('id', 'copii_atrezie_esofagiana_nu_' + newNum).attr('name','copii_atrezie_esofagiana_'+newNum).val('copii_atrezie_esofagiana_nu_'+newNum);

	    	//////
      newElem2.find('#copii_atrezie_intestinala_da_1').attr('id', 'copii_atrezie_intestinala_da_' + newNum).attr('name','copii_atrezie_intestinala_'+newNum).val('copii_atrezie_intestinala_da_'+newNum);

      newElem2.find('#copii_atrezie_intestinala_nu_1').attr('id', 'copii_atrezie_intestinala_nu_' + newNum).attr('name','copii_atrezie_intestinala_'+newNum).val('copii_atrezie_intestinala_nu_'+newNum);

	      	//////
      newElem2.find('#copii_megacolon_congenital_da_1').attr('id', 'copii_megacolon_congenital_da_' + newNum).attr('name','copii_megacolon_congenital_'+newNum).val('copii_megacolon_congenital_da_'+newNum);

      newElem2.find('#copii_megacolon_congenital_nu_1').attr('id', 'copii_megacolon_congenital_nu_' + newNum).attr('name','copii_megacolon_congenital_'+newNum).val('copii_megacolon_congenital_nu_'+newNum);



	  	//  4 ////
      newElem2.find('#copii_boli_metabolice_da_1').attr('id', 'copii_boli_metabolice_da_' + newNum).attr('name','copii_boli_metabolice_'+newNum).val('copii_boli_metabolice_da_'+newNum);

      newElem2.find('#copii_boli_metabolice_nu_1').attr('id', 'copii_boli_metabolice_nu_' + newNum).attr('name','copii_boli_metabolice_'+newNum).val('copii_boli_metabolice_nu_'+newNum);

  	//  5 ////
      newElem2.find('#copii_afectiuni_ereditale_da_1').attr('id', 'copii_afectiuni_ereditale_da_' + newNum).attr('name','copii_afectiuni_ereditale_'+newNum).val('copii_afectiuni_ereditale_da_'+newNum);

      newElem2.find('#copii_boli_metabolice_nu_1').attr('id', 'copii_afectiuni_ereditale_nu_' + newNum).attr('name','copii_afectiuni_ereditale_'+newNum).val('copii_afectiuni_ereditale_nu_'+newNum);

	      	//////
      newElem2.find('#copii_fibroza_chistica_da_1').attr('id', 'copii_fibroza_chistica_da_' + newNum).attr('name','copii_fibroza_chistica_'+newNum).val('copii_fibroza_chistica_da_'+newNum);

      newElem2.find('#copii_fibroza_chistica_nu_1').attr('id', 'copii_fibroza_chistica_nu_' + newNum).attr('name','copii_fibroza_chistica_'+newNum).val('copii_fibroza_chistica_nu_'+newNum);

	      	//////
      newElem2.find('#copii_sidromul_down_da_1').attr('id', 'copii_sidromul_down_da_' + newNum).attr('name','copii_sidromul_down_'+newNum).val('copii_sidromul_down_da_'+newNum);

      newElem2.find('#copii_sidromul_down_nu_1').attr('id', 'copii_sidromul_down_nu_' + newNum).attr('name','copii_sidromul_down_'+newNum).val('copii_sidromul_down_nu_'+newNum);

	  	//  6 ////
      newElem2.find('#copii_afectiuni_hematologice_da_1').attr('id', 'copii_afectiuni_hematologice_da_' + newNum).attr('name','copii_afectiuni_hematologice_'+newNum).val('copii_afectiuni_hematologice_da_'+newNum);

      newElem2.find('#copii_afectiuni_hematologice_nu_1').attr('id', 'copii_afectiuni_hematologice_nu_' + newNum).attr('name','copii_afectiuni_hematologice_'+newNum).val('copii_afectiuni_hematologice_nu_'+newNum);

	       	//////
      newElem2.find('#copii_hernofilie_da_1').attr('id', 'copii_hernofilie_da_' + newNum).attr('name','copii_hernofilie_'+newNum).val('copii_hernofilie_da_'+newNum);

      newElem2.find('#copii_hernofilie_nu_1').attr('id', 'copii_hernofilie_nu_' + newNum).attr('name','copii_hernofilie_'+newNum).val('copii_hernofilie_nu_'+newNum);

	       	//////
      newElem2.find('#copii_leucemie_da_1').attr('id', 'copii_leucemie_da_' + newNum).attr('name','copii_leucemie_'+newNum).val('copii_leucemie_da_'+newNum);

      newElem2.find('#copii_leucemie_nu_1').attr('id', 'copii_leucemie_nu_' + newNum).attr('name','copii_leucemie_'+newNum).val('copii_leucemie_nu_'+newNum);

	   	//  7 ////
      newElem2.find('#copii_afectiuni_tumori_da_1').attr('id', 'copii_afectiuni_tumori_da_' + newNum).attr('name','copii_afectiuni_tumori_'+newNum).val('copii_afectiuni_tumori_da_'+newNum);

      newElem2.find('#copii_afectiuni_tumori_nu_1').attr('id', 'copii_afectiuni_tumori_nu_' + newNum).attr('name','copii_afectiuni_tumori_'+newNum).val('copii_afectiuni_tumori_nu_'+newNum);

	       	//////
      newElem2.find('#copii_limfom_non_holdgkin_da_1').attr('id', 'copii_limfom_non_holdgkin_da_' + newNum).attr('name','copii_limfom_non_holdgkin_'+newNum).val('copii_limfom_non_holdgkin_da_'+newNum);

      newElem2.find('#copii_limfom_non_holdgkin_nu_1').attr('id', 'copii_limfom_non_holdgkin_nu_' + newNum).attr('name','copii_limfom_non_holdgkin_'+newNum).val('copii_limfom_non_holdgkin_nu_'+newNum);

	        	//////
      newElem2.find('#copii_boala_holdgkin_da_1').attr('id', 'copii_boala_holdgkin_da_' + newNum).attr('name','copii_boala_holdgkin_'+newNum).val('copii_boala_holdgkin_da_'+newNum);

      newElem2.find('#copii_boala_holdgkin_nu_1').attr('id', 'copii_boala_holdgkin_nu_' + newNum).attr('name','copii_boala_holdgkin_'+newNum).val('copii_boala_holdgkin_nu_'+newNum);

	         	//////
      newElem2.find('#copii_tumori_maligne_da_1').attr('id', 'copii_tumori_maligne_da_' + newNum).attr('name','copii_tumori_maligne_'+newNum).val('copii_tumori_maligne_da_'+newNum);

      newElem2.find('#copii_tumori_maligne_nu_1').attr('id', 'copii_tumori_maligne_nu_' + newNum).attr('name','copii_tumori_maligne_'+newNum).val('copii_tumori_maligne_nu_'+newNum);

	   	//  8 ////
      newElem2.find('#copii_afectiuni_infectioase_da_1').attr('id', 'copii_afectiuni_infectioase_da_' + newNum).attr('name','copii_afectiuni_infectioase_'+newNum).val('copii_afectiuni_infectioase_da_'+newNum);

      newElem2.find('#copii_afectiuni_infectioase_nu_1').attr('id', 'copii_afectiuni_infectioase_nu_' + newNum).attr('name','copii_afectiuni_infectioase_'+newNum).val('copii_afectiuni_infectioase_nu_'+newNum);

	        	//////
      newElem2.find('#copii_hiv_sida_da_1').attr('id', 'copii_hiv_sida_da_' + newNum).attr('name','copii_hiv_sida_'+newNum).val('copii_hiv_sida_da_'+newNum);

      newElem2.find('#copii_hiv_sida_nu_1').attr('id', 'copii_hiv_sida_nu_' + newNum).attr('name','copii_hiv_sida_'+newNum).val('copii_hiv_sida_nu_'+newNum);

	         	//////
      newElem2.find('#copii_tuberculoza_activa_da_1').attr('id', 'copii_tuberculoza_activa_da_' + newNum).attr('name','copii_tuberculoza_activa_'+newNum).val('copii_tuberculoza_activa_da_'+newNum);

      newElem2.find('#copii_tuberculoza_activa_nu_1').attr('id', 'copii_tuberculoza_activa_nu_' + newNum).attr('name','copii_tuberculoza_activa_'+newNum).val('copii_tuberculoza_activa_nu_'+newNum);

	    	//  9 ////
      newElem2.find('#copii_afectiuni_neurologice_da_1').attr('id', 'copii_afectiuni_neurologice_da_' + newNum).attr('name','copii_afectiuni_neurologice_'+newNum).val('copii_afectiuni_neurologice_da_'+newNum);

      newElem2.find('#copii_afectiuni_neurologice_nu_1').attr('id', 'copii_afectiuni_neurologice_nu_' + newNum).attr('name','copii_afectiuni_neurologice_'+newNum).val('copii_afectiuni_neurologice_nu_'+newNum);

	          	//////
      newElem2.find('#copii_ecefalopatie_cronica_infantila_da_1').attr('id', 'copii_ecefalopatie_cronica_infantila_da_' + newNum).attr('name','copii_ecefalopatie_cronica_infantila_'+newNum).val('copii_ecefalopatie_cronica_infantila_da_'+newNum);

      newElem2.find('#copii_ecefalopatie_cronica_infantila_nu_1').attr('id', 'copii_ecefalopatie_cronica_infantila_nu_' + newNum).attr('name','copii_ecefalopatie_cronica_infantila_'+newNum).val('copii_ecefalopatie_cronica_infantila_nu_'+newNum);

	           	//////
      newElem2.find('#copii_tetrapareza_da_1').attr('id', 'copii_tetrapareza_da_' + newNum).attr('name','copii_tetrapareza_'+newNum).val('copii_tetrapareza_da_'+newNum);

      newElem2.find('#copii_tetrapareza_nu_1').attr('id', 'copii_tetrapareza_nu_' + newNum).attr('name','copii_tetrapareza_'+newNum).val('copii_tetrapareza_nu_'+newNum);

	           	//////
      newElem2.find('#copii_epilepsie_da_1').attr('id', 'copii_epilepsie_da_' + newNum).attr('name','copii_epilepsie_'+newNum).val('copii_epilepsie_da_'+newNum);

      newElem2.find('#copii_epilepsie_nu_1').attr('id', 'copii_epilepsie_nu_' + newNum).attr('name','copii_epilepsie_'+newNum).val('copii_epilepsie_nu_'+newNum);

	     	//  10 ////
      newElem2.find('#copii_afectiuni_osteoarticulare_da_1').attr('id', 'copii_afectiuni_osteoarticulare_da_' + newNum).attr('name','copii_afectiuni_osteoarticulare_'+newNum).val('copii_afectiuni_osteoarticulare_da_'+newNum);

      newElem2.find('#copii_afectiuni_osteoarticulare_nu_1').attr('id', 'copii_afectiuni_osteoarticulare_nu_' + newNum).attr('name','copii_afectiuni_osteoarticulare_'+newNum).val('copii_afectiuni_osteoarticulare_nu_'+newNum);

	            	//////
      newElem2.find('#copii_artrita_reumatoida_juvenila_da_1').attr('id', 'copii_artrita_reumatoida_juvenila_da_' + newNum).attr('name','copii_artrita_reumatoida_juvenila_'+newNum).val('copii_artrita_reumatoida_juvenila_da_'+newNum);

      newElem2.find('#copii_artrita_reumatoida_juvenila_nu_1').attr('id', 'copii_artrita_reumatoida_juvenila_nu_' + newNum).attr('name','copii_artrita_reumatoida_juvenila_'+newNum).val('copii_artrita_reumatoida_juvenila_nu_'+newNum);

	            	//////
      newElem2.find('#copii_boala_lobstein_da_1').attr('id', 'copii_boala_lobstein_da_' + newNum).attr('name','copii_boala_lobstein_'+newNum).val('copii_boala_lobstein_da_'+newNum);

      newElem2.find('#copii_boala_lobstein_nu_1').attr('id', 'copii_boala_lobstein_nu_' + newNum).attr('name','copii_boala_lobstein_'+newNum).val('copii_boala_lobstein_nu_'+newNum);

	       	//  11 ////
      newElem2.find('#copii_afectiuni_renale_da_1').attr('id', 'copii_afectiuni_renale_da_' + newNum).attr('name','copii_afectiuni_renale_'+newNum).val('copii_afectiuni_renale_da_'+newNum);

      newElem2.find('#copii_afectiuni_renale_nu_1').attr('id', 'copii_afectiuni_renale_nu_' + newNum).attr('name','copii_afectiuni_renale_'+newNum).val('copii_afectiuni_renale_nu_'+newNum);

	 // hide/show //

	  newElem2.find('#hide_show_c_3-1').attr('id', 'hide_show_c_3-' + newNum);

	   newElem2.find('#hide_show_c_5-1').attr('id', 'hide_show_c_5-' + newNum);

	    newElem2.find('#hide_show_c_6-1').attr('id', 'hide_show_c_6-' + newNum);

		 newElem2.find('#hide_show_c_7-1').attr('id', 'hide_show_c_7-' + newNum);

		  newElem2.find('#hide_show_c_8-1').attr('id', 'hide_show_c_8-' + newNum);

		   newElem2.find('#hide_show_c_9-1').attr('id', 'hide_show_c_9-' + newNum);

		    newElem2.find('#hide_show_c_10-1').attr('id', 'hide_show_c_10-' + newNum);

//////////////////////////
   $('#exemplu_' + num).after(newElem2);

///////////////////////////


/////PARTS OF KID FORM///////


	//	function show_hide(flag){
	//	var cond1 = $('.exemplu').length;
	//  var newNum_c = newNum - 1;

//		if (flag=="copii_afectiuni_digestive_da_1")

//		{
	//		$('#hide_show_c_3-1').show( "blind", { direction: "up" },  400  )
//		}

//		if (flag=="copii_afectiuni_digestive_nu_1")

//		{
//			$('#hide_show_c_3-1').hide( "blind", { direction: "up" },  400  )
//		}


// }








  });
            $('#btnDel').click(function () {
              var num = $('.exemplu').length;
              $('#exemplu_' + num).remove();

              $val = $input.val();
               $input.val(parseInt($val)-1);
                 counter--;

                if (counter - 1 == 1)

                    $('#btnDel').attr("disabled", true);

                if (counter - 1 > 1)

                        $('#btnDel').attr("disabled", false);

     });

});

$("#pj_contractant_nu").click(function(){
		$('#cnp_contractant-div span').text("CNP");
});
$("#pj_contractant_da").click(function(){
		$('#cnp_contractant-div span').text("CUI");
});

/////////////////////////////////////



function show_hide(flag)
    {


	//	CNP/CUI	//
			if (flag=="pj_contractant_nu")

			{
				$('#hide_show_per_juridica').show( "blind", { direction: "up" },  400  )
			}

			if (flag=="pj_contractant_da")

			{
				$('#hide_show_per_juridica').hide( "blind", { direction: "up" },  400  )
			}

			///// a c ///////
		if (flag=="corespondeta_identica_asigurat_nu")

		{
			$('#hide_show_adresa_c').show( "blind", { direction: "up" },  400  )
		}

		if (flag=="corespondeta_identica_asigurat_da")

		{
			$('#hide_show_adresa_c').hide( "blind", { direction: "up" },  400  )
		}
			///// d c ///////
		if (flag=="contractantul_identica_asigurat_nu")

		{
			$('#hide_show_adresa_dc').show( "blind", { direction: "up" },  400  )
		}

		if (flag=="contractantul_identica_asigurat_da")

		{
			$('#hide_show_adresa_dc').hide( "blind", { direction: "up" },  400  )
		}

	if (flag=="asigurat_fumator_da")

		{

		//$('#nr_tigari-div').css('display', "block");
		//$('#nr_tigari_s-div').css('display', "block");
	//	$('#nr_tigari').css('display', "block");
	$('#nr_tigari-div').show( "drop", { direction: "up" }, 400 );
		$('#nr_tigari_s-div').show( "drop", { direction: "up" }, 400 );
		$('#nr_tigari').show( "drop", { direction: "up" }, 400 );



		}
	if (flag=="asigurat_fumator_nu")

		{
		//	.hide(1000);
	//	$('#nr_tigari-div').css('display', "none");
	//	$('#nr_tigari_s-div').css('display', "none");
	//	$('#nr_tigari').css('display', "none");
	$('#nr_tigari-div').hide( "drop", { direction: "up" },  400  );
		$('#nr_tigari_s-div').hide( "drop", { direction: "up" },  400  );
		$('#nr_tigari').hide( "drop", { direction: "up" },  400  );

		}
/////////// 1 ////////////////////

		if (flag=="asigurat_infarct_da")

		{
		// 	document.getElementById('hide_show_1').style.display = "block";
		//	 $("#hide_show_1 > *").not("#hide_show_1_1").css('display','block');
		$('#hide_show_1').show( "blind", { direction: "up" },  400  )

		}

		if (flag=="asigurat_infarct_nu")

		{
		//	document.getElementById('hide_show_1').style.display = "none";
			//$(".hide_show_1 > *").css('display','none');
			$('#hide_show_1').hide( "blind", { direction: "up" },  400  )

		}

		if (flag=="asigurat_alte_afectiuni_cardiace_da")

		{
		//	document.getElementById('hide_show_1_1').style.display = "block";
			//$(".hide_show_1_1 > *").css('display', "block");
			$('#hide_show_1_1').show( "blind", { direction: "up" },  400  )
		}

		if (flag=="asigurat_alte_afectiuni_cardiace_nu")

		{
		//	document.getElementById('hide_show_1_1').style.display = "none";
			//$(".hide_show_1_1 > *").css('display', "none");
			$('#hide_show_1_1').hide( "blind", { direction: "up" },  400  )
		}
		///////// 2 ///////////////
	// 	var hide1 =	function hide1(){
	// 	hide( "drop", { direction: "up" },  400  );	}
	// 	var show1 =	function show1(){
	// 	show( "drop", { direction: "up" },  400  );	}
	//  var hide1 = 'hide( "drop", { direction: "up" },  400  )';
	//  var show1 = 'show( "drop", { direction: "up" },  400  )';


		if (flag=="asigurat_afectiuni_respiratorii_da")

		{
		//	document.getElementById('hide_show_2').style.display = "block";
		 	$('#hide_show_2').show( "blind", { direction: "up" },  400  )
		//	$('#hide_show_2').show1();

		}

		if (flag=="asigurat_afectiuni_respiratorii_nu")

		{
		//	document.getElementById('hide_show_2').style.display = "none";
		 	$('#hide_show_2').hide( "blind", { direction: "up" },  400  )
		//	$('#hide_show_2').hide1();

		}
		/////// 3 /////////////////
		if (flag=="asigurat_afectiuni_digestive_da")

		{
		//	document.getElementById('hide_show_3').style.display = "block";
		  $('#hide_show_3').show( "blind", { direction: "up" },  400  )
		}

		if (flag=="asigurat_afectiuni_digestive_nu")

		{
		//	document.getElementById('hide_show_3').style.display = "none";
			$('#hide_show_3').hide( "blind", { direction: "up" },  400  )

		}
		/////// 4 /////////////////
		if (flag=="asigurat_boli_metabolice_da")

		{
			 $('#hide_show_4').show( "blind", { direction: "up" },  400  )

		}

		if (flag=="asigurat_boli_metabolice_nu")

		{
			$('#hide_show_4').hide( "blind", { direction: "up" },  400  )

		}

		if (flag=="asigurat_diabet_zaharat_complicat_da")

		{
			$('#hide_show_4_1').show( "blind", { direction: "up" },  400  )

		}

		if (flag=="asigurat_diabet_zaharat_complicat_nu")

		{
			$('#hide_show_4_1').hide( "blind", { direction: "up" },  400  )

		}
		///// 5 ///////////
		if (flag=="asigurat_afectiuni_endocrine_da")

		{
		//	document.getElementById('hide_show_5').style.display = "block";
			$('#hide_show_5').show( "blind", { direction: "up" },  400  )
		}

		if (flag=="asigurat_afectiuni_endocrine_nu")

		{
		//	document.getElementById('hide_show_5').style.display = "none";
			$('#hide_show_5').hide( "blind", { direction: "up" },  400  )
		}
		///// 6 ///////////
		if (flag=="asigurat_afectiuni_ereditare_da")

		{
		//	document.getElementById('hide_show_6').style.display = "block";
			$('#hide_show_6').show( "blind", { direction: "up" },  400  )

		}

		if (flag=="asigurat_afectiuni_ereditare_nu")

		{
		//	document.getElementById('hide_show_6').style.display = "none";
			$('#hide_show_6').hide( "blind", { direction: "up" },  400  )

		}
		///// 7 ///////
		if (flag=="asigurat_afectiuni_hematologice_da")

		{
		//	document.getElementById('hide_show_7').style.display = "block";
			$('#hide_show_7').show( "blind", { direction: "up" },  400  )

		}

		if (flag=="asigurat_afectiuni_hematologice_nu")

		{
		//	document.getElementById('hide_show_7').style.display = "none";
			$('#hide_show_7').hide( "blind", { direction: "up" },  400  )
		}
		///// 8 ///////
		if (flag=="asigurat_tumori_cancer_da")

		{
		//	document.getElementById('hide_show_8').style.display = "block";
			$('#hide_show_8').show( "blind", { direction: "up" },  400  )
		}

		if (flag=="asigurat_tumori_cancer_nu")

		{
		//	document.getElementById('hide_show_8').style.display = "none";
			$('#hide_show_8').hide( "blind", { direction: "up" },  400  )
		}
			///// 9 ///////
		if (flag=="asigurat_boli_infectioase_da")

		{
		//	document.getElementById('hide_show_9').style.display = "block";
			$('#hide_show_9').show( "blind", { direction: "up" },  400  )
		}

		if (flag=="asigurat_boli_infectioase_nu")

		{
		//	document.getElementById('hide_show_9').style.display = "none";
			$('#hide_show_9').hide( "blind", { direction: "up" },  400  )
		}
			///// 10 ///////
		if (flag=="asigurat_afectiuni_neurologice_da")

		{
			$('#hide_show_10').show( "blind", { direction: "up" },  400  )
		}

		if (flag=="asigurat_afectiuni_neurologice_nu")

		{
			$('#hide_show_10').hide( "blind", { direction: "up" },  400  )
		}
			///// 11 ///////
		if (flag=="asigurat_afectiuni_psihice_da")

		{
			$('#hide_show_11').show( "blind", { direction: "up" },  400  )
		}

		if (flag=="asigurat_afectiuni_psihice_nu")

		{
			$('#hide_show_11').hide( "blind", { direction: "up" },  400  )
		}
			///// 12 ///////
		if (flag=="asigurat_afectiuni_orl_da")

		{
			$('#hide_show_12').show( "blind", { direction: "up" },  400  )
		}

		if (flag=="asigurat_afectiuni_orl_nu")

		{
			$('#hide_show_12').hide( "blind", { direction: "up" },  400  )
		}
			///// 13 ///////
		if (flag=="asigurat_afectiuni_oftalmologice_da")

		{
			$('#hide_show_13').show( "blind", { direction: "up" },  400  )
		}

		if (flag=="asigurat_afectiuni_oftalmologice_nu")

		{
			$('#hide_show_13').hide( "blind", { direction: "up" },  400  )
		}
			///// 14 ///////
		if (flag=="asigurat_afectiuni_reumatica_da")

		{
			$('#hide_show_14').show( "blind", { direction: "up" },  400  )
		}

		if (flag=="asigurat_afectiuni_reumatica_nu")

		{
			$('#hide_show_14').hide( "blind", { direction: "up" },  400  )
		}
			///// 15 ///////
		if (flag=="asigurat_afectiuni_renala_da")

		{
			$('#hide_show_15').show( "blind", { direction: "up" },  400  )
		}

		if (flag=="asigurat_afectiuni_renala_nu")

		{
			$('#hide_show_15').hide( "blind", { direction: "up" },  400  )
		}

			///// 16 ///////
			// don't need //
			////////////////

			///// 17 ///////
		if (flag=="asigurat_afectiuni_ginecologice_da")

		{
			$('#hide_show_17').show( "blind", { direction: "up" },  400  )
		}

		if (flag=="asigurat_afectiuni_ginecologice_nu")

		{
			$('#hide_show_17').hide( "blind", { direction: "up" },  400  )
		}
		
			///// 18 Afectiuni pre-existente ///////
		if (flag=="asigurat_afectiuni_preexistente_da")

		{
			$('#hide_show_18').show( "blind", { direction: "up" },  400  )
		}

		if (flag=="asigurat_afectiuni_preexistente_nu")

		{
			$('#hide_show_18').hide( "blind", { direction: "up" },  400  )
		}

		/////////////////////////
		//// Asigurare copil ////
		/////////////////////////

			/////ALL KID FORM ///////
		if (flag=="copii_inclusi_da")

		{
			$('#c_hide_show').show( "blind", { direction: "up" },  400  )
		}

		if (flag=="copii_inclusi_nu")

		{
			$('#c_hide_show').hide( "blind", { direction: "up" },  400  )
		}

		/////PARTS OF KID FORM///////



		var num_c = $('.exemplu').length;

		for(i=1; i<=num_c; i++){

			//	3	//
			if (flag=="copii_afectiuni_digestive_da_"+i)

			{
				$('#hide_show_c_3-'+i).show( "blind", { direction: "up" },  400  )
			}

			if (flag=="copii_afectiuni_digestive_nu_"+i)

			{
				$('#hide_show_c_3-'+i).hide( "blind", { direction: "up" },  400  )
			}

			//	5	//
			if (flag=="copii_afectiuni_ereditale_da_"+i)

			{
				$('#hide_show_c_5-'+i).show( "blind", { direction: "up" },  400  )
			}

			if (flag=="copii_afectiuni_ereditale_nu_"+i)

			{
				$('#hide_show_c_5-'+i).hide( "blind", { direction: "up" },  400  )
			}

			//	6	//
			if (flag=="copii_afectiuni_hematologice_da_"+i)

			{
				$('#hide_show_c_6-'+i).show( "blind", { direction: "up" },  400  )
			}

			if (flag=="copii_afectiuni_hematologice_nu_"+i)

			{
				$('#hide_show_c_6-'+i).hide( "blind", { direction: "up" },  400  )
			}

			//	7	//
			if (flag=="copii_afectiuni_tumori_da_"+i)

			{
				$('#hide_show_c_7-'+i).show( "blind", { direction: "up" },  400  )
			}

			if (flag=="copii_afectiuni_tumori_nu_"+i)

			{
				$('#hide_show_c_7-'+i).hide( "blind", { direction: "up" },  400  )
			}

			//	8	//
			if (flag=="copii_afectiuni_infectioase_da_"+i)

			{
				$('#hide_show_c_8-'+i).show( "blind", { direction: "up" },  400  )
			}

			if (flag=="copii_afectiuni_infectioase_nu_"+i)

			{
				$('#hide_show_c_8-'+i).hide( "blind", { direction: "up" },  400  )
			}

			//	9	//
			if (flag=="copii_afectiuni_neurologice_da_"+i)

			{
				$('#hide_show_c_9-'+i).show( "blind", { direction: "up" },  400  )
			}

			if (flag=="copii_afectiuni_neurologice_nu_"+i)

			{
				$('#hide_show_c_9-'+i).hide( "blind", { direction: "up" },  400  )
			}

			//	10	//
			if (flag=="copii_afectiuni_osteoarticulare_da_"+i)

			{
				$('#hide_show_c_10-'+i).show( "blind", { direction: "up" },  400  )
			}

			if (flag=="copii_afectiuni_osteoarticulare_nu_"+i)

			{
				$('#hide_show_c_10-'+i).hide( "blind", { direction: "up" },  400  )
			}


		}

    };




///////////////////////////////////////////////////////////////////////
</script>


