@extends('master')

@section('content')
<section id="rank" class="content">
    <div id="rank-title" class="between">
        <div class="title">
            <div>캠핑장소개</div>
            <h2><span>Skills Camping</span> 은 이런 곳입니다.</h2>
        </div>

        <div class="title-btn">
            자세히보기 <i class="fa-solid fa-chevron-right"></i>
        </div>
    </div>
    <div id="rank-main" class="flex">
        <div class="rank-top between">
            <img src="./resources/images/03/image_03 (3).jpg" alt="img" title="img" class="rank-img">
            <div class="rank-info">
                <div>바비큐 그릴/도구 대여 및 <br>음식 주문 이용료 안내</div>
                <div>- 바비큐 그릴 대여(도구 및 숯 등 포함) : <br>1개 10,000 원</div>
                <div>- 돼지고기 바비큐 세트 :<br> 1인분 12,000 원</div>
                <div>- 해산물 바비큐 세트 : 1인분 15,000 원</div>
                <div>- 음료 : 1병 3,000 원</div>
                <div>- 주류 : 1병 5,000 원</div>
                <div>- 과자 세트 : 1세트(3종) 4,000 원</div>
                <div class="rank-show">
                    <div></div>
                </div>
            </div>
        </div>
        <div class="rank-other">
            <div class="rank-card between">
                <img src="./resources/images/01/image_01 (24).jpg" alt="img" title="img" class="rank-img">
                <div class="rank-info">
                    <div>이용료 관련 안내</div>
                    <div>이용료 : <br><b>텐트데크</b> <br>(주중 : 15,000 / 주말 : 20,000),<br> <b>오토캠핑</b> <br> (주중 : 25,000 / 주말 : 30,000)</div>
                    <div class="rank-show">
                        <div></div>
                    </div>
                </div>
            </div>
            <div class="rank-card between">
                <img src="./resources/images/01/image_01 (21).jpg" alt="img" title="img" class="rank-img">
                <div class="rank-info">
                    <div>캠핑장 입영 관련 안내</div>
                    <div> * 캠핑장 입영은 <b>예약한 날의 14시</b>부터 가능 합니다. </div>
                    <div class="rank-show">
                        <div></div>
                    </div>
                </div>
            </div>
            <div class="rank-card between">
                <img src="./resources/images/01/image_01 (3).jpg" alt="img" title="img" class="rank-img">
                <div class="rank-info">
                    <div>캠핑장 규모 및 주요시설</div>
                    <div>- 텐트데크(3m X 5m) : <br>10개소 (T01 ~ T10)</div>
                    <div>- 오토캠핑(5m X 8m) : <br>7개소 (A01 ~ A07)</div>
                    <div>- 부대시설 : <br>관리소 1, 취사장 1,<br> 세면장 1, 화장실 2, 포토존 1,<br> 전망대 1, 잔디밭 1, 놀이터 1</div>
                    <div class="rank-show">
                        <div></div>
                    </div>
                </div>
            </div>
            <div class="rank-card between">
                <img src="./resources/images/01/image_01 (18).jpg" alt="img" title="img" class="rank-img">
                <div class="rank-info">
                    <div>당일 예약 관련 안내</div>
                    <div> * 당일 예약의 경우 <b>17시</b>부터 입영할 수 있습니다.</div>
                    <div class="rank-show">
                        <div></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- 캠핑장 소개 서브페이지 -->

<!-- 이용수칙 -->

<section id="notice">
    <div id="notice-container" class="content" style="width: 1400px">
        <input type="radio" name="notice" id="notice1">
        <input type="radio" name="notice" id="notice2">
        <div id="notice-title" class="between">
            <div class="title">
                <div>캠핑장 이용수칙</div>
                <h2>나만 말고 모두를 위해, <span> 꼭 지켜주세요.</span></h2>
            </div>
        </div>

        <div id='notice-main'>
            <div class="notice-info">
                <div class="notice-area">

                    <div>출입</div>
                    <div>- 캠핑장의 출입은 반드시 출입구를 이용하셔야 하며, 관리자의 안내에 따라 주시기 바랍니다.</div>

                    <div class="inner-title">캠핑장 사용료</div>
                    <div>- 캠핑장 사용료는 사용료 징수기준에 준하며, 요금은 선불 입니다.</div>

                </div>


                <div class="notice-hover notice1"></div>
                <div class="notice-hover notice2"></div>
            </div>
            <div class="notice-info">
                <div class="notice-area">

                    <div>장소</div>
                    <div>- 사용자께서는 배정된 곳을 사용하셔야 하며, 항상 깨끗하게 이용하여 주시기 바랍니다.</div>
                    <div class="inner-title">동물</div>
                    <div>- 시설내에서는 애완동물을 포함한 일체의 동물의 출입을 금지합니다.</div>
                </div>
                <div class="notice-hover notice1"></div>
                <div class="notice-hover notice2"></div>
            </div>
            <div class="notice-info">
                <div class="notice-area">

                    <div>자동차</div>
                    <div>- 자동차의 출입은 가능한 23:00부터 07:00까지 삼가 주시기 바랍니다.</div>
                    <div>- 캠핑장내에서의 차량통행은 서행이며, 불필요한 자동차 사용을 삼가하여 주시기 바랍니다.</div>
                    <div>- 캠핑장내에서 자동차를 세차 할 수 없습니다.</div>
                </div>
                <div class="notice-hover notice1"></div>
                <div class="notice-hover notice2"></div>
            </div>
            <div class="notice-info">
                <div class="notice-area">

                    <div>소음</div>
                    <div>- 심한 소음은 항상 주의하여야 합니다.</div>
                    <div>- 특별히 허가된 야간오락 장소에서도 23:00부터 07:00까지는 금지되어 있습니다.</div>
                    <div>- 정숙시간은 21:00부터 07:00까지 입니다.</div>
                </div>
                <div class="notice-hover notice1"></div>
                <div class="notice-hover notice2"></div>
            </div>
            <div class="notice-info">
                <div class="notice-area">

                    <div>위생</div>
                    <div> - 식수 수도꼭지는 식수만을 공급하며, 다른 용도의 사용은 금지되어 있습니다.</div>
                    <div> - 폐수는 반드시 지정된 곳에 버려 주시고 절대로 바닥에 버려서는 안됩니다.</div>
                    <div class="inner-title">홍보</div>
                    <div> - 캠핑장내에서 정치적 또는 종교적인 홍보 등은 금지되어 있습니다.
                        - 관리자의 사전허가 없이는 상업적인 홍보 또는 물품의 판매를 할 수 없습니다.</div>

                </div>
                <div class="notice-hover notice1"></div>
                <div class="notice-hover notice2"></div>
            </div>
            <div class="notice-info">
                <div class="notice-area">

                    <div>쓰레기 수거</div>
                    <div>- 쓰레기는 지정된 장소에 종류별로 분류하여 내놓으셔야 합니다.</div>
                    <div class="inner-title">긴급사태</div>
                    <div> - 위급을 요하는 경우와 호우 · 강풍 등으로 피난이 필요한 경우 관리자의 지시에 따라 주시기 바랍니다.
                    </div>
                </div>
                <div class="notice-hover notice1"></div>
                <div class="notice-hover notice2"></div>
            </div>
            <div class="notice-info">
                <div class="notice-area">

                    <div>화재와 사고</div>
                    <div>- 음식의 조리 및 불 사용은 지정된 곳에서만 할 수 있습니다.</div>
                    <div>- 캠핑장내 불꽃놀이와 나무, 장작불 사용이 전면 금지되어 있습니다.</div>
                </div>
                <div class="notice-hover notice1"></div>
                <div class="notice-hover notice2"></div>
            </div>
            <div class="notice-info">
                <div class="notice-area">

                    <div>유실 또는 피해</div>
                    <div>- 관리자는 사용자의 소유물에 대한 유실 또는 피해에 대하여 책임을 지지 않습니다.</div>
                    <div> - 시설에 대한 피해에 대해서는 피해를 입힌 사람들에게 비용이 청구됩니다.</div>
                </div>
                <div class="notice-hover notice1"></div>
                <div class="notice-hover notice2"></div>
            </div>
        </div>
    </div>
</section>

<!-- 이용수칙 -->

<section id="thing-map" class="content">
    <div id="intro-title">
        <div class="title tc">
            <div>시설배치도</div>
            <h2>Skills Camping 의 <span>시설 배치도</span>입니다.</h2>
        </div>

        <div class="title-btn tc">
            자세히보기 <i class="fa-solid fa-chevron-right"></i>
        </div>
    </div>
    <div id="thing-main" class="between">
        <img src="./resources/images/Camp-map.png" alt="img" title="img">
    </div>
</section>
@endsection

</html>