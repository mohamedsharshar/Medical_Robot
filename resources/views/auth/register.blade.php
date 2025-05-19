@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">تسجيل حساب جديد</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">الاسم</label>
                            <input id="name" type="text" class="form-control" name="name" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">البريد الإلكتروني</label>
                            <input id="email" type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">كلمة المرور</label>
                            <input id="password" type="password" class="form-control" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">تأكيد كلمة المرور</label>
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">نوع المستخدم</label>
                            <select id="role" name="role" class="form-select" required>
                                <option value="doctor">دكتور</option>
                                <option value="nurse">تمريض</option>
                                <option value="admin">إداري</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success w-100">تسجيل</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
