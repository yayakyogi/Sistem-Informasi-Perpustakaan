// ambil keyword
var anggota_keyword = document.getElementById("anggota_keyword");
var list_anggota = document.getElementById("list_anggota");
var select = document.getElementById("select");

// tambahkan event ketika form diketik
anggota_keyword.addEventListener("keyup", function () {
  // buat objek ajax
  var xhr = new XMLHttpRequest();
  // cek kesiapan ajax
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      list_anggota.innerHTML = xhr.responseText;
      anggota_keyword.value = "value";
    }
  };
  // eksekusi ajax
  xhr.open(
    "GET",
    "app/ajax/list_anggota.php?data=" + anggota_keyword.value,
    true
  );
  xhr.send();
});
