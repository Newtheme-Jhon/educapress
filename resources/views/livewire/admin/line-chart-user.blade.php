<div wire:ignore>
    <div id="chart"></div>
</div>

@assets
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@endassets

@script
    <script>
        
        const meses = $wire.meses;
        const usersData = $wire.usersData;
        // console.log(meses)
        // console.log(usersData[0].data)


        var options = {
            chart: {
                type: 'line'
            },
            series: [{
                name: 'users',
                //cantidad de usuarios inscritos por mes
                data: usersData[0].data
            }],
            xaxis: {
                //Meses del año, relacion entre mes y inscripciones por mes
                categories: meses
            },
        }
    
        var chart = new ApexCharts(document.querySelector("#chart"), options);
    
        chart.render();
    </script>
@endscript