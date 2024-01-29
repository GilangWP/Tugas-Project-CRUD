<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    // Fungsi memeriksa session 
    function checkSession() {
    // Ambil Session token dari localStorage 
        //Membuat objek formData 
        const formData = new FormData();
        formData.append('session_token', localStorage.getItem('session_token'));

        //kirim session_token ke server untuk memeriksanya 
        axios.post('https://codercraftgames.000webhostapp.com/session.php', formData)
        .then(response => {
            //Handle respons dari server 
            console.log(response);
            if (response.data.status == 'success') {
                // Jika session masih aktif, arahkan ke halaman dashboard.php   
                const nama = response.data.hasil.name || 'Default Name';
                localStorage.setItem('nama', nama);
            } else {
                //jika session tidak aktif, lakukan yang sesuai (Misalnya, tampilkan pesanan)
                window.location.href = 'login.php';
            }
        })
        .catch(error => {
            //Handle kesalahan koneksi atau server 
            console.error('Error checking response', error);
        });
    }
    //Panggil fungsi checkSession saat halaman dimuat
    checkSession();
</script>