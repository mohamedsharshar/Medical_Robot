@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h4>تعديل بيانات المريض</h4>
    <form method="POST" action="{{ route('patients.update', $patient->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">الاسم</label>
            <input type="text" name="name" class="form-control" value="{{ $patient->name }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">السن</label>
            <input type="number" name="age" class="form-control" value="{{ $patient->age }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">التشخيص</label>
            <input type="text" name="diagnosis" class="form-control" value="{{ $patient->diagnosis }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">رقم الأوضة</label>
            <input type="text" name="room_number" class="form-control" value="{{ $patient->room_number }}" required>
        </div>
        <button type="submit" class="btn btn-primary">تحديث</button>
        <a href="{{ route('patients.index') }}" class="btn btn-secondary">رجوع</a>
    </form>
</div>
@endsection
