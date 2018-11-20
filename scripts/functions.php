<?php
	@session_start();
	putenv("TZ=Asia/Singapore");
	
	error_reporting(E_ALL & ~E_NOTICE);
	
	define("DOMAIN", "http://www.gotogo.com/");
	
	$c2b = array(
			141, //Centro Coron Bed and Breakfast
			153, //Mermaid Resort
			157, //Encenada Beach Resort
			292, //BEST WESTERN Oxford Suites Makati
			316, //Angkor River Guesthouse (formerly T'zot Genot )
			332, //Cheysokha Guesthouse
			334, //Loving Angkor Hotel (formerly Golden Orange Hotel)
			336, //Baphuon Villa
			344, //Paris Angkor Hotel
			350, //Huy Leng Hotel (formerly Angkor Saphir Hostel)
			352, //Parama Hotel and Restaurant
			358, //Myhibiscus Hotels And Resort
			360, //Dynyka Guesthouse
			370, //Angkor Bright Guest House
			378, //Danau Toba International Cottage
			382, //Grand Antares Hotel
			384, //Madani Hotel Medan
			388, //Hotel Putra Mulia
			392, //Cherry Red Hotel
			394, //Cherry Green Hotel
			398, //Hotel Antares Indonesia
			404, //Nasa Guesthouse
			569, //Viva Hotel (Be.V.I.P)
			697, //Wesly House
			701, //Cherry Garden Hotel
			705, //Cherry Pink Hotel
			721, //Graha Kardopa
			745, //Golden Palace Hotel
			749, //Sabrina Golden Palace Hotel
			753, //Ali Baba Hotel
			797, //Central City Hotel
			805, //Hotel Sarila
			817, //Oasis Hotel
			821, //Ocean Hotel
			845, //Angkor Empire Boutique
			853, //Wild Orchid Resort
			857, //Wild Orchid Beach Resort
			873, //Saka Hotel
			881, //Cihampelas Hotel 1
			885, //Cihampelas Hotel 2
			889, //Cihampelas Hotel 3
			969, //Metro Hotel @ KL Sentral
			981, //Coron Village Lodge
			985, //Tameta Pension House
			1021, //Hotel Le Aries
			1037, //Zodiac Golden Palace Hotel
			1041, //Angkor Spirit Palace Villa
			1077, //VIP STAR Hotel
			1109, //Eurotel Angeles
			1161, //Costa Villa Beach Resort
			1169, //Raz Plaza Hotel
			1193, //Hotel Bumi Asih Medan
			1201, //Home Sweet Home Guesthouse
			1205, //Katy Beach Front Villa
			1213, //Tina's Reef Divers Cottages and Restaurant
			1229, //Krorma Yamato Guest House
			1241, //Captain Gregg's Dive Resort
			1245, //Portofino Beach Resort
			1265, //Khmeroyal Hotel
			1305, //Lotus The Luxury Hotel & Apartment
			1345, //P&M Final Option Beach Resort
			1369, //Rose Royal Boutique
			1389, //Buma Subic Hotel and Restaurant
			1409, //Pomelotel
			1449, //Machiavelli Lodge
			1453, //Isla Virginia 1
			1457, //Isla Virginia 2
			1465, //Bay-ler View Hotel
			1469, //Baler Casitas Bed and Breakfast
			1473, //Bay's Inn
			1481, //Villa Mercedita Club Morocco
			1489, //Mega Cikini Hotel
			1493, //Mega Proklamasi Hotel
			1513, //N Hotel 
			1517, //N1 Hotel
			1521, //N2 Hotel
			1525, //N3 Hotel
			1549, //World Hotel
			1600, //Orlando Residences
			1611, //Baywatch Diving and Fun Center
			1615, //Walk Inn Haven
			1625, //Lofi Inn @ Hamilton
			1626, //Be Queen Boutique Hotel
			1632, //Golden Luck Villa
			1636, //Orinko City
			1671 //SH Hotel
		   );
	
	function addslash($string){
		if (!get_magic_quotes_gpc()){
			$string = addslashes($string);
		}
		
		return $string;
	}
?>