@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="alert alert-success text-center">
                مرحباً {{ Auth::user()->name }} في لوحة تحكم الروبوت الطبي
            </div>
            <div class="card">
                <div class="card-header">داشبورد النظام</div>
                <div class="card-body">
                    <p>هنا يمكنك التحكم في الروبوت، إدارة المرضى، ومتابعة الأوامر والإشعارات.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
