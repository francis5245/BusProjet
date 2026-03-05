@extends('Admin.layout.template')
@section('title', 'Dashboard')
@section('content')
<div class="container-fluid mt-4">
      <div class="row g-4 mb-4">
        <div class="col-md-6 col-lg-3">
          <div class="card-gradient" style="--gradient: linear-gradient(90deg, #00c6ff, #0072ff);">
            <div class="d-flex align-items-center">
              <div class="stat-icon">
                <i class="fas fa-hard-hat"></i>
              </div>
              <div>
                <div class="stat-number">4</div>
                <div class="stat-label">Total Trip</div>
                <div class="mt-2"><i class="fas fa-caret-down me-1"></i> Today</div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="card-gradient" style="--gradient: linear-gradient(90deg, #ff6a00, #ee0979);">
            <div class="d-flex align-items-center">
              <div class="stat-icon">
                <i class="fas fa-ticket-alt"></i>
              </div>
              <div>
                <div class="stat-number">0</div>
                <div class="stat-label">Total Ticket Booking</div>
                <div class="mt-2"><i class="fas fa-caret-down me-1"></i> Today</div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="card-gradient" style="--gradient: linear-gradient(90deg, #0072ff, #00c6ff);">
            <div class="d-flex align-items-center">
              <div class="stat-icon">
                <i class="fas fa-list-alt"></i>
              </div>
              <div>
                <div class="stat-number">0</div>
                <div class="stat-label">Total Booking Amount</div>
                <div class="mt-2"><i class="fas fa-caret-down me-1"></i> Today</div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="card-gradient" style="--gradient: linear-gradient(90deg, #00c6ff, #0072ff);">
            <div class="d-flex align-items-center">
              <div class="stat-icon">
                <i class="fas fa-users"></i>
              </div>
              <div>
                <div class="stat-number">0</div>
                <div class="stat-label">Total Passenger</div>
                <div class="mt-2"><i class="fas fa-caret-down me-1"></i> Today</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Charts -->
      <div class="row g-4">
        <div class="col-lg-6">
          <div class="chart-container">
            <h5>Yearly Income &amp; Expense</h5>
            <canvas id="yearlyChart" width="434" height="217" style="display: block; box-sizing: border-box; height: 217px; width: 434px;"></canvas>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="chart-container">
            <h5>Weekly Income &amp; Expense</h5>
            <canvas id="weeklyChart" width="434" height="217" style="display: block; box-sizing: border-box; height: 217px; width: 434px;"></canvas>
          </div>
        </div>
      </div>

      <div class="row g-4 mt-4">
        <div class="col-lg-6">
          <div class="chart-container">
            <h5>Payment Gateway Transaction</h5>
            <canvas id="paymentChart" width="434" height="434" style="display: block; box-sizing: border-box; height: 434px; width: 434px;"></canvas>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="chart-container">
            <h5>Monthly Ticket Booking</h5>
            <canvas id="monthlyTicketChart" width="434" height="217" style="display: block; box-sizing: border-box; height: 217px; width: 434px;"></canvas>
          </div>
        </div>
      </div>

      <div class="row g-4 mt-4">
        <div class="col-lg-6">
          <div class="chart-container">
            <h5>Agent Ticket Booking</h5>
            <canvas id="agentChart" width="434" height="217" style="display: block; box-sizing: border-box; height: 217px; width: 434px;"></canvas>
          </div>
        </div>
      </div>
    </div>

@endsection
