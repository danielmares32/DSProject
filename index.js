let map;

let api_key="AIzaSyABYfdNAPibREcz-3Clw0sKIQlkW6QzgLg";
function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 21.9338292, lng: -102.3196637 },
    zoom: 8,
  });
}