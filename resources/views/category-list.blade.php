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
                                <a href="{{ route('category-create-form')}}">New Category</a> 
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
                    <form action="{{ route('category-list') }}" method="get">
                    <label><b>Search </b><input type="text" name="term" value="{{ $term }}" /></label>
                    </form>
                    </div>

                    {{ $categories->withQueryString()->links() }}
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Code</th>
                            <th scope="col">Name</th>
                            </tr>
                        </thead>
                        @php($i=1)
                        @foreach($categories as $row)
                        <tbody>
                            <tr>
                            <td><a href="{{ route('category-view', ['category' => $row->category_code,]) }}">{{ $row->category_code }}</a></td>
                            <td>{{ $row->category_name }}</td>
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
