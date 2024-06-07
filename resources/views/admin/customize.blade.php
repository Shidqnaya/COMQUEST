<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{asset('build/kostumisasi.css') }}" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins" />

    <title>Document</title>
  </head>

  <body>
  <nav>
      <div class="logo-name">
      <div class="logo-image">
          <img src="{{ asset('images/logo.png') }}" alt="" />
        </div>

        <span class="logo_name">ComQuest</span>
      </div>

      <div class="menu-items">
        <ul class="nav-links">
          <li>
            <a href="/admin/dashboard">
              <i class="uil uil-home"></i>
              <span class="link-name">Dashboard</span>
            </a>
          </li>
          <li>
            <a href="/admin/leaderboard">
              <i class="uil uil-star"></i>
              <span class="link-name">Leaderboards</span>
            </a>
          </li>
          <li>
            <a href="/admin/toko">
              <i class="uil uil-shop"></i>
              <span class="link-name">Shop</span>
            </a>
          </li>
          <li>
            <a href="/admin/customize">
              <i class="uil uil-brush-alt"></i>
              <span class="link-name">Costumize</span>
            </a>
          </li>
          <li>
            <a href="/admin/profile">
              <i class="uil uil-user-circle"></i>
              <span class="link-name">Profile</span>
            </a>
          </li>
        </ul>

        <ul class="logout-mode">
          <li>
            <!-- Tautan yang memicu pengiriman form logout -->
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="uil uil-sign-out-alt"></i>
              <span class="link-name">Logout</span>
            </a>
            <!-- Formulir logout  -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
        </ul>
      </div>
    </nav>


    <section class="dashboard">
      <div class="top">
        <i class="uil uil-bars sidebar-toggle"></i>
        @if($user->avatar)
            <img src="{{ asset('userpfp/' . $user->avatar) }}" alt="Profile Picture" />
        @else
            <img src="{{ asset('images/default.jpeg') }}" alt="Default Profile Picture" />            
        @endif
      </div>

      <div class="dash-content">
        <div class="overview">
          <div class="title">
            <i class="uil uil-paperclip"></i>
            <span class="text">Kostumisasi</span>
          </div>

          TEMA
          <div class="container">
            <div class="circlebox">
              <div class="circleblue"></div>
              <span class="circlename">Classic Blue</span>
            </div>
            <div class="circlebox">
              <div class="circleblack"></div>
              <label>Black Journey</label>
            </div>
            <div class="circlebox">
              <div class="circlepurple"></div>
              <label>Purple Vibe</label>
            </div>
            <div class="circlebox">
              <div class="circlegreen"></div>
              <label>Mossy Quest</label>
            </div>
            <div class="circlebox">
              <div class="circleroastedpeach"></div>
              <label>Roasted Peach</label>
            </div>
            <div class="circlebox">
              <div class="circleswimmingpool"></div>
              <label>Swimming Pool</label>
            </div>
            <div class="circlebox">
              <div class="circlecottoncandy"></div>
              <label>Cotton Candy</label>
            </div>
          </div>
          BANNER
          <div class="container">
            
          </div>
        </div>
      </div>
    </section>
    <script src="{{ asset('js/kostumisasi.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
  </body>
</html>

