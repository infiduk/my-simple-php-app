<br>
        <div class="alert mycolor1" role="alert">월별 제품별 매출현황</div>
<script>
  function find_text()
{
    form1.action="/~four13/monthly/lists/text1/" + form1.text1.value + "/page";
    form1.submit();
}
$(function() {
    $('#text1') .datetimepicker({
        locale: 'ko',
        format: 'YYYY',
        viewMode: 'years',
        defaultDate: moment()
    });

    $('#text1') .on("dp.change", function (e) {
        find_text();
    });
});
</script>
<?     
$uri_array=$this->uri->uri_to_assoc(3);
$text1=array_key_exists("text1",$uri_array) ? urldecode($uri_array["text1"]) : "";
$page = array_key_exists("page",$uri_array) ? "page/" . urldecode($uri_array["page"]) : "0" ;
?>    
        <form name="form1" action="" method="post">
            <div class="row">
                <div class="col-4" align="left">            
                    <div class="input-group input-group-sm table-sm date">
                        <div class="input-group-prepend">
                            <span class="input-group-text">년도</span>
                        </div>
                        <input type="text" id="text1" name="text1" value="<?=$text1 ?>" class="form-control" onkeydown="if (event.keyCode == 13) {find_text();}">
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
                <td width="16%">제품명</td>
                <td width="7%">1월</td>
                <td width="7%">2월</td>
                <td width="7%">3월</td>
                <td width="7%">4월</td>
                <td width="7%">5월</td>
                <td width="7%">6월</td>
                <td width="7%">7월</td>
                <td width="7%">8월</td>
                <td width="7%">9월</td>
                <td width="7%">10월</td>
                <td width="7%">11월</td>
                <td width="7%">12월</td>
            </tr>
<?
    foreach ($list as $row)                             // 연관배열 list를 row를 통해 출력한다.
    {
?>
<tr>
    <td><?=$row->product_name ?></td>
    <td align="right"><?=$row->s1 ?></td>
    <td align="right"><?=$row->s2 ?></td>
    <td align="right"><?=$row->s3 ?></td>
    <td align="right"><?=$row->s4 ?></td>
    <td align="right"><?=$row->s5 ?></td>
    <td align="right"><?=$row->s6 ?></td>
    <td align="right"><?=$row->s7 ?></td>
    <td align="right"><?=$row->s8 ?></td>
    <td align="right"><?=$row->s9 ?></td>
    <td align="right"><?=$row->s10 ?></td>
    <td align="right"><?=$row->s11 ?></td>
    <td align="right"><?=$row->s12 ?></td>
</tr>
<?
    }
?>
</table>
<?=$pagination; ?>
