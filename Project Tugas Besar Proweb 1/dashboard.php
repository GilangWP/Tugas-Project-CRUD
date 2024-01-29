<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    
</head>

<body>
    <div class="wrapper">
        <?php include "header.php"; ?>
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h4 id="asd">Selamat Datang</h4>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 d-flex">
                            <div class="card flex-fill border-0 illustration">
                                <div class="card-body p-0 d-flex flex-fill">
                                    <div class="row g-0 w-100">
                                        <div class="col-6">
                                            <div class="p-3 m-1">
                                                <h4>Welcome Back, Player</h4>
                                                <p class="mb-0">Level 0</p>
                                            </div>
                                        </div>
                                        <div class="col-6 align-self-end text-end">
                                            <img src="images\profile_picture.jpeg" class="img-fluid illustration-img"
                                                alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 d-flex">
                            <div class="card flex-fill border-0">
                                <div class="card-body py-4">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
                                            <h4 class="mb-2">
                                                $ 78.00
                                            </h4>
                                            <p class="mb-2">
                                                Total Earnings
                                            </p>
                                            <div class="mb-0">
                                                <span class="badge text-success me-2">
                                                    +9.0%
                                                </span>
                                                <span class="text-muted">
                                                    Since Last Month
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Table Element -->
                    <div class="card border-0">
                        <div class="card-header">
                            <h5 class="card-title">
                            News Data Chart
                            </h5>
                            <h6 class="card-subtitle text-muted">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum ducimus,
                                necessitatibus reprehenderit itaque!
                            </h6>
                        </div>
       
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                   <!-- Donwload Excel -->
                                   <button onclick="downloadExcel()" class="btn btn-success mr-2">
                                        <i class="fas fa-download"></i>Unduh Excel
                                    </button>
                                
                                    <!-- Donwload PDF -->
                                    <button onclick="downloadPDF()" class="btn btn-danger">
                                        <i class="fas fa-download"></i>Unduh PDF
                                    </button>
                                </div>
                            <div class="col-md-6 offset-md-3 text-center">
                                <div class="card bg-success my-4">
                                    <div class="card-header">
                                    Akumulasi Berita
                                    </div>
                                        <div class="card-body">
                                            <h3 id="jumlahBerita" class="text-dark">
                                                <i class="fas fa-newspaper"></i> Loading...
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="tahunSelect">Pilih Tahun</label>
                                    <select class="form-control text-center" id="tahunSelect"></select>
                                </div>
                            </div>
                                <h2 class="text-center mt-3">GRAFIK JUMLAH BERITA DALAM 1 TAHUN</h2>
                            <div class="row">
                                <div class="col-md-12">
                                    <canvas id="newsChart" width="400" height="200"></canvas>
                                </div>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function logout() {
            // Mendapatkan session_token dari tempat penyimpanan yang sesuai (misalnya, cookie)
            const sessionToken = localStorage.getItem('session_token');
            // Hapus 'nama' dari localStorage saat logout
            localStorage.removeItem('nama');

            // Membuat objek FormData
            const formData = new FormData();
            formData.append('session_token', sessionToken);

            // Konfigurasi Axios untuk Logout
            axios.post('https://codercraftgames.000webhostapp.com/logout.php', formData)
                .then(response => {
                // Handle respons dari server
                if (response.data.status == 'success') {
                    // Jika logout berhasil, arahkan kembali ke halaman login
                    localStorage.removeItem('session_token');
                    window.location.href = 'login.php';
                } else {
                    // Jika logout gagal, tampilkan pesan kesalahan
                    alert('Logout failed. Please try again');
                }
                })
                .catch(error => {
                // Handle kesalahan koneksi atau server
                console.error('Error during logout', error);
                });
        }
            
    </script>

    <script>
        //Fungsi untuk mengambil data dari API berdasarkan tahun menggunakan axios.p
        function fetchData(tahun) {
            var formData = new FormData();
            formData.append('tahun', tahun);

            return axios ({
                method: 'post',
                url: 'https://codercraftgames.000webhostapp.com/sum_beritatahun.php',
                data: formData,
                headers: {'Content-Type': 'multipart/form-data'}
            });
        }

        // Fungsi untuk membuat chart dengan data yang diambil
        function createChart(data) {
            var ctx = document.getElementById('newsChart').getContext('2d');

            //Check if there is an existing chart and destroy it
            var existingChart = Chart.getChart(ctx);
            if (existingChart) {
                existingChart.destroy();
            }

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.map(item=>item.bulan),
                    datasets: [{
                        label: 'Jumlah Berita',
                        data: data.map(item=>item.jumlah_berita),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1 //Menetapkan langkah antar nilai pada sumbu
                            }
                        }
                    }
                }
            });
        }

        // Fungsi untuk mengisi select option dengan tahun
        function populateSelectedOptions(data) {
            var selectElement = document.getElementById('tahunSelect');
            data.forEach(item => {
                var option = document.createElement('option');
                option.value = item.tahun;
                option.text = item.tahun;
                selectElement.add(option);
            });
            
            //set default selected year to the latest year
            var latestYear = data[0].tahun;
            document.getElementById('tahunSelect').value = latestYear;

            // Fetch data and create the initial chart
            fetchData(latestYear)
            .then (response => {
                var chartData = response.data;
                createChart(chartData);
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
        }

        // Event listener untuk perubahan select option tahun
        document.getElementById('tahunSelect').addEventListener('change',function() {
            var selectedYear = this.value;
            fetchData(selectedYear)
            .then(response => {
                var chartData = response.data;
                createChart(chartData);
            })
            .catch(error => {
                console.error('Error fetching data', error);
            });
        });
        
        // Inisialisasi select option dengan data tahun dari API
        axios.get('https://codercraftgames.000webhostapp.com/select_tahun.php')
            .then(response => {
                var tahunData = response.data;
                populateSelectedOptions(tahunData);
                console.log(tahunData);
            })
            .catch(error => {
                console.error('Error fetching tahun data', error);
            });
    </script>
    <script>
        // Mengambil data jumlah berita dari API menggunakan AXIOS
        axios.get('https://codercraftgames.000webhostapp.com/sum_berita.php')
        .then(function(response) {
            // Memproses data yang diterima dari API 
            var dataJumlahBerita = response.data;

            //Mengambil elemen untuk menampilkan jumlah berita
            var jumlahBeritaElement = document.getElementById('jumlahBerita');

            // Menampilkan jumlah berita pada dashboard dengan font awesome icon
            jumlahBeritaElement.innerHTML = `<i class="fas fa-newspaper"></i> Jumlah Berita: ${dataJumlahBerita[0].jumlah_berita}`;
        })
        .catch(function(error) {
            console.error('Error fetching data', error);
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js">
    </script>
    <script>
                document.getElementById('asd').innerText = 'Selamat datang ' + localStorage.getItem('nama');
                function dashboard() {
                    window.location.href = "dashboard.php";
                }
                function kelola() {
                    window.location.href = "kelola.php";
                }
    </script>
    <script>
        function downloadExcel() {
            // Fetch data based on the Selected year
            var selectedYear = document.getElementById('tahunSelect').value;
            fetchData(selectedYear)
            .then(response=> {
                var data = response.data;

                //buat worksheet
                var ws = XLSX.utils.json_to_sheet(data);

                //Buat File Excel
                var wb = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(wb, ws, "Laporan");
                
                // Simpan file Excel dan unduh
                XLSX.writeFile(wb, "Laporan_excel_" + selectedYear + ".xlsx");
            })
            .catch(error=> {
                console.error('Error fetching data for Excel:', error);
            });
        }
        function downloadPDF(){
            //Ambil elemen canvas dari chart
            var canvas = document.getElementById('newsChart');

            // Konversi elemen canvas mnejadi gambar
            var imgData = canvas.toDataURL('image/png');

            //Ambil tahun terpilih dari dropdown
            var selectedYear = document.getElementById('tahunSelect').value;

            //Definisikan content untuk PDF menggunakan pdfmake
            var docDefinition = {
                content: [
                    { text: 'Laporan Tahun ' + selectedYear, style: 'header'},
                    { image: imgData, width: 500 },
                ],
                styles: {
                    header: {
                        fontSize: 18,
                        bold: true,
                        margin: [0,0,0,10],
                    },
                },
            };
            
            //Buat PDF Menggunakan pdfmake
            pdfMake.createPdf(docDefinition).download('laporan_' + selectedYear + '_pdf.pdf');
        }
    </script>

</body>

</html>
