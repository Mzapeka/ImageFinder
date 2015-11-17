<?php
/**
 * Created by PhpStorm.
 * User: Mzapeka
 * Date: 17.11.15
 * Time: 22:23
 */

namespace Model;


use PHPExcel_IOFactory;

class Main {

    private $mainPage = "";

    public function getImgList(){
        //var_dump($_FILES);
        $productList = $this->getInfoFromFile();
/*        foreach ($productList as $product){
            $res[] = $this->Image_Crawler($product);
        }
        var_dump($res);*/

        $json = $this->get_url_contents('http://ajax.googleapis.com/ajax/services/search/images?v=1.0&q='.urlencode($productList[1]));

        $data = json_decode($json);

        foreach ($data->responseData->results as $result) {
            $re[] = array('url' => $result->url, 'alt' => $result->title);
        }

        print_r($re);

    }

    private function getInfoFromFile(){
        require_once ('Core/System/Classes/PHPExcel/IOFactory.php');
        $xls = PHPExcel_IOFactory::load($_FILES['prodList']['tmp_name']);
        $xls->setActiveSheetIndex(0);
        $sheet = $xls->getActiveSheet();

        $productList = array();
        for ($i = 2; $i <= $sheet->getHighestRow(); $i++) {
            $productList[] = $sheet->getCellByColumnAndRow(0, $i)->getValue();
        }
        return $productList;
    }

    private function Image_Crawler($product){
        $url = "http://images.google.ie/images?as_q=##query##&hl=it&imgtbs=z&btnG=Cerca+con+Google&as_epq=&as_oq=&as_eq=&imgtype=&imgsz=m&imgw=&imgh=&imgar=&as_filetype=&imgc=&as_sitesearch=&as_rights=&safe=images&as_st=y";
        $web_page = file_get_contents( str_replace("##query##",urlencode($product), $url ));
        //echo(str_replace("##query##",urlencode($k), $url));
        //echo $web_page;
        $tieni = stristr($web_page,"dyn.setResults(");
        $tieni = str_replace( "dyn.setResults(","", str_replace(stristr($tieni,");"),"",$tieni) );
        $tieni = str_replace("[]","",$tieni);
        $m = preg_split("/[\[\]]/",$tieni);
        $x = array();
        for($i=0;$i<count($m);$i++) {
            $m[$i] = str_replace("/imgres?imgurl\\x3d","",$m[$i]);
            $m[$i] = str_replace(stristr($m[$i],"\\x26imgrefurl"),"",$m[$i]);
            $m[$i] = preg_replace("/^\"/i","",$m[$i]);
            $m[$i] = preg_replace("/^,/i","",$m[$i]);
            if ($m[$i]!="") array_push($x,$m[$i]);
        }
        return $x;
    }

    function get_url_contents($url) {
        $crl = curl_init();

        curl_setopt($crl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)');
        curl_setopt($crl, CURLOPT_URL, $url);
        curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($crl, CURLOPT_CONNECTTIMEOUT, 5);

        $ret = curl_exec($crl);
        curl_close($crl);
        return $ret;
    }



}

