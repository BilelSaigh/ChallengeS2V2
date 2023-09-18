function getRoleName(role) {
    switch (role) {
        case 0:
            return 'Admin';
        case 1:
            return 'Editor';
        case 2:
            return 'Moderator';
        case 3:
            return 'User';
        default:
            return 'Unknown Role';
    }
}

document.addEventListener("DOMContentLoaded", function () {
    const chartCanvas = document.getElementById('userChart');
    const chartDataJSON = chartCanvas.getAttribute('data-newUsers');
    const chartData = JSON.parse(chartDataJSON);

    const visitorChartCanvas = document.getElementById('visitorChart');
    const visitorChartDataJSON = visitorChartCanvas.getAttribute('data-visitors');
    const visitorChartData = JSON.parse(visitorChartDataJSON);

    const visitorCtx = visitorChartCanvas.getContext('2d');
    const ctx = chartCanvas.getContext('2d');

    let currentPeriod = 'byWeek'; // Initial period
    let userChart = null;
    let visitorChart = null;
    const destroyCurrentChart = () => {
        if (userChart !== null || visitorChart !== null ) {
            userChart.destroy();
            visitorChart.destroy();
        }
    };


    const updateChart = () => {
        destroyCurrentChart();
        const periodData = chartData[currentPeriod];
        const labels = periodData.map(entry => entry[currentPeriod === 'byMonth' ? 'month' : currentPeriod === 'byWeek' ? 'week' : 'day']);
        const users = periodData.map(entry => entry.total_count);
        const visitors = periodData.map(entry => entry.total_count);


        userChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: `New Users by ${currentPeriod === 'byMonth' ? 'Month' : currentPeriod === 'byWeek' ? 'Week' : 'Day'}`,
                    data: users,
                    backgroundColor: 'rgba(75, 192, 192, 0.7)',
                }],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        stepSize: 1
                    }
                }
            }
        });
        visitorChart = new Chart(visitorCtx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: `Visitors by ${currentPeriod === 'byMonth' ? 'Month' : currentPeriod === 'byWeek' ? 'Week' : 'Day'}`,
                    data: visitors,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                }],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        stepSize: 1
                    }
                }
            }
        });
    };

    updateChart(); // Initialize the chart with the initial period

    const periodButton = document.getElementById('periodButton');
    periodButton.addEventListener('change', () => {
        currentPeriod = periodButton.value;
        console.log(currentPeriod)
        updateChart();
    });
});

// document.addEventListener("DOMContentLoaded", function () {
//     const chartCanvas = document.getElementById('userChart');
//     const chartDataJSON = chartCanvas.getAttribute('data-newUsers');
//     const chartData = JSON.parse(chartDataJSON);
//
//     const ctx = chartCanvas.getContext('2d');
//
//
//     const visitorChartCanvas = document.getElementById('visitorChart');
//     const visitorChartDataJSON = visitorChartCanvas.getAttribute('data-visitors');
//     const visitorChartData = JSON.parse(visitorChartDataJSON);
//     console.log(visitorChartData)
//
//     const visitorCtx = visitorChartCanvas.getContext('2d');
//
//     let currentPeriod = 'byWeek'; // Initial period
//     let currentChart = null;
//
//     const destroyCurrentChart = () => {
//         if (currentChart !== null) {
//             console.log(currentChart)
//             currentChart.destroy();
//         }
//     };
//
//     const updateChart = () => {
//         destroyCurrentChart();
//
//         const periodData = currentPeriod === 'byWeek' ? chartData.byWeek : chartData.byMonth; // Adjust based on your data structure
//         const visitorData = visitorChartData[currentPeriod];
//
//         const labels = periodData.map(entry => entry[currentPeriod === 'byMonth' ? 'month' : currentPeriod === 'byWeek' ? 'week' : 'day']); // Adjust based on your data structure
//         const users = periodData.map(entry => entry.total_count);
//         const visitors = visitorData.map(entry => entry.total_count);
//
//         currentChart = new Chart(ctx, {
//             type: 'bar',
//             data: {
//                 labels: labels,
//                 datasets: [{
//                     label: `New Users by ${currentPeriod === 'byMonth' ? 'Month' : 'Week'}`,
//                     data: users,
//                     backgroundColor: 'rgba(75, 192, 192, 0.7)',
//                 }],
//             },
//             options: {
//                 scales: {
//                     y: {
//                         beginAtZero: true,
//                         stepSize: 1
//                     }
//                 }
//             }
//         });
//
//         currentChart = new Chart(visitorCtx, {
//             type: 'line',
//             data: {
//                 labels: labels,
//                 datasets: [{
//                     label: `Visitors by ${currentPeriod === 'byMonth' ? 'Month' : 'Week'}`,
//                     data: visitors,
//                     borderColor: 'rgba(255, 99, 132, 1)',
//                     backgroundColor: 'rgba(255, 99, 132, 0.2)',
//                 }],
//             },
//             options: {
//                 scales: {
//                     y: {
//                         beginAtZero: true,
//                         stepSize: 1
//                     }
//                 }
//             }
//         });
//     };
//
//     updateChart(); // Initialize the chart with the initial period
//
//     const periodButton = document.getElementById('periodButton');
//     periodButton.addEventListener('change', () => {
//         currentPeriod = periodButton.value;
//         updateChart();
//     });
// });
// document.addEventListener("DOMContentLoaded", function () {
//     const userChartCanvas = document.getElementById('userChart');
//     const userDataJSON = userChartCanvas.getAttribute('data-newUsers');
//     const userData = JSON.parse(userDataJSON);
//     const userCtx = userChartCanvas.getContext('2d');
//
//     const visitorChartCanvas = document.getElementById('visitorChart');
//     const visitorDataJSON = visitorChartCanvas.getAttribute('data-visitors');
//     const visitorData = JSON.parse(visitorDataJSON);
//     const visitorCtx = visitorChartCanvas.getContext('2d');
//
//     let currentPeriod = 'byWeek'; // Initial period
//     let userChart = null;
//     let visitorChart = null;
//     const destroyCurrentChart = () => {
//         if (userChart !== null || visitorChart !== null ) {
//             userChart.destroy();
//             visitorChart.destroy();
//         }
//     };
//
//     const updateCharts = () => {
//         destroyCurrentChart();
//         const userPeriodData = userData[currentPeriod];
//         const userLabels = userPeriodData.map(entry => entry[currentPeriod === 'byMonth' ? 'month' : currentPeriod === 'byWeek' ? 'week' : 'day']);
//         const userUsers = userPeriodData.map(entry => entry.total_count);
//
//         const visitorPeriodData = visitorData[currentPeriod];
//         const visitorLabels = visitorPeriodData.map(entry => entry[currentPeriod === 'byMonth' ? 'month' : currentPeriod === 'byWeek' ? 'week' : 'day']);
//         const visitors = visitorPeriodData.map(entry => entry.total_count);
//         console.log(visitors)
//
//
//          userChart = new Chart(userCtx, {
//
//             type: 'bar',
//             data: {
//                 labels: userLabels,
//                 datasets: [{
//                     label: `New Users by ${currentPeriod === 'byMonth' ? 'Month' : 'Week'}`,
//                     data: userUsers,
//                     backgroundColor: 'rgba(75, 192, 192, 0.7)',
//                 }],
//             },
//             options: {
//                 scales: {
//                     y: {
//                         beginAtZero: true,
//                         stepSize: 1
//                     }
//                 }
//             }
//         });
//
//          visitorChart = new Chart(visitorCtx, {
//             type: 'line',
//             data: {
//                 labels: visitorLabels,
//                 datasets: [{
//                     label: `Visitors by ${currentPeriod === 'byMonth' ? 'Month' : currentPeriod === 'byWeek' ? 'Week' : 'Day'}`,
//                     data: visitors,
//                     borderColor: 'rgba(255, 99, 132, 1)',
//                     // backgroundColor: 'rgba(255, 99, 132, 0.2)',
//                 }],
//             },
//              options: {
//                  responsive: true,
//                  indexAxis: 'y',
//                  plugins: {
//                      legend: {
//                          position: 'top',
//                      },
//                      title: {
//                          display: true,
//                          text: 'Chart.js Line Chart'
//                      }
//                  },
//                  scales: {
//                      y: {
//                          beginAtZero: true,
//                          stepSize: 1
//                      },
//                      x: {
//                          beginAtZero: true
//                      }
//                  }
//              },
//         });
//     };
//
//     updateCharts(); // Initialize the charts with the initial period
//
//     const periodButton = document.getElementById('periodButton');
//     periodButton.addEventListener('change', () => {
//         currentPeriod = periodButton.value;
//         updateCharts();
//     });
// });
// document.addEventListener("DOMContentLoaded", function () {
//     const userChartCanvas = document.getElementById('userChart');
//     const userDataJSON = userChartCanvas.getAttribute('data-newUsers');
//     const userData = JSON.parse(userDataJSON);
//     const userCtx = userChartCanvas.getContext('2d');
//     let userChart = null; // Keep track of user chart instance
//
//     const visitorChartCanvas = document.getElementById('visitorChart');
//     const visitorDataJSON = visitorChartCanvas.getAttribute('data-visitors');
//     const visitorData = JSON.parse(visitorDataJSON);
//     const visitorCtx = visitorChartCanvas.getContext('2d');
//     let visitorChart = null; // Keep track of visitor chart instance
//
//     let currentPeriod = 'byWeek'; // Initial period
//
//     const updateCharts = () => {
//         // Destroy existing charts if they exist
//         if (userChart !== null) {
//             userChart.destroy();
//         }
//         if (visitorChart !== null) {
//             visitorChart.destroy();
//         }
//
//         const userPeriodData = userData[currentPeriod];
//         const userLabels = userPeriodData.map(entry => entry[currentPeriod === 'byMonth' ? 'month' : currentPeriod === 'byWeek' ? 'week' : 'day']);
//         const userUsers = userPeriodData.map(entry => entry.total_count);
//
//         const visitorPeriodData = visitorData[currentPeriod];
//         const visitorLabels = visitorPeriodData.map(entry => entry[currentPeriod === 'byMonth' ? 'month' : currentPeriod === 'byWeek' ? 'week' : 'day']);
//         const visitorVisitors = visitorPeriodData.map(entry => entry.total_count);
//
//         userChart = new Chart(userCtx, {
//             type: 'bar',
//             data: {
//                 labels: userLabels,
//                 datasets: [{
//                     label: `New Users by ${currentPeriod === 'byMonth' ? 'Month' : 'Week'}`,
//                     data: userUsers,
//                     backgroundColor: 'rgba(75, 192, 192, 0.7)',
//                 }],
//             },
//             options: {
//                 scales: {
//                     y: {
//                         beginAtZero: true,
//                         stepSize: 1
//                     }
//                 }
//             }
//         });
//         visitorChart = new Chart(visitorCtx, {
//             type: 'line',
//             data: {
//                 labels: visitorLabels,
//                 datasets: [{
//                     label: `Visitors by ${currentPeriod === 'byMonth' ? 'Month' : 'Week'}`,
//                     data: visitorVisitors,
//                     borderColor: 'rgba(255, 99, 132, 1)',
//                     backgroundColor: 'rgba(255, 99, 132, 0.2)',
//                 }],
//             },
//             options: {
//                 scales: {
//                     y: {
//                         beginAtZero: true,
//                     }
//                 }
//             }
//         });
//     };
//
//     updateCharts(); // Initialize the charts with the initial period
//
//     const periodButton = document.getElementById('periodButton');
//     periodButton.addEventListener('change', () => {
//         currentPeriod = periodButton.value;
//         updateCharts();
//     });
// });
