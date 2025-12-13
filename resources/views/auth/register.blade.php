<!DOCTYPE html>
<html lang="en">
    @include('layouts.partials.head')
  <body>
    <!-- tap on top starts-->
    <div class="tap-top"><i class="iconly-Arrow-Up icli"></i></div>
    <!-- tap on tap ends-->
    <!-- loader-->
    @include('layouts.partials.loader')
    <!-- login page start-->
    <div class="container-fluid p-0">
      <div class="row m-0">
        <div class="col-12 p-0">    
          <div class="login-card login-dark">
            <div>
              <div><a class="logo text-center" href="index.html"><img class="img-fluid for-light m-auto" src="../assets/images/logo/logo1.png" alt="looginpage"><img class="img-fluid for-dark" src="../assets/images/logo/logo-dark.png" alt="logo"></a></div>
              <div class="login-main"> 
                <form class="theme-form" method="POST" action="{{ route('register') }}">
                  @csrf
                  <h2 class="text-center">{{__('Create your account')}}</h2>
                  <p class="text-center">{{__('Enter your personal details to create account')}}</p>
                  <div class="form-group">
                    <label class="col-form-label pt-0">{{__('Your Name')}}</label>
                    <div class="row g-2">
                      <div class="col-12">
                        <input name="name" class="form-control" type="text" required="" placeholder="{{__('Name')}}">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">{{__('Email Address')}}</label>
                    <input class="form-control" name="email" type="email" required="" placeholder="{{__('Test@gmail.com')}}">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">{{__('Password')}}</label>
                    <div class="form-input position-relative">
                      <input class="form-control" type="password" name="password" required="" placeholder="{{__('*********')}}"> 
                      <div class="show-hide"><span class="show"></span></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">{{__('Confirm Password')}}</label>
                    <div class="form-input position-relative">
                      <input class="form-control" type="password" name="password_confirmation" required="" placeholder="{{__('*********')}}"> 
                      <div class="show-hide"><span class="show"></span></div>
                    </div>
                  </div>

                  <div class="form-group mb-0 checkbox-checked">
                    <div class="form-check checkbox-solid-info">
                      <input name="terms" class="form-check-input" id="solid6" type="checkbox">
                      <label class="form-check-label" for="solid6">{{__('Agree with')}}<a class="ms-3 link" href="forget-password.html">{{__('Privacy Policy')}}</a></label>
                    </div>
                    <button class="btn btn-primary btn-block w-100 mt-3" type="submit">{{__('Create Account')}}</button>
                  </div>
                  <div class="login-social-title">
                    <h6>{{__('Or Sign in with')}}                 </h6>
                  </div>
                  <div class="form-group">
                    <ul class="login-social">
                      <li><a href="https://www.linkedin.com" target="_blank"><i class="icon-linkedin"></i></a></li>
                      <li><a href="https://twitter.com" target="_blank"><i class="icon-twitter"></i></a></li>
                      <li><a href="https://www.facebook.com" target="_blank"><i class="icon-facebook"></i></a></li>
                      <li><a href="https://www.instagram.com" target="_blank"><i class="icon-instagram"></i></a></li>
                    </ul>
                  </div>
                  <p class="mt-4 mb-0 text-center">{{__('Already have an account?')}}<a class="ms-2" href="login.html">{{__('Sign in')}}</a></p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      @include('layouts.partials.scripts')
    </div>
  </body>
</html>