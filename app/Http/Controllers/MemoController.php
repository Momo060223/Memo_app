<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memo;    // 追加

class MemoController extends Controller
{
    public function show()
    {
        $memo_info = Memo::get();
        //dd($memo_info);
        return view('home')->with('memo_info', $memo_info); // 追加
    }
    
    public function add(Request $request)
    {
        $memo_text = $request->memo_text;
        $memo_model = new Memo();
        $memo_model->content = $memo_text;
        $memo_model->save();
    
        return self::show(); // ここを書き替える
    }

    public function getEdit($edit_id)
    {
        $memo_info = Memo::find($edit_id); // 追記
        return view('edit')->with('memo_info', $memo_info); // 追記
    }
    
    public function delete(Request $request)
    {
        $delete_id = $request->delete_id;

        $memo_model = Memo::find($delete_id);
        $memo_model->delete();

        return self::show();
    }

    public function postEdit(Request $request)
    {
        $edit_id = $request->edit_id;
        $edit_memo = $request->edit_memo;

        Memo::where('id', $edit_id)->update(['content' => $edit_memo]);

        return self::show();
    }
}
