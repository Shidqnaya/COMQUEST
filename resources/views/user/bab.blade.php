<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('build/bab.css') }}" rel="stylesheet" />
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
            <a href="/user/dashboard">
              <i class="uil uil-home"></i>
              <span class="link-name">Dashboard</span>
            </a>
          </li>
          <li>
            <a href="/user/leaderboard">
              <i class="uil uil-star"></i>
              <span class="link-name">Leaderboards</span>
            </a>
          </li>
          <li>
            <a href="/user/toko">
              <i class="uil uil-shop"></i>
              <span class="link-name">Shop</span>
            </a>
          </li>
          <li>
            <a href="/user/customize">
              <i class="uil uil-brush-alt"></i>
              <span class="link-name">Costumize</span>
            </a>
          </li>
          <li>
            <a href="/user/profile">
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
        <div class="search-box">
          <i class="uil uil-search"></i>
          <input type="text" placeholder="Cari bab..." />
        </div>
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
                    <span class="text">{{ $matkul->code }} | {{ $matkul->name }}</span>
                </div>
                <div class="container">
                    @foreach ($babs as $bab)
                        <div class="babbox">
                            <div class="bab">
                                <p class="bab-name">{{ $bab->name }}</p>
                            </div>
                            <div>
                                <a href="{{ route('user.quizzes.index', ['matkul' => $matkul->id, 'bab' => $bab->id]) }}" class="takequiz-btn">List Quiz</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('js/script.js') }}"></script>
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