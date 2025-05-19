@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h4>إضافة مريض جديد</h4>
    <form method="POST" action="{{ route('patients.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">الاسم</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">السن</label>
            <input type="number" name="age" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">التشخيص</label>
            <input type="text" name="diagnosis" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">رقم الأوضة</label>
            <input type="text" name="room_number" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">حفظ</button>
        <a href="{{ route('patients.index') }}" class="btn btn-secondary">رجوع</a>
    </form>
</div>
@endsection
