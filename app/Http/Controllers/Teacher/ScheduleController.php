<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $batches = auth()->user()->batches()->get();
        return view('teacher.schedule', compact('batches'));
    }
}
