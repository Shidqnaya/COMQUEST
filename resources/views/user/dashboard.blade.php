<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="{{ asset('build/dashboard.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins" />
  <title>Dashboard</title>
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
      <li><a href="/user/dashboard"><i class="uil uil-home"></i><span class="link-name">Dashboard</span></a></li>
      <li><a href="/user/leaderboard"><i class="uil uil-star"></i><span class="link-name">Leaderboards</span></a></li>
      <li><a href="/user/toko"><i class="uil uil-shop"></i><span class="link-name">Shop</span></a></li>
      <li><a href="/user/customize"><i class="uil uil-brush-alt"></i><span class="link-name">Costumize</span></a></li>
      <li><a href="/user/profile"><i class="uil uil-user-circle"></i><span class="link-name">Profile</span></a></li>
    </ul>
    <ul class="logout-mode">
      <li>
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="uil uil-sign-out-alt"></i><span class="link-name">Logout</span>
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
    <form action="{{ route('user.matkul.search') }}" method="GET" class="search-box">
      <i class="uil uil-search"></i>
      <input type="text" name="query" placeholder="Cari matkul..." />
      <button type="submit">Cari</button>
    </form>
    @if($user->avatar)
            <img src="{{ asset('userpfp/' . $user->avatar) }}" alt="Profile Picture" />
        @else
            <img src="{{ asset('images/default.jpeg') }}" alt="Default Profile Picture" />            
        @endif
  </div>
  <div class="dash-content">
    <div class="overview">
      <div class="kostumisasi" style="background-image: none;">
        <div class="atas">
          <span class="namauser">Hallo {{$user->username }}!</span>
          <a href="/user/customize"><i class="uil uil-pen"></i></a>
        </div>
        <br>
        <div class="poin">
          <a href="/user/toko" class="poinframe">
            <i class="uil uil-usd-circle"></i>
            <span class="userpoin">{{$user->balance}}</span>
          </a>
        </div>
      </div>
      <div class="title"><i class="uil uil-paperclip"></i><span class="text">Matkul overview</span></div>
      <div id="filter" class="filter">
        <button class="btn" onclick="filterObject('all')">Show All</button>
        <button class="btn" onclick="filterObject('S3')">Semester 3</button>
        <button class="btn" onclick="filterObject('S4')">Semester 4</button>
        <button class="btn" onclick="filterObject('S5')">Semester 5</button>
      </div>
      <div class="matkulcontainer">
        @foreach ($matkuls as $matkul)
          <a href="{{ route('user.babs.index', $matkul->id) }}">
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
                <span class="matkulcode">{{ $matkul->code }} </span>
                <span class="matkulname">{{ $matkul->name }}</span>
              </div>
            </div>
          </a>
        @endforeach
      </div>
    </div>
  </div>
</section>

<script src="{{ asset('js/filter.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {
  // Memeriksa tema yang dipilih dari localStorage
  function getTheme() {
    return localStorage.getItem("theme");
  }

  // Memeriksa gambar item yang dipilih dari localStorage
  const selectedItemImage = localStorage.getItem("selectedItemImage");

  // Menerapkan tema yang dipilih
  const savedTheme = getTheme();
  if (savedTheme) {
    document.body.classList.add(savedTheme);
  }

  // Menerapkan gambar item sebagai latar belakang jika ada
  const kostumisasiElement = document.querySelector('.kostumisasi');
  if (selectedItemImage && selectedItemImage !== 'null') {
    kostumisasiElement.style.backgroundImage = `url('${selectedItemImage}')`;
  }
});
</script>

</body>
</html>
