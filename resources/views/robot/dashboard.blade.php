@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-header bg-gradient bg-primary text-white d-flex align-items-center">
                    <i class="fas fa-robot fa-lg me-2"></i> تحكم في حركة الروبوت
                </div>
                <div class="card-body text-center">
                    <div class="d-flex flex-wrap justify-content-center gap-2 mb-3">
                        <button class="btn btn-success d-flex flex-column align-items-center" onclick="sendCommand('F')">
                            <i class="fas fa-arrow-up fa-2x mb-1"></i> أمام
                        </button>
                        <button class="btn btn-danger d-flex flex-column align-items-center" onclick="sendCommand('B')">
                            <i class="fas fa-arrow-down fa-2x mb-1"></i> خلف
                        </button>
                        <button class="btn btn-primary d-flex flex-column align-items-center" onclick="sendCommand('R')">
                            <i class="fas fa-arrow-right fa-2x mb-1"></i> يمين
                        </button>
                        <button class="btn btn-primary d-flex flex-column align-items-center" onclick="sendCommand('L')">
                            <i class="fas fa-arrow-left fa-2x mb-1"></i> يسار
                        </button>
                        <button class="btn btn-warning d-flex flex-column align-items-center" onclick="sendCommand('S')">
                            <i class="fas fa-stop fa-2x mb-1"></i> إيقاف
                        </button>
                    </div>
                    <div id="command-status" class="mt-3"></div>
                    <div class="mt-3">
                        <b>أوامر صوتية مدعومة:</b>
                        <span class="badge bg-info"><i class="fas fa-microphone"></i> go</span>
                        <span class="badge bg-info"><i class="fas fa-microphone"></i> back</span>
                        <span class="badge bg-info"><i class="fas fa-microphone-slash"></i> stop</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-header bg-gradient bg-success text-white d-flex align-items-center">
                    <i class="fas fa-heartbeat fa-lg me-2"></i> القياسات الحيوية والبيئية (لايف)
                </div>
                <div class="card-body">
                    <div id="live-data">
                        <div>تحميل البيانات...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow border-0">
                <div class="card-header bg-gradient bg-dark text-white d-flex align-items-center">
                    <i class="fas fa-history fa-lg me-2"></i> سجل الأوامر
                </div>
                <div class="card-body" id="commands-log">
                    <div>تحميل...</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow border-0">
                <div class="card-header bg-gradient bg-warning text-dark d-flex align-items-center">
                    <i class="fas fa-stethoscope fa-lg me-2"></i> آخر تشخيص للمريض
                </div>
                <div class="card-body">
                    <div id="last-diagnosis-view">
                        <span class="text-muted">لا يوجد تشخيص بعد. استخدم أداة التشخيص بالأسفل.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow border-0">
                <div class="card-header bg-gradient bg-warning text-dark d-flex align-items-center">
                    <i class="fas fa-stethoscope fa-lg me-2"></i> تشخيص المريض بعد الفحص
                </div>
                <div class="card-body" id="diagnosis-section">
                    <form id="diagnosis-form" class="row g-2 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label">درجة الحرارة (NTC)</label>
                            <input type="number" step="0.1" min="20" max="45" class="form-control" id="input-temp" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">معدل ضربات القلب (BPM)</label>
                            <input type="number" step="1" min="30" max="200" class="form-control" id="input-bpm" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">المسافة (سم)</label>
                            <input type="number" step="1" min="0" max="100" class="form-control" id="input-ultrasonic" required>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-warning w-100"><i class="fas fa-search"></i> شخّص الآن</button>
                        </div>
                    </form>
                    <div id="diagnosis-result" class="mt-3"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4" id="diagnosis-cards-row"></div>
    <div class="row mt-4">
        @foreach($diagnoses as $diagnosis)
            <div class="col-md-4 mb-4">
                <div class="card diagnosis-card animate__animated animate__fadeInUp shadow border-0">
                    <div class="card-header bg-gradient bg-info text-white d-flex align-items-center">
                        <i class="fas fa-notes-medical fa-lg me-2"></i> تشخيص رقم #{{ $diagnosis->id }}
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <img src="https://cdn-icons-png.flaticon.com/512/2965/2965567.png" width="40" class="me-2" alt="تشخيص">
                            <div>
                                <div><b>درجة الحرارة:</b> <span class="badge bg-primary">{{ $diagnosis->ntc_temp }} °C</span></div>
                                <div><b>النبض:</b> <span class="badge bg-danger">{{ $diagnosis->bpm }} BPM</span></div>
                                <div><b>المسافة:</b> <span class="badge bg-info">{{ $diagnosis->ultrasonic }} سم</span></div>
                            </div>
                        </div>
                        <div class="diagnosis-result-html">{!! $diagnosis->result !!}</div>
                    </div>
                    <div class="card-footer text-end small text-muted">
                        <i class="fas fa-clock"></i> {{ $diagnosis->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div id="robot-alerts" class="mt-3"></div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
<script>
function sendCommand(cmd) {
    fetch('/robot/command', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({command: cmd})
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById('command-status').innerHTML = `<div class='alert alert-${data.status === 'نجح' ? 'success' : 'danger'}'>${data.response}</div>`;
        loadCommands();
        if(data.status === 'نجح') showAlert('تم تنفيذ الأمر بنجاح', 'success');
        else showAlert('حدث خطأ أثناء تنفيذ الأمر', 'danger');
    });
}
function loadLiveData() {
    fetch('/robot/live')
        .then(res => res.json())
        .then(data => {
            document.getElementById('live-data').innerHTML = `
                <div class='mb-2'><i class='fas fa-thermometer-half text-primary'></i> <b>درجة الحرارة (NTC):</b> <span class='badge bg-primary'>${data.ntc_temp ?? '--'} °C</span></div>
                <div class='mb-2'><i class='fas fa-heartbeat text-danger'></i> <b>معدل ضربات القلب:</b> <span class='badge bg-danger'>${data.bpm ?? '--'} BPM</span></div>
                <div class='mb-2'><i class='fas fa-ruler-vertical text-info'></i> <b>المسافة (تجنب العوائق):</b> <span class='badge bg-info'>${data.ultrasonic ?? '--'} سم</span></div>
                <div class='mb-2'><i class='fas fa-microphone text-secondary'></i> <b>الحالة الصوتية:</b> <span class='badge bg-secondary'>${data.voice ?? '--'}</span></div>
                <div class='mt-2'><i class='fas fa-tv text-success'></i> <b>عرض على شاشة LCD:</b> <span class='badge bg-success'>${data.lcd ?? '---'}</span></div>
            `;
        });
}
function loadCommands() {
    fetch('/robot/live')
        .then(res => res.json())
        .then(data => {
            let cmd = data.last_command;
            let html = '';
            if(cmd) {
                html += `<div class='alert alert-info'>${cmd.command} - ${cmd.status} - ${cmd.created_at}</div>`;
            } else {
                html = 'لا يوجد أوامر بعد';
            }
            document.getElementById('commands-log').innerHTML = html;
        });
}
function showAlert(msg, type) {
    let el = document.getElementById('robot-alerts');
    el.innerHTML = `<div class='alert alert-${type}'>${msg}</div>`;
    setTimeout(()=>{el.innerHTML='';}, 3000);
}
document.getElementById('diagnosis-form').onsubmit = function(e) {
    e.preventDefault();
    const temp = parseFloat(document.getElementById('input-temp').value);
    const bpm = parseInt(document.getElementById('input-bpm').value);
    const ultrasonic = parseInt(document.getElementById('input-ultrasonic').value);
    let result = '';
    if (temp > 38) {
        result += '<div class="alert alert-danger animate__animated animate__shakeX"><i class="fas fa-temperature-high"></i> ارتفاع في درجة الحرارة (احتمال حمى)</div>';
    } else if (temp < 35) {
        result += '<div class="alert alert-warning animate__animated animate__shakeX"><i class="fas fa-temperature-low"></i> انخفاض في درجة الحرارة (احتمال هبوط)</div>';
    } else {
        result += '<div class="alert alert-success animate__animated animate__pulse"><i class="fas fa-thermometer-half"></i> درجة الحرارة طبيعية</div>';
    }
    if (bpm > 100) {
        result += '<div class="alert alert-danger animate__animated animate__shakeX"><i class="fas fa-heart-broken"></i> معدل ضربات القلب مرتفع (احتمال إجهاد/قلق)</div>';
    } else if (bpm < 60) {
        result += '<div class="alert alert-warning animate__animated animate__shakeX"><i class="fas fa-heart"></i> معدل ضربات القلب منخفض (احتمال هبوط/إعياء)</div>';
    } else {
        result += '<div class="alert alert-success animate__animated animate__pulse"><i class="fas fa-heartbeat"></i> معدل ضربات القلب طبيعي</div>';
    }
    if (ultrasonic < 20) {
        result += '<div class="alert alert-info animate__animated animate__fadeIn"><i class="fas fa-user-check"></i> المريض قريب من الروبوت (جاهز للفحص أو التفاعل)</div>';
    } else {
        result += '<div class="alert alert-secondary animate__animated animate__fadeIn"><i class="fas fa-user-clock"></i> المريض بعيد عن الروبوت</div>';
    }
    document.getElementById('diagnosis-result').innerHTML = result;
    document.getElementById('last-diagnosis-view').innerHTML = result;
    // حفظ التشخيص في قاعدة البيانات
    fetch('/robot/diagnosis', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ntc_temp: temp, bpm: bpm, ultrasonic: ultrasonic, result: result})
    });
    // تحديث الكروت بعد الحفظ
    setTimeout(loadDiagnoses, 500);
};
function loadDiagnoses() {
    fetch('/robot/diagnoses')
        .then(res => res.json())
        .then(data => {
            let html = '';
            data.forEach(function(diagnosis) {
                html += `<div class='col-md-4 mb-4'>
                    <div class='card diagnosis-card animate__animated animate__fadeInUp shadow border-0'>
                        <div class='card-header bg-gradient bg-info text-white d-flex align-items-center'>
                            <i class='fas fa-notes-medical fa-lg me-2'></i> تشخيص رقم #${diagnosis.id}
                        </div>
                        <div class='card-body'>
                            <div class='d-flex align-items-center mb-2'>
                                <img src='https://cdn-icons-png.flaticon.com/512/2965/2965567.png' width='40' class='me-2' alt='تشخيص'>
                                <div>
                                    <div><b>درجة الحرارة:</b> <span class='badge bg-primary'>${diagnosis.ntc_temp} °C</span></div>
                                    <div><b>النبض:</b> <span class='badge bg-danger'>${diagnosis.bpm} BPM</span></div>
                                    <div><b>المسافة:</b> <span class='badge bg-info'>${diagnosis.ultrasonic} سم</span></div>
                                </div>
                            </div>
                            <div class='diagnosis-result-html'>${diagnosis.result}</div>
                        </div>
                        <div class='card-footer text-end small text-muted'>
                            <i class='fas fa-clock'></i> ${new Date(diagnosis.created_at).toLocaleString('ar-EG')}
                        </div>
                    </div>
                </div>`;
            });
            document.getElementById('diagnosis-cards-row').innerHTML = html;
        });
}
window.onload = function() {
    loadLiveData();
    loadCommands();
    loadDiagnoses();
};
</script>
@endsection
