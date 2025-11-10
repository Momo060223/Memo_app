<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>メモ帳</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="container">
    <div class="memo_area">
        <div class="memo_form">
            <h2>メモを追加</h2>
            <form action="{{ asset('/add') }}" method="post">
	        @csrf
                <input class="memo_text" type="text" name="memo_text" id="memo_text">
                <input type="submit" value="追加">
            </form>
        </div>
        <div class="memo_show">
            @foreach($memo_info as $memo)
                <div class="memo_item">
                    <div class="memo_title">
                        <time>{{$memo->created_at}}</time>
                        <p>{{$memo->content}}</p>
                    </div>
                    <div class="btn_area">
                        <div class="edit_form">
                            <form action="{{ asset('/edit/'.$memo->id) }}" method="get">
                                @csrf
                                <input type="submit" value="編集">
                            </form>
                        </div>
                        <div class="del_area">
                            <form action="{{ asset('/delete') }}" method="post"> 
                            @csrf
                                <input type="hidden" name="delete_id" value="{{$memo->id}}">
                                <input type="submit" value="削除">
                            </form>
                        </div>
                    </div>
                </div>    
            @endforeach
        </div>
    </div>
</div>
</body>
</html>
