// tangkap keyword
var buku_keyword = document.getElementById("buku_keyword");
var list_buku = document.getElementById("list_buku");

// tambah event ketika diketik
buku_keyword.addEventListener("keyup", function () {
  // buat objek ajax
  var xhr = new XMLHttpRequest();
  // cek kesiapan ajax
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      list_buku.innerHTML = xhr.responseText;
    }
  };

  // eksekusi ajax
  xhr.open("GET", "app/ajax/list_buku.php?data=" + buku_keyword.value, true);
  xhr.send();
});
