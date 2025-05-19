@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">الرئيسية</div>
                <div class="card-body text-center">
                    <h4>مرحباً {{ Auth::user()->name }} 👋</h4>
                    <p>يمكنك التنقل بين الصفحات من القائمة بالأعلى:<br>
                        <span class="badge bg-primary">تحكم الروبوت</span> - <span class="badge bg-success">إدارة المرضى</span> - <span class="badge bg-info">الملف الشخصي</span>
                    </p>
                    <div class="alert alert-info mt-4">
                        هذا النظام يتيح لك التحكم في الروبوت الطبي، متابعة بياناته لايف، إدارة المرضى، وتسجيل كل الأوامر والإشعارات.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
