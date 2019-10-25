<br>
        <div class="alert mycolor1" role="alert">구분별 분포도</div>
<script>
  function find_text()
{
    form1.action="/~four13/graph/lists/text1/" + form1.text1.value + "/text2/" + form1.text2.value + "/page";
    form1.submit();
}
$(function() {
    $('#text1') .datetimepicker({
        locale: 'ko',
        format: 'YYYY-MM-DD',
        defaultDate: moment().subtract(1, 'month').toDate()
    });
    $('#text2') .datetimepicker({
        locale: 'ko',
        format: 'YYYY-MM-DD',
        defaultDate: moment()
    });

    $('#text1') .on("dp.change", function (e) {
        find_text();
    });
    $('#text2') .on("dp.change", function (e) {
        find_text();
    });
});
</script>
<?     
$uri_array=$this->uri->uri_to_assoc(3);
$text1=array_key_exists("text1",$uri_array) ? urldecode($uri_array["text1"]) : "";
$text2=array_key_exists("text2",$uri_array) ? urldecode($uri_array["text2"]) : "";
$page = array_key_exists("page",$uri_array) ? "page/" . urldecode($uri_array["page"]) : "0" ;
?>    
        <form name="form1" action="" method="post">
            <div class="row">
                <div class="col-6" align="left">            
                    <div class="input-group input-group-sm table-sm date">
                        <div class="input-group-prepend">
                            <span class="input-group-text">날짜</span>
                        </div>
                        <input type="text" id="text1" name="text1" value="<?=$text1 ?>" class="form-control" onkeydown="if (event.keyCode == 13) {find_text();}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <div class="input-group-addon"><i class="far fa-calendar-alt fa-lg"></i></div>
                            </div>
                        </div>
                        &nbsp;-&nbsp;
                        <input type="text" id="text2" name="text2" value="<?=$text2 ?>" class="form-control" size="9" onkeydown="if (event.keyCode == 13) {find_text();}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <div class="input-group-addon"><i class="far fa-calendar-alt fa-lg"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?
            $str_label="";
            $str_data="";
            foreach ($list as $row) {
                $str_label .= "'$row->gubun_name', ";
                $str_data .= $row->cnumo . ',';
            }
        ?>

        <script src="/~four13/my/js/Chart.js"></script>
        <script src="/~four13/my/js/utils.js"></script>

        <br><br>

        <style>
            canvas {
                -moz-user-select: none;
                -webkit-user-select: none;
                -ms-user-select: none;
            }
        </style>

        <div id="canvas-holder" style="width:60%">
            <canvas id="chart-area"></canvas>
        </div>
        
        <canvas id="myChart" width="300" height="300"></canvas>
        <script>
            var ctx = document.getElementById('myChart').getContext('2d');
            var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'doughnut',

            // The data for our dataset
            data: {
                labels: [<?=$str_label; ?>],
                datasets: [{
                    label: '제품별 분포도',
                    backgroundColor: [
                        "rgba(255, 99, 132, 0.7)",
                        "rgba(255, 159, 64, 0.7)",
                        "rgba(255, 205, 86, 0.7)",
                        "rgba(75, 192, 192, 0.7)",
                        "rgba(153, 102, 255, 0.7)",
                        "rgba(201, 203, 207, 0.7)",
                        "rgba(54, 162, 235, 0.7)",
                    ],
                    data: [<?=$str_data; ?>]
                }]
            },

            // Configuration options go here
            options: {
                responsive: true,
                legend: {
                    position: "top",
                },
                title: {
                    display: false,
                    text: "구분별 분포도",
                },
            }
            });
        </script>