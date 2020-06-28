<?php
require 'top.php';

$location = $_POST['url'];
if($location!="") {
    echo $location;
    $html = file_get_contents($location);
    $start = (int)strpos($html, "fdb_lst_ul");
    $end = (int)strpos($html, "끝 페이지");
    $html = substr($html, $start, $end-$start);
    if(!strpos($html, 'cpage')) $repeat = 1;
    else $repeat = (int)$html[(int)strrpos($html, 'cpage')+6];
    $once = array();
    $cnt = 0;
    if(strpos($location, 'document_srl')){
        $start = (int)strrpos($location, 'document_srl')+13;
        $end = $start + 1;
        while(('0'<=$location[$end] && $location[$end]<='9')) {
            $end++;
            if($end >= strlen($location)) break;
        }
    }
    else {
        $start = (int)strrpos($location, '/')+1;
        $end = strlen($location);
    }
    $pyear = $_POST['year'];
    $pmonth = $_POST['month'];
    $pday = $_POST['day'];
    $phour = $_POST['hour'];
    $pmin = $_POST['min'];

    $code = substr($location, $start, $end-$start);
    for($j = 1; $j<=$repeat; $j++) {

        $URL = 'https://www.twicenest.com/index.php?mid=board&document_srl='.$code."&cpage=".$j."#".$code."_comment";
        
        $html = file_get_contents($URL);
        $start = strpos($html, "fdb_lst_ul");
        $end = strpos($html, "rd_end", $start);
        $html = substr($html, $start-2, $end-$start);
        //echo "<br/>".htmlspecialchars($html);
        $start = 1; $end = strlen($html);
        while($start < $end) {
            if(!strpos($html, "meta", (int)$start)) break;
            $loc = (int)strpos($html, "meta", (int)$start)+16;
            if($loc > $end) break;
    
            $start = (int)$loc+1;
            $length = (int)strpos($html, "<", (int)$loc) - (int)$loc;
            if($html[(int)$loc-40] == "i") continue;
            
            $name = substr($html, (int)$loc, (int)$length);
            if($name == "글쓴이") continue;
    
            $date = (int)strpos($html, "date", (int)$start)+6;
            $year = (int)substr($html, $date, 4);
            if($pyear < $year) break;
            else if($pyear == $year) {
                $month = (int)substr($html, $date+5, 2);
                if($pmonth < $month) break;
                else if($pmonth == $month) {
                    $day = (int)substr($html, $date+8, 2);
                    if($pday < $day) break;
                    else if($pday == $day) {
                        $hour = (int)substr($html, $date+11, 2);
                        if($phour < $hour) break;
                        else if($phour == $hour) {
                            $min = (int)substr($html, $date+14, 2);
                            if($pmin < $min) break;
                        }
                    }
                }
            }
            $once[$cnt] = $name;
            $cnt = $cnt + 1;
        }
    } 
    
    echo "<ol>";
    for($i=0; $i<$cnt; $i++) {
        echo "<li>".$once[$i]."</li>";
    }
    echo "</ol></br>";

    $valid = array_fill(0, $cnt, false);
    echo "<h2>****** 당첨 ******</h2><br/>";
    if($_POST['number']=="") $number = 1;
    else $number = $_POST['number'];

    if($number > $cnt) $number = $cnt;

    echo '<div style="padding-left: 25px;">';
    for($i=0; $i<$number; $i++) {
        $index = rand(0, $cnt-1);
        if($valid[$index]) {
            $i--;
            continue;
        }
        $valid[$index] = true;
        echo (string)($index+1).". ".$once[$index]."<br/>";
    }
    echo "</div>";
}
else {
    echo "Url 넣으라고</br>";
}

require 'bottom.php';
?>