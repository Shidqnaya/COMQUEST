<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('build/kostumisasi.css') }}" />
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

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            @if(session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
            @endif

            <div class="itemtitle">
                <span>TEMA</span>
            </div>
            
            <div class="container">
                
                <div class="circlebox">
                    <div class="circleblue"></div>
                    <span class="circlename">Classic Blue</span>
                </div>
                <div class="circlebox">
                    <div class="circleblack"></div>
                    <span class="circlename">Black Journey</span>
                </div>
                <div class="circlebox">
                    <div class="circlepurple"></div>
                    <span class="circlename">Purple Vibe</span>
                </div>
                <div class="circlebox">
                    <div class="circlegreen"></div>
                    <span class="circlename">Mossy Quest</span>
                </div>
                <div class="circlebox">
                    <div class="circleroastedpeach"></div>
                    <span class="circlename">Roasted Peach</span>
                </div>
                <div class="circlebox">
                    <div class="circleswimmingpool"></div>
                    <span class="circlename">Swimming Pool</span>
                </div>
                <div class="circlebox">
                    <div class="circlecottoncandy"></div>
                    <span class="circlename">Cotton Candy</span>
                </div>
            </div>

            <div class="itemtitle">
                <span>BANNER</span>
            </div>

            <div class="container">
                @foreach ($userItems as $userItem)
                <div class="circlebanner">
                    <div class="banner" style="background-image: url('{{ asset('gambaritem/' . $userItem->item->foto) }}');">
                        <br><br>
                    </div>
                    <span class="circlebannername" type="text" name="nama" id="nama">{{ $userItem->item->nama }}</span>
                    <button class="takequiz-btn" data-item-id="{{ $userItem->item->id }}">Gunakan</button>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<script src="{{ asset('js/kostumisasi.js') }}"></script>
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

  // Mengambil semua tombol 'Gunakan' pada item-item
  const useItemButtons = document.querySelectorAll('.takequiz-btn');

  useItemButtons.forEach(button => {
    const bannerDiv = button.parentNode.querySelector('.banner');
    const itemImage = bannerDiv.style.backgroundImage.slice(5, -2);

    // Periksa apakah item ini adalah item yang dipilih
    if (selectedItemImage === itemImage) {
      button.textContent = "Batalkan";

      // Menambahkan event listener untuk tombol "Batalkan"
      button.addEventListener('click', function(event) {
        event.preventDefault();

        // Menghapus gambar item yang dipilih dari localStorage
        localStorage.removeItem("selectedItemImage");

        // Menghapus latar belakang pada elemen kostumisasi
        const kostumisasiElement = window.parent.document.querySelector('.kostumisasi');
        if (kostumisasiElement) {
          kostumisasiElement.style.backgroundImage = `none`;
        }
        console.log("Background image set to 'none'"); // Debugging

        // Mengubah teks tombol kembali ke "Gunakan"
        this.textContent = "Gunakan";

        // Mengarahkan pengguna ke halaman dashboard untuk memastikan latar belakang diterapkan
        window.location.href = "/user/dashboard";
      });
    } else {
      button.addEventListener('click', function(event) {
        event.preventDefault();

        // Menyimpan gambar item yang dipilih ke localStorage
        localStorage.setItem("selectedItemImage", itemImage);

        // Mengubah latar belakang kostumisasi pada dashboard
        const kostumisasiElement = window.parent.document.querySelector('.kostumisasi');
        if (kostumisasiElement) {
          kostumisasiElement.style.backgroundImage = `url('${itemImage}')`;
        }

        // Mengarahkan pengguna ke halaman dashboard untuk memastikan latar belakang diterapkan
        window.location.href = "/user/dashboard";
      
      });
    }

  });
});
</script>

</body>
</html>
