<?php
function getGoogleImg($k) {
    $url = "http://images.google.it/images?as_q=##query##&hl=it&imgtbs=z&btnG=Cerca+con+Google&as_epq=&as_oq=&as_eq=&imgtype=&imgsz=m&imgw=&imgh=&imgar=&as_filetype=&imgc=&as_sitesearch=&as_rights=&safe=images&as_st=y";
    $web_page = file_get_contents( str_replace("##query##",urlencode($k), $url ));
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