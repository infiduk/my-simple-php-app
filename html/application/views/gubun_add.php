<br>
        <div class="alert mycolor1" role="alert">구분</div>
				
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
            </tbody></table>
            <div align="center">
                <a href="/~four13/gubun/add"><input type="submit" value="저장" class="btn btn-sm mycolor1"></a>
                <a href="/~four13/gubun/"><input type="button" value="이전버튼" class="btn btn-sm mycolor1"></a>
            </div>
        </form>