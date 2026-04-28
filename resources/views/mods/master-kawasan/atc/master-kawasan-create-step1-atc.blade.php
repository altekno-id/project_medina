@push('js-push')
    <script>
        let map;
        let marker;
        let searchBox;
        let mapInitialized = false;

        function initMap() {
            const mapElement = document.getElementById("map");
            const searchElement = document.getElementById("map-search");

            if (!mapElement || !searchElement) {
                return;
            }

            const defaultLocation = {
                lat: Number(@js($form['master_kawasans']['latitude'] ?? 1.6660311220282815)),
                lng: Number(@js($form['master_kawasans']['longitude'] ?? 101.4011585618487)),
            };

            map = new google.maps.Map(mapElement, {
                center: defaultLocation,
                zoom: 13,
            });

            marker = new google.maps.Marker({
                position: defaultLocation,
                map: map,
                draggable: true,
            });

            function updateLatLng(lat, lng) {
                marker.setPosition({
                    lat,
                    lng
                });
                map.panTo({
                    lat,
                    lng
                });

                @this.set('form.master_kawasans.latitude', lat, false);
                @this.set('form.master_kawasans.longitude', lng, false);
            }

            marker.addListener("dragend", function(event) {
                updateLatLng(
                    event.latLng.lat(),
                    event.latLng.lng()
                );
            });

            map.addListener("click", function(event) {
                updateLatLng(
                    event.latLng.lat(),
                    event.latLng.lng()
                );
            });

            searchBox = new google.maps.places.SearchBox(searchElement);

            map.addListener("bounds_changed", function() {
                searchBox.setBounds(map.getBounds());
            });

            searchBox.addListener("places_changed", function() {
                const places = searchBox.getPlaces();

                if (!places || places.length === 0) {
                    return;
                }

                const place = places[0];

                if (!place.geometry || !place.geometry.location) {
                    return;
                }

                const lat = place.geometry.location.lat();
                const lng = place.geometry.location.lng();

                updateLatLng(lat, lng);
                map.setZoom(16);
            });

            mapInitialized = true;
        }

        document.addEventListener('livewire:init', function() {
            Livewire.on('init-map', function() {
                setTimeout(function() {
                    if (typeof google !== 'undefined' && google.maps) {
                        initMap();
                    }
                }, 300);
            });
        });
    </script>

    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ config('app.map_api') }}&libraries=places&callback=initMap"
        async
        defer></script>
@endpush
