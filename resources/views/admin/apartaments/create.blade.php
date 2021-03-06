@extends('layouts.app')

@section('bootstrap')

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}

    <script src="{{ asset('js/app.js') }}" defer></script>

@endsection


@section('header')
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    {{-- <a class="navbar-brand" href="{{ url('/home') }}">
                        Home
                    </a> --}}
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <a class="navbar-brand">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/69/Airbnb_Logo_B%C3%A9lo.svg/1200px-Airbnb_Logo_B%C3%A9lo.svg.png" width="150" height="50" class="d-inline-block align-top" alt="">
                        </a>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
    </div>
@endsection

@section('main')
  <div class="container">
      <div class="row">
        <div class="col-12">
          @foreach ($errors->all() as $message)
              {{$message}}
          @endforeach
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Apartaments</li>
            </ol>
          </nav>
          <form action="{{route('admin.apartaments.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="form-group">
              <label for="title">Titolo</label>
              <input type="text" name="title" id="title" class="form-control">
            </div>
            <div class="form-group">
              {{-- ricordarci il ckeditor --}}
              <label for="description">Descrizione</label>
              {{-- <input type="text" name="description" id="description" class="form-control"> --}}
              <textarea id="editor" name="description" rows="8" cols="80" class="form-control"></textarea>
            </div>
            <div class="form-group">
              <label for="cover_img">Fotografia principale</label>
              <input type="file" name="cover_img" id="cover_img">
            </div>
            <div class="form-group">
              <label for="rooms_number">Numero di stanze</label>
              <input type="number" name="rooms_number" class="form-control">
            </div>
            <div class="form-group">
              <label for="bathrooms_number">Numero di bagni</label>
              <input type="number" name="bathrooms_number" class="form-control">
            </div>
            <div class="form-group">
              <label for="beds_number">Numero di letti</label>
              <input type="number" name="beds_number" class="form-control">
            </div>
              <!-- Default switch -->
                {{-- <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input" id="customSwitches" name="visible">
                  <label class="custom-control-label" for="customSwitches" value="1">Visible</label>
                </div> --}}
              <div class="form-group" >
                <label for="visible">Visible/Hidden</label>
                <select class="form-control" id="visible" name="visible">
                  <option value="1">Visible</option>
                  <option value="0">Hidden</option>
                </select>
              </div>
            <div class="form-group">
              <label for="size">Dimensioni</label>
              <input type="number" name="size" class="form-control">
            </div>
            <div class="form-group">
              <label for="address">Indirizzo</label>
              <input type="search" class="form-control" id="form-address" placeholder="Inserisci il tuo indirizzo"/>
            </div>
            <div class="form-group">
              <label for="form-address2">Nome Strada</label>
              <input type="text" class="form-control" id="form-address2" placeholder="Inserisci il nome della strada. Esempio: Via Roma" />
            </div>
            <div class="form-group">
              <label for="numero-civico">Numero Civico</label>
              <input type="text" class="form-control" id="numero-civico" placeholder="Numero civico" />
            </div>
            <div class="form-group">
              <label for="form-city">Città</label>
              <input type="text" class="form-control" id="form-city" placeholder="Città" />
            </div>
            <div class="form-group">
              <label for="form-zip">Codice Postale</label>
              <input type="text" class="form-control" id="form-zip" placeholder="Codice Postale" />
            </div>
            <div class="form-group">
              <label for="address">Indirizzo Completo</label>
              <input type="text" name="address" id="full-address" class="form-control" readonly="readonly">
            </div>
            <div class="form-group">
              <label for="price">Prezzo</label>
              <input type="number" step="0.01" name="price" class="form-control">
            </div>
            <div class="form-group">
              <input type="hidden" id="form-lat" step="0.01" name="latitude" class="form-control">
            </div>
            <div class="form-group">
              <input type="hidden" id="form-lng" step="0.01" name="longitude" class="form-control">
            </div>
            <div class="form-group">
              <h3>Caratteristiche</h3>
              @foreach ($features as $feature)
              <label for="features-{{$feature->id}}">{{$feature->name}}</label>
              <input type="checkbox" name="features[]" id="features-{{$feature->id}}" value="{{$feature->id}}">
                @endforeach
            </div>
            <div class="form-group">
              <h3>Servizi</h3>
              @foreach ($services as $service)
              <label for="services-{{$service->id}}">{{$service->name}}</label>
              <input type="checkbox" name="services[]" id="services-{{$service->id}}" value="{{$service->id}}">
                @endforeach
            </div>

            {{-- <div class="form-group">
              <h3>Photos</h3>
              @foreach ($photos as $photo)
              <label for="photos-{{$photo->id}}">{{$photo->name}}</label>
              <input type="checkbox" name="photos[]" id="photos-{{$photo->id}}" value="{{$photo->id}}">
              @endforeach
              <label for="photo">Fotografia</label>
              <input type="file" name="photo" id="photo">
            </div> --}}

            <input type="submit" value="Salva" class="btn btn-primary">
          </form>
        </div>
      </div>
    </div>
@endsection

@section('svg')
  @include('partials.svg_logo')
@endsection
