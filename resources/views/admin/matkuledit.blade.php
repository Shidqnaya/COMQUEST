<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{asset('build/creatematkul.css')}}" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins" />

    <title>Document</title>
  </head>

  <body>
    <div class="content">
      <div class="btn-group-back">
        <a href="/dashboard" class="back-btn">Go To Dashboard</a>
      </div>

      <div class="profileContainer">
            <div class="title">
                <i class="uil uil-paperclip"></i>
                <span class="text">Edit Matkul</span>
            </div>
            <form action="{{ route('admin.matkul.update', $matkul->id) }}" method="post">
                @csrf
                @method('PUT')
                <p>
                    <label for="url_foto" class="text">Quiz Picture (optional)</label><br />
                    <input class="form-control" type="file" name="url_foto" id="url_foto" autocomplete="off" />
                </p>
                <p>
                    <label for="name" class="text">Matkul name</label><br />
                    <input class="form-control" type="text" name="name" id="name" required autocomplete="off" placeholder="Enter matkul name, e.g., 'Pemrograman'" value="{{$matkul->name}}" />
                </p>
                <p>
                    <label for="code" class="text">Matkul code</label><br />
                    <input class="form-control" type="text" name="code" id="code" required autocomplete="off" placeholder="Enter matkul code, e.g., 'KOM120C'" value="{{$matkul->code}}" />
                </p>
                <p>
                    <label for="semester" class="text">Semester</label><br />
                    <input class="form-control" type="text" name="semester" id="semester" required autocomplete="off" placeholder="Enter in the format 'S number', e.g., 'S4'"value="{{$matkul->semester}}" />
                </p>
                <div class="button-container">
                    <button class="btn" type="submit" name="update">UPDATE</button>
                </div>
            </form>
        </div>
    </div>
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
    <!---
    <script>
      //komennnnnnnnnnnnnnnnnnnnnn
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
    -->
  </body>
</html>
