@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$title}}

                <div class="text-center">
                <nav>
                    <br>
                    <ul class="list-group list-group-horizontal " style="display: inline-flex;">
                        <li class="list-group-item">
                            <a href="">Create Menu</a> 
                        </li>
                        </ul>
                </nav>
                </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>    
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>    
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif

                    <div class="text-center">
                    <form action="{{ route('menu-list') }}" method="get">
                    <label><b>Search </b><input type="text" name="term" value="{{ $term }}" /></label>
                    </form>
                    </div>

                    {{ $menu->withQueryString()->links() }}

                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Code</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">&nbsp</th>
                            </tr>
                        </thead>
                        @foreach($menu as $row)
                        <tbody>
                            <tr>
                            <td> <a href="{{ route('menu-view', ['menu' => $row->menu_code,]) }}">
                                {{ $row->menu_code }}</a></td>
                            <td> <a href="{{ route('menu-view', ['menu' => $row->menu_code,]) }}">
                                {{ $row->menu_name }}</a></td>
                            <td>{{ $row->menu_price }}</td>
                            <td>ADD</td>
                            </tr>
                        @endforeach  
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
