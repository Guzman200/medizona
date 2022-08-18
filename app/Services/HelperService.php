<?php

namespace App\Services;


class HelperService {

    /**
     * Tranforma la fecha a letra
     * 
     * @param string $date en formato y-m-d
     * 
     * @return string
     */
    public static function tranformarFecha($date)
    {

        $fechaArray = explode('-', $date);

        $mes = self::mes($fechaArray[1]);

        return $fechaArray[2] . " de $mes del año " . $fechaArray[0]; 

    }

    public static function mes($mes){

        switch($mes){
            case "01" :
                return "enero";
            break;
            case "02" :
                return "febrero";
            break;
            case "03" :
                return "marzo";
            break;
            case "04" :
                return "abril";
            break;
            case "05" :
                return "mayo";
            break;
            case "06" :
                return "junio";
            break;
            case "07" :
                return "julio";
            break;
            case "08" :
                return "agosto";
            break;
            case "09" :
                return "septiembre";
            break;
            case "10" :
                return "octubre";
            break;
            case "11" :
                return "noviembre";
            break;
            case "12" :
                return "diciembre";
            break;
        }
    }

}