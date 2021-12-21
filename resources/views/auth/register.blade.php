@extends('layouts.app')

@section('content')

<div class="form-wraper">
  <h3 class="mb-0">הירשם לחשבונך </h3>
    <form method="POST" action="{{ route('register') }}">
      @csrf
      <div class="form-group">
        <select placeholder="שם האוניברסיטה או המכללה " class="form-control" id="university" name="university">
          <option value="College1"  selected>כללה 1</option>        
          <option value="College2"  selected>כללה 2</option>
          <option value="College3"  selected>כללה 3</option>        
          <option value="Select University" disabled selected>ם האוניברסיטה או המכללה<</option> 
        </select>
      </div>
      <div class="form-group">
        <select placeholder="תוֹאַר " class="form-control" id = 'course' name = 'course'>
          <option value="science art"  selected>Science Art</option>        
          <option value="degree"  selected>Degree</option>        
          <option value="Select Course" disabled selected>Name of course</option>
        </select>
      </div>
      <div class="form-group">
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="שם פרטי " value="{{ old('name') }}" required autocomplete="name" autofocus>
          @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
          @enderror
      </div>
      <div class="form-group">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"  placeholder="כתובת דוא " value="{{ old('email') }}" required autocomplete="email">
          @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
      </div>
      <div class="form-group">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="סיסמה "  name="password" required autocomplete="new-password">
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
      <div class = "form-group">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
      </div>
      <div class="form-group checkout-form border-0 p-0 mt-0">
        <span class="checkbox-wrap d-block">
          <label class="container w-100 mb-0">כדי להירשם אצלנו אנא סמן כדי להסכים ל   <a href="#" class="terms-text">תנאים והגבלות </a>
            <input type="checkbox">
            <span class="checkmark"></span>
          </label>
        </span>
      </div>
      <div class="form-group">
        <button class="log-btn form-btn">הירשם </button>
      </div>
  </form>
</div>
@endsection