<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Mapas - EcoSync</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <style>
    html, body {
      height: 100%;
      margin: 0;
    }
    #map {
      height: 100%;
      width: 100%;
    }
    .back-btn {
      position: absolute;
      top: 15px;
      left: 15px;
      background: #2e7d32;
      color: #fff;
      border: none;
      border-radius: 8px;
      padding: 10px 15px;
      text-decoration: none;
      font-weight: bold;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }
    .back-btn:hover {
      background: #1b5e20;
    }
  </style>
</head>
<body>
  <a href="painel.php" class="back-btn">⬅ Voltar</a>
  <div id="map"></div>

<script>
    // ... (Mantenha o código anterior, mas substitua a parte do event listener) ...

    var currentLatLng = null;
    var destinationLatLng = null; // Nova variável para armazenar as coordenadas de destino

    function getCurrentLocation() {
        if ("geolocation" in navigator) {
            navigator.geolocation.getCurrentPosition(function(position) {
                currentLatLng = L.latLng(position.coords.latitude, position.coords.longitude);
                map.setView(currentLatLng, 15);
                L.marker(currentLatLng).addTo(map).bindPopup("Sua Localização").openPopup();
                loadSavedRoutes(); // Chama a função para carregar as rotas salvas
            }, function(error) {
                alert("Erro ao obter a sua localização. Verifique as permissões do navegador.");
                loadSavedRoutes(); // Chama a função mesmo se a localização falhar
            });
        } else {
            alert("Geolocalização não é suportada por este navegador.");
            loadSavedRoutes();
        }
    }

    // Carrega a localização assim que a página carrega
    getCurrentLocation();

    // Evento de clique para traçar a rota
    document.getElementById('route-button').addEventListener('click', function() {
        const destinationAddress = document.getElementById('destination-address').value;
        if (!destinationAddress) {
            alert("Por favor, digite o endereço de destino.");
            return;
        }

        const geocodingUrl = `https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(destinationAddress)}&format=json&limit=1`;
        fetch(geocodingUrl)
            .then(response => response.json())
            .then(data => {
                if (data && data.length > 0) {
                    destinationLatLng = L.latLng(parseFloat(data[0].lat), parseFloat(data[0].lon));
                    drawRoute(currentLatLng, destinationLatLng);
                    // Mostra o botão de salvar a rota
                    document.getElementById('save-route-container').style.display = 'block';
                } else {
                    alert("Não foi possível encontrar o endereço de destino.");
                }
            })
            .catch(error => {
                console.error('Erro na geocodificação:', error);
                alert("Ocorreu um erro ao buscar o endereço.");
            });
    });

    // Função para traçar a rota no mapa
    function drawRoute(origem, destino) {
        if (!origem || !destino) return;

        if (window.routingControl) {
            map.removeControl(window.routingControl);
        }

        window.routingControl = L.Routing.control({
            waypoints: [
                origem,
                destino
            ],
            routeWhileDragging: false,
            show: false,
            language: 'pt-BR',
            lineOptions: {
                styles: [{
                    color: '#2e7d32',
                    weight: 6
                }]
            },
            collapsible: true
        }).addTo(map);

        map.fitBounds(L.latLngBounds([origem, destino]));
    }
    
    // ...

    // Evento de clique para salvar a rota
    document.getElementById('save-button').addEventListener('click', function() {
        const routeName = document.getElementById('route-name').value;
        if (!routeName) {
            alert("Por favor, digite um nome para a rota.");
            return;
        }
        if (!currentLatLng || !destinationLatLng) {
            alert("Nenhuma rota foi traçada para ser salva.");
            return;
        }

        const routeData = {
            nome_rota: routeName,
            origem_lat: currentLatLng.lat,
            origem_lng: currentLatLng.lng,
            destino_lat: destinationLatLng.lat,
            destino_lng: destinationLatLng.lng
        };

        fetch('salvar_rota.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(routeData)
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.success) {
                // Atualiza a lista de rotas salvas
                loadSavedRoutes();
                // Opcionalmente, esconde o container de salvar
                document.getElementById('save-route-container').style.display = 'none';
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            alert("Ocorreu um erro ao salvar a rota.");
        });
    });

    // Função para buscar e exibir as rotas salvas
    function loadSavedRoutes() {
        fetch('carregar_rotas.php')
            .then(response => response.json())
            .then(routes => {
                const savedRoutesContainer = document.getElementById('saved-routes-container');
                savedRoutesContainer.innerHTML = '<h4>Rotas Salvas:</h4>';
                
                if (routes.length === 0) {
                    savedRoutesContainer.innerHTML += '<p>Nenhuma rota salva.</p>';
                } else {
                    const ul = document.createElement('ul');
                    routes.forEach(route => {
                        const li = document.createElement('li');
                        li.textContent = route.nome_rota;
                        li.style.cursor = 'pointer';
                        li.onclick = function() {
                            const origem = L.latLng(route.origem_lat, route.origem_lng);
                            const destino = L.latLng(route.destino_lat, route.destino_lng);
                            drawRoute(origem, destino);
                        };
                        ul.appendChild(li);
                    });
                    savedRoutesContainer.appendChild(ul);
                }
            })
            .catch(error => {
                console.error('Erro ao carregar rotas:', error);
            });
    }

</script>



<div class="search-container">
    <input type="text" id="destination-address" placeholder="Digite o endereço de destino...">
    <button id="route-button">Traçar Rota</button>

    <div id="save-route-container" style="display: none; margin-top: 10px;">
        <input type="text" id="route-name" placeholder="Nome da rota (ex: Casa -> Trabalho)">
        <button id="save-button">Salvar Rota</button>
    </div>
</div>





</body>
</html>