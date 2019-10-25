<br>
        <div class="alert mycolor1" role="alert">제품</div>
				
        <form name="form1" method="POST" enctype="multipart/form-data">
            <table class="table table-bordered table-sm mymargin5">
                <tbody>
                <tr>
                    <td width="20%" class="mycolor2" style="vertical-align:middle">
                        <font color="red">*</font> 구분명
                    </td>
                    <td width="80%" align="left">
                        <div class="form-inline">
                            <select name="gubun_no" class="form-control form-control-sm">
                                <option value="">선택하세요.</option>
<?
    foreach($list as $row1)
    {
        echo("<option value='$row1->no13'>$row1->name13</option>");
    }
?>
                            </select>
                        </div>
<? if(form_error("gubun_no")==true) echo form_error("gubun_no"); ?>
                    </td>
                </tr>
                <tr>
                    <td width="20%" class="mycolor2" style="vertical-align:middle">
                        <font color="red">*</font> 제품명
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
                        <font color="red">*</font> 가격
                    </td>
                    <td width="80%" align="left">
                        <div class="form-inline">
                            <input type="number" id="price" name="price" class="form-control form-control-sm" value="">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="20%" class="mycolor2" style="vertical-align:middle">
                        <font color="red">*</font> 재고
                    </td>
                    <td width="80%" align="left">
                        <div class="form-inline">
                            <input type="number" id="jaego" name="jaego" class="form-control form-control-sm" value="">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="20%" class="mycolor2" style="vertical-align:middle">
                        <font color="red">*</font> 이미지
                    </td>
                    <td width="80%" align="left">
                        <div class="form-inline">
                            <input type="file" id="pic" name="pic" class="form-control form-control-sm" value="">
                        </div>
                    </td>
                </tr>
            </tbody></table>
            <div align="center">
                <a href="/~four13/product/add"><input type="submit" value="저장" class="btn btn-sm mycolor1"></a>
                <a href="/~four13/product/"><input type="button" value="이전버튼" class="btn btn-sm mycolor1"></a>
            </div>
        </form>