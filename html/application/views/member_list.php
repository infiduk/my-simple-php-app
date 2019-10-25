<br>
        <div class="alert mycolor1" role="alert">사용자</div>
<script>
  function find_text()
{
    if (!form1.text1.value)       // 값이 없는 경우, 전체 자료
        form1.action="/~four13/member/lists";
    else                                    // 값이 있는 경우, text1 값 전달
        form1.action="/~four13/member/lists/text1/" + form1.text1.value;
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
                      <a href="/~four13/member/add<?=$tmp; ?>" class="btn btn-sm mycolor1">추가</a>
                </div>
            </div>
        </form>
<table class="table  table-bordered  table-sm  mymargin5">
<tbody><tr class="mycolor2">
                <td width="10%">번호</td>			
                <td width="20%">아이디</td>
                <td width="20%">암호</td>
                <td width="20%">이름</td>
                <td width="20%">전화</td>
                <td width="10%">등급</td>
            </tr>
<?
    foreach ($list as $row)                             // 연관배열 list를 row를 통해 출력한다.
    {
        $no=$row->no13;                                 // 사용자번호
        $tel1 = trim(substr($row->tel13,0,3));					// 전화 : 지역번호 추출
        $tel2 = trim(substr($row->tel13,3,4));					// 전화 : 국번호 추출
        $tel3 = trim(substr($row->tel13,7,4));					// 전화 : 번호 추출
        $tel = $tel1 . "-" . $tel2 . "-" . $tel3;       // 합치기
        $rank = $row->rank13==0 ? "직원" : "관리자" ;				// 0->직원, 1->관리자 
?>
<tr>
    <td><?=$no; ?></td>
    <td><a href="/~four13/member/view/no/<?=$no; ?><?=$tmp; ?>"><?=$row->uid13; ?></a></td>
		<td><?=$row->pwd13; ?></td>
		<td><?=$row->name13; ?></td>    
		<td><?=$tel; ?></td> 
    <td><?=$rank; ?></td>
</tr>
<?
    }
?>
</table>
<?=$pagination; ?>
