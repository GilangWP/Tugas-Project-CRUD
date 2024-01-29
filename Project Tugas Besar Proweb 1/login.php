<!DOCTYPE html>
<html lang="en">
<head>
    <link href='https://fonts.googleapis.com/css?family=Chakra Petch' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap-5.2.3-dist/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body id="logbg">
    <div class="container d-flex align-items-center vh-100">
        <div class="card col-5 mx-auto">
            <div class="card-body">
                <h1 class="mb-5 mt-4 text-center" style="font-family: 'Chakra Petch';font-size: 50px;">Login</h1>
    <form>
        <!-- Email input -->
        <div class="form-outline mb-4">
          <input id="username" type="text" class="form-control" placeholder="Username" name="username" required />
        </div>
      
        <!-- Password input -->
        <div class="form-outline mb-4">
          <input id="password" type="password" class="form-control" placeholder="Password" name="password" required />
        </div>
      
        <!-- 2 column grid layout for inline styling -->
        <div class="row mb-4">
          <div class="col d-flex justify-content-center">
            <!-- Checkbox -->
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
              <label class="form-check-label" for="form2Example31"> Remember me </label>
            </div>
          </div>
      
          <div class="col">
            <!-- Simple link -->
            <a href="#!">Forgot password?</a>
          </div>
        </div>
      
        <!-- Submit button -->
        <!-- <input type="submit" class="btn btn-primary btn-block mb-4" href="Dashboard.html" value="Log in"/> onclick="login()" -->
        <button type="button" onclick="login()" class="btn btn-primary btn-block mb-4 mx-auto">Login</button>

        <!-- Register buttons -->
        <div class="text-center">
          <p>Not a member? <a href="">Register!</a></p>
          
        </div>
      </form>  
            </div>
        </div>
    </div>
    <!-- <script src="script.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
      //Fungsi Login
      function login() {
        //Mendapatkan nilai dari form
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        //membuat objek FormData
        const formData = new FormData();
        formData.append('user', username);
        formData.append('pwd', password);

        // Konfigurasi Axios 
        axios.post('https://codercraftgames.000webhostapp.com/login2.php', formData)
        .then(response => {
          console.log(response);
          // Handle respons dari server 
          if (response.data.status ==  'success' ) {
            //jika login berhasil, buka dashboard
            const sessionToken = response.data.session_token;
            localStorage.setItem('session_token', sessionToken);
            window.location.href = 'index.php';
          } else {
            // Jika login gagal, tampilkan pesan kesalahan 
            alert('Login failed. Please check your credentials.');
          }
        })
        .catch(error => {
          // Handle kesalahan koneksi atau server 
          console.error('Error during login', error);
        });
      }
    </script>
</body>
</html>