// chart.js

document.addEventListener('DOMContentLoaded', () => {
    console.log("Chart JS Loaded");

    // Example: Chart.js initialization
    if (typeof Chart !== 'undefined') {
        const ctx = document.getElementById('taskChart');
        if (ctx) {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Pending', 'In Progress', 'Completed'],
                    datasets: [{
                        label: 'Tasks',
                        data: [12, 19, 7],
                        backgroundColor: [
                            'rgba(231, 76, 60, 0.7)',
                            'rgba(241, 196, 15, 0.7)',
                            'rgba(46, 204, 113, 0.7)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    }
});
