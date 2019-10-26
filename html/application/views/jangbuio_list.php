<br>
        <div class="alert mycolor1" role="alert">기간별 매출입현황</div>
<script>
  function find_text()
{
    form1.action="/~four13/jangbuio/lists/text1/" + form1.text1.value + "/text2/" + form1.text2.value + "/text3/" + form1.text3.value + "/page";
    form1.submit();
}
function make_excel()
{
    form1.action="/~four13/jangbuio/excel/text1/" + form1.text1.value+"/text2/" + form1.text2.value +
                          "/text3/" + form1.text3.value + "/page";
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
$text3=array_key_exists("text3",$uri_array) ? urldecode($uri_array["text3"]) : "";
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
                        &nbsp;&nbsp;
                        <div class="input-group-prepend">
                            <span class="input-group-text">제품명</span>
                        </div>
                        <select name="text3" class="form-control form-control-sm" onchange="javascript:find_text();">
                            <option value="0">전체</option>
                        <?
                            foreach ($list_product as $row) {
                                if($row->no13 == $text3)
                                    echo("<option value='$row->no13' selected>$row->name13</option>");
                                else
                                    echo("<option value='$row->no13'>$row->name13</option>");
                            }
                        ?>
                        <input type="button" value="EXCEL" class="form-control btn btn-sm mycolor1" onClick="if (confirm('엑셀파일로 저장할까요?')) make_excel();">
                    </div>
                </div>
            </div>
        </form>
<table class="table  table-bordered  table-sm  mymargin5">
<tbody><tr class="mycolor2">
                <td width="10%">번호</td>
                <td width="15%">날짜</td>			
                <td width="15%">제품명</td>
                <td width="10%">단가</td>
                <td width="10%">매입수량</td>
                <td width="10%">매출수량</td>
                <td width="15%">금액</td>
                <td width="15%">비고</td>
            </tr>
<?
    foreach ($list as $row)                             // 연관배열 list를 row를 통해 출력한다.
    {
        $no=$row->no13;                                 // 사용자번호
        $writeday=$row->writeday13;
        $product_name=$row->product_name;
        $price=$row->price13;
        $numi=$row->numi13 ? number_format($row->numi13) : "";
        $numo=$row->numo13 ? number_format($row->numo13) : "";
        $prices=$row->prices13;
        $bigo=$row->bigo13;
?>
<tr>
    <td><?=$no; ?></td>
    <td><?=$writeday ?></td>
    <td><?=$product_name ?></td>
    <td align="right"><?=number_format($price) ?></td>
    <td align="right"><?=$numi ?></td>
    <td align="right"><?=$numo ?></td>
    <td align="right"><?=number_format($prices) ?></td>
    <td align="left"><?=$bigo ?></td>    
</tr>
<?
    }
?>
</table>
<?=$pagination; ?>
