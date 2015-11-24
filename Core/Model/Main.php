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
        // Set output quantity of pictures (max - 20 pcs.)
        $imageNumber = 5;
        set_time_limit(0);
        // Get requests from Excel file
        $productList = $this->getInfoFromFile();
        $result = array();
        // Getting the links to array
        if (LIMIT){
            for ($j=0; $j < LIMIT; $j++) {
                array_push($result, $this->getLinks($productList[$j], $imageNumber));
            }
        }
        else {
            foreach($productList as $product){
                array_push($result, $this->getLinks($product, $imageNumber));
            }
        }
        return $result;
    }

    public function getImageListByApi(){
        $productList = $this->getInfoFromFile();
        set_time_limit(0);
        $result = array();
        if (LIMIT){
            for ($j=0; $j < LIMIT; $j++) {
                array_push($result, $this->getLinksByApi($productList[$j]));
            }
        }
        else {
            foreach($productList as $product){
                array_push($result, $this->getLinksByApi($product));
            }
        }
        return $result;
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

private function getLinksByApi($request){
    $j = 0;
    for ($i = 0; $i<3; $i++){
    $json = $this->get_url_contents('http://ajax.googleapis.com/ajax/services/search/images?v=1.0&q='.urlencode($request).'&start='.$j);

    $dataw = json_decode($json);
        foreach ($dataw->responseData->results as $result) {
            $re[$request][] = $result->url;
        }
        $j += 4;
    }
    return $re;
}

private function getLinks($request, $numLinks){
    require_once 'Core/System/simple_html_dom.php';
    $url = "http://images.google.ie/images?as_q=##query##&hl=it&imgtbs=z&btnG=Cerca+con+Google&as_epq=&as_oq=&as_eq=&imgtype=&imgsz=m&imgw=&imgh=&imgar=&as_filetype=&imgc=&as_sitesearch=&as_rights=&safe=images&as_st=y";
    $web_page = file_get_contents( str_replace("##query##",urlencode($request), $url ));
    $content = str_get_html($web_page); // - создаем объект DOM из строки.
    $images = $content->find('#ires td a img');
    $i = 0;
    foreach ($images as $image){
        $arr[$request][] = $image->src;
        if ($i == $numLinks-1){
            break;
        }
        $i++;
    }
    return $arr;
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

    function imgWriteAction(){
        //var_dump($_POST);

        if ($_POST['link']){
            if(is_file("/images/".$_POST['imgId'].".jpg")){
                unlink("/images/".$_POST['imgId'].".jpg");
                return 'ok';
            }
            else{

                $image = file_get_contents($_POST['link']);
                $er = file_put_contents("images/".$_POST['imgId'].".jpg",$image);
                echo "$er";
            }
        }
        return 'fall';
    }
    function clearFolderAction(){
        $dir = 'images';
            if ($objs = glob($dir."/*")) {
                foreach($objs as $obj) {
                    unlink($obj);
                }
            }
    }
}

