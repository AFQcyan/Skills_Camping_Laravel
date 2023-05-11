<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript">
    var secure_token = '{{ csrf_token() }}';
</script>
@if(session()->has('flash_message'))
<script>
    var msg = "{{ session('flash_message')}}";
    alert(msg);
</script>
@endif
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skills Camping</title>
    <link rel="stylesheet" href="../resources/css/style.css">
    <link rel="stylesheet" href="../resources/css/fontawesome-free-6.2.0-web/css/all.min.css">
    <script src="../resources/js/jquery-3.6.4.js"></script>
    <script src="../resources/js/script.js"></script>
</head>

<body>
    <header>
        <div class="content between">
            <a href="/" id="logo">
                <img src="./resources/images/logo.png" alt="메인 로고" title="메인 로고">
            </a>
            <div id="navi" class="center">
                <nav>
                    <ul class="flex">
                        <li><a href="/camp">캠핑장 소개</a></li>
                        <li><a href="/reservation">예약하기</a></li>
                        <li><a href="/mypage">마이 페이지</a></li>
                    </ul>

                </nav>
                <div id="util" class="flex center">
                    @if (!session()->has('user'))
                    <p><button onclick='location.href="/user"'>로그인</button></p>
                    @else
                    <p><button onclick='location.href="/logout"'>로그아웃</button></p>
                    @endif
                    <div class="oper">
                        <button onclick='location.href="/manage/reserv"'>운영관리</button>
                        <div class="depth-2 between">
                            <ul class="dep2">
                                <li><a href="/manage/reserv">예약 관리</a></li>
                                <li><a href="/manage/order">주문 관리</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- 헤더 -->
    <div class="main">
        @yield('content')

    </div>
    <footer>
        <div id="footer-nav">
            <ul class="flex">
                <li>개인정보처리방침</li>
                <li>홈페이지 이용약관</li>
            </ul>
        </div>
        <div id="footer" class="between">
            <div id="footer-left">
                <div>
                    고객센터 운영시간 : 평일 09:00 ~ 18:00, 주말 10:00 ~ 15:00, 점심시간 12:30~13:30<br>
                    충청남도 청양군 대치면 까치내로 123<br>
                    고객센터 전화번호 : 041-987-1234 E-mail<br>
                </div>
            </div>
            <div id="footer-right">
                <img src="./resources/images/footer-logo.png" alt="푸터 로고" title="푸터 로고">
                <div>Copyright(C) Skills Camping All Rights Reserved.</div>
            </div>
        </div>
    </footer>
</body>

</html>