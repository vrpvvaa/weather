<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Погода в городах</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Текущая погода</h1>

    <!-- Выпадающий список для выбора города -->
    <select id="citySelect">
        <option value="524901">Москва</option>
        <option value="498817">Санкт-Петербург</option>
        <option value="551487">Казань</option>
        <option value="501175">Ростов-на-Дону</option>
        <option value="1486209">Екатеринбург</option>
    </select>

    <!-- Блок для отображения погоды -->
    <div id="weather">
        <p>Выберите город для отображения погоды.</p>
    </div>

    <script>
        $(document).ready(function() {
            // Функция для запроса погоды для выбранного города
            function getWeather(cityId) {
                $.ajax({
                    url: 'get_weather.php',
                    type: 'GET',
                    data: { city_id: cityId },
                    success: function(data) {
                        var weather = JSON.parse(data);
                        var html = "<p>Температура: " + weather.main.temp + "°C</p>";
                        html += "<p>Описание: " + weather.weather[0].description + "</p>";
                        html += "<p>Влажность: " + weather.main.humidity + "%</p>";
                        $('#weather').html(html);
                    },
                    error: function() {
                        $('#weather').html('<p>Ошибка при получении данных</p>');
                    }
                });
            }

            // При изменении выбранного города
            $('#citySelect').change(function() {
                var cityId = $(this).val();
                getWeather(cityId);
            });

            // Загружаем погоду для города по умолчанию (например, для Москвы)
            getWeather($('#citySelect').val());
        });
    </script>
</body>
</html>