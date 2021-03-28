@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$title}} {{ $menu->menu_code }}

                <nav>
                    <br>
                    <ul class="list-group list-group-horizontal ">
                        <li class="list-group-item">
                            <a href="">Show Categories</a> 
                        </li>

                        <li class="list-group-item">
                        <a href="">Show Ingredients</a>
                        </li>

                        <li class="list-group-item">
                            <a href="">Update</a> 
                        </li>

                        <li class="list-group-item">
                        <a href="">Delete</a>
                        </li>
                    </ul>
                </nav>


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



                    Code :: {{ $menu->menu_code }} <br>
                    Name ::{{ $menu->menu_name }} <br>
                    Category
                    Ingredient
                    Price ::{{ $menu->menu_price }} <br>
                    Description ::{{ $menu->menu_description }}
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
