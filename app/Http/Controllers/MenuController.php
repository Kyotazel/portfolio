<?php

namespace App\Http\Controllers;

use App\DataTables\MenuDataTable;
use App\Models\CategoryMenu;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(MenuDataTable $dataTable)
    {
        $menus = Menu::all();
        $categoryMenus = CategoryMenu::all();
        return $dataTable->render('admin.menu', [
            'menus' => $menus,
            'categoryMenus' => $categoryMenus
        ]);
    }

    public function store(Request $request)
    {
        if($request->id_parent) {
            $validated = $request->validate([
                "name" => "required",
                "link" => "required",
                "category_menu_id" => "required"
            ]);
        } else {
            $validated = $request->validate([
                "name" => "required",
                "icon" => "required",
                "link" => "required",
                "category_menu_id" => "required"
            ]);
        }

        $data = Menu::updateOrCreate([
            "id" => $request->id
        ],[
            "name" => $request->name,
            "icon" => $request->icon,
            "link" => $request->link,
            "id_parent" => $request->id_parent,
            "category_menu_id" => $request->category_menu_id,
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
        $data = Menu::findOrFail($request->id);
        return response()->json([
            "name" => $data->name,
            "icon" => $data->icon,
            "link" => $data->link,
            "category_menu_id" => $data->category_menu_id,
            "id_parent" => $data->id_parent,
        ]);
    }

    public function destroy(Request $request)
    {
        $data = Menu::findOrFail($request->id);
        $data->delete();

        return response()->json([
            "text" => "Data Deleted"
        ]);
    }

    public function change(Request $request)
    {

        $status = $request->status == 1 ? 0 : 1;
        $data = Menu::findOrFail($request->id);
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
