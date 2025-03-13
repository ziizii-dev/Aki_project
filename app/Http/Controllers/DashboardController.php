<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DashboardController extends Controller
{
    public function index()
    {
     
        $dataEntries = Data::all(); 
    
       
        $user = Auth::user();
        $isAdmin = Auth::guard('admin')->check(); 
    

        return view('data.index', compact('dataEntries', 'isAdmin', 'user'));
      
    }
    
    public function create()
    {
        return view('data.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:20',
            'category' => 'required|in:カテゴリ１,カテゴリ２,カテゴリ３',
            'content' => 'required|string|max:200',
        ], [
            'title.required' => 'タイトルを入力してください',
            'title.max' => 'タイトルは20文字以内で入力してください。',
            'category.required' => 'カテゴリは不明な値です',
            'content.required' => '本文を入力してください',
            'content.max' => '本文は200文字以内で入力してください。',
        ]);

        Data::create($validated);
        return redirect()->route('dashboard.index')->with('success', 'データが登録されました');
    }
    public function edit($id)
    {
        $dataEntry = Data::findOrFail($id);
        return view('data.edit', compact('dataEntry'));
    }
    
    public function update(Request $request, $id)
    {
        $data = Data::findOrFail($id); 
    
 
        $validated = $request->validate([
            'title' => 'required|string|max:20',
            'category' => 'required|in:カテゴリ１,カテゴリ２,カテゴリ３',
            'content' => 'required|string|max:200',
        ], [
            'title.required' => 'タイトルを入力してください',
            'title.max' => 'タイトルは20文字以内で入力してください。',
            'category.required' => 'カテゴリは不明な値です',
            'content.required' => '本文を入力してください',
            'content.max' => '本文は200文字以内で入力してください。',
        ]);
    
        $data->title = $validated['title'];
        $data->category = $validated['category'];
        $data->content = $validated['content'];
    
     
    
        $data->save(); 
    
       
        return redirect()->route('dashboard.index')->with('success', 'データが更新されました');
    }
    

    public function destroy($id)
    {
        $data = Data::findOrFail($id); 
    
        $data->delete(); 
    
        return redirect()->route('dashboard.index')->with('success', 'データが削除されました');
    }
        
    public function show($id)
    {
        $data = Data::findOrFail($id); 
        return view('data.edit', compact('data')); 
    }
    
    

    public function exportCSV()
    {
        $dataEntries = Data::all();
        $fileName = 'data_export_' . now()->format('Ymd_His') . '.csv';
    
       
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];
    
    
        $callback = function () use ($dataEntries) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['タイトル', 'カテゴリ', '本文']); // CSVのヘッダ行
    
            foreach ($dataEntries as $entry) {
                fputcsv($handle, [
                    $entry->title,
                    $entry->category,
                    $entry->content,
                ]);
            }
    
            fclose($handle);
        };
    
       
        return Response::stream($callback, 200, $headers);
    }

    

}