@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$title}}</div>

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
                    
                    <form action="" method="post">
                    @csrf
                    <table class="table">
                        <tbody>
                            <tr>
                            <td>Code ::</td>
                            <td><input type="text" name="category_code" /></td>
                            </tr>
                            <tr>
                            <td>Name ::</td>
                            <td><input type="text" name="category_name" /></td>
                            </tr>
                        </tbody>
                        <tr>
                        <td class="text-center" colspan="2">
                        <button type="submit">Create</button>
                        </td>
                        </tr>
                    </table>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
