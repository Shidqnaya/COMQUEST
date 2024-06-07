<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{asset('build/quizpage.css')}}" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins" />

    <title>Quiz Page</title>
  </head>

  <body>
    <div class="content">
      <div class="btn-group-back">
        <a href="{{ route('user.quizzes.index', ['matkul' => $matkul->id, 'bab' => $bab->id]) }}" class="back-btn">Exit Quiz</a>
      </div>

      <div class="title">
        <i class="uil uil-paperclip"></i>
        <span class="text">[{{$matkul->name}}]</span><br>
        <span class="text">Quiz {{$quiz->name}} Bab {{$bab->name}}</span>
      </div>

      <div class="container">
        <!-- Question -->
        <form method="post" action="{{ route('user.quizzes.submit',['matkul' => $matkul->id,'bab' => $bab->id, 'quiz' => $quiz->id]) }}">
            @csrf
            @foreach($questions as $index =>  $ques)
                <div class="question-container" data-question="{{ $index + 1 }}" style="display: {{ $index === 0 ? 'block' : 'none' }};">
                    <span class="question">{{$ques->question}}</span>
                    <div class="option-container">
                        @foreach($ques->answers as $option)
                            <div class="form-check" tabindex="0">
                                <input type="radio" class="form-check-input" id="option{{ $option->id }}" name="answers[{{ $ques->id }}]" value="{{ json_encode(['is_correct' => $option->is_correct, 'id' => $option->id]) }}">
                                <span>&nbsp</span>
                                <label class="form-check-label" for="option{{ $option->id }}">{{ $option->answer }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

                <div class="btn-group-continue">
                    <button class="continue-btn" id="submit-btn" style="display: none;" type="submit">Submit</button>
                </div>
            </form>
            <div class="btn-group-continue">
                <button class="continue-btn" id="next-btn">Next</button>
            </div>
      </div>

      
    </div>

    <script src="script.js"></script>
    <script>
      // Pagination logic
      document.addEventListener('DOMContentLoaded', () => {
        const questions = document.querySelectorAll('.question-container');
        let currentQuestion = 0;
        console.log(questions.length);

        const nextBtn = document.getElementById('next-btn');
        const submitBtn = document.getElementById('submit-btn');

        nextBtn.addEventListener('click', () => {
          questions[currentQuestion].style.display = 'none';
          currentQuestion++;
          if (currentQuestion < questions.length) {
            questions[currentQuestion].style.display = 'block';
          }
          if (currentQuestion === questions.length - 1) {
            nextBtn.style.display = 'none';
            submitBtn.style.display = 'block';
          }
        });
      });

      // Theme logic
      function getTheme() {
        return localStorage.getItem("theme");
      }

      document.addEventListener("DOMContentLoaded", () => {
        const savedTheme = getTheme();
        if (savedTheme) {
          document.body.classList.add(savedTheme);
        }
      });

      // Form check logic
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
  </body>
</html>
