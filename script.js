window.onload = function(){
  // Check browser cache first, use if there and less than 5minutes old
  if(localStorage.when != null && parseInt(localStorage.when) + 300000 > Date.now()) {
    let freshness = Math.round((Date.now() - localStorage.when)/1000) + " second(s)";     //compares the current time with the old updated local storage
    var info = //Changing the fetched values using a place holder
    `<ul class="mid-input">
      <li id="city-name">${localStorage.city_name}</li>
      <li id="weather-condition">${localStorage.weather_condition}</li>
      <li id="temp">Temp: ${localStorage.temp}°C</li>
      <li id="pressure">Pressure: ${localStorage.pressure}hpa  </li>
      <li id="humid">Humidity: ${localStorage.humidity}%</li>
      <li id="wspeed">Wind Speed: ${localStorage.windspeed} km/hr</li>
    </ul>`
  document.getElementById("data").innerHTML = info;
    console.log(freshness);
  } else {
    //displaying the given location in default
    fetch('http://localhost:8100/index.php')
    .then(response => response.json())
    
    .then(data => {
      
      const celcius = Math.round(data.weather_temperature - 273); //Conversion of the temp from kelvin to celcius 
    
      var info = //Changing the fetched values using a place holder
        `
      <ul class="mid-input">
                  <li id="city-name">${data.city}</li>
                  <li id="weather-condition">${data.weather_description}</li>
                  <li id="temp">Temp: ${celcius}°C</li>
                  <li id="pressure">Pressure: ${data.pressure}hpa  </li>
                  <li id="humid">Humidity: ${data.weather_humidity}%</li>
                  <li id="wspeed">Wind Speed: ${data.weather_wind} km/hr</li>
              </ul>
        `
      document.getElementById("data").innerHTML = info;

      //storing the values from the api to local storage 
      localStorage.city_name = data.city;
      localStorage.weather_condition = data.weather_description;
      localStorage.temp = celcius;
      localStorage.pressure = data.pressure;
      localStorage.humidity = data.weather_humidity;
      localStorage.windspeed = data.weather_wind;
      localStorage.when = Date.now();
    })
    
    .catch(err => console.log(err));  //Error handling
    
    
    //Function for submit button!!
    function processed(){    
    alert("Coming soon...")
    }
  }
}