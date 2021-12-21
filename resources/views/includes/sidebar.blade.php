@if (Auth::check())
<?php
  $id = Auth::user()->id;
  $users = DB::table('users')
            ->select('*')
            ->where('id',$id)
            ->get();
          foreach ($users as $user) { 
            if($user->avatar != '') {
              $image =  asset('/assets/users/' .$user->avatar); 
            }     
            else { 
              $image =  asset('/assets/users/1.jpg'); 
            }
          ?>
  <div class="sidebar-wraper">
    <div class="sidebar-bg-image"></div>
      <div class="user-sidebar">
        <div class="avatar-upload">
          <div class="avatar-preview">
            <div id="imagePreview" style="background-image:url({{ $image }});">
            </div>
          </div>
        </div>
        <h4>{{$user->first_name . ' ' . $user->last_name}}</h4>
        <p>{{$user->email}}</p>
      </div>
      <ul>
        <li>
          <a class="{{ (request()->is('home')) ? 'active' : '' }}" href="{{route('front.home')}}"> <i class="ti-user"></i>פּרוֹפִיל </a>
        </li>
        <li>
          <a class="{{ (request()->is('home/notifications')) ? 'active' : '' }}" href="{{route('front.notifications')}}" ><i class="ti-bell"></i>ההתראות</a>
        </li>
        <li >
          <a class="{{ (request()->is('my-courses')) ? 'active' : '' }}" href="{{route('front.my-courses')}}"><i class="ti-book"></i>הקורסים שלי </a>
        </li>
        <li >
          <a class="{{ (request()->is('home/payment-method')) ? 'active' : '' }}" href="{{route('front.paymethod')}}"><i class="ti-credit-card"></i>אמצעי תשלום </a>
        </li>
        <li >
          <a class="{{ (request()->is('history')) ? 'active' : '' }}" href="{{route('front.history')}}" class="border-0"><i class="ti-timer"></i> היסטוריית רכישות </a>
        </li>
      </ul>
    </div>
  <?php }?>
@endif