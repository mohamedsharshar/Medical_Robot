@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">تعديل الملف الشخصي</div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">الاسم</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">البريد الإلكتروني</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">كلمة المرور الجديدة (اختياري)</label>
                            <input id="password" type="password" class="form-control" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">تأكيد كلمة المرور</label>
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
                        </div>
                        <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                    </form>
                    <div class="mb-3">
                        <label for="profile_image" class="form-label">صورة الملف الشخصي</label>
                        <form method="POST" action="{{ route('profile.updateImage') }}" enctype="multipart/form-data">
                            @csrf
                            <input id="profile_image" type="file" class="form-control" name="profile_image" required>
                            <button type="submit" class="btn btn-secondary mt-2">رفع الصورة</button>
                        </form>
                        @php
                            $img = session('just_uploaded_image') ? session('just_uploaded_image') : Auth::user()->profile_image;
                        @endphp
                        @if($img)
                            <img src="{{ asset('uploads/' . $img) }}" class="mt-2 rounded" width="100" height="100" onerror="this.onerror=null;this.src='/default-avatar.png';">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
