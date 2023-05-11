<script src="../resources/bootstrap/bootstrap.min.js"></script>
<link rel="stylesheet" href="../resources/bootstrap/bootstrap.min.css">
@extends('master')

@section('content')
<section class="site-slide">
    <div class="container">
        <div class="slide-item">
            <img src="./resources/images/01/image_01 (1).png" alt="slide-img" title="slide-img">
        </div>
    </div>
</section>
<section id="reservation">
    <div class="content">
        <div class="title">
            <div class="title-type">예약하기</div>
            <h2>Skills Camping <span>예약 현황표</span></h2>
        </div>
        <table>
            <thead>
                <tr>
                    <th colspan="15"><i class="fa-solid fa-house-flag"></i> : 예약대기 | <i class="fa-solid fa-house-lock"> : 예약중 | <i class="fa-solid fa-person-shelter"></i> : 예약완료</i></th>
                </tr>
                <tr>
                    <th>자리/날짜</th>
                    <th>오늘</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>A01</td>
                    <td>■</td>
                    <td>▲</td>
                    <td>●</td>
                    <td>▲</td>
                    <td>●</td>
                    <td>▲</td>
                    <td>●</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
<div class="modal fade" id="resv-block">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1>예약불가</h1>
            </div>
            <div class="modal-body">
                <p>예약할 수 없습니다.</p>
            </div>
        </div>
    </div>
</div>
@endsection