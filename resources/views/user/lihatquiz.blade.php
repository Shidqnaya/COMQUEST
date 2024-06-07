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
          <input type="text" placeholder="Cari kuis..." />
        </div>
        @if($user->avatar)
            <img src="{{ asset('userpfp/' . $user->avatar) }}" alt="Profile Picture" />
        @else
            <img src="{{ asset('images/default.jpeg') }}" alt="Default Profile Picture" />            
        @endif
      </div>
        <div class="dash-content">
            <div class="title">
              <span class="text">{{ $matkul->code }} | {{ $matkul->name }}</span>
            </div>
            <div class="overview">
                <div class="title">
                    <i class="uil uil-paperclip"></i>
                    <span class="text">{{ $bab->name }}</span>
                </div>
                <div class="container">
                @foreach ($quizzes as $quiz)
                    <div class="babbox">
                        <div class="quiz">
                            <p class="quiz-name">{{ $quiz->name }}</p>
                        </div>
                        <div>
                            <a href="#" class="takequiz-btn" data-quiz-id="{{ $quiz->id }}">Kerjakan Quiz</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="popup-info">
                <h2>Quiz Guide</h2>
                <span class="info"> 1. Kuis ini terdiri dari beberapa pertanyaan pilihan ganda</span>
                <span class="info"> 2. Setiap jawaban yang benar akan memberi Anda 10 coin</span>
                <span class="info"> 3. Gunakan tombol "Next" untuk beralih ke pertanyaan berikutnya</span>
                <span class="info"> 4. Setelah menjawab semua pertanyaan, klik tombol "Submit" untuk mengirim jawaban Anda</span>

                <div class="btn-group">
                    <button class="info-btn exit-btn">Back</button>
                    <a href="#" class="info-btn continue-btn" id="continue-btn">Continue</a>
                </div>
            </div>

    </section>
    <script src="{{ asset('js/script.js') }}"></script>
    <script>
      // Memeriksa tema yang dipilih dari localStorage
      function getTheme() {
        return localStorage.getItem("theme");
      }


      document.addEventListener('DOMContentLoaded', function() {
          const takeQuizButtons = document.querySelectorAll('.takequiz-btn');
          const continueButton = document.querySelector('.continue-btn');
          const savedTheme = getTheme();
          if (savedTheme) {
            document.body.classList.add(savedTheme);
          }

          const baseUrl = "{{ route('user.quizzes.attempt', ['matkul' => $matkul->id, 'bab' => $bab->id, 'quiz' => ':quizId']) }}";

          takeQuizButtons.forEach(button => {
              button.addEventListener('click', function(event) {
                  event.preventDefault();

                  // Get the quiz ID from the data attribute
                  const quizId = this.getAttribute('data-quiz-id');

                  // Replace the placeholder with the actual quiz ID
                  const quizUrl = baseUrl.replace(':quizId', quizId);
                  console.log('Generated URL:', quizUrl);

                  // Update the href attribute of the continue button with the quiz URL
                  continueButton.setAttribute('href', quizUrl);
              });
            });
          });

    </script>
</body>
</html>