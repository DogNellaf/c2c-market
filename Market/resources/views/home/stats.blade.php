@extends('layouts.home')
@section('title', 'Статистика')
@section('head_additions')
  <script src="{{ asset('js/chart.min.js') }}"> </script>
  <script src="{{ asset('js/chartjs-plugin-trendline.js') }}"></script>
@endsection
@section('home-stats_active', 'active')
@section('card')
  <div class="row mt-4 mb-4">
    <div class="col">
      <form>
        <!-- <input type="date"> -->
      </form>
    </div>
  </div>
  <div class="row mt-4 mb-4">
    <div class="col">
      <canvas id="statsChart" class="stats-canvas"></canvas>
    </div>
  </div>
  <script>
    const ctx = document.getElementById('statsChart');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: [
          @foreach ($months as $month)
            {{ $month }},
          @endforeach
        ],
        datasets: [{
          label: 'Доход по месяцам',
          data: [
            @foreach ($values as $value)
              {{ $value }},
            @endforeach
          ],
          borderWidth: 1,
          trendlineLinear: {
            colorMin: "blue",
            colorMax: "blue",
            lineStyle: "dotted",
            width: 2
          }
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true,
            suggestedMax: {{ $max_value }}
          }
        }
      }
    });
  </script>
@endsection