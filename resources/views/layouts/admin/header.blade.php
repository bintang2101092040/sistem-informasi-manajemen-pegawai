<!-- header.blade.php -->

<header class="navbar navbar-expand-md d-none d-lg-flex d-print-none">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
            aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-nav flex-row order-md-last">
            <div class="d-none d-md-flex">
                <!-- Dark Mode Toggle -->
                <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode"
                    data-bs-toggle="tooltip" data-bs-placement="bottom">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H24z" fill="none" />
                        <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
                    </svg>
                </a>
                <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode"
                    data-bs-toggle="tooltip" data-bs-placement="bottom">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24H24z" fill="none" />
                        <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                        <path
                            d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
                    </svg>
                </a>
            </div>
            <!-- Notification Dropdown -->
            <div class="nav-item dropdown d-none d-md-flex me-3">
                <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1"
                    aria-label="Show notifications" id="notification-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24H24z" fill="none" />
                        <path
                            d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
                        <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
                    </svg>
                    <span class="badge bg-red" id="pending-cuti-count" style="color: white"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Pengajuan Izin Pending</h3>
                        </div>
                        <div class="list-group list-group-flush list-group-hoverable" id="pending-cuti-list">
                            <!-- List of pending cuti requests will be appended here by JavaScript -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- User Dropdown -->
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                    aria-label="Open user menu">
                    <span class="avatar avatar-sm"
                        style="background-image: url({{ asset('tabler/static/avatars/000m.jpg') }})"></span>
                    <div class="d-none d-xl-block ps-2">
                        <div>{{ Auth::guard('user')->user()->name }}</div>
                        <div class="mt-1 small text-secondary">
                            {{ ucwords(Auth::guard('user')->user()->roles->pluck('name')[0]) }}
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    {{-- <a href="./settings.html" class="dropdown-item">Settings</a> --}}
                    <a href="/proseslogoutadmin" class="dropdown-item">Logout</a>
                </div>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbar-menu">
            <div>
                <form action="./" method="get" autocomplete="off" novalidate>
                    <div class="input-icon">
                        <span class="input-icon-addon">
                            <!-- Download SVG icon from http://tabler-icons.io/i/search -->

                        </span>
                        <input type="hidden" value="" class="form-control" placeholder="Search…"
                            aria-label="Search in website">
                    </div>
                </form>
            </div>
        </div>
    </div>
</header>

<!-- Tambahkan script ini di bagian bawah body sebelum closing tag </body> -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetchPendingCutiCount();

        function fetchPendingCutiCount() {
            fetch('/pending-cuti-count')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('pending-cuti-count').textContent = data.count;
                })
                .catch(error => console.error('Error fetching pending cuti count:', error));
        }

        document.getElementById('notification-icon').addEventListener('click', function() {
            fetchPendingCutiList();
        });

        function fetchPendingCutiList() {
            fetch('/pending-cuti-list')
                .then(response => response.json())
                .then(data => {
                    const listContainer = document.getElementById('pending-cuti-list');
                    listContainer.innerHTML = ''; // Clear existing list
                    if (data.length === 0) {
                        listContainer.innerHTML =
                            '<div class="list-group-item">No pending cuti requests</div>';
                    } else {
                        data.forEach(item => {
                            const listItem = document.createElement('a');
                            listItem.className = 'list-group-item';
                            listItem.href = `/presensi/izinsakit`;
                            listItem.style.width = '400px'; // Menambahkan padding
                            listItem.style.marginBottom = '0.5rem'; // Jarak antar item
                            // Change the URL if needed
                            listItem.innerHTML = `
                                <div class="row align-items-center">
                                    <div class="col-auto"><span class="status-dot status-dot-animated bg-red d-block"></span></div>
                                    <div class="col text-truncate">
                                        <a href="" class="text-body d-block">${item.nama_lengkap}</a>
                                        <div class="d-block text-secondary text-truncate mt-n1">
                                           Tanggal: ${formatTanggal(item.tgl_izin_dari)} - ${formatTanggal(item.tgl_izin_sampai)}
                                            <br>
                                            Status: <div class="badge ${getBadgeClass(item.status_izin)}" style="color: white;">${getStatusLabel(item.status_izin)}</div>
                                        </div>
                                    </div>
                                </div>
                            `;
                            listContainer.appendChild(listItem);
                        });
                    }
                })
                .catch(error => console.error('Error fetching pending cuti list:', error));
        }

        function getStatusLabel(status) {
            switch (status) {
                case 'i':
                    return 'Izin';
                case 's':
                    return 'Sakit';
                case 'c':
                    return 'Cuti';
                default:
                    return 'Unknown';
            }
        }

        function getBadgeClass(status) {
            switch (status) {
                case 'i':
                    return 'bg-info'; // Biru muda untuk Izin
                case 's':
                    return 'bg-danger'; // Merah untuk Sakit
                case 'c':
                    return 'bg-success'; // Hijau untuk Cuti
                default:
                    return 'bg-secondary'; // Abu-abu untuk status tidak dikenal
            }
        }

        function formatTanggal(tanggal) {
            const options = {
                day: '2-digit',
                month: 'long',
                year: 'numeric',
                locale: 'id-ID'
            };
            return new Intl.DateTimeFormat('id-ID', options).format(new Date(tanggal));
        }
    });
</script>
