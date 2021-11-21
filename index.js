let map;

let api_key="AIzaSyABYfdNAPibREcz-3Clw0sKIQlkW6QzgLg";
function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: -34.397, lng: 150.644 },
    zoom: 8,
  });
}