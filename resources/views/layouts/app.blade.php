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
    <link rel="icon" href="{{ asset('storage/logo/scor.png') }}" type="image/png">

    <style>
        /* custom.css */
        button.bg-green-500 {
            background-color: #48bb78 !important; /* Tailwind green-500 */
        }

        button.hover\:bg-green-700:hover {
            background-color: #2f855a !important; /* Tailwind green-700 */
        }

        button.text-white {
            color: #ffffff !important;
        }

        button.font-bold {
            font-weight: 700 !important;
        }

        button.py-2 {
            padding-top: 0.5rem !important;
            padding-bottom: 0.5rem !important;
        }

        button.px-4 {
            padding-left: 1rem !important;
            padding-right: 1rem !important;
        }

        button.rounded {
            border-radius: 0.25rem !important;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <title>ScorpanTur- Admin</title>
</head>
<body class="text-gray-800 font-inter">
    <!--sidenav -->
    <div class="fixed left-0 top-0 w-64 h-full bg-[#f8f4f3] p-4 z-50 sidebar-menu transition-transform">
        <a href="{{ url('/dashboards') }}" class="flex items-center pb-4 border-b border-b-gray-800">
            <img src="{{ asset('storage/logo/outbox.png') }}" class='w-48 h-26' alt="Logo">
        </a>
        <ul class="mt-4">
            @auth
            <span class="text-gray-400 font-bold">ADMIN</span>
            <li class="mb-1 group">
                <a href="{{ url('/dashboards') }}" class="flex font-semibold items-center py-2 px-4 rounded-md {{ request()->is('dashboards') ? 'bg-gray-950 text-gray-100' : 'text-gray-900 hover:bg-gray-950 hover:text-gray-100' }}">
                    <i class="ri-home-2-line mr-3 text-lg"></i>
                    <span class="text-md">Acasă</span>
                </a>
            </li>
            @if(auth()->user()->admin_level == 1)
            <li class="mb-1 group">
                <a href="{{ url('/destinations') }}" class="flex font-semibold items-center py-2 px-4 rounded-md {{ request()->is('destinations*') ? 'bg-gray-950 text-gray-100' : 'text-gray-900 hover:bg-gray-950 hover:text-gray-100' }}">
                    <i class='bx bx-map mr-3 text-lg'></i>
                    <span class="text-md">Destinații</span>
                </a>
            </li>
            @endif            
            @if(auth()->user()->admin_level == 1)
            <li class="mb-1 group">
                <a href="{{ url('/routes') }}" class="flex font-semibold items-center py-2 px-4 rounded-md {{ request()->is('routes*') || request()->is('stops*') ? 'bg-gray-950 text-gray-100' : 'text-gray-900 hover:bg-gray-950 hover:text-gray-100' }}">
                    <i class='bx bx-bus mr-3 text-lg'></i>
                    <span class="text-md">Rute</span>
                </a>
            </li>
            @endif
            @if(auth()->user()->admin_level == 1)
            <li class="mb-1 group">
                <a href="{{ url('/contacts') }}" class="flex font-semibold items-center py-2 px-4 rounded-md {{ request()->is('contacts*') ? 'bg-gray-950 text-gray-100' : 'text-gray-900 hover:bg-gray-950 hover:text-gray-100' }}">
                    <i class='bx bx-bus mr-3 text-lg'></i>
                    <span class="text-md">Contacte</span>
                </a>
            </li>
            @endif
            <span class="text-gray-400 font-bold">Setări</span>
            @if(auth()->user()->admin_level == 1)
            <li class="mb-1 group">
                <a href="{{ url('/users') }}" class="flex font-semibold items-center py-2 px-4 rounded-md {{ request()->is('users*') ? 'bg-gray-950 text-gray-100' : 'text-gray-900 hover:bg-gray-950 hover:text-gray-100' }}">
                    <i class='bx bx-user mr-3 text-lg'></i>
                    <span class="text-md">Administratori</span>
                </a>
            </li>
            @endif
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <li class="mb-1 group">
                    <button type="submit" class="flex font-semibold items-center py-2 px-4 text-gray-900 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                        <i class='bx bx-log-out mr-3 text-lg'></i>
                        <span class="text-md">Logout</span>
                    </button>
                </li>
            </form>
            @endauth
        </ul>
    </div>    
    <div class="fixed top-0 left-0 w-full h-full bg-black/50 z-40 md:hidden sidebar-overlay"></div>
    <!-- end sidenav -->
    <main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-200 min-h-screen transition-all main">
        <!-- navbar -->
        <div class="py-2 px-6  bg-[#f8f4f3] flex items-center shadow-md shadow-black/5 sticky top-0 left-0 z-30">
            <button type="button" class="text-4xl mt-2 mb-2 text-gray-900 font-semibold sidebar-toggle">
                <i class="ri-menu-line"></i>
            </button>
        </div>
        <!-- end navbar -->

      <!-- Content -->
      <div class="mx-6 mt-6">
      @yield('content')
    </div>
      <!-- End Content -->
    </main>

    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
     // start: Sidebar
    const sidebarToggle = document.querySelector('.sidebar-toggle')
    const sidebarOverlay = document.querySelector('.sidebar-overlay')
    const sidebarMenu = document.querySelector('.sidebar-menu')
    const main = document.querySelector('.main')
    
    // Load sidebar state from localStorage
    if (localStorage.getItem('sidebarState') === 'open') {
        main.classList.add('active')
        sidebarOverlay.classList.remove('hidden')
        sidebarMenu.classList.remove('-translate-x-full')
    }

    sidebarToggle.addEventListener('click', function (e) {
        e.preventDefault()
        main.classList.toggle('active')
        sidebarOverlay.classList.toggle('hidden')
        sidebarMenu.classList.toggle('-translate-x-full')
        
        // Save sidebar state to localStorage
        if (main.classList.contains('active')) {
            localStorage.setItem('sidebarState', 'open')
        } else {
            localStorage.setItem('sidebarState', 'closed')
        }
    })
    
    sidebarOverlay.addEventListener('click', function (e) {
        e.preventDefault()
        main.classList.remove('active')
        sidebarOverlay.classList.add('hidden')
        sidebarMenu.classList.add('-translate-x-full')
        localStorage.setItem('sidebarState', 'closed')
    })

    document.querySelectorAll('.sidebar-dropdown-toggle').forEach(function (item) {
        item.addEventListener('click', function (e) {
            e.preventDefault()
            const parent = item.closest('.group')
            if (parent.classList.contains('selected')) {
                parent.classList.remove('selected')
            } else {
                document.querySelectorAll('.sidebar-dropdown-toggle').forEach(function (i) {
                    i.closest('.group').classList.remove('selected')
                })
                parent.classList.add('selected')
            }
        })
    })

    // end: Sidebar

    // start: Popper
    const popperInstance = {}
    document.querySelectorAll('.dropdown').forEach(function (item, index) {
        const popperId = 'popper-' + index
        const toggle = item.querySelector('.dropdown-toggle')
        const menu = item.querySelector('.dropdown-menu')
        menu.dataset.popperId = popperId
        popperInstance[popperId] = Popper.createPopper(toggle, menu, {
            modifiers: [
                {
                    name: 'offset',
                    options: {
                        offset: [0, 8],
                    },
                },
                {
                    name: 'preventOverflow',
                    options: {
                        padding: 24,
                    },
                },
            ],
            placement: 'bottom-end'
        });
    })

    document.addEventListener('click', function (e) {
        const toggle = e.target.closest('.dropdown-toggle')
        const menu = e.target.closest('.dropdown-menu')
        if (toggle) {
            const menuEl = toggle.closest('.dropdown').querySelector('.dropdown-menu')
            const popperId = menuEl.dataset.popperId
            if (menuEl.classList.contains('hidden')) {
                hideDropdown()
                menuEl.classList.remove('hidden')
                showPopper(popperId)
            } else {
                menuEl.classList.add('hidden')
                hidePopper(popperId)
            }
        } else if (!menu) {
            hideDropdown()
        }
    })

    function hideDropdown() {
        document.querySelectorAll('.dropdown-menu').forEach(function (item) {
            item.classList.add('hidden')
        })
    }

    function showPopper(popperId) {
        popperInstance[popperId].setOptions(function (options) {
            return {
                ...options,
                modifiers: [
                    ...options.modifiers,
                    { name: 'eventListeners', enabled: true },
                ],
            }
        });
        popperInstance[popperId].update();
    }

    function hidePopper(popperId) {
        popperInstance[popperId].setOptions(function (options) {
            return {
                ...options,
                modifiers: [
                    ...options.modifiers,
                    { name: 'eventListeners', enabled: false },
                ],
            }
        });
    }
    // end: Popper

    // start: Tab
    document.querySelectorAll('[data-tab]').forEach(function (item) {
        item.addEventListener('click', function (e) {
            e.preventDefault()
            const tab = item.dataset.tab
            const page = item.dataset.tabPage
            const target = document.querySelector('[data-tab-for="' + tab + '"][data-page="' + page + '"]')
            document.querySelectorAll('[data-tab="' + tab + '"]').forEach(function (i) {
                i.classList.remove('active')
            })
            document.querySelectorAll('[data-tab-for="' + tab + '"]').forEach(function (i) {
                i.classList.add('hidden')
            })
            item.classList.add('active')
            target.classList.remove('hidden')
        })
    })
    // end: Tab

    // start: Chart
    </script>
</body>
</html>
