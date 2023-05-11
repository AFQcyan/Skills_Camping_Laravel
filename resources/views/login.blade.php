@extends('master')

@section('content')
<section id="login">
    <div class="content">
        <form action="/user" method="post">
            {!! csrf_field() !!}
            <div class="title">
                <h2>Skills Camping <span> 로그인</span></h2>
            </div>
            <div id="login-main">
                <div class="login-each between">
                    <h3><i class="fa-solid fa-user"></i></h3>
                    <input type="text" name="name" id="name" placeholder="이름을 입력해주세요">
                </div>
                <div class="login-each between">
                    <h3><i class="fa-solid fa-mobile-screen"></i></h3>
                    <input type="text" name="phone" id="phone" placeholder="전화번호를 입력해주세요">
                </div>
            </div>
            <input type="submit" class='title-btn' value="로그인">
        </form>
    </div>
</section>


<script>
    // 전화번호 자동으로 포멧 맞춰주기
    document.querySelector('input[name="phone"]').addEventListener('input', () => {
        document.querySelector('input[name="phone"]').value = phoneFormat(document.querySelector('input[name="phone"]').value)
    })
</script>
@endsection