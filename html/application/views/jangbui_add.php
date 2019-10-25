<br>
        <div class="alert mycolor1" role="alert">매입장</div>
<script>
$(function() {
    $('#writeday') .datetimepicker({
        locale: 'ko',
        format: 'YYYY-MM-DD',
        defaultDate: moment()
    });
});

function find_product()
{
    window.open("/~four13/findproduct","","resizable=yes,scrollbars=yes,width=500,height=600");
}
</script>				
        <form name="form1" method="POST" enctype="multipart/form-data">
            <table class="table table-bordered table-sm mymargin5">
                <tbody>
                <tr>
                    <td width="20%" class="mycolor2" style="vertical-align:middle">
                        <font color="red">*</font> 날짜
                    </td>
                    <td width="80%" align="left">
                        <div class="input-group input-group-sm table-sm date">
                            <input type="date" id="writeday" name="writeday" size="20" maxlength="20" value="<?=set_value("writeday"); ?>" class="form-control form-control-sm" style="flex:0.25 auto;">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <div class="input-group-addon"><i class="far fa-calendar-alt fa-lg"></i></div>
                                </div>
                            </div>
							<? If (form_error("writeday")==true) echo form_error("writeday"); ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="20%" class="mycolor2" style="vertical-align:middle">
                        <font color="red">*</font> 제품명
                    </td>
                    <td width="80%" align="left">
                        <div class="form-inline">
                            <input type="hidden" name="product_no" value="<?=set_value("product_no"); ?>" >
                            <input type="text" name="product_name" value="" class="form-control form-control-sm" disabled>
                            <input type="button" value="제품찾기" onClick="find_product();" class="btn btn-sm mycolor1">
                        </div>
<? if(form_error("product_no")==true) echo form_error("product_no"); ?>
                    </td>
                </tr>
                <script>
    function cal_prices()
    {
        form1.prices.value = Number(form1.price.value) * Number(form1.numi.value);
        form1.bigo.focus();
    }
</script>
                <tr>
                    <td width="20%" class="mycolor2" style="vertical-align:middle">
                        단가
                    </td>
                    <td width="80%" align="left">
                        <div class="form-inline">
                            <input type="number" id="price" name="price" value="form1.price.value" class="form-control form-control-sm" readonly>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="20%" class="mycolor2" style="vertical-align:middle">
                        수량
                    </td>
                    <td width="80%" align="left">
                        <div class="form-inline">
                            <input type="number" id="numi" name="numi" class="form-control form-control-sm" onchange="cal_prices();">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="20%" class="mycolor2" style="vertical-align:middle">
                        금액
                    </td>
                    <td width="80%" align="left">
                        <div class="form-inline">
                            <input type="number" id="prices" name="prices" class="form-control form-control-sm" value="form1.prices.value" readonly>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="20%" class="mycolor2" style="vertical-align:middle">
                        비고
                    </td>
                    <td width="80%" align="left">
                        <div class="form-inline">
                            <input type="text" id="bigo" name="bigo" size="50" class="form-control form-control-sm" value="">
                        </div>
                    </td>
                </tr>
            </tbody></table>
            <div align="center">
                <a href="/~four13/jangbui/add"><input type="submit" value="저장" class="btn btn-sm mycolor1"></a>
                <a href="/~four13/jangbui/"><input type="button" value="이전버튼" class="btn btn-sm mycolor1"></a>
            </div>
        </form>