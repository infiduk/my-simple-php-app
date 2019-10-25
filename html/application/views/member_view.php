<br>
        <div class="alert mycolor1" role="alert">사용자</div>
<?
    $uri_array=$this->uri->uri_to_assoc(3);
	$text1=array_key_exists("text1",$uri_array) ? "text1/" . urldecode($uri_array["text1"]) : "";
    $page = array_key_exists("page",$uri_array) ? "page/" . urldecode($uri_array["page"]) : "" ;
    $no=$row->no13;
	$tel1 = trim(substr($row->tel13,0,3));
	$tel2 = trim(substr($row->tel13,3,4));
	$tel3 = trim(substr($row->tel13,7,4));
	$tel = $tel1 . "-" . $tel2 . "-" . $tel3;
    $rank = $row->rank13==0 ? '직원' : '관리자';
?>
<?      
 $tmp = $text1 ? "/no/$no/$text1/$page" : "/no/$no/$page";   ?>				
        <form name="form1" method="member_insert.html">
            <table class="table table-bordered table-sm mymargin5">
                <tbody><tr>
                    <td width="20%" class="mycolor2" style="vertical-align:middle"> 번호</td>
                    <td width="80%" align="left">
                        <div class="form-inline"><?=$row->no13; ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="20%" class="mycolor2" style="vertical-align:middle">
                        <font color="red">*</font> 이름
                    </td>
                    <td width="80%" align="left">
                        <div class="form-inline">
                            <input type="text" name="name" size="20" maxlength="20" value="<?=$row->name13; ?>" class="form-control form-control-sm" readonly>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="20%" class="mycolor2" style="vertical-align:middle">
                        <font color="red">*</font> 아이디
                    </td>
                    <td width="80%" align="left">
                        <div class="form-inline">
                            <input type="text" name="uid" class="form-control form-control-sm" value="<?=$row->uid13; ?>" readonly>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="20%" class="mycolor2" style="vertical-align:middle">
                        <font color="red">*</font> 암호
                    </td>
                    <td width="80%" align="left">
                        <div class="form-inline">
                            <input type="text" name="pwd" class="form-control form-control-sm" value="<?=$row->pwd13; ?>" readonly>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="20%" class="mycolor2" style="vertical-align:middle">
                         전화
                    </td>
                    <td width="80%" align="left">
                        <div class="form-inline">
                            <input type="text" name="tel1" size="3" maxlength="3" value="<?=$tel1; ?>" class="form-control form-control-sm" readonly>-
                            <input type="text" name="tel2" size="4" maxlength="4" value="<?=$tel2; ?>" class="form-control form-control-sm" readonly>-
                            <input type="text" name="tel3" size="4" maxlength="4" value="<?=$tel3; ?>" class="form-control form-control-sm" readonly>
    
                        </div>
                    </td>
                </tr>
    
                <tr>
                    <td width="20%" class="mycolor2" style="vertical-align:middle">
                         등급
                    </td>
                    <td width="80%" align="left">
                        <div class="form-inline">
<?
	if($rank == '직원') {
	?>
		<label><input type='radio' name='rank' value='0' checked> 직원</label>&nbsp;&nbsp;
		<label><input type='radio' name='rank' value='1'>&nbsp;관리자</label>
	<?} else { ?>
		<label><input type='radio' name='rank' value='0'>&nbsp;직원</label>
		<label><input type='radio' name='rank' value='1' checked>&nbsp;관리자</label>
	<?
	}
?>                       
                        </div>
                    </td>
                </tr>
            </tbody></table>
            <div align="center">
				<a href="/~four13/member/edit<?=$tmp; ?>"><input type="button" value="수정" class="btn btn-sm mycolor1"></a>              
            </div>
        </form>