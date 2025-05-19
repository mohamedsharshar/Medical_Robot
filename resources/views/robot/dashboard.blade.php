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
setInterval(loadLiveData, 3000);
setInterval(loadCommands, 4000);
window.onload = function() { loadLiveData(); loadCommands(); };
</script>
@endsection
