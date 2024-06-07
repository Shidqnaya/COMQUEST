<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{asset('build/createquiz.css')}}" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins" />

    <title>Document</title>
  </head>

  <body>
    <div class="content">
      <div class="btn-group-back">
        <a href="{{route('admin.quiz.create', $bab->id)}}" class="back-btn">Back to Quiz</a>
      </div>

      <span class="text">{{$matkul->name}}</span>
      <div class="title">
        <i class="uil uil-paperclip"></i>
        <span class="text">Quiz {{$quiz->name}} Bab {{$bab->name}}</span>
      </div>

      <div class="container">
        <form action="{{ route('admin.soal.store', [$bab->id, $quiz->id]) }}" method="post">
                @csrf
              <div class="question-container">
                <textarea class="form-control question" type="text" name="question" id="question" required autocomplete="off" placeholder="masukkan question disini"></textarea>
              </div>

              <!-- <div class="option-container">
                INIKOSONG
              </div> -->
            </div>

            <div class="btn-group-continue">
              <button class="continue-btn" type="submit" name="update">TAMBAH SOAL</button>
            </div>
      </form>
      <div class="title">
        <i class="uil uil-paperclip"></i>
        <span class="text">Preview Soal</span>
      </div>

      @foreach($quiz->questions as $question)
      <div class="container">

          <form action="{{ route('admin.soal.update', [$bab->id, $quiz->id, $question->id]) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('PUT')
            <textarea class="question-containerform-control question" type="text" name="question" id="question" required autocomplete="off" placeholder="question">{{$question->question}}</textarea>
          <div class="button-container">
            <button class="btn tambahopsi" type="submit">
              Simpan Soal
            </button>
            </div>
          </form>

          <div class="button-container">
          <form action="{{ route('admin.soal.destroy', [$bab->id, $quiz->id, $question->id]) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button class="btn tambahopsi" type="submit">
              <i class="uil uil-trash-alt"></i> Hapus Soal
            </button>
          </form>
        </div>

        <div class="option-container">
        <form action="{{ route('admin.opsi.store', $question->id) }}" method="post"
        style="margin-top: 20px; margin-bottom: 20px; width: 100%;">
          @csrf
          <div class="form-check" tabindex="0">
            <span>&nbsp</span>
            <textarea tabindex="0" class="form-check-label question" for="answer" placeholder="masukan opsi" class="form-control" type="text" name="answer" id="answer" required autocomplete="off"></textarea>

            <div class="button-container">
              <label><input type="radio" name="is_correct" id="is_correct" value=1 />Correct</label><br>
              <label><input type="radio" name="is_correct" id="is_correct" value=0 />Wrong</label>
              <button class="btn opsi" type="submit" name="tambahkanOpsi">TAMBAH OPSI</button>
            </div>
          </div>
        </form>
          OPSI
          <!-- disini tampilin opsi -->
          @foreach($question->answers as $option)
          <div class="form-check" tabindex="0">
            <span>&nbsp</span>
            

              <form action="{{  route('admin.opsi.update', [$bab->id, $quiz->id, $question->id, $option]) }}" method="POST" style="display:flex; flex-direction:row; justify-content:space-between; width: 100%;">
                @csrf
                @method('PUT')
                <textarea tabindex="0" class="form-check-label question" for="answer" placeholder="masukan opsi" class="form-control" type="text" name="answer" id="answer" required autocomplete="off">{{$option->answer}}</textarea>
                <label><input type="radio" name="is_correct" id="is_correct" value="1" {{ $option->is_correct == 1 ? 'checked' : '' }} />Correct</label>
                <label><input type="radio" name="is_correct" id="is_correct" value="0" {{ $option->is_correct == 0 ? 'checked' : '' }} />Wrong</label>
                <div class="button-container" style="margin-left: 10px;">
                  <button class="btn tambahopsi" type="submit">
                    Update Opsi
                  </button>
                </div>
              </form>

              <form action="{{ route('admin.opsi.destroy', [$bab->id, $quiz->id, $question->id, $option] ) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button class="button-container btnnn tambahopsi" type="submit">
                  Hapus opsi
                </button>
              </form>

            <!-- <div class="button-container">
              <a href="{{ route('admin.opsi.destroy', [$bab->id, $quiz->id, $question->id, $option] ) }}" class="trash" name="update"><i class="uil uil-trash-alt"></i></a>
            </div> -->
          </div>
          @endforeach
        </div>
      </div>
      @endforeach
    </div>

    <script src="script.js"></script>
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
