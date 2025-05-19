<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RobotCommand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RobotController extends Controller
{
    public function dashboard()
    {
        return view('robot.dashboard');
    }

    public function sendCommand(Request $request)
    {
        $request->validate([
            'command' => 'required|in:start,stop,move',
        ]);
        // Simulate API call
        $status = rand(0,1) ? 'نجح' : 'فشل';
        $response = $status === 'نجح' ? 'تم تنفيذ الأمر بنجاح' : 'حدث خطأ أثناء التنفيذ';
        $cmd = RobotCommand::create([
            'command' => $request->command,
            'status' => $status,
            'sent_by' => Auth::id(),
            'response' => $response,
        ]);
        return response()->json(['status' => $status, 'response' => $response]);
    }

    public function liveData()
    {
        // Simulate live data (sensor/camera)
        return response()->json([
            'battery' => rand(60,100) . '%',
            'temp' => rand(20,35) . '°C',
            'camera' => 'https://placehold.co/320x180?text=Camera+Feed',
            'last_command' => RobotCommand::latest()->first(),
        ]);
    }
}
