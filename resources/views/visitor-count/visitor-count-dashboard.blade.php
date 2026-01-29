<x-app-layout>
    <div class="min-h-screen">
        <div class="w-full flex justify-center py-6 relative">
            <div class="rounded-lg w-11/12 max-w-7xl bg-white flex flex-col items-center py-5 px-6">

                @if (session('success'))
                    <div class="bg-green-500 text-white p-3 rounded-md mb-4 w-full">
                        <p class="text-sm font-medium">{{ session('success') }}</p>
                    </div>
                @endif

                <div class="flex items-center justify-between mb-5 w-full">
                    <h1 class="text-3xl font-bold drop-shadow" style="color: #b91c1c;">Visitor Count</h1>
                    
                    <!-- Settings Button -->
                    <button onclick="openSettingsModal()" class="px-6 py-2 bg-gray-700 text-white rounded-lg font-medium hover:bg-gray-800 transition flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Settings
                    </button>
                </div>

                <!-- Visitor Count Card -->
                <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-xl p-6 mb-6 w-full shadow-md">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 text-center">

                        <!-- Today -->
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Views Today</p>
                            <p class="text-4xl font-bold text-red-700">
                                {{ $daily_count }}
                            </p>
                        </div>

                        <!-- Month -->
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Views This Month</p>
                            <p class="text-4xl font-bold text-red-700">
                                {{ $monthly_count }}
                            </p>
                        </div>

                        <!-- Year -->
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Views This Year</p>
                            <p class="text-4xl font-bold text-red-700">
                                {{ $yearly_count }}
                            </p>
                        </div>

                    </div>
                </div>

                <!-- Chart View Controls -->
                <div class="flex gap-3 mb-5 w-full">
                    <button onclick="updateChart('daily')" id="dailyBtn" class="px-5 py-2 rounded-lg font-medium transition {{ $period == 'daily' ? 'bg-red-700 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        Daily
                    </button>
                    <button onclick="updateChart('monthly')" id="monthlyBtn" class="px-5 py-2 rounded-lg font-medium transition {{ $period == 'monthly' ? 'bg-red-700 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        Monthly
                    </button>
                    <button onclick="updateChart('yearly')" id="yearlyBtn" class="px-5 py-2 rounded-lg font-medium transition {{ $period == 'yearly' ? 'bg-red-700 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        Yearly
                    </button>
                </div>

                <!-- Line Graph -->
                <div class="bg-white rounded-xl p-5 w-full shadow-md border border-gray-200">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Visitor Trend</h3>
                    <canvas id="visitorChart" style="max-height: 350px;"></canvas>
                </div>

            </div>
        </div>
    </div>

    <!-- Settings Modal -->
    <div id="settingsModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg p-8 max-w-md w-full mx-4 shadow-2xl">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Settings</h2>
                <button onclick="closeSettingsModal()" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Homepage Display Period -->
            <form action="{{ route('visitor-count.homepage-period') }}" method="POST" class="mb-6">
                @csrf
                <label class="block text-sm font-semibold text-gray-700 mb-3">Select which period appears on the homepage.</label>
                <div class="space-y-2">
                    <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50 transition">
                        <input type="radio" name="homepage_period" value="daily" {{ $homepage_period == 'daily' ? 'checked' : '' }} class="mr-3 text-red-700 focus:ring-red-700">
                        <span class="text-gray-700">Daily</span>
                    </label>
                    <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50 transition">
                        <input type="radio" name="homepage_period" value="monthly" {{ $homepage_period == 'monthly' ? 'checked' : '' }} class="mr-3 text-red-700 focus:ring-red-700">
                        <span class="text-gray-700">Monthly</span>
                    </label>
                    <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50 transition">
                        <input type="radio" name="homepage_period" value="yearly" {{ $homepage_period == 'yearly' ? 'checked' : '' }} class="mr-3 text-red-700 focus:ring-red-700">
                        <span class="text-gray-700">Yearly</span>
                    </label>
                </div>
                <button type="submit" class="w-full mt-4 px-6 py-2 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition">
                    Update
                </button>
            </form>

            <hr class="my-6">

            <!-- Clear All Data -->
            <form action="{{ route('visitor-count.clear') }}" method="POST" onsubmit="return confirm('Are you sure you want to clear all visitor data? This action cannot be undone.');">
                @csrf
                @method('DELETE')
                <label class="block text-sm font-semibold text-gray-700 mb-3">Danger Zone</label>
                <button type="submit" class="w-full px-6 py-2 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700 transition flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Clear All Visitor Data
                </button>
            </form>
        </div>
    </div>

    <!-- Chart.js -->
    <script>
        // Chart data for all periods
        const chartDataAll = {
            daily: @json($daily_chart),
            monthly: @json($monthly_chart),
            yearly: @json($yearly_chart)
        };

        let currentChart;
        let currentPeriod = '{{ $period }}';

        function createChart(period) {
            const chartData = chartDataAll[period];
            const labels = chartData.map(d => d.label);
            const data = chartData.map(d => d.count);

            if (currentChart) {
                currentChart.destroy();
            }

            const ctx = document.getElementById('visitorChart').getContext('2d');
            currentChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Visitors',
                        data: data,
                        borderColor: '#b91c1c',
                        backgroundColor: 'rgba(185, 28, 28, 0.1)',
                        tension: 0.4,
                        fill: true,
                        borderWidth: 3,
                        pointRadius: 5,
                        pointBackgroundColor: '#b91c1c',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointHoverRadius: 7,
                        pointHoverBackgroundColor: '#991b1b',
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                font: { size: 14, weight: 'bold' },
                                color: '#374151'
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            titleFont: { size: 14, weight: 'bold' },
                            bodyFont: { size: 13 },
                            cornerRadius: 8
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                font: { size: 12 },
                                color: '#6b7280'
                            },
                            grid: { color: 'rgba(0, 0, 0, 0.05)' },
                            title: {
                                display: true,
                                text: 'Number of Visitors',
                                font: { size: 13, weight: 'bold' },
                                color: '#374151'
                            }
                        },
                        x: {
                            ticks: {
                                font: { size: 12 },
                                color: '#6b7280'
                            },
                            grid: { display: false }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    }
                }
            });
        }

        function updateChart(period) {
            currentPeriod = period;
            
            // Update button styles
            document.querySelectorAll('#dailyBtn, #monthlyBtn, #yearlyBtn').forEach(btn => {
                btn.classList.remove('bg-red-700', 'text-white');
                btn.classList.add('bg-gray-200', 'text-gray-700');
            });
            
            document.getElementById(period + 'Btn').classList.remove('bg-gray-200', 'text-gray-700');
            document.getElementById(period + 'Btn').classList.add('bg-red-700', 'text-white');
            
            createChart(period);
        }

        // Initialize chart when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            createChart(currentPeriod);
        });

        // Modal functions
        function openSettingsModal() {
            document.getElementById('settingsModal').classList.remove('hidden');
        }

        function closeSettingsModal() {
            document.getElementById('settingsModal').classList.add('hidden');
        }

        // Close modal on outside click
        document.getElementById('settingsModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeSettingsModal();
            }
        });
    </script>
</x-app-layout>