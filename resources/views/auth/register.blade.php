<div>
<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dokdo" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Plus+Jakarta+Sans" />
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <link href="{{('build/signup.css') }}" rel="stylesheet" />
  </head>
  <body>
  <img src="{{('images/logo.png') }}" style="margin-left:65px;margin-bottom:0px; height:400px; width:400px;" alt="Logo" class="logo" />
    <div class="container1" style="margin: 30px">
      <div class="col">
        <div class="container2">
          <h4 class="title1 text-center">WELCOME TO</h4>
          <h1 class="title2 text-center">ComQuest</h1>
          <form style="padding-bottom: 60px; padding-right: 90px; padding-left: 40px; padding-top: 10px" action="/register" method="post">
          @csrf
            <fieldset class="">
              <p>
                <label for="username">Username </label><br />
                <input class="form-control" type="text" name="username" id="username" required />
              </p>
              <p>
                <label for="name">Nama </label><br />
                <input class="form-control" type="text" name="name" id="nama" required />
              </p>
              <p>
                <label for="email">Email </label><br />
                <input class="form-control" type="text" name="email" id="email" required />
              </p>
              <p>
                <label for="gender">Jenis Kelamin </label><br />
                <label><input type="radio" name="gender" id="gender" value="Laki-laki" />Laki-laki</label>
                <label><input type="radio" name="gender" id="gender" value="Perempuan" />Perempuan</label>
              </p>
              <p>
                <label for="password">Password </label><br />
                <input class="form-control" type="password" name="password" id="password" required /><br />
              </p>

              <div class="button-container">
                <div class="d-grid gap-2">
                  <button class="button1" type="submit" name="register">Sign Up</button>
                  <p class="Question">Already have an account?</p>
                  <button class="button2"><a href="/auth" class="akun">Log In</a></button>
                </div>
              </div>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
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
</div>
