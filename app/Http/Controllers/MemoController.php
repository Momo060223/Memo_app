<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memo;    // 追加
use Illuminate\Support\Facades\Log; //ログ出力用


class MemoController extends Controller
{    
    public function store(Request $request)
    {
        Log::debug('This is a debug log.');
        Log::info('テストログ：コントローラーの処理が動きました');
        Log::warning('注意ログ：予想外の値です');
        Log::error('エラーログ：処理中に問題が発生しました');

        // show() で $memo_info を渡して home.blade.php を表示
        return $this->show();
    }
    
    public function show()
    {
        $memo_info = Memo::get();
        //dd($memo_info);
        return view('home')->with('memo_info', $memo_info); // 追加
    }
    
    public function add(Request $request)
    {
        $memo_text = $request->memo_text;

        // 新しいメモを作成
        $memo_model = new Memo();
        $memo_model->content = $memo_text;
        $memo_model->save();

        // 追加後はリダイレクトして show() を経由させる
        return redirect('/');  
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
        if (!$memo_model) {
            return redirect('/')->with('error', '削除対象のメモが存在しません。');
        }

        $memo_model->delete();
        return redirect('/'); // PRG パターン
    }

    public function index(Request $request)
    {
    // ① 検索ワードを受け取る（ない場合は null）
        $search = $request->query('search_word');

    // ② 検索ワードがあるかどうかで出し分け
        if ($search) {
        // 検索ワードを含むメモだけを取り出す
            $memo_info = Memo::where('content', 'LIKE', '%' . $search . '%')
                         ->orderBy('created_at', 'desc')
                         ->get();
        } else {
        // 全部のメモを取り出す
            $memo_info = Memo::orderBy('created_at', 'desc')->get();
        }

        // ③ 結果をビューに返す
        return view('home', compact('memo_info', 'search'));
    }
    
    public function postEdit(Request $request)
    {
        $edit_id = $request->edit_id;
        $edit_memo = $request->edit_memo;

        // ID に該当するメモを更新
        Memo::where('id', $edit_id)->update(['content' => $edit_memo]);

        // 更新後はトップページにリダイレクト
        return redirect('/');
    }

    public function favorite($id)
    {
        $memo = Memo::find($id);

        // もし今がお気に入りなら解除、そうでなければ登録
        $memo->is_favorite = !$memo->is_favorite;

        $memo->save();

        return redirect()->route('home');
    }

    public function favoriteList()
    {
        // is_favorite が「1（お気に入り）」のメモだけ取ってくる
        $memo_info = Memo::where('is_favorite', true)
                     ->orderBy('created_at', 'desc')
                     ->get();

        return view('favorites', compact('memo_info'));
    }
}
 