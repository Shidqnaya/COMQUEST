<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('build/admintoko.css') }}" />
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

        <span class="logo_name">ComQuiz</span>
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
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="uil uil-sign-out-alt"></i>
              <span class="link-name">Logout</span>
            </a>
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
            <span class="text">Toko</span>
          </div>
          
          <form action="{{ route('admin.item.create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="container">
                <div class="circlebox">
                    <div class="banner">
                        <br><br>
                    </div>
                    
                    <input class="form-control" type="file" name="foto" id="foto" autocomplete="off" style="margin-top: 10px;margin-bottom:10px;margin-left: 10px;"/>
                    
                    <input class="circlename" type="text" name="nama" id="nama" placeholder="masukkan nama item" required autocomplete="off" />
                    <input class="circleprice" type="text" name="price" id="price" placeholder="masukkan harga item" required autocomplete="off" />
                    <button class="takequiz-btn">ADD ITEM</button>
                </div>
            </div>
          </form>
          ITEMS
          <div class="container">
            @foreach ($items as $item)
                <div class="circlebox">
                    <div class="banner" style="background-image: url('{{ asset('gambaritem/' . $item->foto) }}');">
                    <br><br>
                    </div>
                    <form action="{{ route('admin.item.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                            <input class="form-control" type="file" name="foto" id="foto" autocomplete="off" style="margin-top: 10px;margin-bottom:10px;margin-left: 10px;"/>
                            <input class="circlename" type="text" name="nama" id="nama" value="{{ $item->nama }}" required autocomplete="off" />
                            <input class="circleprice" type="text" name="price" id="price" value="{{ $item->price }}" required autocomplete="off" />
                        
                        <button class="takequiz-btn" type="submit">UPDATE ITEM</button>
                        
                    </form>
                    <form action="{{ route('admin.item.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="takequiz-btn" type="submit">HAPUS ITEM</button>
                    </form>
                </div>
            @endforeach

          </div>
        </div>
      </div>
    </section>
    <script src="{{asset('js/toko.js') }}"></script>
    <script src="{{asset('js/script.js') }}"></script>
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