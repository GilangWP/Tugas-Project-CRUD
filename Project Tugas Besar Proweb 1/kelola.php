<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/v/bs5/dt-1.13.8/datatables.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    
</head>

<body>
    <div class="wrapper">
        <?php include "header.php"; ?>
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="mb-3">
                        <div class="d-flex align-items-center justify-content-between my-3">
                            <h4>CC Dashboard</h4>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Tambah Data
                            </button>
                        </div>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Penambahan Data</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="addNewsForm">
                                        <div class="mb-3">
                                            <label for="judul" class="form-label">Judul</label>
                                            <input type="text" class="form-control" maxlength="50" id="judul" name="judul" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="deskripsi" class="form-label">Deskripsi</label>
                                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="url_image" class="form-label">Foto</label>
                                            <input type="file" class="form-control" name="url_image" id="url_image" accept="image/*" required>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" onclick="addNews()">Add Data</button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Table Element -->
                    <div class="card border-0">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="newsTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Judul</th>
                                            <th scope="col">Konten</th>
                                            <th scope="col">Gambar</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <a href="#" class="theme-toggle">
                <i class="fa-regular fa-moon"></i>
                <i class="fa-regular fa-sun"></i>
            </a>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a href="#" class="text-muted">
                                    <strong>CoderCraft</strong>
                                </a>
                            </p>
                        </div>
                        <div class="col-6 text-end">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="#" class="text-muted">Contact</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="text-muted">About Us</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="text-muted">Terms</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0\dist\js\bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- Jquery dan datatables js -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.8/datatables.min.js"></script>

    <script>
        function addNews(){
            const judul = document.getElementById("judul").value;
            const deskripsi = document.getElementById("deskripsi").value;
            const tanggal = new Date().toISOString().split('T')[0];
            const urlImageInput = document.getElementById("url_image");
            const url_image = urlImageInput.files[0];
            var formData = new FormData();
            formData.append('judul', judul);
            formData.append('deskripsi', deskripsi);
            formData.append('tanggal', tanggal);
            formData.append('url_image', url_image);
            axios
            .post("https://codercraftgames.000webhostapp.com/addnews.php", formData, {
                header: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then(function(response) {
                console.log(response.data);
                console.log(formData);
                alert(response.data);
                document.getElementById('addNewsForm').reset();
                $("#newsTable").DataTable().ajax.reload();
            })
            .catch(function(error) {
                console.error(error);
                alert("Error adding news.");
            });
        }
        function delNews(id){
            var formData = new FormData();
            formData.append('id', id);
            if(confirm("Are you sure you want to delete this news?")){
                axios
                    .post("https://codercraftgames.000webhostapp.com/delete-article.php", formData)
                    .then(function(response) {
                        alert(response.data);
                        $("#newsTable").DataTable().ajax.reload();
                    })
                    .catch(function(error) {
                        console.error(error);
                        alert("Error deleting news.");
                    });
            }
        }
    </script>
        <!-- Axios javascript -->
    <script>
        $(document).ready(function(){
            //initialize datatable
            var table = $('#newsTable').DataTable({
                "responsive": true,
                "processing": true,
                "serverSide": true,
                "ajax": function(data, callback, settings) {
                    axios.get('https://codercraftgames.000webhostapp.com/list-article.php', {
                        params: {
                            key: data.search.value
                        }
                    })
                    .then(function(response) {
                        //add a new property 'no' to each row
                        response.data.forEach(function(row, index) {
                            row.no = index + 1;
                        });

                        callback({
                            draw: data.draw,
                            recordsTotal: response.data.length,
                            recordsFiltered: response.data.length,
                            data: response.data
                        });
                    })
                    .catch(function(error) {
                        console.error(error);
                        alert('Error fetching news data.');
                    });
                },
                "columns": [{
                    "data": "no"
                },
                {
                    "data": "title" 
                },
                {
                    "data": "description"
                },
                {
                    "data": "img",
                    render: function(data, type, row) {
                        return '<img src="' + data + '" alt="image" style="max-width: 100px; max-height: 100px;">';
                    }
                },
                {
                    "data": null,
                    render: function(data, type, row) {
                        return '<button class="btn btn-danger btn-sm" onclick="delNews('+row.id+')">Delete</button>' +
                        '<form action="edit.php" method="post">' +
                        '<input type="hidden" name="id" value="' + row.id + '">' +
                        '<button type="submit" class="btn btn-primary btn-sm">Edit</button>' +
                        '</form>';
                    }
                }
                ]
            });
        });
    </script>
</body>

</html>