<br>
        <div class="alert mycolor1" role="alert">제품</div>
<script>
  function find_text()
{
    if (!form1.text1.value)       // 값이 없는 경우, 전체 자료
        form1.action="/~four13/product/lists";
    else                                    // 값이 있는 경우, text1 값 전달
        form1.action="/~four13/product/lists/text1/" + form1.text1.value;
    form1.submit();
}
</script>
<?     
$uri_array=$this->uri->uri_to_assoc(3);
$text1=array_key_exists("text1",$uri_array) ? "/text1/" . urldecode($uri_array["text1"]) : "";
$page = array_key_exists("page",$uri_array) ? "page/" . urldecode($uri_array["page"]) : "0" ;
$tmp = $text1 ? "$text1/$page" : "/$page";   ?>    
        <form name="form1" action="" method="post">
            <div class="row">
                <div class="col-3" align="left">            
                    <div class="input-group  input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text">이름</span>
                        </div>
                        <input type="text" name="text1" value="" class="form-control" onkeydown="if (event.keyCode == 13) {find_text();}">
                        <div class="input-group-append">
                            <button class="btn  btn-primary mycolor1" type="button" onclick="find_text();">검색</button>
                        </div>
                    </div>
                </div>
                <div class="col-9" align="right">           
                      <a href="/~four13/product/add<?=$tmp; ?>" class="btn btn-sm mycolor1">추가</a>
                </div>
            </div>
        </form>
<table class="table  table-bordered  table-sm  mymargin5">
<tbody><tr class="mycolor2">
                <td width="10%">번호</td>
                <td width="20%">구분명</td>			
                <td width="20%">제품명</td>
                <td width="20%">단가</td>
                <td width="20%">재고</td>
            </tr>
<?
    foreach ($list as $row)                             // 연관배열 list를 row를 통해 출력한다.
    {
        $no=$row->no13;                                 // 사용자번호
        $gubun_name=$row->gubun_name;
        $name=$row->name13;
        $price=$row->price13;
        $jaego=$row->jaego13
?>
<tr>
    <td><?=$no; ?></td>
    <td><?=$gubun_name ?></td>
    <td align="left"><a href="/~four13/product/view/no/<?=$no; ?><?=$tmp; ?>"><?=$row->name13; ?></a></td>
    <td align="right"><?=number_format($row->price13) ?></td>
    <td><?=number_format($row->jaego13) ?></td>    
</tr>
<?
    }
?>
</table>
<?=$pagination; ?>
