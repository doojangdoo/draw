<?php
require 'top.php';
?>
            <div class = "options">
                <form action="find.php" method="POST">
                    <h2>URL</h2>
                    <p><input type="text" class="underline" name="url" style="width:300px;" placeholder="URL 입력"></p>
                    
                    <?php
                    date_default_timezone_set('Asia/Seoul');
                    $year = date("Y");
                    $month = date("m");
                    $day = date("d");
                    $hour = date("H");
                    $min = date("i");
                    ?>

                    <h2>당발 시간</h2>
                    <p>
                    <select name="year" id="year">
                        <?php
                        for($year; $year>=2020; $year--) {
                            echo "<option value=".$year.">".$year."</option>";
                        }
                        ?>
                    </select> 년
                    <select name="month" id="month">
                        <?php
                        for($i=1; $i<=12; $i++) {
                            if($i<10) {
                                if($i == $month)
                                echo "<option value=0".$i." selected>0".$i."</option>";
                                else
                                echo "<option value=0".$i.">0".$i."</option>";
                            }
                            else {
                                if($i == $month)
                                echo "<option value=".$i." selected>".$i."</option>";
                                else
                                echo "<option value=".$i.">".$i."</option>";
                            }
                        }
                        ?>
                    </select> 월
                    <select name="day" id="day">
                        <?php
                        for($i=1; $i<=31; $i++) {
                            if($i<10) {
                                if($i == $day)
                                echo "<option value=0".$i." selected>0".$i."</option>";
                                else
                                echo "<option value=0".$i.">0".$i."</option>";
                            }
                            else{
                                if($i == $day)
                                echo "<option value=".$i." selected>".$i."</option>";
                                else
                                echo "<option value=".$i.">".$i."</option>";
                            }
                        }
                        ?>
                    </select> 일
                    <select name="hour" id="hour">
                        <?php
                        for($i=0; $i<24; $i++) {
                            if($i<10) {
                                if($i == $hour)
                                echo "<option value=0".$i." selected>0".$i."</option>";
                                else
                                echo "<option value=0".$i.">0".$i."</option>";
                            }
                            else{
                                if($i == $hour)
                                echo "<option value=".$i." selected>".$i."</option>";
                                else
                                echo "<option value=".$i.">".$i."</option>";
                            }
                        }
                        ?>
                    </select> 시
                    <select name="min" id="min">
                        <?php
                        for($i=0; $i<=59; $i++) {
                            if($i<10) {
                                if($i == $min)
                                echo "<option value=0".$i." selected>0".$i."</option>";
                                else
                                echo "<option value=0".$i.">0".$i."</option>";
                            }
                            else{
                                if($i == $min)
                                echo "<option value=".$i." selected>".$i."</option>";
                                else
                                echo "<option value=".$i.">".$i."</option>";
                            }
                        }
                        ?>
                    </select> 분까지
                    </p>
                    <h2>당발 인원</h2>
                    <p>
                        <input type="text" class="underline" name="number" style="text-align:center; width: 40px;" placeholder="1"> 명
                    </p>
                    <input id="btn_draw" type="submit" value="당발">
                </form>

                <ul>
                    <li>대댓으로 탑승한 건 카운트 안됨.</li>
                </ul>
            </div>
<?php
require 'bottom.php';
?>