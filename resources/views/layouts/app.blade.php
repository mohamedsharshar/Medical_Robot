<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم الروبوت الطبي</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">الروبوت الطبي</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    @auth
                        <li class="nav-item dropdown d-flex align-items-center">
                            @if(Auth::user()->profile_image)
                                <img src="{{ asset('uploads/' . Auth::user()->profile_image) }}" class="rounded-circle me-2" width="36" height="36" style="object-fit:cover;" onerror="this.onerror=null;this.src='/default-avatar.png';">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}" class="rounded-circle me-2" width="36" height="36">
                            @endif
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">الرئيسية</a></li>
                                <li><a class="dropdown-item" href="{{ route('robot.dashboard') }}">تحكم الروبوت</a></li>
                                <li><a class="dropdown-item" href="{{ route('patients.index') }}">إدارة المرضى</a></li>
                                <li><a class="dropdown-item" href="{{ route('profile') }}">الملف الشخصي</a></li>
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">تعديل الملف الشخصي</a></li>
                                <li><form method="POST" action="{{ route('logout') }}">@csrf<button class="dropdown-item" type="submit">تسجيل الخروج</button></form></li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">تسجيل الدخول</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    <main>
        @yield('content')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
