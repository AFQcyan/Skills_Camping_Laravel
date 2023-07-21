<?php

use \App\Models\Reservation as ReservModel;
use \App\Models\Order as OrderModel;

if (!session()->has('user')) {
    return redirect("/user")->with('flash_message', '로그인 후 이용할 수 있습니다.');
}
$reservationList = ReservModel::where('phone', '=', session('user')['phone'])->where('name', '=', session('user')['name'])->get();

?>
@extends('master');
@section('content')
<section class="site-slide">
    <div class="container">
        <div class="slide-item"><img src="../resources/images/01/image_01 (1).png" alt="slide-img" title="slide-img"></div>
    </div>
</section>
<div id="mypage">
    <div class="content">
        <div class="title">
            <div>마이페이지</div>
            <h2>Skills Camping <span>예약목록</span></h2>
        </div>
        <table>
            <thead>
                <tr>
                    <th>예약날짜</th>
                    <th>예약자리</th>
                    <th>예약상태</th>
                    <th>예약취소버튼</th>
                    <th>바비큐 주문하기</th>
                    <th>주문건수</th>
                    <!-- 주문 상세보기 버튼이 있어야한다고 따로 말하지 않았고 -->
                    <!-- 주문내역보기 버튼의 기능을 말하지 않는 걸 보면 -->
                    <!-- 주문상세보기 = 주문내역보기 같음 -->
                    <th>주문내역보기</th>
                </tr>
            </thead>
            <tbody>

                <?php
                foreach ($reservationList as $resv) {
                    $orderList = OrderModel::get()->where('reservation_id', '=', $resv->id);
                    $nonCancelList = OrderModel::get()->where('reservation_id', '=', $resv->id)->where('type', '!=', 'cancel');
                ?>
                    <tr class="reservation-row" data-id="<?= $resv->id ?>">
                        <td><?= $resv->date ?></td>
                        <td><?= $resv->place ?></td>
                        <td><?= $resv->type == "ongoing" ? "예약중" : "예약완료" ?></td>
                        <td><button class="reservation-cancel-btn">예약취소</button></td>
                        <td><button class="bbq-order-btn">바비큐 주문하기</button></td>
                        <td class="order-count"><?= count($nonCancelList) ?></td>
                        <td><button class="order-detail-btn">주문상세보기</button></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
@endsection