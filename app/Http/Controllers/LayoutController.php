<?php

namespace App\Http\Controllers;

use App\Models\Layout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LayoutController extends Controller
{
    public function saveLayout(Request $request)
    {
        $request->validate([
            'layout' => 'required|array',
            'layout.*.id' => 'required|string',
            'layout.*.x' => 'required|integer',
            'layout.*.y' => 'required|integer',
            'layout.*.w' => 'required|integer',
            'layout.*.h' => 'required|integer',
        ]);

        Layout::updateOrCreate(
            ['userId' => Auth::id()],
            ['layout' => $request->layout]
        );

        return response()->json(['success' => true]);
    }

    public function getLayout()
    {
        $layout = Layout::where('userId', Auth::id())->first();

        return response()->json([
            'layout' => $layout ? $layout->layout : []
        ]);
    }
}
