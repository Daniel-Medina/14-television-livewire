<x-admin-layout nombre="Panel de detalles">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Encabezado que permite ver el primer video de la lista -->
    <section class="mt-4 container mx-auto pb-8">

        @livewire('admin.panel.panel')

    </section>


    @push('js')
        <script src="{{ asset('js/chart.min.js') }}"></script>

        <script>
            window.onload = function () {
                livewire.emit('get_accesos');
                livewire.emit('get_global');
            }

            livewire.on('datos-acceso', function(data) {
                this.cargarGAccesos(data);
            })
            livewire.on('datos-global', function(data) {
                this.cargarGGlobal(data);
            })
        </script>

        <script>
            const ctx = document.getElementById("myChart").getContext("2d");
            //Iniciar la tabla
            function cargarGGlobal(data) {
                const myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: 'Vistas globales',
                            data: data.data,
                            backgroundColor: 'rgba(37, 126, 231)',
                            borderColor: 'rgba(124, 163, 255)',
                            borderWidth: 1,
                        }],
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        </script>

        <script>
            const graficaAccesos = document.getElementById("accesos").getContext("2d");
            function cargarGAccesos (data) {
                //Iniciar la tabla
                const chartAccesos = new Chart(graficaAccesos, {
                    type: 'bar',
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: 'Vistas diarias',
                            data: data.data,
                            backgroundColor: 'rgba(255, 160, 00, 1)',
                            borderColor: 'rgba(255, 182, 67, 1)', 
                            borderWidth: 2,
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        </script>
    @endpush

</x-admin-layout>
