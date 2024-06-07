<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('build/admindashboard.css') }}" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins" />

    <title>Admin Dashboard</title>
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
        <form action="{{ route('admin.matkul.search') }}" method="GET" class="search-box">
          <i class="uil uil-search"></i>
          <input type="text" name="query" placeholder="Cari matkul..." />
          <button type="submit">Cari</button>
        </form>
        @if($user->avatar)
        <img src="{{ asset('userpfp/' . $user->avatar) }}" alt="Profile Picture" />
        @else
          <!-- Tampilkan gambar default jika user tidak memiliki foto profil -->
          <img src="{{ asset('images/default.jpeg') }}"/>
        @endif
      </div>
      <div class="dash-content">
    <div class="overview">
        <div class="kostumisasi">
            <a href="{{ route('admin.matkul.create') }}">
                <div class="atas">
                    <i class="uil uil-plus-circle"></i>
                    <span class="text">Create</span>
                </div>
            </a>
        </div>
          <div class="title">
            <i class="uil uil-paperclip"></i>
            <span class="text">Matkul overview</span>
          </div>

          <div id="filter" class="filter">
            <button class="btn" onclick="filterObject('all')">Show All</button>
            <button class="btn" onclick="filterObject('S3')">Semester 3</button>
            <button class="btn" onclick="filterObject('S4')">Semester 4</button>
            <button class="btn" onclick="filterObject('S5')">Semester 5</button>
          </div>

          <div class="matkulcontainer">
            @foreach ($matkuls as $matkul)
            <a href="{{ route('admin.bab.create', $matkul->id) }}">
              <div class="matkul S{{$matkul->semester}}">
                  <div class="matkulpic">
                    @if($matkul->photo)
                    <img src="{{ asset('matkulfoto/' . $matkul->photo) }}" alt="Matkul Picture" />
                    @else
                      <!-- Tampilkan gambar default jika user tidak memiliki foto profil -->
                      <img src="{{ asset('images/download.png') }}" alt="picture"/>
                    @endif
                  </div>
                  <div class="textcontainer">
                    <span class="matkulcode">{{ $matkul->code }} |</span>
                    <span class="matkulname">{{ $matkul->name }}</span>
              </div>
          </a>
                <div class="buttons">
                  <a href="{{ route('admin.matkul.edit', $matkul->id) }}"><button class="btn">EDIT</button></a>
                  <form class="formbtn" action="{{ route('admin.matkul.destroy', $matkul->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button class="btn" type="submit">DELETE</button>
                  </form>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </section>

    <script src="{{ asset('js/filter.js') }}"></script>
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
