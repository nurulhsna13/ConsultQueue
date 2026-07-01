// ==========================
// ConsultQueue Javascript
// ==========================

function kirimPesan(){

    alert("Terima kasih.\n\nPesan berhasil dikirim.");

}

function konfirmasiHapus(){

    return confirm("Yakin ingin menghapus data ini?");

}

function logout(){

    return confirm("Yakin ingin logout?");

}

// Menampilkan tahun otomatis pada footer jika diperlukan
document.addEventListener("DOMContentLoaded", function(){

    let tahun = document.getElementById("tahun");

    if(tahun){

        tahun.innerHTML = new Date().getFullYear();

    }

});