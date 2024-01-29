<?php
include('check_session.php');

//Ambil ID dari $_POST
$id = isset($_POST['id']) ? $_POST['id'] : null;
?> 
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="wrapper">
        <?php include "header.php"; ?>
        <main class="content px-3 py-2 mt-4">
            <div class="container-fluid">
                <div class="card border-0">
                    <div class="card-body">
                        <h2 class="mb-4">Add News Form</h2>

                        <form id="addNewsForm">
                            <!-- Masukkan nilai $id langsung kedalam input hidden  -->
                            <input type="hidden" id="newsId" name="newsId" value="<?php echo $id; ?>">
                            <div class="mb-3">
                                <label for="judul" class="form-label">Title</label>
                                <input type="text" class="form-control" maxlength="50" id="judul" name="judul" required>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Description:</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="url_image" class="form-label">Image</label>
                                <input type="file" class="form-control" id="url_image" name="url_image" accept="image/*" required>
                            </div>

                            <button type="button" class="btn btn-primary mt-3" onclick="editNews()">Edit News</button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0\dist\js\bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        function getData() {
            const newsId = document.getElementById('newsId').value;
            var formData = new FormData();
            formData.append('id', newsId);
            //Lakukan permintaan ajax untuk mendapatkan data berita berdasarkan ID
            axios.post('https://codercraftgames.000webhostapp.com/selectdata.php', formData)
                .then(function(response) {
                    //isi nilai input dengan data yang diterima
                    document.getElementById('judul').value = response.data.title;
                    document.getElementById('deskripsi').value = response.data.description;
                })
                .catch(function(error) {
                    console.error(error);
                    alert('Error fetching news data');
                });
        }

        function editNews() {
            const newsId = document.getElementById("newsId").value;
            const judul = document.getElementById("judul").value;
            const deskripsi = document.getElementById("deskripsi").value;
            const urlImageInput = document.getElementById("url_image");
            const url_image = urlImageInput.files[0];
            const tanggal = new Date().toISOString().split('T')[0];
            
            //Get Form data
            var formData = new FormData();
            formData.append('id', newsId);
            formData.append('title', judul);
            formData.append('description', deskripsi);
            formData.append('tanggal', tanggal);

            if (urlImageInput.files.length > 0) {
                formData.append('url_image', url_image);
            } else {
                formData.append('url_image', null);
                //Tidak Perlu menambahkan 'url_image' karena tidak ada file yang dipilih 
            }
            //Lakukan permintaan AJAX untuk mengedit berita
            
            axios.post('https://codercraftgames.000webhostapp.com/editnews.php', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                },
            })
            .then(function(response) {
                console.log(response.data);
                alert(response.data); //Tampilkan pesan berhasil atau tanggapan yang sesuai
                window.location.href ='kelola.php';
            })
            .catch(function(error) {
                console.error(error);
                alert("Error editing news.");
            });
        }

        window.onload = getData;
    </script>
</body>