
@props([
    'title' => '',
    'type' => 'line',
    'labels' => [],
    'datasets' => [],
    'class' => ''
])

<?php
$id = "chart_" . \Nette\Utils\Random::generate(25);
?>

<div class="{{$class}} chart-component">
    <canvas id="{{$id}}" ></canvas>

    <script>
        document.addEventListener('chart:init', function (e) {
            const {Chart} = e.detail;
            const ctx = document.getElementById('{{$id}}');

            const isPhone = window.innerWidth < 768;

            new Chart(ctx, {
                type: '{{ $type }}',
                data: {
                    labels: [
                        @foreach($labels as $label)
                            '{{ $label }}',
                        @endforeach
                    ],
                    datasets: [{
                        label: '{{$title}}',
                        data: [
                            @foreach($datasets as $dataset)
                                {{ $dataset }},
                            @endforeach
                        ],
                        borderWidth: 1,
                    }]
                },
                options: {
                    layout: {
                        padding: {
                            top: isPhone ? 0 : 20
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });
        });
    </script>
</div>
