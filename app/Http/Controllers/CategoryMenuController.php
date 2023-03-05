<?php

namespace App\Http\Controllers;

use App\DataTables\CategoryMenuDataTable;
use App\Models\CategoryMenu;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryMenuController extends Controller
{
    public function index(CategoryMenuDataTable $dataTable)
    {
        return $dataTable->render('admin.category_menu');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required"
        ]);

        $data = CategoryMenu::updateOrCreate([
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
        $data = CategoryMenu::findOrFail($request->id);
        return response()->json([
            "name" => $data->name
        ]);
    }

    public function destroy(Request $request)
    {
        $data = CategoryMenu::findOrFail($request->id);
        $data->delete();

        return response()->json([
            "text" => "Data Deleted"
        ]);
    }

    public function change(Request $request)
    {

        $status = $request->status == 1 ? 0 : 1;
        $data = CategoryMenu::findOrFail($request->id);
        $data->status = $status;
        $data->save();

        $text = "";
        if($status == 1) {
            $text = "Data Actived";
        } else {
            $text = "Data Inactived";
        }

        return response()->json([
            "text" => $text
        ]);
    }
}
