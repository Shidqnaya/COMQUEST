<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dokdo" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Plus+Jakarta+Sans" />
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Log In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <link href="{{('build/login.css') }}" rel="stylesheet" />
  </head>
  <body>
    <img src="{{('images/logo.png') }}" style="margin-left:0px;margin-right:30px; height:500px; width:500px;" alt="Logo" class="logo" />
    <div class="container1" style="margin: 30px">
      <div class="col">
        <div class="container2">
          <h4 class="title1 text-center">WELCOME TO</h4>
          <h1 class="title2 text-center">ComQuest</h1>
          <form style="padding-bottom: 60px; padding-right: 90px; padding-left: 40px; padding-top: 10px" action="/login" method="post">
          @csrf <!-- include CSRF token -->
            <fieldset class="">
              <p>
                <label for="username">Username </label><br />
                <input class="form-control" type="text" name="username" id="username" required />
              </p>
              <p>
                <label for="password">Password </label><br />
                <input class="form-control" type="password" name="password" id="password" required /><br />
              </p>

              <div class="button-container">
                <div class="d-grid gap-2">
                  <button class="button1" type="submit" name="login">Log In</button>
                  <p class="Question">Not on ComQuest yet?</p>
                  <button class="button2">  <a href="/"  class="akun">Sign Up</a></button>
                </div>
              </div>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
    <script src="{{('js/script.js') }}"></script>
    <script>
      // Memeriksa tema yang dipilih dari localStorage
      function getTheme() {
        return localStorage.getItem("theme");
      }

      // Menerapkan tema yang dipilih
      document.addEventListener("DOMContentLoaded", () => {
        const savedTheme = getTheme();
        if (savedTheme) {
          document.body.classList.add(savedTheme);
        }
      });
    </script>
  </body>
</html>
