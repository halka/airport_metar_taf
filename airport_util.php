<?php
//$requested_airports = "RJch, Rjtt";
//var_dump(splitAirport($requested_airports));
// var_dump(getMetarRaw("RJOO"));
// var_dump(getMetarDecoded("RJOO"));
// var_dump(getTaf("RJOO"));
namespace halkaAU {
    class AirportUtil {
        function __construct() {
        }
        
        function splitAirport($airports){
            return preg_split("/[\s,　]+/", strtoupper($airports), NULL, PREG_SPLIT_NO_EMPTY);
        }

        function getMetarRaw($icao){
            error_reporting(0);
            $metar = file_get_contents("http://tgftp.nws.noaa.gov/data/observations/metar/stations/{$icao}.TXT");
            if(strlen($metar)>1) {
                return $metar;
            }else{
                return "METAR for {$icao} is not available.";
            }
        }

        function getMetarDecoded($icao){
            error_reporting(0);
            $metardecoded = file_get_contents("http://tgftp.nws.noaa.gov/data/observations/metar/decoded/${icao}.TXT");
            if(strlen($metardecoded)>1) {
                return $metardecoded;
            }else{
                return "MEATR for {$icao} is not available.";
            }
        }

        function getTAF($icao){
            error_reporting(0);
            $taf = file_get_contents("http://tgftp.nws.noaa.gov/data/forecasts/taf/stations/{$icao}.TXT");
            $taf = preg_replace("/((      ))/", "", $taf);
            if(strlen($taf)>1) {
                return $taf;
            }else{
                return "TAF for {$icao} is not available.";
            }
        }
    }
}
