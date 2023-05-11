@extends('master')

@section('content')
<section id="slide">
    <div class="slide-info">
        <h2>인생의 힐링을 위해<br> Skills Camping 으로 오세요.</h2>
        <div class="flex">
            <div>자세히 보기 <i class="fa-solid fa-chevron-right"></i></div>
            <button class="stop-btn"><i class="fa-solid fa-pause"></i></button>
            <button class="start-btn"><i class="fa-solid fa-play"></i></button>
        </div>
    </div>
    <div class="container">
        <div class="slide-item">
            <img src="./resources/images/01/image_01 (1).png" alt="slide-img" title="slide-img">
        </div>
        <div class="slide-item">
            <img src="./resources/images/01/image_01 (6).jpg" alt="slide-img" title="slide-img">
        </div>
        <div class="slide-item">
            <img src="./resources/images/01/image_01 (25).jpg" alt="slide-img" title="slide-img">
        </div>

        <div class="btn-box"></div>
    </div>
</section>


<!-- <div class="visual-txt content">
        <h2>인생의 힐링을 위해<br> Skills Camping 으로 오세요.</h2>
        <div class="flex">
            <div>자세히 보기 <i class="fa-solid fa-chevron-right"></i></div>
            <i class="fa-solid fa-play"></i>
        </div>
    </div> -->
<!-- 비주얼 -->

<!-- 소개 -->

<section id="introduce" class="content">
    <div id="intro-title">
        <div class="title tc">
            <div>캠핑장 소개</div>
            <h2>충남의 핫플 <span>Skills Camping</span></h2>
            <div>충청남도의 자연경관과 어우러진 최고의 캠핑장</div>
        </div>

        <div class="title-btn tc">
            자세히보기 <i class="fa-solid fa-chevron-right"></i>
        </div>
    </div>
    <div id="intro-main" class="between">
        <div class="intro-info">
            <img src="./resources/images/01/image_01 (15).jpg" alt="img" title="img" class="intro-img">
            <div class="intro-text">
                <div>
                    <b>충청남도 칠갑산</b>의 정기를 받아<br>
                    모두가 행복한 힐링을 즐길 수 있는 이곳은<br>
                    <b>Skills Camping</b> 입니다.
                </div>

                <div class="title-btn">
                    자세히보기 <i class="fa-solid fa-chevron-right"></i>
                </div>
            </div>
        </div>
        <div class="intro-info">
            <img src="./resources/images/01/image_01 (22).jpg" alt="img" title="img" class="intro-img">
        </div>
        <div class="intro-info">
            <i class="fa-sharp fa-solid fa-warning"></i>
            <div>
                <div class="info-each">
                    <div><i class="fa-solid fa-screwdriver-wrench"></i> 캠핑장 구성</div>
                    <div>
                        - 텐트데크(3m X 5m) : 10 개소 <br>
                        - 오토캠핑(5m X 8m) : 7 개소
                    </div>
                </div>
                <div class="info-each">
                    <div> <i class="fa-solid fa-screwdriver-wrench"></i> 부대시설 : </div>
                    <div>관리소, 취사장, 세면장, 화장실,<br> 포토존, 전망대, 잔디밭, 어린이놀이터 </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- 캠핑장소개 -->

<!-- 예약 안내 -->

<section id="intro2" class="content between">
    <div class="intro2-img">
        <img src="./resources/images/01/image_01 (4).jpg" alt="img" title="img">
        <div>최고급 캠핑 시설을 Skills Camping에서 만나보세요!</div>
    </div>
    <div class="intro2-txt">
        <div class="title">
            <div>예약 안내</div>
            <h2>Skills Camping <span>예약 방법 안내</span></h2>
        </div>
        <div class="rule">
            <div class="rule-each"> <b><i class="fa-solid fa-book"></i> 캠핑장 예약</b>은 <b>당일부터 13일 후</b>까지 가능합니다.</div>
            <div class="rule-each"> <b><i class="fa-solid fa-person-walking"></i> 캠핑장 입영</b>은 <b>예약한 날의 14시</b>부터 가능 합니다. </div>
            <div class="rule-each"> <b><i class="fa-solid fa-business-time"></i> 당일 예약</b>의 경우 <b>17시</b>부터 입영할 수 있습니다.</div>
            <div class="rule-each"> <b><i class="fa-solid fa-circle-info"></i> 예약문의</b><br>
                <b class="p-hl"><i class="fa-solid fa-mobile-screen-button"></i> 전화번호</b> : 041-987-1234<br>
                <b class="p-hl"><i class="fa-solid fa-clock"></i> 운영시간</b> : 평일 09:00 ~ 18:00, 주말 10:00 ~ 15:00, 점심시간 12:30~13:30
            </div>

        </div>
        <div class="title-btn">
            자세히보기 <i class="fa-solid fa-chevron-right"></i>
        </div>
    </div>
</section>

<!-- 예약 안내 -->

<!-- 배너 -->

<section id="banner">
    <div id="banner-container" class="content flex">
        <img src="./resources/images/location.png" alt="img" title="img" class="banner-img">
        <div class="banner-txt">
            <div>
                <h5 class="banner-type">오시는 길</h5>
                <h5 class="banner-type">환영합니다</h5>
            </div>
            <div>국내 최대, 최고급 시설 <br> Skills Camping 오시는길</div>
            <div>
                - Skills Camping 오픈 기념 장비 무료 대여 이벤트 시행 중 <br>
                - 자동차 캠핑장 신설 기념 칠갑산 자동차 투어 코스 개설
            </div>
            <div>2023-02-02 ~ 2023-02-14</div>
        </div>
    </div>
</section>
@endsection