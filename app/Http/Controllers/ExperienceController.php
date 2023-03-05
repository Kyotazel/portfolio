<?php

namespace App\Http\Controllers;

use App\DataTables\ExperienceDataTable;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index(ExperienceDataTable $dataTable)
    {
        return $dataTable->render('admin.experience');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required",
            "first_time" => "required",
            "last_time" => "required",
        ]);

        $data = Experience::updateOrCreate([
            "id" => $request->id
        ],[
            "name" => $request->name,
            "first_time" => $request->first_time,
            "last_time" => $request->last_time,
            "proffesion" => $request->proffesion,
            "description" => $request->description,
        ]);

        $text = "";
        if($request->id) {
            $text = "Data Updated";
        } else {
            $text = "Data Saved";
        }

        return response()->json([
            "text" => $text
        ]);
    }

    public function edit(Request $request)
    {
        $data = Experience::findOrFail($request->id);
        return response()->json([
            "name" => $data->name,
            "first_time" => $data->first_time,
            "last_time" => $data->last_time,
            "proffesion" => $data->proffesion,
            "description" => $data->description,
        ]);
    }

    public function destroy(Request $request)
    {
        $data = Experience::findOrFail($request->id);
        $data->delete();

        return response()->json([
            "text" => "Data Deleted"
        ]);
    }
}
