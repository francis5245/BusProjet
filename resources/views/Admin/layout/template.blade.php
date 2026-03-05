<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name') }} - @yield('title')</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Admin Styles -->
    <link rel="stylesheet" href="{{ asset('asset/css/Admin.css') }}" />
</head>

<body>
    {{-- Sidbar --}}
    @include('Admin.layout.sidbar')
    <div class="content">


        {{-- menu --}}
        @include('Admin.layout.menu')
        {{-- content --}}
        @yield('content')


        <div class="loading" id="loadingScreen" style="display: none;">
            <div class="loading-spinner"></div>
            <p>Please wait...</p>
        </div>
    </div>
    <script src="{{ asset('asset/js/Admin.js') }}"></script>
    <script>
        // Show loading screen
        showLoading();
        hideLoadingAfterDelay(1500);

        // Initialize Charts
        function initializeCharts() {
            // Yearly Chart
            const yearlyCtx = document.getElementById('yearlyChart').getContext('2d');
            new Chart(yearlyCtx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Income',
                        data: [25000, 28000, 30000, 32000, 35000, 38000, 40000, 42000, 45000, 48000, 50000,
                            52000
                        ],
                        backgroundColor: '#00c6ff',
                        borderColor: '#0072ff',
                        borderWidth: 1
                    }, {
                        label: 'Expense',
                        data: [12000, 13000, 14000, 15000, 16000, 17000, 18000, 19000, 20000, 21000, 22000,
                            23000
                        ],
                        backgroundColor: '#ff6a00',
                        borderColor: '#ee0979',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return '$' + value / 1000 + 'k';
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    }
                }
            });

            // Weekly Chart
            const weeklyCtx = document.getElementById('weeklyChart').getContext('2d');
            new Chart(weeklyCtx, {
                type: 'line',
                data: {
                    labels: ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                    datasets: [{
                        label: 'Income',
                        data: [200, 500, 1200, 1800, 1500, 800, 300],
                        borderColor: '#00c6ff',
                        backgroundColor: 'rgba(0, 198, 255, 0.1)',
                        fill: true,
                        tension: 0.4
                    }, {
                        label: 'Expense',
                        data: [100, 300, 800, 1000, 1200, 600, 200],
                        borderColor: '#0072ff',
                        backgroundColor: 'rgba(0, 114, 255, 0.1)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    }
                }
            });

            // Payment Chart
            const paymentCtx = document.getElementById('paymentChart').getContext('2d');
            new Chart(paymentCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Cash', 'Credit Card', 'Mobile Payment', 'Bank Transfer', 'Other'],
                    datasets: [{
                        data: [30, 25, 20, 15, 10],
                        backgroundColor: ['#00c6ff', '#0072ff', '#ff6a00', '#ee0979', '#8e44ad'],
                        borderColor: '#fff',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        }
                    }
                }
            });

            // Monthly Ticket Chart
            const monthlyTicketCtx = document.getElementById('monthlyTicketChart').getContext('2d');
            new Chart(monthlyTicketCtx, {
                type: 'line',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                        'October', 'November', 'December'
                    ],
                    datasets: [{
                        label: 'Tickets Booked',
                        data: [120, 150, 180, 200, 220, 240, 260, 280, 300, 320, 340, 360],
                        borderColor: '#0072ff',
                        backgroundColor: 'rgba(0, 114, 255, 0.1)',
                        fill: true,
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });

            // Agent Chart
            const agentCtx = document.getElementById('agentChart').getContext('2d');
            new Chart(agentCtx, {
                type: 'bar',
                data: {
                    labels: ['Agent 01', 'Agent 02', 'Agent 03', 'Agent 04', 'Agent 05'],
                    datasets: [{
                        label: 'Sales',
                        data: [660, 4532, 3200, 2800, 1500],
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.7)',
                            'rgba(54, 162, 235, 0.8)',
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(54, 162, 235, 0.4)'
                        ],
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        }

        // Initialize charts after loading
        setTimeout(initializeCharts, 1600);

        // Animate stats counters
        function animateCounter(element, target) {
            let current = 0;
            const increment = target / 50;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    element.textContent = target;
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(current);
                }
            }, 30);
        }

        // Start counters after loading
        setTimeout(() => {
            const tripElement = document.querySelector('.stat-number');
            if (tripElement) {
                animateCounter(tripElement, 4);
            }
        }, 1700);

        // Dynamic Clock
        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            document.getElementById('clock').textContent = `${hours}:${minutes}:${seconds}`;
        }

        // Update clock every second
        setInterval(updateClock, 1000);
        updateClock();

        // Handle page visibility
        document.addEventListener('visibilitychange', function() {
            if (!document.hidden) {
                updateClock();
            }
        });

        // Bootstrap tooltip initialization
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



</html>
