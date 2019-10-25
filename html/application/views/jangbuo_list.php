<br>
        <div class="alert mycolor1" role="alert">매출장</div>
<script>
  function find_text()
{
    form1.action="/~four13/jangbuo/lists/text1/" + form1.text1.value + "/page";
    form1.submit();
}
$(function() {
    $('#text1') .datetimepicker({
        locale: 'ko',
        format: 'YYYY-MM-DD',
        defaultDate: moment()
    });

    $('#text1') .on("dp.change", function (e) {
        find_text();
    });
});
</script>
<?     
$uri_array=$this->uri->uri_to_assoc(3);
$text1=array_key_exists("text1",$uri_array) ? "/text1/" . urldecode($uri_array["text1"]) : "";
$page = array_key_exists("page",$uri_array) ? "page/" . urldecode($uri_array["page"]) : "0" ;
$tmp = $text1 ? "$text1/$page" : "/$page";
?>    
        <form name="form1" action="" method="post">
            <div class="row">
                <div class="col-3" align="left">            
                    <div class="input-group input-group-sm table-sm date" id="text1">
                        <div class="input-group-prepend">
                            <span class="input-group-text">날짜</span>
                        </div>
                        <input type="date" name="text1" value="<?=$text1 ?>" class="form-control" onkeydown="if (event.keyCode == 13) {find_text();}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <div class="input-group-addon"><i class="far fa-calendar-alt fa-lg"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-9" align="right">           
                      <a href="/~four13/jangbuo/add<?=$tmp; ?>" class="btn btn-sm mycolor1">추가</a>
                </div>
            </div>
        </form>
<table class="table  table-bordered  table-sm  mymargin5">
<tbody><tr class="mycolor2">
                <td width="10%">번호</td>
                <td width="15%">날짜</td>			
                <td width="15%">제품명</td>
                <td width="15%">단가</td>
                <td width="10%">수량</td>
                <td width="15%">금액</td>
                <td width="20%">비고</td>
            </tr>
<?
    foreach ($list as $row)                             // 연관배열 list를 row를 통해 출력한다.
    {
        $no=$row->no13;                                 // 사용자번호
        $writeday=$row->writeday13;
        $product_name=$row->product_name;
        $price=$row->price13;
        $numo=$row->numo13;
        $prices=$row->prices13;
        $bigo=$row->bigo13;
?>
<tr>
    <td><?=$no; ?></td>
    <td><?=$writeday ?></td>
    <td><a href="/~four13/jangbuo/view/no/<?=$no; ?><?=$tmp; ?>"><?=$product_name ?></a></td>
    <td align="right"><?=number_format($price) ?></td>
    <td align="right"><?=$numo ?></td>
    <td align="right"><?=number_format($prices) ?></td>
    <td align="left"><?=$bigo ?></td>    
</tr>
<?
    }
?>
</table>
<?=$pagination; ?>
