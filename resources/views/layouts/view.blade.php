<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
<link rel="icon" href="{{ asset('storage/logo/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <style>
        .iti {
            width: 100%;
        }
        .iti__flag-container {
            margin-right: 12px;
        }
        .iti__input {
            width: 100%;
            box-sizing: border-box;
        }
        .iti--separate-dial-code .iti__flag-container {
            right: auto;
        }
        .iti--separate-dial-code input[type="tel"] {
            padding-left: 80px; /* Adjust based on the width of the country code */
        }
        .dot {
            height: 12px;
            width: 12px;
            background-color: gray;
            border-radius: 50%;
            display: inline-block;
        }
        .dot.active {
            background-color: blue;
        }
        .line {
            height: 40px;
            width: 2px;
            background-color: gray;
            margin-top: 4px;
        }
      .modal {
            display: none;
            z-index: 50;
        }
        .modal.active {
            display: flex;
        }
        .seat {
            cursor: pointer;
        }
        .seat.available {
            background-color: #10b981; /* Green for available */
            color: #fff;
        }
        .seat.occupied {
            background-color: #ef4444; /* Red for occupied */
            color: #fff;
            cursor: not-allowed;
        }
        .seat.selected {
            background-color: #3b82f6; /* Blue for selected */
            color: #fff;
        }
        .white-space {
        background-color: white;
        pointer-events: none; /* Disable click events */
    }
    </style>


    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Rezervare - ScorpanTur</title>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
    <header class="border-b-4 border-green-600">
        <div class="container mx-auto flex justify-between items-center py-4 px-12">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('storage/logo/scor.png') }}" class="w-48 h-26" alt="Logo">
                </a>
            </div>
            <!-- Hamburger Menu -->
            <div class="md:hidden">
                <button id="menu-btn" class="text-green-900 focus:outline-none">
                    <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
            <!-- Navigation Menu -->
            <nav id="menu" class="hidden md:flex space-x-8">
                <a href="https://scorpantur.com/" class="text-black hover:text-green-700">Acasă</a>
                <a href="https://scorpantur.com/?page_id=1313" class="text-black hover:text-green-700">Curse Ocazionale</a>
                <a href="https://scorpantur.com/?page_id=621" class="text-black hover:text-green-700">Despre Noi</a>
                <a href="https://scorpantur.com/?page_id=9" class="text-black hover:text-green-700">Contacte</a>
            </nav>
        </div>
        <!-- Mobile Menu -->
        <nav id="mobile-menu" class="hidden md:hidden ">
            <div class="flex flex-col items-center px-8 pt-4 pb-4 space-y-4 border-t-4 border-green-600">
                <a href="https://scorpantur.com/    " class="block text-black hover:text-green-700">Acasă</a>
                <a href="https://scorpantur.com/?page_id=1313" class="block text-black hover:text-green-700">Curse Ocazionale</a>
                <a href="https://scorpantur.com/?page_id=621" class="block text-black hover:text-green-700">Despre Noi</a>
                <a href="https://scorpantur.com/?page_id=9" class="block text-black hover:text-green-700">Contacte</a>
            </div>
        </nav>
    </header>


    <main class="flex-grow">
    @yield('content')
</main>

    <footer class="relative bg-cover bg-center bg-no-repeat mb-4" style="background-image: url('{{ asset('storage/logo/footer.png') }}');">
        <div class="bg-black bg-opacity-50 py-8 px-4">
            <div class="text-center text-white border-t border-b border-white py-8">
            <h2 class="text-4xl font-bold mb-4">Contactează-ne</h2>
            <p class="text-2xl font-bold mb-8">Rezervază Bilete pentru cursele spre București și Aeroportul Otopeni</p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 justify-center">
              <a href="tel:+1234567890" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full inline-flex items-center space-x-2 justify-center max-w-xs mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24c1.12.37 2.33.57 3.57.57c.55 0 1 .45 1 1V20c0 .55-.45 1-1 1c-9.39 0-17-7.61-17-17c0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1c0 1.25.2 2.45.57 3.57c.11.35.03.74-.25 1.02z"/></svg>
                <span>Telefon</span>
              </a>
              <a href="https://wa.me/1234567890" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-full inline-flex items-center space-x-2 justify-center max-w-xs mx-auto">
               <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 256 258"><defs><linearGradient id="logosWhatsappIcon0" x1="50%" x2="50%" y1="100%" y2="0%"><stop offset="0%" stop-color="#1faf38"/><stop offset="100%" stop-color="#60d669"/></linearGradient><linearGradient id="logosWhatsappIcon1" x1="50%" x2="50%" y1="100%" y2="0%"><stop offset="0%" stop-color="#f9f9f9"/><stop offset="100%" stop-color="#fff"/></linearGradient></defs><path fill="url(#logosWhatsappIcon0)" d="M5.463 127.456c-.006 21.677 5.658 42.843 16.428 61.499L4.433 252.697l65.232-17.104a123 123 0 0 0 58.8 14.97h.054c67.815 0 123.018-55.183 123.047-123.01c.013-32.867-12.775-63.773-36.009-87.025c-23.23-23.25-54.125-36.061-87.043-36.076c-67.823 0-123.022 55.18-123.05 123.004"/><path fill="url(#logosWhatsappIcon1)" d="M1.07 127.416c-.007 22.457 5.86 44.38 17.014 63.704L0 257.147l67.571-17.717c18.618 10.151 39.58 15.503 60.91 15.511h.055c70.248 0 127.434-57.168 127.464-127.423c.012-34.048-13.236-66.065-37.3-90.15C194.633 13.286 162.633.014 128.536 0C58.276 0 1.099 57.16 1.071 127.416m40.24 60.376l-2.523-4.005c-10.606-16.864-16.204-36.352-16.196-56.363C22.614 69.029 70.138 21.52 128.576 21.52c28.3.012 54.896 11.044 74.9 31.06c20.003 20.018 31.01 46.628 31.003 74.93c-.026 58.395-47.551 105.91-105.943 105.91h-.042c-19.013-.01-37.66-5.116-53.922-14.765l-3.87-2.295l-40.098 10.513z"/><path fill="#fff" d="M96.678 74.148c-2.386-5.303-4.897-5.41-7.166-5.503c-1.858-.08-3.982-.074-6.104-.074c-2.124 0-5.575.799-8.492 3.984c-2.92 3.188-11.148 10.892-11.148 26.561s11.413 30.813 13.004 32.94c1.593 2.123 22.033 35.307 54.405 48.073c26.904 10.609 32.379 8.499 38.218 7.967c5.84-.53 18.844-7.702 21.497-15.139c2.655-7.436 2.655-13.81 1.859-15.142c-.796-1.327-2.92-2.124-6.105-3.716s-18.844-9.298-21.763-10.361c-2.92-1.062-5.043-1.592-7.167 1.597c-2.124 3.184-8.223 10.356-10.082 12.48c-1.857 2.129-3.716 2.394-6.9.801c-3.187-1.598-13.444-4.957-25.613-15.806c-9.468-8.442-15.86-18.867-17.718-22.056c-1.858-3.184-.199-4.91 1.398-6.497c1.431-1.427 3.186-3.719 4.78-5.578c1.588-1.86 2.118-3.187 3.18-5.311c1.063-2.126.531-3.986-.264-5.579c-.798-1.593-6.987-17.343-9.819-23.64"/></svg>
                <span>WhatsApp</span>
              </a>
              <a href="viber://chat?number=1234567890" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-full inline-flex items-center space-x-2 justify-center max-w-xs mx-auto">
               <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M7.965 6.202a.822.822 0 0 0-.537.106h-.014c-.375.22-.713.497-1.001.823c-.24.277-.37.557-.404.827c-.02.16-.006.322.041.475l.018.01c.27.793.622 1.556 1.052 2.274a13.374 13.374 0 0 0 2.03 2.775l.024.034l.038.028l.023.027l.028.024a13.564 13.564 0 0 0 2.782 2.04c1.155.629 1.856.926 2.277 1.05v.006c.123.038.235.055.348.055a1.61 1.61 0 0 0 .964-.414c.325-.288.6-.627.814-1.004v-.007c.201-.38.133-.738-.157-.981A12.126 12.126 0 0 0 14.41 13c-.448-.243-.903-.096-1.087.15l-.393.496c-.202.246-.568.212-.568.212l-.01.006c-2.731-.697-3.46-3.462-3.46-3.462s-.034-.376.219-.568l.492-.396c.236-.192.4-.646.147-1.094a11.807 11.807 0 0 0-1.347-1.88a.748.748 0 0 0-.44-.263zM12.58 5a.5.5 0 0 0 0 1c1.264 0 2.314.413 3.145 1.205c.427.433.76.946.978 1.508c.219.563.319 1.164.293 1.766a.5.5 0 0 0 1 .042a5.359 5.359 0 0 0-.361-2.17a5.442 5.442 0 0 0-1.204-1.854l-.01-.01C15.39 5.502 14.085 5 12.579 5"/><path fill="currentColor" d="M12.545 6.644a.5.5 0 0 0 0 1h.017c.912.065 1.576.369 2.041.868c.477.514.724 1.153.705 1.943a.5.5 0 0 0 1 .023c.024-1.037-.31-1.932-.972-2.646V7.83c-.677-.726-1.606-1.11-2.724-1.185l-.017-.002z"/><path fill="currentColor" d="M12.526 8.319a.5.5 0 1 0-.052.998c.418.022.685.148.853.317c.169.17.295.443.318.87a.5.5 0 1 0 .998-.053c-.032-.6-.22-1.13-.605-1.52c-.387-.39-.914-.58-1.512-.612"/><path fill="currentColor" fill-rule="evenodd" d="M7.067 2.384a22.15 22.15 0 0 1 9.664 0l.339.075a5.155 5.155 0 0 1 3.872 3.763a19.718 19.718 0 0 1 0 9.7a5.155 5.155 0 0 1-3.872 3.763l-.34.075a22.15 22.15 0 0 1-6.077.499L8 22.633a.75.75 0 0 1-1.24-.435l-.439-2.622a5.155 5.155 0 0 1-3.465-3.654a19.717 19.717 0 0 1 0-9.7a5.155 5.155 0 0 1 3.872-3.763zm9.337 1.463a20.65 20.65 0 0 0-9.01 0l-.34.076A3.655 3.655 0 0 0 4.31 6.591a18.217 18.217 0 0 0 0 8.962a3.655 3.655 0 0 0 2.745 2.668l.09.02a.75.75 0 0 1 .576.608l.294 1.758l1.872-1.675a.75.75 0 0 1 .553-.19a20.653 20.653 0 0 0 5.964-.445l.339-.076a3.655 3.655 0 0 0 2.745-2.668c.746-2.94.746-6.021 0-8.962a3.655 3.655 0 0 0-2.745-2.668z" clip-rule="evenodd"/></svg>
                <span>Viber</span>
              </a>
            </div>
          </div>
        </div>
      </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>

    document.addEventListener('DOMContentLoaded', function() {
        const tripType = document.querySelector('input[name="trip_type"]:checked');
        const returnContainer = document.getElementById('return-container');
        if (tripType && tripType.value === 'dus-intors') {
            returnContainer.style.display = 'block';
        } else {
            returnContainer.style.display = 'none';
        }
    });

    function toggleReturnDate() {
        const tripType = document.querySelector('input[name="trip_type"]:checked').value;
        const returnContainer = document.getElementById('return-container');
        if (tripType === 'dus-intors') {
            returnContainer.style.display = 'block';
        } else {
            returnContainer.style.display = 'none';
        }
    }



        document.addEventListener('DOMContentLoaded', function () {
  const buttons = document.querySelectorAll('.currency-btn');
  const defaultButton = document.getElementById('default-currency');

  // Set the default selected button
  defaultButton.classList.add('bg-gray-200', 'text-gray-900');

  buttons.forEach(button => {
    button.addEventListener('click', function (event) {
      event.preventDefault();
      buttons.forEach(btn => btn.classList.remove('bg-gray-200', 'text-gray-900'));
      button.classList.add('bg-gray-200', 'text-gray-900');
      // Add additional logic to handle currency change here
    });
  });
});


const menuBtn = document.getElementById('menu-btn');
        const menu = document.getElementById('menu');
        const mobileMenu = document.getElementById('mobile-menu');

        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

    </script>
     <script>
    $(document).ready(function() {
        var input = document.querySelector("#phone");
        var iti = window.intlTelInput(input, {
            initialCountry: "md", // Set the initial country to Republic of Moldova
            separateDialCode: true,
            geoIpLookup: function(callback) {
                $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "md";
                    callback(countryCode);
                });
            },
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
        });

        // Remove the leading 0 from the placeholder
        input.addEventListener('countrychange', function() {
            var placeholder = iti.getPlaceholder();
            input.setAttribute('placeholder', placeholder.replace(/^0+/, ''));
        });
    });
</script>

</body>
</html>
