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
        set_time_limit(0);
        $productList = $this->getInfoFromFile();
        $result = array();
        for ($j=0; $j < 5; $j++) {
            array_push($result, $this->getLinks($productList[$j], 5));
        }
        return $result;
        /*echo "<pre>";
        print_r($result);
        echo "</pre>";*/

        /*$img = file_get_contents($arr[0]);
        file_put_contents('1.jpg',$img);
        echo $img;*/

        //$res[] = $this->Image_Crawler($productList[0]);
        //var_dump($res);
         /*for ($i = 0; $i<2; $i++){
        $json = $this->get_url_contents('http://ajax.googleapis.com/ajax/services/search/images?v=1.0&q='.urlencode($productList[0]));

        $dataw[] = json_decode($json);*/
         //}
        //var_dump($dataw);

        /*foreach ($dataw as $val){
            foreach ($val->responseData->results as $result) {
                $re[] = array('url' => $result->url, 'alt' => $result->title);
            }
        }*/

      /*  include('Core/System/GoogleImages.php');
        $gimage = new \System\GoogleImages();
        $gimage->get_images(urlencode($productList[1]), 4, 5);*/
        /*echo "<pre>";
        print_r($re);
        echo "</pre>";*/
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
        if (isset($_POST['link'])){
            if(is_file("images/".$_POST['imgId'].".jpg")){
                unlink("images/".$_POST['imgId'].".jpg");
                return 'ok';
            }
            else{
                $image = file_get_contents($_POST['link']);
                file_put_contents("images/".$_POST['imgId'].".jpg",$image);
                return 'ok';
            }
        }
        return 'false';
    }



}

