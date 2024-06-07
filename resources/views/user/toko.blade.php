<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('build/toko.css') }}" />
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
            <span class="text">Toko</span>
          </div>

          <div class="container">
            @foreach ($items as $item)
                <div class="circlebox">
                    <div class="banner" style="background-image: url('{{ asset('gambaritem/' . $item->foto) }}');" ><br><br>
                    </div>

                    <span class="circlename" type="text" name="nama" id="nama">{{ $item->nama }}</span>
                    <span class="circleprice" type="text" name="price" id="price"> ${{ $item->price }} </span>
                    
                    <button class="takequiz-btn" data-item-id="{{ $item->id }}">BELI</button>
                    
                </div>
            @endforeach
          </div>
        </div>
        <div class="popup-info">
          <h2>Are you sure you want to buy this item?</h2>
          <span class="info"> Click 'NO' to cancel, 'YES' to buy</span>

          <div class="btn-group">
            <button class="info-btn exit-btn">NO</button>
            <a href="toko.html" class="info-btn continue-btn">YES</a>
          </div>
        </div>
      </div>
    </section>
    <script src="{{ asset('js/toko.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script>
    // Memeriksa tema yang dipilih dari localStorage
    function getTheme() {
        return localStorage.getItem("theme");
    }

    // Menerapkan tema yang dipilih
    document.addEventListener("DOMContentLoaded", () => {
        const takeQuizButtons = document.querySelectorAll('.takequiz-btn');
        const continueButton = document.querySelector('.continue-btn');
        const savedTheme = getTheme();
        if (savedTheme) {
            document.body.classList.add(savedTheme);
        }

        const baseUrl = "{{ route('user.item.purchase', ['item' => ':itemId']) }}";

        takeQuizButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                // Get the item ID from the data attribute
                const itemId = this.getAttribute('data-item-id');

                // Replace the placeholder with the actual item ID
                const itemUrl = baseUrl.replace(':itemId', itemId);
                console.log('Generated URL:', itemUrl);

                // Update the href attribute of the continue button with the item URL
                continueButton.setAttribute('href', itemUrl);
            });
        });
    });
</script>
  </body>
</html>
