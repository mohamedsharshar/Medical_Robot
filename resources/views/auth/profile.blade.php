@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">الملف الشخصي</div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            @if(Auth::user()->profile_image)
                                <img src="{{ asset('uploads/' . Auth::user()->profile_image) }}" class="rounded" width="120" height="120">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}" class="rounded" width="120" height="120">
                            @endif
                        </div>
                        <div class="col-md-9">
                            <ul class="list-group">
                                <li class="list-group-item"><strong>الاسم:</strong> {{ Auth::user()->name }}</li>
                                <li class="list-group-item"><strong>البريد الإلكتروني:</strong> {{ Auth::user()->email }}</li>
                                <li class="list-group-item"><strong>النوع:</strong> {{ Auth::user()->role }}</li>
                                @if(Auth::user()->role === 'doctor')
                                    <li class="list-group-item"><strong>الاختصاص:</strong> طبيب - يمكنك متابعة المرضى وتوزيع المهام على الروبوت.</li>
                                @elseif(Auth::user()->role === 'admin')
                                    <li class="list-group-item"><strong>الدور:</strong> إداري - يمكنك إدارة المستخدمين والنظام بالكامل.</li>
                                @elseif(Auth::user()->role === 'nurse')
                                    <li class="list-group-item"><strong>الدور:</strong> تمريض - يمكنك متابعة المرضى وتنفيذ المهام الروبوتية.</li>
                                @endif
                            </ul>
                            <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary mt-3">تعديل الملف الشخصي</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
