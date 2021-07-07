var statusTransaksi = document.getElementById("statusTransaksi");

function status() {
  // buat objek ajax
  var xhr = new XMLHttpRequest();
  // cek kesiapan ajax
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      console.log(xhr.responseText);
      window.location = "index.php?pages=transaksi&views=index";
    }
  };

  // eksekusi ajax
  xhr.open("GET", "app/ajax/status.php?id=" + statusTransaksi.value, true);
  xhr.send();
}
