@extends('layouts.app')

@section('title', 'לאפס את הסיסמה')

@section('content')

<div class="form-wraper" style=" margin:135px auto;">
    <div class="card">
        <div class="card-header">
            <h3> לאפס את הסיסמה   </h3>
        </div>
        <div class="row">
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group row">
                    <div class="col-md-2">
                        <label for="email" class="col-md-4 col-form-label text-md-right"> כתובת דוא"ל  </label>
                    </div>
                    <div class="col-md-10">
                        <div class="form-group">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <button type="submit" class="btn circle btn-theme effect btn-md">
                                    שלח קישור לאיפוס סיסמה
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

@endsection
