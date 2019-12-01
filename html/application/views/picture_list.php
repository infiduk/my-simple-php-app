<br>
        <div class="alert mycolor1" role="alert">갤러리</div>
<script>
  function find_text()
{
    if (!form1.text1.value)       // 값이 없는 경우, 전체 자료
        form1.action="/~four13/product/lists";
    else                                    // 값이 있는 경우, text1 값 전달
        form1.action="/~four13/product/lists/text1/" + form1.text1.value;
    form1.submit();
}

  function zoomimage(iname,pname)
{
    w=window.open("/~four13/picture/zoom/iname/"+iname+"/pname/"+pname,
        "imageview", "resizeable=yes,scrollbars=yes, status=no, width=800, height=600");
    w.focus();
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
            </div>
        </form>
<div class="row">
<?
    foreach ($list as $row)                             // 연관배열 list를 row를 통해 출력한다.
    {
        $iname=$row->pic13 ? $row->pic13 : "";
        $pname=$row->name13;
?>
<div class="col-3">
    <div class="mythumb_box">
        <a href="javascript:zoomimage('<?=$iname ?>','<?=$pname ?>');">
            <img src="/~four13/product_img/thumb/<?=$iname ?>" class="mythumb_image">
        </a>
        <div class="mythumb_text"><?=$pname?></div>
    </div>
</div>
<?
    }
?>
</div>
<?=$pagination; ?>