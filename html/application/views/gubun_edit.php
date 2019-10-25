<br>
        <div class="alert mycolor1" role="alert">구분</div>

				<?
                        $uri_array=$this->uri->uri_to_assoc(3);
                        $text1=array_key_exists("text1",$uri_array) ? "text1/" . urldecode($uri_array["text1"]) : "";                    
                        $page = array_key_exists("page",$uri_array) ? "page/" . urldecode($uri_array["page"]) : "" ;
                        $no=$row->no13;
				?>
                <?    $tmp = $text1 ? "/no/$no/$text1/$page" : "/no/$no/$page";   ?>	
        <form name="form1" method="POST">
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
                            <input type="text" name="name" size="20" maxlength="20" value="<?=$row->name13; ?>" class="form-control form-control-sm">
                        </div>
                    </td>
                </tr>
            </tbody></table>
            <div align="center">
				<a href="/~four13/gubun/edit/<?=$tmp; ?>"><input type="submit" value="저장" class="btn btn-sm mycolor1">
                <a href="/~four13/gubun/del<?=$tmp; ?>"><input type="button" value="삭제" class="btn btn-sm mycolor1"></a>
            </div>
        </form>