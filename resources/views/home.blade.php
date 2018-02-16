@extends('layouts/app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                @php
                if (Auth::user()!=null)
                {
                @endphp
                    <td><input type="button" value="Posts" onclick="window.location.href='/my_private_friends_public_posts';"></td>
                @php
                } else {
                @endphp
                    <td><input type="button" value="Posts" onclick="window.location.href='/all_public_posts';"></td>
                @php
                }
                @endphp
            </div>
        </div>
    </div>
</div>
@endsection
