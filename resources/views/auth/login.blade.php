@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">تسجيل الدخول</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">البريد الإلكتروني</label>
                            <input id="email" type="email" class="form-control" name="email" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">كلمة المرور</label>
                            <input id="password" type="password" class="form-control" name="password" required>
                        </div>
                        <div class="mb-3 text-center">
                            <a href="{{ route('register') }}">ليس لديك حساب؟ سجل الآن</a>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">دخول</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
