@extends('layouts.geomir')
@section('header')
    @include('layouts.navigation')
@endsection

@section('content')
<title>About Us</title>
    <style>
        .contenedor {
            height: 80vh;
            margin: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #C084FC; /* Color de fons opcional */
        }

        .title {
            font-size: 3em;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .image-container {
            position: relative;
            width: 400px; /* Ajusta la mida de la imatge aquí */
            height: 400px; /* Ajusta la mida de la imatge aquí */
            margin-bottom: 10px;
        }

        .image-container img {
            position: absolute;
            width: 100%;
            height: 100%;
            transition: all 0.5s ease;
        }

        .serious-image {
            filter: grayscale(100%);
        }

        .funny-image {
            display: none;
            filter: contrast(150%);
        }

        .image-container:hover .serious-image {
            transform: scaleX(-1);
        }

        .image-container:hover .funny-image {
            display: block;
        }

        .person-info {
            text-align: center;
        }

        .name, .role, .hobby {
            display: block;
            font-weight: bold;
        }

        .hobby {
            display: none;
        }

        .image-container:hover + .person-info .role {
            display: none;
        }

        .image-container:hover + .person-info .hobby {
            display: block;
        }

        /* Estils addicionals per al modal */
        .modal-content {
            background-color: purple;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .modal-content iframe {
            max-width: 100%;
            border-radius: 5px;
        }


    </style>
    
    <div class="contenedor">
        <div class="title">About Us</div>
        <div class="image-container" id="modal-button">
            <img src="{{ asset('img/serio.jpg') }}" alt="Serious" class="serious-image">
            <img src="{{ asset('img/contento.jpeg') }}" alt="Funny" class="funny-image">
            <audio id="music1" src="{{ asset('img/sonido.mp3') }}"></audio>
        </div>
        <div class="person-info">
            <div class="name">Óscar Gómez</div>
            <div class="role">Frontend Developer</div>
            <div class="hobby">Backend Developer</div>
        </div>

        <div id="video-modal" class="hidden fixed inset-0 z-50 overflow-auto bg-gray-500 bg-opacity-75">
            <div class="flex items-center justify-center h-full">
                <div class="bg-white p-8 rounded shadow-md">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/OyBu98vj-rU?si=_fNXQEwnd5FqRGrc" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe><button id="modal-close-button" class="mt-4 p-2 bg-gray-700 text-white rounded">Close</button>
                </div>
            </div>
        </div>

    </div>

    <script>
        document.querySelectorAll('.image-container').forEach(function(container) {
            var audio = container.querySelector('audio');

            container.onmouseover = function() {
                audio.play();
            };

            container.onmouseout = function() {
                audio.pause();
            };
        });

        const modal = document.getElementById('video-modal');
        const modalButton = document.getElementById('modal-button');
        const modalCloseButton = document.getElementById('modal-close-button');

        modalButton.addEventListener('click', function () {
            modal.classList.toggle('hidden');
        });

        modalCloseButton.addEventListener('click', function () {
            modal.classList.toggle('hidden');
        });

    </script>

@endsection

@section('footer')
    <footer class="bg-gray-800 text-white">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center flex-col sm:flex-row">
                <div class="mb-6 sm:mb-0">
                    <a href="/" class="text-xl font-bold text-purple-400 hover:text-gray-300">
                        GeoApp
                    </a>
                </div>
                
                <div class="flex space-x-6">
                    <a href="#!" class="text-gray-400 hover:text-gray-300">
                        <span class="sr-only">Facebook</span>
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#!" class="text-gray-400 hover:text-gray-300">
                        <span class="sr-only">Twitter</span>
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#!" class="text-gray-400 hover:text-gray-300">
                        <span class="sr-only">Instagram</span>
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#!" class="text-gray-400 hover:text-gray-300">
                        <span class="sr-only">LinkedIn</span>
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
                
            <div class="text-center mt-8">
                <p>
                    &copy; {{ date('Y') }} GeoApp. 
                    All rights reserved.
                </p>
                <p class="mt-1">
                    Privacy Policy | Terms and Conditions
                </p>
            </div>
        </div>
    </footer>

@endsection