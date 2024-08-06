<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marbot;

class MarbotController extends Controller
{
    public function preview($id)
    {
        $marbot = Marbot::with(['user', 'keluargas', 'riwayatkepegawaians', 'kesehatans'])->findOrFail($id);
        return view('marbot.previewpdf', compact('marbot'));
    }
}
