<?php

namespace App\Http\Controllers;

use App\DataTables\SkillDataTable;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index(SkillDataTable $dataTable)
    {
        return $dataTable->render('admin.skill');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required"
        ]);

        $data = Skill::updateOrCreate([
            "id" => $request->id
        ],[
            "name" => $request->name
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
        $data = Skill::findOrFail($request->id);
        return response()->json([
            "name" => $data->name
        ]);
    }

    public function destroy(Request $request)
    {
        $data = Skill::findOrFail($request->id);
        $data->delete();

        return response()->json([
            "text" => "Data Deleted"
        ]);
    }
}
