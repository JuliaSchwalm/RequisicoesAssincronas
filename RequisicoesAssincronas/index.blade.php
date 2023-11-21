<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
<form>

    <label id="titulo-diferente">Verifique a temperatura na sua cidade</label><br><br>
        <label>Cidade:</label>
        <input type="text" id="cidade" name="cidade" placeholder="Cidade" oninput="carregaTemperatura(this.value);">
        <br>
        <label>Estado:</label>
        <input type="text" id="estado" name="estado" placeholder="Estado" oninput="carregaTemperatura(this.value);">
        <br>
        <label>País:</label>
        <input type="text" id="pais" name="pais" placeholder="País" oninput="carregaTemperatura(this.value);">
        <br>
        <br>
        <label>Temperatura:</label>
        <input type="text" id="temperatura" name="temperatura" readonly>
        <br>
        <img id="weather-icon" src=".\assets\temp.png" alt="Condição do Tempo">
    </form>
</body>

</html>

<script>
    function carregaTemperatura() {

        let xhr = new XMLHttpRequest();
        let cidade = document.getElementById("cidade").value;
        let estado = document.getElementById("estado").value;
        let pais = document.getElementById("pais").value;
        let url1 = 'https://api.api-ninjas.com/v1/geocoding?city=' + cidade + '&state=' + estado + '&country=' + pais;
        xhr.open('GET', url1, true);
        xhr.setRequestHeader('X-API-Key', 'Qmn2GPdFoOYy3xr8IBR8pw==C9QBsD6J2oqsDNZJ');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    let obj = JSON.parse(xhr.responseText)[0];
                    let url2 = `https://api.open-meteo.com/v1/forecast?latitude=${obj.latitude.toFixed(6)}&longitude=${obj.longitude.toFixed(6)}&current_weather=true`;

                    let xhr2 = new XMLHttpRequest();
                    xhr2.open('GET', url2, true);
                    xhr2.onreadystatechange = function () {
                        if (xhr.readyState === 4) {
                            if (xhr.status === 200) {
                                let obj2 = JSON.parse(xhr2.responseText);
                               atualizaCampos(obj2.current_weather);
                            }
                        }
                    }
                    xhr2.send();
                }
                else {
                    alert("ATENÇÃO, status=" + xhr.status);
                }
            }
        }
        xhr.send();

    }
    function atualizaCampos(json) {
        document.getElementById("temperatura").value = json.temperature;
        }




</script>