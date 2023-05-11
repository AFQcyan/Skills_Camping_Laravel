@extends('master')
<?php

use \App\Models\Reservation as ReservModel;
use \App\Models\Order as OrderModel;
?>

<style>
    section:target {
        display: inline-block;
    }

    .btn {
        display: inline-block;
        padding: 5px 10px;
        border: 1px solid black;
        border-radius: 5px;
        text-decoration: none;
        color: black;
    }
</style>

<body>
    <?php

    if (!session()->has('user')) {
        redirect('/user')->with('flash_message', '로그인 후 이용할 수 있습니다.');
    }
    if ('000-0000-0000' != session('user')['phone'] && '관리자' != session('user')['name']) {
        redirect('/user')->with('flash_message', '관리자만 이용할 수 있습니다.');
    }

    $pagenum = 4;
    $startDate = date("Y-m-d", time());
    $endDate = date("Y-m-d", strtotime($startDate . ' +13 day'));

    $rvList = ReservModel::get();

    if (
        isset($_GET['startdate']) &&
        isset($_GET['enddate'])
    ) {
        $startDate = $_GET['startdate'];
        $endDate = $_GET['enddate'];
    }

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 0;
    }


    if ($page < 1) {
        $page = 1;
    }

    if ($page > ceil(count($rvList) / 4)) {
        $page = ceil(count($rvList) / 4);
    }


    $reservationList = ReservModel::get()->where('date', '>=', $startDate)->where('date', '<=', $endDate);
    ?>
    @section('content')
    <section id="reserv" class='manage'>
        <div class="site-slide">
            <div class="container">
                <div class="slide-item">
                    <img src="./resources/images/01/image_01 (1).png" alt="slide-img" title="slide-img">
                </div>
            </div>
        </div>
        <div class="content">
            <div class="tabs">
                <a class="active" href="#reserv">예약관리</a>
                <a class="" href="#order">주문관리</a>
            </div>
            <div class="title">
                <div>예약 관리</div>
                <h2>Skills Camping <span>예약목록</span></h2>
            </div>

            <div class="date">
                <p>시작일 : <input type="date" name="startdate" value="<?= $startDate ?>"></p>
                <p>종료일 : <input type="date" name="enddate" value="<?= $endDate ?>"></p>
                <p><button class='title-btn'>조회</button></p>
            </div>

            <div class="flex">
                <div class="total-count">예약 총 건수 : 총 <?= count($reservationList) ?> 건</div>
                <div class="total-price">합계 금액 : <?php
                                                    $price = 0;
                                                    foreach ($reservationList as $reservation) {
                                                        if (date('w', strtotime($reservation->date)) == 0 || date('w', strtotime($reservation->date)) == 6) {
                                                            $price += strstr($reservation->place, 'T') ? 20000 : 30000;
                                                        } else {
                                                            $price += strstr($reservation->place, 'T') ? 15000 : 25000;
                                                        }
                                                    }

                                                    echo number_format($price) . " 원";
                                                    ?></div>
            </div>

            <table border="1">
                <thead>
                    <tr>
                        <th>예약날짜</th>
                        <th>자리번호</th>
                        <th>예약자명</th>
                        <th>예약자휴대폰번호</th>
                        <th>예약상태</th>
                        <th>신청일</th>
                        <th>예약처리(승인/취소)버튼</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($page == 0) {
                        foreach ($reservationList as $resv) { ?>
                            <tr>
                                <td><?= ($resv->date) ?></td>
                                <td><?= ($resv->place) ?></td>
                                <td><?= ($resv->name) ?></td>
                                <td><?= ($resv->phone) ?></td>
                                <td><?= ($resv->type == 'ongoing' ? '예약중' : '예약완료') ?></td>
                                <td><?= ($resv->create_date) ?></td>
                                <td>
                                    <?php if ($resv->type == 'ongoing') : ?>
                                        <button class="title-btn" onclick='location.href="./process_reservation_manage.php?id=<?= ($resv->id) ?>&process=accept"'>승인</button>
                                        <button class="title-btn" onclick='location.href="./process_reservation_manage.php?id=<?= ($resv->id) ?>&process=reject"'>취소</button>
                                    <?php else : ?>
                                        이미 승인됨
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php }
                    } else {
                        for ($i = ($page * $pagenum) - 4; $i < $page * $pagenum; $i++) {
                            if ($i < count($reservationList)) {
                            ?>
                                <tr>
                                    <td><?= p($reservationList[$i]->date) ?></td>
                                    <td><?= p($reservationList[$i]->place) ?></td>
                                    <td><?= p($reservationList[$i]->name) ?></td>
                                    <td><?= p($reservationList[$i]->phone) ?></td>
                                    <td><?= p($reservationList[$i]->type == 'ongoing' ? '예약중' : '예약완료') ?></td>
                                    <td><?= p($reservationList[$i]->create_date) ?></td>
                                    <td>
                                        <?php if ($reservationList[$i]->type == 'ongoing') : ?>
                                            <button class="title-btn" onclick='location.href="./process_reservation_manage.php?id=<?= p($reservationList[$i]->id) ?>&process=accept"'>승인</button>
                                            <button class="title-btn" onclick='location.href="./process_reservation_manage.php?id=<?= p($reservationList[$i]->id) ?>&process=reject"'>취소</button>
                                        <?php else : ?>
                                            이미 승인됨
                                        <?php endif; ?>
                                    </td>
                                </tr>

                    <?php
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>
            <div class="page-btn">
                <?php
                if ($page != 1) {
                ?>
                    <button onclick='location.href=`./manage.php?startdate=<?= $startDate ?>&enddate=<?= $endDate ?>&page=<?= $page - 1 ?>#reserv`'><i class="fa-solid fa-chevron-left"></i></button>
                <?php
                }
                ?>
                <?php
                for ($i = 1; $i <= ceil(count($reservationList) / $pagenum); $i++) {
                ?>
                    <button class="<?= $page == $i ? 'selected' : '' ?>" onclick='location.href=`./manage.php?startdate=<?= $startDate ?>&enddate=<?= $endDate ?>&page=<?= $i ?>#reserv`'><?= $i ?></button>
                <?php
                }
                ?>
                <?php
                if ($page != ceil(count($rvList) / 4)) {
                ?>
                    <button onclick='location.href=`./manage.php?startdate=<?= $startDate ?>&enddate=<?= $endDate ?>&page=<?= $page + 1 ?>#reserv`'><i class="fa-solid fa-chevron-right"></i></button>
                <?php
                }
                ?>
            </div>
        </div>

    </section>

    <section id="order" class="manage">
        <div class="site-slide">
            <div class="container">
                <div class="slide-item">
                    <img src="./resources/images/01/image_01 (1).png" alt="slide-img" title="slide-img">
                </div>
            </div>
        </div>
        <div class="content">
            <div class="tabs">
                <a class="" href="#reserv">예약관리</a>
                <a class="active" href="#order">주문관리</a>
            </div>

            <div class="title">
                <div>주문관리</div>
                <h2>Skills Camping <span>주문목록</span></h2>
            </div>

            <?php
            $order = OrderModel::select("*")->orderBy('id', 'DESC')->get();
            $reservation = ReservModel::select("*")->orderBy('id', 'DESC')->get();
            ?>

            <form active="./manage.php#order" method="get" class="date">
                <p>주문일 : <input type="date" name="orderdate" value="<?= isset($_GET['orderdate']) ? $_GET['orderdate'] : '' ?>"></p>
            </form>

            <div>
                <p>주문접수총건수: <span class="all-order-count"></span></p>
                <p>주문취소총건수: <span class="all-order-cancel"></span></p>
                <p>배달완료총건수: <span class="all-order-complete-count"></span></p>
                <p>배달완료 합계금액: <span class="all-order-complete-price"></span> 원</p>
            </div>

            <table id="order-table">
                <thead>
                    <tr>
                        <th>(예약/주문)날짜</th>
                        <th>자리번호</th>
                        <th>주문건수(취소건은 제외)</th>
                        <th>배달완료건수</th>
                        <th>주문합계금액(취소건의 금액은 제외)</th>
                        <th>주문상세보기</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

            <div style="display:none" id="order-info">
                <?= json_encode($order) ?>
            </div>
            <div style="display:none" id="reservation-info">
                <?= json_encode($reservation) ?>
            </div>
        </div>

        <script>
            if (window.location.href == "http://localhost/manage.php#reserv") {
                window.location.href = `./manage.php?startdate=${localStorage.getItem('startDate')}&enddate=${localStorage.getItem('endDate')}#reserv`
            }

            const startDate = document.querySelector('input[name="startdate"]')
            const endDate = document.querySelector('input[name="enddate"]')
            const dateBtn = document.querySelector('.date button')

            dateBtn.addEventListener('click', () => {
                localStorage.setItem('startDate', startDate.value)
                localStorage.setItem('endDate', endDate.value)
                if (localStorage.getItem('startDate') != null && localStorage.getItem('endDate') != null) {
                    window.location.href = `./manage.php?startdate=${localStorage.getItem('startDate')}&enddate=${localStorage.getItem('endDate')}#reserv`
                }
            })
            console.log(localStorage.getItem('startDate'))

            let lastDate = null
            const currentReservationList = []
            const refreshFunction = () => {
                setTable(lastDate)
            }
            const popup = new ManagementDetailPopup(refreshFunction)

            const order = JSON.parse(document.querySelector('#order-info').innerHTML);
            const reservation = JSON.parse(document.querySelector('#reservation-info').innerHTML);
            let orderDate;

            console.log(order, reservation)

            order.forEach((x) => {
                x.data = JSON.parse(x.json_data)

                orderDate = x.create_date

                x.price = x.data.orderList[0] * 12000;
                x.price += x.data.orderList[1] * 15000;
                x.price += x.data.orderList[2] * 3000;
                x.price += x.data.orderList[3] * 5000;
                x.price += x.data.orderList[4] * 4000;
                x.price += x.data.tool ? 10000 : 0;
            })

            reservation.forEach((x, i) => {
                x.order = order.filter(y => y.reservation_id === x.id)
            })

            refreshFunction()

            document.querySelector('input[name="orderdate"]').addEventListener('change', (e) => setTable(e.target.value));

            function setTable(date) {
                lastDate = date
                document.querySelector('#order-table tbody').innerHTML = ''
                currentReservationList.length = 0

                reservation.forEach((x, i) => {
                    if (date && x.date !== date) {
                        return;
                    }
                    currentReservationList.push(x)

                    const tr = createTr(x)

                    document.querySelector('#order-table tbody').appendChild(tr)
                    popup.saveData(x.id, x.order, tr.querySelector('.order-count'))
                })

                setTotal()
            }

            function createTr({
                id,
                date,
                place,
                order,
                create_date
            }) {
                const tr = document.createElement('tr')
                tr.innerHTML = `
                    <tr>
                        <td>${date} / ${orderDate}</td>
                        <td>${place}</td>
                        <td class="order-count">${order.reduce((s,order)=>(order.type !== 'cancel' ? s+1 : s), 0)}</td>
                        <td>${order.reduce((s,order)=>(order.type === 'complete' ? s+1 : s), 0)}</td>
                        <td>${parseInt(order.reduce((s,order)=>(order.type !== 'cancel' ? (order.price+s) : s), 0)).toLocaleString()} 원</td>
                        <td><button class="detail-popup-btn" data-value="${id}">주문 상세보기</button></td>
                    </tr>
                `
                tr.querySelector('button').addEventListener('click', () => {
                    popup.open({
                        index: id
                    })
                })
                return tr
            }

            function setTotal(order) {
                document.querySelector('.all-order-count').innerHTML = currentReservationList.reduce((s, {
                        order
                    }) =>
                    s + order.reduce((s, order) => (order.type !== 'cancel' ? s + 1 : s), 0), 0)

                document.querySelector('.all-order-cancel').innerHTML = currentReservationList.reduce((s, {
                        order
                    }) =>
                    s + order.reduce((s, order) => (order.type === 'cancel' ? s + 1 : s), 0), 0)

                document.querySelector('.all-order-complete-count').innerHTML = currentReservationList.reduce((s, {
                        order
                    }) =>
                    s + order.reduce((s, order) => (order.type === 'complete' ? s + 1 : s), 0), 0)

                document.querySelector('.all-order-complete-price').innerHTML = parseInt(currentReservationList.reduce((s, {
                        order
                    }) =>
                    (s + order.reduce((s, order) => (order.type === 'complete' ? s + order.price : s), 0)), 0)).toLocaleString()
            }
        </script>
    </section>