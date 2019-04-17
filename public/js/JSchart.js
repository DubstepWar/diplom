/*window.onload = function() {
    getData();

};
function getData() {
    let row=[];
    let coll=[];
    $.ajax({ url: "/korresp_chart",
        success: function(data){
            data[0].forEach(function(item, i, data) {
                coll.push(item)
            });data[1].forEach(function(item, i, data) {
                row.push(item)
            });
            var ctx = document.getElementById("myChart");

            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: row,
                    datasets: [{
                        label: 'KORRESP STATS',
                        data: coll,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:false
                            }
                        }]
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.yLabel;
                            }
                        }
                    }
                },

            });



        },
        error: function (error) {
        alert('error ' + eval(error));
        }});
}

*/