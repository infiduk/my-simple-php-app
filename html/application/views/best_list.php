<br>
        <div class="alert mycolor1" role="alert">BEST 제품</div>
<script>
  function find_text()
{
    form1.action="/~four13/best/lists/text1/" + form1.text1.value + "/text2/" + form1.text2.value + "/page";
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
<table class="table  table-bordered  table-sm  mymargin5">
<tbody><tr class="mycolor2">	
                <td width="40%">제품명</td>
                <td width="30%">판매횟수</td>
                <td width="30%">총 판매수량</td>
            </tr>
<?
    foreach ($list as $row)                             // 연관배열 list를 row를 통해 출력한다.
    {
        $product_name=$row->product_name;
        $cnumo=$row->cnumo ? number_format($row->cnumo) : "";
        $snumo=$row->snumo ? number_format($row->snumo) : "";
?>
<tr>
    <td><?=$product_name ?></td>
    <td align="right"><?=$cnumo ?></td>
    <td align="right"><?=$snumo ?></td>
</tr>
<?
    }
?>
</table>
<?=$pagination; ?>
