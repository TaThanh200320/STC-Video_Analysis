<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::with('area')->get();
        return view('locations.positions.index', ['positions' => $positions]);
    }

    public function create()
    {
        $areas = Area::select('ten', 'id')->get();
        return view('locations.positions.create', ['areas' => $areas]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'max:255|unique:khuvuc,ma',
            'description' => 'nullable|string|max:255',
        ]);
        Position::create([
            'ten' => $request->name,
            'ma' => $request->code,
            'mota' => $request->description,
            'khuvucid' => $request->areaId,
        ]);

        return redirect('/locations/positions')->with('status', 'Position created successfully');
    }

    public function edit($positionId)
    {
        $position = Position::with('area')->findOrFail($positionId);
        $oldArea = $position->area;
        $areas = Area::get();
        return view('locations.positions.edit', [
            'position' => $position,
            'areas' => $areas,
            'oldArea' => $oldArea,
        ]);
    }

    public function update(Request $request, $positionId)
    {
        $position = Position::findOrFail($positionId);
        $request->validate([
            'name' => 'string|max:255',
            'description' => 'nullable|string|max:255',
        ]);
        $data = [
            'ten' => $request->name,
            'mota' => $request->description,
            'khuvucid' => $request->areaId,
        ];

        if ($request->code != $position->ma) {
            $request->validate([
                'name' => 'string|max:255',
                'code' => 'string|max:255|unique:khuvuc,ma',
                'description' => 'nullable|string|max:255',
            ]);

            $data += [
                'ma' => $request->code,
            ];
        }

        $position->update($data);

        return redirect('/locations/positions')->with('status', 'Position Updated Successfully');
    }

    public function destroy($positionId)
    {
        $user = Position::findOrFail($positionId);
        $user->delete();

        return redirect('/locations/positions')->with('status', 'Position Delete Successfully');
    }
}
