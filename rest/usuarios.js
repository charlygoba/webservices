
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    var nombre = JSON.parse(this.responseText);
    document.getElementById("nombre").innerHTML = nombre.us_nombre;
    var apellido = JSON.parse(this.responseText);
    document.getElementById("apellido").innerHTML = apellido.us_apellidop;
  }
};
xmlhttp.open("GET", "usuarios.php/users/1", true);
xmlhttp.send();

