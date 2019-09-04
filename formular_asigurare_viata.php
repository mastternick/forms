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
									"localitate_livrare": {required: true, minlength: 3},
									"judet_livrare": { required: true, minlength: 3},
									"strada_livrare": { required: true, minlength: 3},
									"nume": { required: true,  minlength: 5 },
									"email": {  required: true, email: true},
									"telefon": {  required: true, minlength: 10,number:true,phoneStart0: true },
									cnp: { required: true, roCNP: true }
									},
									errorPlacement: function(error, element) {$(element).parent('div').addClass('error');}
									});
								});
</script>
<?php
$period_asig = "";
$invest = "";
$mod_plata = "";
$data="";
$send               = "";
$message_error      = "";
$tip_asig_viata     = "";
$protectie_medicala = $deces = $invaliditate = $spitalizare = $interventii_chirurgicale = $boli_grave = $imobilizare_gipsat =  "";
$benef_pensionar = "DA";
$localitate_livrare = $judet_livrare = $strada_livrare = $nr_livrare = $bloc_livrare = $scara_livrare = $etaj_adresa_livrare = $apartament_livrare = "";
$nume               = $cnp = $telefon = $email = $stare_civila = $copii_minori = $educatie = "";
$ocupatie_asigurat = "";

$nume_prenume_copil = $cnp_copil = "";

if (verifyFormToken('formular_calatorii')) {
    if (isset($_POST['send_data'])) {

		$nume_prenume_copil = stripcleantohtml($_POST['nume_prenume_copil']);
		$cnp_copil = stripcleantohtml($_POST['cnp_copil']);

        $tip_asig_viata           = stripcleantohtml($_POST['tip_asig_viata']);
        $protectie_medicala               = stripcleantohtml($_POST['protectie_medicala']);
        $deces        = stripcleantohtml($_POST['deces']);
        $invaliditate       = stripcleantohtml($_POST['invaliditate']);
        $spitalizare       = stripcleantohtml($_POST['spitalizare']);

		$interventii_chirurgicale			 = stripcleantohtml($_POST['interventii_chirurgicale']);
		$boli_grave	 = stripcleantohtml($_POST['boli_grave']);

		$imobilizare_gipsat = stripcleantohtml($_POST['imobilizare_gipsat']);
		$benef_pensionar = stripcleantohtml($_POST['benef_pensionar']);

		$stare_civila = stripcleantohtml($_POST['stare_civila']);
		$copii_minori = stripcleantohtml($_POST['copii_minori']);
		$educatie = stripcleantohtml($_POST['educatie']);
		$ocupatie_asigurat = stripcleantohtml($_POST['ocupatie_asigurat']);

        $localitate_livrare  = stripcleantohtml($_POST['localitate_livrare']);
        $judet_livrare       = stripcleantohtml($_POST['judet_livrare']);
        $strada_livrare      = stripcleantohtml($_POST['strada_livrare']);
        $nr_livrare          = stripcleantohtml($_POST['nr_livrare']);
        $bloc_livrare        = stripcleantohtml($_POST['bloc_livrare']);
        $scara_livrare       = stripcleantohtml($_POST['scara_livrare']);
        $etaj_adresa_livrare = stripcleantohtml($_POST['etaj_adresa_livrare']);
        $apartament_livrare  = stripcleantohtml($_POST['apartament_livrare']);
        $nume                = stripcleantohtml($_POST['nume']);
        $cnp                 = stripcleantohtml($_POST['cnp']);
        $telefon             = stripcleantohtml($_POST['telefon']);
        $email               = stripcleantohtml($_POST['email']);
		$data				 = stripcleantohtml($_POST['data']);

		$period_asig             = stripcleantohtml($_POST['period_asig']);
        $invest               = stripcleantohtml($_POST['invest']);
		$mod_plata				 = stripcleantohtml($_POST['mod_plata']);

$sql="select * from colaboratori where activ=1 and idcolaborator=20  ";
$rows = $db->query($sql);
    while ($record = $db->fetch_array($rows))
	 	{
			$destinatar = $record['email'];
		}

		
	//	if (empty($nume_prenume_copil))
   //         $message_error .= 'Nume prenume copil este incorect.<br>';
	//	if (empty($cnp_copil))
     //       $message_error .= 'Cnp copil este incorect.<br>';
	//	if (empty($tip_asig_viata))
    //        $message_error .= 'Tip asig viata este incorect.<br>';
	//	if (empty($protectie_medicala))
   //         $message_error .= 'Protectie medicala este incorecta.<br>';
	//	if (empty($deces))
    //        $message_error .= 'Deces este incorecta.<br>';
	//	if (empty($invaliditate))
    //        $message_error .= 'Invaliditate este incorecta.<br>';
	//	if (empty($spitalizare))
     //	if (empty($interventii_chirurgicale))
    //        $message_error .= 'Interventii chirurgicale este incorecta.<br>';
	//	if (empty($boli_grave))
      //      $message_error .= 'Boli grave este incorecta.<br>';
	//	if (empty($imobilizare_gipsat))
    //        $message_error .= 'Imobilizare gipsat este incorecta.<br>';
	//	if (empty($benef_pensionar))
    //        $message_error .= 'Benef pensionar este incorecta.<br>';
	
		
		
		
		
		
		
		
        if (empty($data)) $message_error.='Data este incorecta.<br>';
        if (empty($localitate_livrare))
            $message_error .= 'Localitatea este incorecta.<br>';
        if (empty($judet_livrare))
            $message_error .= 'Judetul este incorect.<br>';
        if (empty($strada_livrare))
            $message_error .= 'Strada este incorecta.<br>';
        if (!valName($nume))
            $message_error .= 'Numele este incorect.<br>';
        if (!valideazacnp($cnp))
            $message_error .= 'Cnp invalid.<br>';
        if (empty($telefon))
            $message_error .= 'Telefonul este incorect.<br>';
        if (!isValidEmail($email))
            $message_error .= 'Email invalid.<br>';
        if ($message_error == '') {

				if ($tip_asig_viata=="Pentru Copil")
			{

		//			$cp_np="<th>Nume complet copil</th>";
		//			$cp_cnp="<th>CNP copil</th>";

          $cp_np=" <tr><td style='font-weight: bold;'>Nume complet copil</td><td  >".$nume_prenume_copil."</td></tr>";
          $cp_cnp=" <tr><td style='font-weight: bold;'>CNP copil</td><td  >".$cnp_copil."</td></tr>";

					//$v_sp=$serie_pad;
				//	$v_np=$nr_pad;

			//		$c_nume="<td>".$nume_prenume_copil."</td>";
			//		$c_cnp="<td>".$cnp_copil."</td>";

			}
			////////////////////////////////1
			// $table_polita .= "<h1>1.Polita Asigurare de viata</h1>";
      //       $table_polita .= "<table border='1' cellpadding='1' cellspacing='1' width='100%'>";
      //       $table_polita .= "<tr><th>Tip asigurare viata:</th>".$cp_np."".$cp_cnp."<th>Protectie-probleme medicale:</th><th>Deces:</th><th>Invaliditate:</th><th>Spitalizare</th><th>Interventii chirurgicale</th><th>Boli grave</th><th>Imobilizare in aparat gipsat</th><th>Beneficiati de o suma de bani<br> in momentul pensionarii</th><th>Data intrarii in vigoare</th><th>Perioda de asigurare</th><th>Investitia anuala(RON)</th><th>Modul de plata</th></tr>";
      //       $table_polita .= "<tr><td>" . $tip_asig_viata . "</td>".$c_nume."".$c_cnp."<td>" . $protectie_medicala . "</td><td>" . $deces . "</td><td>" . $invaliditate . "</td><td>" . $spitalizare . "</td><td>" . $interventii_chirurgicale . "</td><td>" . $boli_grave . "</td><td>" . $imobilizare_gipsat . "</td><td>" . $benef_pensionar . "</td><td>" . $data . "</td><td>" . $period_asig . "</td><td>" . $invest . "</td><td>" . $mod_plata . "</td></tr></table>";
			// ///////////////////////////////////
      $table_polita.= " <br><br>";
       $table_polita.= "<table border='2' style='border: 2px solid #c1d72a;' cellpadding='6' cellspacing='3' width='70%' >";
       $table_polita.= "
       <tr><td colspan='2' style='font-weight: bold; background: #c1d72a; color: #363c39;'><h2>1.Polita Asigurare de viata</h2></td></tr>
       <tr><td style='font-weight: bold;    width:70%;'>Tip asigurare viata</td><td  >".$tip_asig_viata."</td></tr>
       ".$cp_np."
       ".$cp_cnp."
       <tr><td style='font-weight: bold;'>Protectie-probleme medicale</td><td  >".$protectie_medicala."</td></tr>
       <tr><td style='font-weight: bold;'>Deces</td><td  >".$deces."</td></tr>
       <tr><td style='font-weight: bold;'>Invaliditate</td><td  >".$invaliditate."</td></tr>
       <tr><td style='font-weight: bold;'>Spitalizare</td><td  >".$spitalizare."</td></tr>
       <tr><td style='font-weight: bold;'>Interventii chirurgicale</td><td  >".$interventii_chirurgicale."</td></tr>
       <tr><td style='font-weight: bold;'>Boli grave</td><td  >".$boli_grave."</td></tr>
       <tr><td style='font-weight: bold;'>Imobilizare in aparat gipsat</td><td  >".$imobilizare_gipsat."</td></tr>
       <tr><td style='font-weight: bold;'>Data intrarii in vigoare</td><td  >".$data."</td></tr>
       <tr><td style='font-weight: bold;'>Perioda de asigurare</td><td  >".$period_asig."</td></tr>
       <tr><td style='font-weight: bold;'>Investitia anuala(RON)</td><td  >".$invest."</td></tr>
       <tr><td style='font-weight: bold;'>Modul de plata</td><td  >".$mod_plata."</td></tr>
        ";
       $table_polita.="</table>";
      /////////////////////////////////2
            // $table_adresa_loc .= "<h1>2. Adresa de livrare</h1>";
            // $table_adresa_loc .= "<table border='1' cellpadding='1' cellspacing='1' width='100%'><tr><th>Localitate</th><th>Judet</th><th>Strada</th><th>Nr.</th>			<th>Bloc</th><th>Scara</th><th>Etaj</th><th>Apartament</th></tr>";
            // $table_adresa_loc .= "<tr><td>" . $localitate_livrare . "</td><td>" . $judet_livrare . "</td><td>" . $strada_livrare . "</td><td>" . $nr_livrare . "</td>			<td>" . $bloc_livrare . "</td><td>" . $scara_livrare . "</td><td>" . $etaj_adresa_livrare . "</td><td>" . $apartament_livrare . "</td></tr></table>";
        //////////////////////////
        $table_adresa_loc.= " <br><br><br>";
         $table_adresa_loc.= "<table border='2' style='border: 2px solid #c1d72a;' cellpadding='6' cellspacing='3' width='70%' >";
         $table_adresa_loc.= "
         <tr><td colspan='2' style='font-weight: bold; background: #c1d72a; color: #363c39;'><h2>2. Adresa de livrare</h2></td></tr>
         <tr><td style='font-weight: bold;    width:70%;'>Localitate</td><td  >".$localitate_livrare."</td></tr>
         <tr><td style='font-weight: bold;'>Judet</td><td  >".$judet_livrare."</td></tr>
         <tr><td style='font-weight: bold;'>Strada</td><td  >".$strada_livrare."</td></tr>
         <tr><td style='font-weight: bold;'>Nr</td><td  >".$nr_livrare."</td></tr>
         <tr><td style='font-weight: bold;'>Bloc</td><td  >".$bloc_livrare."</td></tr>
         <tr><td style='font-weight: bold;'>Scara</td><td  >".$scara_livrare."</td></tr>
         <tr><td style='font-weight: bold;'>Etaj</td><td  >".$etaj_adresa_livrare."</td></tr>
         <tr><td style='font-weight: bold;'>Apartament</td><td  >".$apartament_livrare."</td></tr>
          ";
         $table_adresa_loc.="</table>";

        ///////////////////////////////////3
		  //  $table_proprietar .= "<h1>3. Date contact</h1>";
      //       $table_proprietar .= "<table border='1' cellpadding='1' cellspacing='1' width='100%'>";
      //       $table_proprietar .= "<tr><th>Nume si prenume:</th><th>Cnp</th><th>Telefon</th><th>Email</th><th>Stare civila</th><th>Copii minori</th><th>Educatie</th><th>Ocupatie asigurat</th></tr>";
      //       $table_proprietar .= "<tr><td>" . $nume . "</td><td>" . $cnp . "</td><td>" . $telefon . "</td><td>" . $email . "</td><td>" . $stare_civila . "</td><td>" . $copii_minori . "</td><td>" . $educatie . "</td><td>" . $ocupatie_asigurat . "</td></tr></table>";
			///////////////////////////////////////////////////////////
      $table_proprietar.= " <br><br><br>";
       $table_proprietar.= "<table border='2' style='border: 2px solid #c1d72a;' cellpadding='6' cellspacing='3' width='70%' >";
       $table_proprietar.= "
       <tr><td colspan='2' style='font-weight: bold; background: #c1d72a; color: #363c39;'><h2>3. Date contact</h2></td></tr>
       <tr><td style='font-weight: bold;    width:70%;'>Nume si prenume</td><td  >".$nume."</td></tr>
       <tr><td style='font-weight: bold;'>Cnp</td><td  >".$cnp."</td></tr>
       <tr><td style='font-weight: bold;'>Telefon</td><td  >".$telefon."</td></tr>
       <tr><td style='font-weight: bold;'>Email</td><td  >".$email."</td></tr>
       <tr><td style='font-weight: bold;'>Stare civila</td><td  >".$stare_civila."</td></tr>
       <tr><td style='font-weight: bold;'>Copii minori</td><td  >".$copii_minori."</td></tr>
       <tr><td style='font-weight: bold;'>Educatie</td><td  >".$educatie."</td></tr>
       <tr><td style='font-weight: bold;'>Ocupatie asigurat</td><td  >".$ocupatie_asigurat."</td></tr>
        ";
       $table_proprietar.="</table>";
      /////////////////////////////////////////////////////////
			$nume_companie = "Transilvania Broker Sibiu";

$mesaj = "<div style='font-size:22px;color:#c1d72a;'><h1>Comanda dumneavoastra pentru Oferta de Asigurare Viata a fost inregistrata!<u></u><u></u></h1></div>
<span class='im' style='font-size:14px; font-style: italic;'><p>Pentru comenzile plasate dupa ora 18:00 pana la ora 07:00 a celei de a doua zi, personalul nostru o sa va contacteze in dimineata urmatoare incepand cu ora 07:00<u></u><u></u></p><p>In cazul in care constatati ca datele introduse sunt incorecte, va rugam sa ne instiintati pe e-mail la adresa <a href='mailto:sibiu@transilvaniabroker.ro' target='_blank'>sibiu@transilvaniabroker.ro</a> <u></u><u></u></p></span> ";


            include("class.phpmailer.php");

			$contacts = array($destinatar,$email);
			foreach($contacts as $contact) {

            $mail    = new PHPMailer();

			$subject = "Comanda dumneavoastra pentru Oferta de Asigurare Viata a fost inregistrata!";

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
            $mail->Body    =  $mesaj . $table_polita . $table_adresa_loc . $table_proprietar;
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
        <div class="bullet">1.Despre Asigurare</div>
        <div class="rowElem" id="tip_asig_viata-div" style="float:left;width:49%;">
            <label>Ce tip de asigurare de viata doriti?</label>
            <select onchange="copil_f(this.value);" name="tip_asig_viata" id="tip_asig_viata" style="
    width: 165px;">

				<!-- <option value="" selected="selected"></option> -->
                <option <?php if ($tip_asig_viata=='Protectie' ) echo "selected"; ?> value="Protectie">Protectie</option>
                <option <?php if ($tip_asig_viata=='Economisire' ) echo "selected"; ?> value="Economisire">Economisire</option>
				 <option <?php if ($tip_asig_viata=='Pentru Copil' ) echo "selected"; ?> value="Pentru Copil">Pentru Copil</option>
            </select>
            <div id="tip_asig_viata-tip" class="jFormerTip"> <span class="tipArrow"></span> </div>
        </div>


		<div class="clear"></div>
		<div class="rowElem" id="nume_prenume_copil-div" style="float:left;width:49%;">
            <label>Nume si prenume copil:</label>
           <input id="nume_prenume_copil" type="text" name="nume_prenume_copil" value="<?php echo $nume_prenume_copil; ?>" />
            <div id="nume_prenume_copil-tip" class="jFormerTip"> <span class="tipArrow"></span> </div>
        </div>

		<div class="rowElem" id="cnp_copil-div" style="float:left;width:49%;">
            <label>CNP copil:</label>
            <input id="cnp_copil" type="text" name="cnp_copil" value="<?php echo $cnp_copil; ?>" />
            <div id="cnp_copil-tip" class="jFormerTip"> <span class="tipArrow"></span> </div>
        </div>

		<div class="clear"></div>


        <div class="rowElem" id="protectie_medicala-div" style="float:left;width:49%;">
            <label>Doriti acoperiri pentru boli grave?</label>
            <select name="protectie_medicala" id="protectie_medicala">
				<!-- <option value="" selected="selected"></option> -->
				  <option <?php if ($protectie_medicala=='NU' ) echo "selected"; ?> value="NU">NU</option>
				  <option <?php if ($protectie_medicala=='DA' ) echo "selected"; ?> value="DA">DA</option>
            </select>
            <div id="protectie_medicala-tip" class="jFormerTip"> <span class="tipArrow"></span> </div>
        </div>
        <div class="clear"></div>
        <div class="despartitor">&nbsp;</div>
        <div class="rowElem" id="deces-div" style="float:left;width:49%;">
            <label>Deces:</label>
            <select name="deces" id="deces">
				<!-- <option value="" selected="selected"></option> -->
                <option <?php if ($deces=='Din accident' ) echo "selected"; ?> value="Din accident">Din accident</option>
                <option <?php if ($deces=='Din orice cauza' ) echo "selected"; ?> value="Din orice cauza">Din orice cauza</option>

            </select>
            <div id="deces-tip" class="jFormerTip"> <span class="tipArrow"></span> </div>
        </div>
        <div class="rowElem" id="invaliditate-div" style="float:left;width:49%;">
            <label>Invaliditate:</label>
            <div class="clear"></div>
            <select name="invaliditate" id="invaliditate">
				<!-- <option value="" selected="selected"></option> -->
                <option <?php if ($deces=='Din accident' ) echo "selected"; ?> value="Din accident">Din accident</option>
                <option <?php if ($deces=='Din orice cauza' ) echo "selected"; ?> value="Din orice cauza">Din orice cauza</option>

            </select>
            <div id="invaliditate-tip" class="jFormerTip"> <span class="tipArrow"></span> </div>
        </div>
        <div class="clear"></div>
        <div class="despartitor">&nbsp;</div>

        <div class="rowElem" id="spitalizare-div" style="float:left;width:49%;">
            <label>Spitalizare:</label>
            <select name="spitalizare" id="spitalizare">
				<!-- <option value="" selected="selected"></option> -->
                <option <?php if ($deces=='Din accident' ) echo "selected"; ?> value="Din accident">Din accident</option>
                <option <?php if ($deces=='Din orice cauza' ) echo "selected"; ?> value="Din orice cauza">Din orice cauza</option>
            </select>
            <div id="spitalizare-tip" class="jFormerTip"> <span class="tipArrow"></span> </div>
        </div>


		<div class="rowElem" id="interventii_chirurgicale-div" style="float:left;width:49%;">
            <label>Interventii chirurgicale:</label>
            <select name="interventii_chirurgicale" id="interventii_chirurgicale">
				<!-- <option value="" selected="selected"></option> -->
                <option <?php if ($deces=='Din accident' ) echo "selected"; ?> value="Din accident">Din accident</option>
                <option <?php if ($deces=='Din orice cauza' ) echo "selected"; ?> value="Din orice cauza">Din orice cauza</option>
            </select>
            <div id="interventii_chirurgicale-tip" class="jFormerTip"> <span class="tipArrow"></span> </div>
        </div>
        <div class="clear"></div>





		<div class="rowElem" id="boli_grave-div" style="float:left;width:49%;">
            <label>Boli grave:</label>
            <select name="boli_grave" id="boli_grave">
               <!-- <option value="" selected="selected"></option> -->
                <option <?php if ($boli_grave=='DA' ) echo "selected"; ?> value="DA">DA</option>
				 <option <?php if ($boli_grave=='NU' ) echo "selected"; ?> value="NU">NU</option>
            </select>
            <div id="boli_grave-tip" class="jFormerTip"> <span class="tipArrow"></span> </div>
        </div>


		<div class="rowElem" id="imobilizare_gipsat-div" style="float:left;width:49%;">
            <label>Imobilizare in aparat gipsat:</label>
            <select name="imobilizare_gipsat" id="imobilizare_gipsat">
				<!-- <option value="" selected="selected"></option> -->
                <option <?php if ($imobilizare_gipsat=='DA' ) echo "selected"; ?> value="DA">DA</option>
                <option <?php if ($imobilizare_gipsat=='NU' ) echo "selected"; ?> value="NU">NU</option>
            </select>
            <div id="imobilizare_gipsat-tip" class="jFormerTip"> <span class="tipArrow"></span> </div>
        </div>


		<!--<div class="rowElem" id="benef_pensionar-div" style="float:left;width:49%;">
            <label>Doriti sa beneficiati de o suma de bani in momentul pensionarii?</label>
            <select name="benef_pensionar" id="benef_pensionar">

                <option <?php if ($benef_pensionar =='DA' ) echo "selected"; ?> value="DA">DA</option>
                <option <?php if ($benef_pensionar =='NU' ) echo "selected"; ?> value="NU">NU</option>
            </select>
            <div id="benef_pensionar-tip" class="jFormerTip"> <span class="tipArrow"></span> </div>
        </div>
        <div class="clear"></div> -->



		<div class="rowElem" id="data-div" style="float:left;width:49%;">
			<label>Data start:</label>
			<input id="data" type="text" name="data" value="<?php echo $data; ?>" />
			<div id="data-tip" class="jFormerTip" style="margin-top:-67px;">
				<span class="tipArrow"></span><div class="tipContent"><p>Data intrarii in vigoare a politei</p></div>
			</div>
		</div>

		<div class="rowElem" id="period_asig-div" style="float:left;width:49%;">
            <label>Perioada asigurata</label>
            <select name="period_asig" id="period_asig">

                <option <?php if ($period_asig =='5 ani' ) echo "selected"; ?> value="5 ani">5 ani</option>
                <option <?php if ($period_asig =='10 ani' ) echo "selected"; ?> value="10 ani">10 ani</option>
				<option <?php if ($period_asig =='15 ani' ) echo "selected"; ?> value="15 ani">15 ani</option>
                <option <?php if ($period_asig =='20 ani' ) echo "selected"; ?> value="20 ani">20 ani</option>
				<option <?php if ($period_asig =='25 ani' ) echo "selected"; ?> value="25 ani">25 ani</option>
                <option <?php if ($period_asig =='30 ani' ) echo "selected"; ?> value="30 ani">30 ani</option>
            </select>
            <div id="period_asig-tip" class="jFormerTip"> <span class="tipArrow"></span> </div>
        </div>
       <div class="clear"></div>

		<div class="rowElem" id="invest-div" style="float:left;width:49%;">
			<label>Suma pe care doresti sa <br>o investesti anual</label>
			<input id="invest" type="text" name="invest" value="<?php echo $invest; ?>" />
			<div id="invest-tip" class="jFormerTip">
				<span class="tipArrow"></span><div class="tipContent"><p>Suma este in RON</p></div>
			</div>
		</div>



		<div class="rowElem" id="mod_plata-div" style="float:left;width:49%;">
            <label>Mod de plata</label>
            <select name="mod_plata" id="mod_plata">
			    <option <?php if ($mod_plata =='Trimestrial' ) echo "selected"; ?> value="Trimestrial">Trimestrial</option>
                <option <?php if ($mod_plata =='Semestrial' ) echo "selected"; ?> value="Semestrial">Semestrial</option>
                <option <?php if ($mod_plata =='Anual' ) echo "selected"; ?> value="Anual">Anual</option>
            </select>
            <div id="mod_plata-tip" class="jFormerTip"> <span class="tipArrow"></span> </div>
        </div>
        <div class="clear"></div>




        <div class="despartitor">&nbsp;</div>
        <div class="bullet">2.Informatii despre solicitant</div>
        <div class="rowElem" id="nume-div" style="float:left;width:49%;">
            <label>Nume si prenume:</label>
            <input id="nume" type="text" name="nume" value="<?php echo $nume; ?>" />
            <div id="nume-tip" class="jFormerTip"> <span class="tipArrow"></span> </div>
        </div>
        <div class="rowElem" id="cnp-div" style="float:left;width:49%;">
            <label>Cnp:</label>
            <input id="cnp" type="text" name="cnp" value="<?php echo $cnp; ?>" />
            <div id="cnp-tip" class="jFormerTip"> <span class="tipArrow"></span> </div>
        </div>
        <div class="clear"></div>
        <div class="rowElem" id="telefon-div" style="float:left;width:49%;">
            <label>Telefon:</label>
            <input id="telefon" type="text" name="telefon" value="<?php echo $telefon; ?>" />
            <div id="telefon-tip" class="jFormerTip"> <span class="tipArrow"></span> </div>
        </div>
        <div class="rowElem" id="email-div" style="float:left;width:49%;">
            <label>Email:</label>
            <input id="email" type="text" name="email" value="<?php echo $email; ?>" />
            <div id="email-tip" class="jFormerTip"> <span class="tipArrow"></span> </div>
        </div>
        <div class="clear"></div>

		 <div class="rowElem" id="stare_civila-div" style="float:left;width:49%;">
            <label>Stare civila:</label>
            <select name="stare_civila" id="stare_civila ">
                                                         <option <?php if ($stare_civila=='Alegeti' ) echo "selected"; ?> value="Alegeti">Alegeti</option>
                                                         <option  <?php if ($stare_civila =='Casatorit(a)' ) echo "selected"; ?> value="Casatorit(a)">Casatorit(a)</option>
														 <option  <?php if ($stare_civila =='Necasatorit(a)' ) echo "selected"; ?> value="Necasatorit(a)">Necasatorit(a)</option>
														 <option  <?php if ($stare_civila =='Divortat(a)' ) echo "selected"; ?> value="Divortat(a)">Casatorit(a)</option>
														 <option  <?php if ($stare_civila =='Vaduv(a)' ) echo "selected"; ?> value="Vaduv(a)">Vaduv(a)</option>
                                       </select>
            <div id="stare_civila-tip" class="jFormerTip"> <span class="tipArrow"></span> </div>
        </div>


		 <div class="rowElem" id="copii_minori-div" style="float:left;width:49%;">
            <label>Copii minori:</label>
            <select name="copii_minori" id="copii_minori ">

                                                         <option  <?php if ($copii_minori =='niciun copil' ) echo "selected"; ?> value="niciun copil">niciun copil</option>
														 <option  <?php if ($copii_minori =='un copil' ) echo "selected"; ?> value="un copil">un copil</option>
														 <option  <?php if ($copii_minori =='doi copii' ) echo "selected"; ?> value="doi copii">doi copii</option>
														 <option  <?php if ($copii_minori =='trei copii' ) echo "selected"; ?> value="trei copii">trei copii</option>
														  <option  <?php if ($copii_minori =='patru copii' ) echo "selected"; ?> value="patru copii">patru copii</option>
														 <option  <?php if ($copii_minori =='cinci copii' ) echo "selected"; ?> value="cinci copii">cinci copii</option>
														 <option  <?php if ($copii_minori =='mai mult de cinci copii' ) echo "selected"; ?> value="mai mult de cinci copii">mai mult de cinci copii</option>
                                       </select>
            <div id="copii_minori-tip" class="jFormerTip"> <span class="tipArrow"></span> </div>
        </div>
        <div class="clear"></div>


		<div class="rowElem" id="educatie-div" style="float:left;width:49%;">
            <label>Educatie:</label>
            <select name="educatie" id="educatie ">

                                                         <option <?php if ($educatie=='Alegeti' ) echo "selected"; ?> value="Alegeti">Alegeti</option>
														 <option  <?php if ($educatie =='Gimnaziu' ) echo "selected"; ?> value="Gimnaziu">Gimnaziu</option>
														 <option  <?php if ($educatie =='Scoala profesionala' ) echo "selected"; ?> value="Scoala profesionala">Scoala profesionala</option>
														 <option  <?php if ($educatie =='Liceu' ) echo "selected"; ?> value="Liceu">Liceu</option>
														  <option  <?php if ($educatie =='Post liceala' ) echo "selected"; ?> value="Post liceala">Post liceala</option>
														 <option  <?php if ($educatie =='Studii superioare' ) echo "selected"; ?> value="Studii superioare">Studii superioare</option>
														 <option  <?php if ($educatie =='Studii post universitare' ) echo "selected"; ?> value="Studii post universitare">Studii post universitare</option>
                                       </select>
            <div id="educatie-tip" class="jFormerTip"> <span class="tipArrow"></span> </div>
        </div>
		
		 <div class="rowElem" id="ocupatie_asigurat-div" style="float:left;width:49%;">
            <label>Ocupatie:</label>
            <input id="ocupatie_asigurat" type="text" name="ocupatie_asigurat" value="<?php echo $ocupatie_asigurat; ?>" />
            <div id="ocupatie_asigurat-tip" class="jFormerTip"> <span class="tipArrow"></span> </div>
        </div>
		
        <div class="clear"></div>


        <div class="rowElem" id="localitate_livrare-div" style="float:left;width:49%;">
            <label>Localitate:</label>
            <input id="localitate_livrare" type="text" name="localitate_livrare" value="<?php echo $localitate_livrare; ?>" />
            <div id="localitate_livrare-tip" class="jFormerTip"> <span class="tipArrow"></span> </div>
        </div>
        <div class="rowElem" id="judet_livrare-div" style="float:left;width:49%;">
            <label>Judet:</label>
            <input id="judet_livrare" type="text" name="judet_livrare" value="<?php echo $judet_livrare; ?>" />
            <div id="judet_livrare-tip" class="jFormerTip"> <span class="tipArrow"></span> </div>
        </div>
        <div class="clear"></div>
        <div class="rowElem" id="strada_livrare-div" style="width:49%;">
            <label>Strada:</label>
            <input id="strada_livrare" type="text" name="strada_livrare" value="<?php echo $strada_livrare; ?>" />
            <div id="strada_livrare-tip" class="jFormerTip"> <span class="tipArrow"></span> </div>
        </div>
        <div class="clear"></div>
        <div class="rowElem" id="nr_livrare-div" style="float:left;width:18%;">
            <label>Nr.:</label>
            <input id="nr_livrare" type="text" name="nr_livrare" style="width:30px;" value="<?php echo $nr_livrare; ?>" />
            <div id="nr_livrare-tip" class="jFormerTip"> <span class="tipArrow"></span> </div>
        </div>
        <div class="rowElem" id="bloc_livrare-div" style="float:left;width:18%;">
            <label>Bloc:</label>
            <input id="bloc_livrare" type="text" name="bloc_livrare" style="width:30px;" value="<?php echo $bloc_livrare; ?>" />
            <div id="bloc_livrare-tip" class="jFormerTip"> <span class="tipArrow"></span> </div>
        </div>
        <div class="rowElem" id="scara_livrare-div" style="float:left;width:18%;">
            <label>Scara:</label>
            <input id="scara_livrare" type="text" name="scara_livrare" style="width:30px;" value="<?php echo $scara_livrare; ?>" />
            <div id="scara_livrare-tip" class="jFormerTip"> <span class="tipArrow"></span> </div>
        </div>
        <div class="rowElem" id="etaj_adresa_livrare-div" style="float:left;width:18%;">
            <label>Etaj:</label>
            <input id="etaj_adresa_livrare" type="text" name="etaj_adresa_livrare" style="width:30px;" value="<?php echo $etaj_adresa_livrare; ?>" />
            <div id="etaj_adresa_livrare-tip" class="jFormerTip"> <span class="tipArrow"></span> </div>
        </div>
        <div class="rowElem" id="apartament_livrare-div" style="float:left;width:18%;">
            <label>Apart:</label>
            <input id="apartament_livrare" type="text" name="apartament_livrare" style="width:30px;" value="<?php echo $apartament_livrare; ?>" />
            <div id="apartament_livrare-tip" class="jFormerTip"> <span class="tipArrow"></span> </div>
        </div>
        <div class="clear"></div>
        <div class="despartitor">&nbsp;</div>





        <input type="hidden" name="token" value="<?php echo $newToken; ?>">
        <div class="rowElem">
            <label>Trimite datele introduse:</label>
            <input class="submit" type="submit" name="send_data" value="Trimite" />
        </div>
    </form>
	
	
	

	

    <script language="javascript">

                    // $(
					// "#tip_asig_viata-div, #protectie_medicala-div, #deces-div, #invaliditate-div, #spitalizare-div, #localitate_livrare-div, #judet_livrare-div, #strada_livrare-div, #nr_livrare-div, #bloc_livrare-div, #scara_livrare-div, #etaj_adresa_livrare-div, #apartament_livrare-div, #nume-div, #cnp-div, #telefon-div, #email-div, #interventii_chirurgicale-div, #boli_grave-div, #imobilizare_gipsat-div, #benef_pensionar-div, #stare_civila-div,#data-div, #copii_minori-div,#period_asig-div,#invest-div,#mod_plata-div,#educatie-div,#ocupatie_asigurat-div,  #nume_prenume_copil-div,#cnp_copil-div").click(function() {
                                // parent_div = ($(this).attr("id"));
                                // tip_div_l = ($(this).attr("id")).length - 4;
                                // tip_div = ($(this).attr("id")).substring(0, tip_div_l) + "-tip";
                                // $('.jFormerTip').css('display', "none");
                                // $("#" + tip_div).css('display', "block");
                                // $('#formular_calatorii').find("*").removeClass("form_over_el");
                                // $("#" + parent_div).removeClass("form_out_el");
                                // $("#" + parent_div).addClass("form_over_el");
                                // return false;
								// });

					$('#data').datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'dd-mm-yy'

		});



		$('#nume_prenume_copil-div').css('display', "none");
		$('#cnp_copil-div').css('display', "none");
	function copil_f(id)
    {

	if (id!="Pentru Copil")
		$('#nume_prenume_copil-div').css('display', "none");
		$('#cnp_copil-div').css('display', "none");

	if (id=="Pentru Copil")
		{
		$('#nume_prenume_copil-div').css('display', "block");
		$('#cnp_copil-div').css('display', "block");
		}

    };



</script>
