<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>お気に入りメモ一覧</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<h2><span class="star">★</span> お気に入りメモ一覧</h2>

<a href="{{ route('home') }}" class="btn btn-primary">← メモ一覧へ戻る</a>

<div class="memo_show">

    @if($memo_info->isEmpty())
        <p>お気に入りのメモはありません。</p>
    @else
        @foreach($memo_info as $memo)
            <div class="memo_item">
                <div class="memo_title">
                    <time>{{ $memo->created_at }}</time>
                    <p>{{ $memo->content }}</p>
                </div>

                <div class="btn_area">
                    {{-- ★オンオフボタン --}}
                    <div class="favorite_area">
                        <form action="{{ asset('/favorite/'.$memo->id) }}" method="post">
                            @csrf
                            <button type="submit" style="background:none; border:none; font-size:20px;">
                                {{-- お気に入りなら黄色、そうでなければ灰色 --}}
                                <span class="star-icon @if($memo->is_favorite) active @endif">
                                    ★
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

</div>

</body>
</html>
