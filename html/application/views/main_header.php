<html lang="kr"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>판매관리</title>
        <link href="/~four13/my/css/bootstrap.min.css" rel="stylesheet">
        <link href="/~four13/my/css/my.css" rel="stylesheet">
        <script src="/~four13/my/js/jquery-3.3.1.min.js"></script>
        <script src="/~four13/my/js/popper.min.js"></script>
        <script src="/~four13/my/js/bootstrap.min.js"></script>
        <script src="/~four13/my/js/moment-with-locales.min.js"></script>
        <script src="/~four13/my/js/bootstrap-datetimepicker.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
        <link href="/~four13/my/css/bootstrap-datetimepicker.css" rel="stylesheet"></script>
        <link href="/~four13/my/css/fontawesome-all.min.css" rel="stylesheet"></script>
    
    </head>
    <body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="/~four13/">판매관리</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/~four13/jangbui">매입</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/~four13/jangbuo">매출</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/~four13/jangbuio">기간조회</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">  
                             통계
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="/~four13/best">BEST제품</a>
                            <a class="dropdown-item" href="/~four13/monthly">월별제품별현황</a>
                            <a class="dropdown-item" href="/~four13/graph">종류별분포도</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">  
                             기초정보
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="/~four13/gubun">구분</a>
                            <a class="dropdown-item" href="/~four13/product">제품</a>
                            <?
                                if($this->session->userdata('rank')==1)
                                    echo("
                            <div class='dropdown-divider'></div>
                            <a class='dropdown-item' href='/~four13/member'>사용자</a>
                                    ");
                            ?>
                        </div>
                    </li>
                </ul>
                <?
                if (!$this->session->userdata('uid'))
                    echo("<a class='btn btn-sm btn-outline-secondary btn-dark' data-toggle='modal' href='#exampleModal'>로그인</a>");
                else
                    echo("<a class='btn btn-sm btn-outline-secondary btn-dark' href='/~four13/login/logout'>로그아웃</a>");
                ?>
            </div>
        </nav>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">로그인</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method='post' action="/~four13/login/check">
                            <div class="form-group">
                                <label for="uid" class="col-form-label">아이디</label>
                                <input type="text" class="form-control" id="uid" name="uid">
                            </div>
                            <div class="form-group">
                                <label for="pwd" class="col-form-label">비밀번호</label>
                                <input type="password" class="form-control" id="pwd" name="pwd">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
                            <button type="submit" class="btn btn-primary">로그인</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>