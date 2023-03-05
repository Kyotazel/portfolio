<?php

namespace App\Http\Controllers;

use App\DataTables\ServiceDataTable;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ServiceController extends Controller
{
    public function index(ServiceDataTable $dataTable)
    {
        return $dataTable->render('admin.service');
    }

    public function create()
    {
        return view('admin.service-form');
    }

    public function edit($slug)
    {
        $data = Service::where('slug', $slug)->first();
        return view('admin.service-form', ['data' => $data]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "title" => "required",
            "icon" => "required"
        ]);

        $count = strlen($request->content);
        $preview = "";
        if ($count != 0) {
            $preview = substr(strip_tags($request->content), 0, 100) . "...";
        }

        $data = Service::updateOrCreate([
            "id" => $request->id
        ],[
            "title" => $request->title,
            "icon" => $request->icon,
            "content" => $request->content,
            "short_content" => $preview
        ]);

        $text = "Data Created";
        if($request->id) {
            $text = "Data Updated";
        }

        Session::flash('status', 'success');
        Session::flash('text', $text);

        return response()->json(['redirect' => '/service']);
    }

    public function destroy(Request $request)
    {
        $data = Service::where('slug', $request->slug)->first();
        $data->delete();

        return response()->json([
            "text" => "Data Deleted"
        ]);
    }
}
