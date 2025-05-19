@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h4>إدارة المرضى</h4>
        <a href="{{ route('patients.create') }}" class="btn btn-success">إضافة مريض</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>الاسم</th>
                <th>السن</th>
                <th>التشخيص</th>
                <th>رقم الأوضة</th>
                <th>إجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($patients as $patient)
            <tr>
                <td>{{ $patient->name }}</td>
                <td>{{ $patient->age }}</td>
                <td>{{ $patient->diagnosis }}</td>
                <td>{{ $patient->room_number }}</td>
                <td>
                    <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-primary btn-sm">تعديل</a>
                    <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
