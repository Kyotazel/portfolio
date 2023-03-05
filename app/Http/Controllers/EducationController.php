<?php

namespace App\Http\Controllers;

use App\DataTables\EducationDataTable;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index(EducationDataTable $dataTable)
    {
        return $dataTable->render('admin.education');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required",
            "first_time" => "required",
            "last_time" => "required",
        ]);

        $data = Education::updateOrCreate([
            "id" => $request->id
        ],[
            "name" => $request->name,
            "first_time" => $request->first_time,
            "last_time" => $request->last_time,
            "major" => $request->major,
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
        $data = Education::findOrFail($request->id);
        return response()->json([
            "name" => $data->name,
            "first_time" => $data->first_time,
            "last_time" => $data->last_time,
            "major" => $data->major,
            "description" => $data->description,
        ]);
    }

    public function destroy(Request $request)
    {
        $data = Education::findOrFail($request->id);
        $data->delete();

        return response()->json([
            "text" => "Data Deleted"
        ]);
    }
}
