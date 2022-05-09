<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body{
            background-image: url({{asset('authregister/images/baraa.jpg')}});
            
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up | User</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{asset('authregister/fonts/material-icon/css/material-design-iconic-font.min.css')}}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{asset('authregister/css/style.css')}}">
    
      <link rel="stylesheet" href="{{asset('cms/plugins/toastr/toastr.min.css')}}">
</head>
<body>

    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    <form id="create-form" >
                        <h2 class="form-title">Create account User</h2>
                        <div class="form-group">
                            <input type="text" class="form-input" id="first_name" placeholder="First Name"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input"  id="last_name" placeholder="Last Name"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input"  id="address" placeholder="Address"/>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-input" id="email" placeholder="Your Email"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" id="mobile"  placeholder="phone number"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input"  id="password" placeholder="Password"/>
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        </div>

                        <div class="form-group">
                            <button type="button" onclick="performStore()" class="form-submit" >Sign up</button>
                        </div>
                    </form>
                    <p class="loginhere">
                        Have already an account ? <a href="{{route('cms.login','user')}}" class="loginhere-link">Login here</a>
                    </p>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="{{asset('authregister/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('authregister/js/main.js')}}"></script>
    <script>
        function performStore() {
         
            axios.post('/cms/user/register', {
                first_name: document.getElementById('first_name').value,
                last_name: document.getElementById('last_name').value,
                email: document.getElementById('email').value,
                address: document.getElementById('address').value,
                password: document.getElementById('password').value,
                mobile: document.getElementById('mobile').value,
            })
            .then(function (response) {
                console.log(response);
                toastr.success(response.data.message);
                document.getElementById('create-form').reset();
                window.location.href = "{{route('cms.login','user')}}";


            })
            .catch(function (error) {
                console.log(error.response);
                toastr.error(error.response.data.message);
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{asset('cms/plugins/toastr/toastr.min.js')}}"></script>
</body>
</html>