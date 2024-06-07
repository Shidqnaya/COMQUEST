<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('build/quizend.css') }}" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins" />

    <title>Quiz Review</title>
  </head>

  <body>
    <div class="content">
      <div class="btn-group-back">
        <a href="{{ route('user.dashboard') }}" class="back-btn">Go To Dashboard</a>
      </div>

      <div class="title">
      <span class="text">{{ $matkul->name }}</span>
      </div>
  
      <div class="title">
        <i class="uil uil-paperclip"></i>
        <span class="text">Quiz {{ $quiz->name }} Bab {{ $bab->name }}</span>
      </div>

      <div class="containerresult">
        <span>Quiz Result!</span>
        <span>You Score <span>{{ $score }}</span> out of <span>{{ $questions->count() * 100 }}</span></span>
        <span>Receive <span>{{ $balance }}</span> Coin</span>
      </div>

      <div class="btn-group-continue">
        <a href="#" class="continue-btn">Review</a>
      </div>

      @foreach ($questions as $question)
        <div class="container">
          <div class="question-container">
            <!-- Pertanyaan kuis -->
            <span class="question">{{ $question->question }}</span>
          </div>
          <div class="option-container">
              @foreach ($question->answers as $answer)
                @php
                  $userAnswer = isset($ans[$question->id]) && json_decode($ans[$question->id], true)['id'] == $answer->id;
                  $isCorrect = $answer->is_correct;
                  $userSelectedCorrect = isset($ans[$question->id]) && json_decode($ans[$question->id], true)['is_correct'] == 1;
                @endphp
                <div class="form-check {{ $userAnswer ? ($userSelectedCorrect ? 'benar' : 'salah') : ($isCorrect ? 'benar' : '') }}" tabindex="0">
                  <span tabindex="0" class="form-check-input" name="quizOption" id="option{{ $answer->id }}" value="{{ $answer->id }}"></span>
                  <span>&nbsp</span>
                  <label tabindex="0" class="form-check-label" for="option{{ $answer->id }}">
                  {{ $answer->answer }}
                  <!-- @if ($userAnswer)
                    @if ($userSelectedCorrect)
                    <i class="uis uis-check-circle benar"></i>
                    @else
                      <i class="uis uis-times-circle salah"></i>
                    @endif
                  @endif -->
                  </label>
                </div>
              @endforeach
            </div>
        </div>
      @endforeach

      <div class="btn-group-back">
        <a href="{{ route('user.dashboard') }}" class="back-btn">Selesai Review</a>
      </div>
    </div>

    <script src="{{ asset('script.js') }}"></script>
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
    <script>
      document.querySelectorAll(".form-check, .form-check-label, .form-check-input").forEach((item) => {
        item.addEventListener("click", (event) => {
          const input = item.querySelector(".form-check-input");
          if (input) {
            input.checked = true;
          }
        });
        item.addEventListener("focus", (event) => {
          const formCheck = item.closest(".form-check");
          if (formCheck) {
            formCheck.classList.add("focused");
          }
        });
        item.addEventListener("blur", (event) => {
          const formCheck = item.closest(".form-check");
          if (formCheck) {
            formCheck.classList.remove("focused");
          }
        });
      });
    </script>
    <script>
      // Komentar
      document.getElementById("commentForm").addEventListener("submit", function (event) {
        event.preventDefault();
        let name = document.getElementById("name").value;
        let comment = document.getElementById("comment").value;

        let commentElement = document.createElement("div");
        commentElement.innerHTML = "<strong>" + name + ":</strong> " + comment;

        document.getElementById("comments").appendChild(commentElement);

        // Clear form
        document.getElementById("name").value = "";
        document.getElementById("comment").value = "";
      });
    </script>
  </body>
</html>
