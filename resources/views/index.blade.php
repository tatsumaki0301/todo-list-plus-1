@extends('layouts.default')
<head>
  <link rel="stylesheet" href="/css/index.css" >
</head>
@section('title', 'TodoList')

@section('content')
<div class="todo_main_area">
  <div>
    <div class="todo_title_area">
      <p class="todo_title_item">TodoList</p>
      @if (Auth::check())
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <p class="user_name">こんにちは{{$user->name}}さん　　<button class="logout_button">logout</button></p>
      </form>
      @else
        <p class="user_name">こんにちはゲストさん　<a href="/login">ログイン</a>|<a href="/register">登録</a></p>
      @endif
    </div>
    @auth
    <div class="find_button_area">
      <button class="find_button"><a href="/find">検索ページ</a></button>
    </div>
    <table class="todo_add_area">
      <tr>
        <th></th>
        <th>内容</th>
        <th>タグ</th>
        <th>追加</th>
      </tr>
    <form action="/add" method="POST">
      @csrf
      <tr>
        <td><input type="hidden" name="user_id" value="{{$id}}"/></td>
        <td><input type="text" name="content" class="todo_input_item" required/></td>
        <td>
          <select name="tag_id">
            @foreach($tags as $tag)
            <option value="{{$tag->id}}">{{$tag->name}}</option>
            @endforeach
          </select>
        </td>
        <td><button class="todo_add_button">追加</button></td>
      </tr>
    </form>
    </table>
  </div>
  <div class="todo_all_area">
    <table  class="todo_all_table">
      <tr>
        <th></th>
        <th></th>
        <th>作成日時</th>
        <th>内容</th>
        <th>タグ</th>
        <th>更新</th>
        <th></th>
        <th>削除</th>
      </tr>
    @endauth
    @foreach($todos as $todo)
      <tr>
      <form action="/update" method="POST">
        @csrf
        <td><input type="hidden" name="id" value="{{$todo->id}}" /></td>
        <td><input type="hidden" name="user_id" value="{{$id}}" /></td>
        <td>{{$todo->created_at}}</td>
        <td><input type="text" name="content" value="{{$todo->content}}" class="todo_all_input_item" required/></td>
        <td><select name="tag_id">
          @foreach($tags as $tag)
          <option value="{{$tag->id}}"  @if($tag->id == $todo->tag_id) selected @endif>{{$tag->name}}</option>
          @endforeach
        </select></td>
        <td><button class="todo_all_update_button_item">更新</buttom></td>
      </form>
      <form action="/delete" method="POST">
        @csrf
        <td><input type="hidden" name="deleteId" value="{{$todo->id}}" /></td>
        <td><button class="todo_all_delete_button_item">削除</button></td>
      </form>
      </tr>
    @endforeach
    </table>
  {{ $todos->links('vendor.pagination.default')}}
  </div>
</div>




<div class="todo_main_area-1">
  <div>
    <div class="todo_title_area-1">
      <p class="todo_title_item-1">TodoList</p>
      @if (Auth::check())
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <p class="user_name-1">こんにちは{{$user->name}}さん　　<button class="logout_button-1">logout</button></p>
      </form>
      @else
        <p class="user_name-1">こんにちはゲストさん　<a href="/login">ログイン</a>|<a href="/register">登録</a></p>
      @endif
    </div>
    @auth
    <div class="find_button_area-1">
      <button class="find_button-1"><a href="/find">検索ページ</a></button>
    </div>
    <table class="todo_add_area">
    <form action="/add" method="POST">
      @csrf
      <tr>
        <th></th>
        <td><input type="hidden" name="user_id" value="{{$id}}"/></td>
      </tr>
      <tr>
        <th>内容</th>
        <td><input type="text" name="content" class="todo_input_item" required/></td>
      </tr>
      <tr>
        <th>タグ</th>
        <td>
          <select name="tag_id" class="tag_item-1">
            @foreach($tags as $tag)
            <option value="{{$tag->id}}">{{$tag->name}}</option>
            @endforeach
          </select>
        </td>
      </tr>
      <tr>
        <th></th>
        <td><button class="todo_add_button">追加</button></td>
      </tr>
    </form>
    </table>
  </div>
  <div class="todo_all_area">
    @foreach($todos as $todo)
    <table  class="todo_all_table-1">
      <tr>
      <form action="/update" method="POST">
        @csrf
        <th>作成日時</th>
        <input type="hidden" name="id" value="{{$todo->id}}" />
        <input type="hidden" name="user_id" value="{{$id}}" />
        <td>{{$todo->created_at}}</td>
      </tr>
      <tr>
        <th>内容</th>
        <td><input type="text" name="content" value="{{$todo->content}}" class="todo_all_input_item-1" required/></td>
      </tr>
      <tr>
        <th>タグ</th>
        <td><select name="tag_id" class="tag_all_item-1">
          @foreach($tags as $tag)
          <option value="{{$tag->id}}"  @if($tag->id == $todo->tag_id) selected @endif>{{$tag->name}}</option>
          @endforeach
        </select></td>
      </tr>
      <tr>
        <th>更新</th>
        <td><button class="todo_all_update_button_item">更新</buttom></td>
      </form>
      </tr>
      <tr>
      <form action="/delete" method="POST">
        @csrf
        <th>削除</th>
        <input type="hidden" name="deleteId" value="{{$todo->id}}" />
        <td><button class="todo_all_delete_button_item">削除</button></td>
      </form>
      </tr>
    @endforeach
    @endauth
    </table>
  {{ $todos->links('vendor.pagination.default')}}
  </div>
</div>

@endsection