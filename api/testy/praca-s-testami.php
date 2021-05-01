<?php
// API ENDPOINT NA PRACU S TESTAMI Z POHLADU UCITELA

$surove_prijate_data = $_GET;

include "api-endpoint-include.php";
include "api-frontend/ApiTesty_API_frontend_ucitel.class.php";


if ($generic_sanity_check) { // na tejto API musi byt prihlaseny vylucne ucitel
	$generic_sanity_check = ApiTesty_sanityChecker::generic_check__prihlaseny_ucitel();
}

if ($generic_sanity_check) {
	// sanity checker v tychto vetvach rovno kontroluje, ktora poziadavka sa ma vykonat, preto je to rozvetvene cez if elseif
	if (ApiTesty_sanityChecker::praca_s_testami_ucitel__nacitaj_vsetky_testy($surove_prijate_data)) {
		$vystup = ApiTesty_API_frontend_ucitel::nacitaj_zoznam_testov_ucitela($mysqli_api_testy, $_SESSION["userId"]);
		echo json_encode($vystup);
	}

	else {
		echo json_encode( Hlasky__API_T::get_hlaska("API_T__GSC_3") ); // nespravny format dat
	}
}
?>