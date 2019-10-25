<br>
        <div class="alert mycolor1" role="alert">사용자</div>
				
        <form name="form1" method="POST">
            <table class="table table-bordered table-sm mymargin5">
                <tbody>
                <tr>
                    <td width="20%" class="mycolor2" style="vertical-align:middle">
                        <font color="red">*</font> 이름
                    </td>
                    <td width="80%" align="left">
                        <div class="form-inline">
                            <input type="text" id="name" name="name" size="20" maxlength="20" value="<?=set_value("name"); ?>" class="form-control form-control-sm">
							<? If (form_error("name")==true) echo form_error("name"); ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="20%" class="mycolor2" style="vertical-align:middle">
                        <font color="red">*</font> 아이디
                    </td>
                    <td width="80%" align="left">
                        <div class="form-inline">
                            <input type="text" id="uid" name="uid" class="form-control form-control-sm" value="<?=set_value("uid"); ?>">
							<? If (form_error("uid")==true) echo form_error("uid"); ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="20%" class="mycolor2" style="vertical-align:middle">
                        <font color="red">*</font> 암호
                    </td>
                    <td width="80%" align="left">
                        <div class="form-inline">
                            <input type="text" id="pwd" name="pwd" class="form-control form-control-sm" value="<?=set_value("pwd"); ?>">
							<? If (form_error("pwd")==true) echo form_error("pwd"); ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="20%" class="mycolor2" style="vertical-align:middle">
                         전화
                    </td>
                    <td width="80%" align="left">
                        <div class="form-inline">
                            <input type="text" id="tel1" name="tel1" size="3" maxlength="3" value="" class="form-control form-control-sm">-
                            <input type="text" id="tel2" name="tel2" size="4" maxlength="4" value="" class="form-control form-control-sm">-
                            <input type="text" id="tel3" name="tel3" size="4" maxlength="4" value="" class="form-control form-control-sm">
    
                        </div>
                    </td>
                </tr>
    
                <tr>
                    <td width="20%" class="mycolor2" style="vertical-align:middle">
                         등급
                    </td>
                    <td width="80%" align="left">
                        <div class="form-inline">
														<label><input type='radio' name='rank' value='0'> 직원</label>&nbsp;&nbsp;
														<label><input type='radio' name='rank' value='1'>&nbsp;관리자</label>                    
                        </div>
                    </td>
                </tr>
            </tbody></table>
            <div align="center">
                <a href="/~four13/member/add"><input type="submit" value="저장" class="btn btn-sm mycolor1"></a>
                <a href="/~four13/member/"><input type="button" value="이전버튼" class="btn btn-sm mycolor1"></a>
            </div>
        </form>