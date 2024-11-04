<?php

namespace App\Http\Controllers;

use App\Models\Layout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LayoutController extends Controller
{
    public function saveLayout(Request $request)
    {
        $validated = $request->validate([
            'layout' => 'required|array',
            'layout.*.id' => 'required|string',
            'layout.*.x' => 'required|integer',
            'layout.*.y' => 'required|integer',
            'layout.*.w' => 'required|integer',
            'layout.*.h' => 'required|integer',
            'gridConfig' => 'required|array',
            'gridConfig.column' => 'required|integer',
            'gridConfig.itemWidth' => 'required|integer',
            'gridConfig.maxRow' => 'required|integer',
        ]);

        Layout::updateOrCreate(
            ['userId' => Auth::id()],
            [
                'layout' => $request->layout,
                'preferences' => $request->gridConfig
            ]
        );

        return response()->json(['success' => true]);
    }

    public function getLayout()
    {
        $layout = Layout::where('userId', Auth::id())->first();

        return response()->json([
            'layout' => $layout ? $layout->layout : [],
            'gridConfig' => $layout ? $layout->preferences : null
        ]);
    }
}