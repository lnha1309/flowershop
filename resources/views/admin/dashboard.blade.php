@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
      <h1>Dashboard</h1>

      <div class="date">
        <input type="date" />
      </div>

      <div class="insights">
        <div class="sales">
          <span class="material-icons-sharp"> analytics </span>
          <div class="middle">
            <div class="left">
              <h3>Total Sales</h3>
              <h1>$25,024</h1>
            </div>
            <div class="progress">
              <svg>
                <circle cx="38" cy="38" r="36"></circle>
              </svg>
              <div class="number">
                <p>81%</p>
              </div>
            </div>
          </div>
          <small class="text-muted"> Last 24 hours </small>
        </div>

        <div class="expenses">
          <span class="material-icons-sharp"> bar_chart </span>
          <div class="middle">
            <div class="left">
              <h3>Total Expenses</h3>
              <h1>$14,160</h1>
            </div>
            <div class="progress">
              <svg>
                <circle cx="38" cy="38" r="36"></circle>
              </svg>
              <div class="number">
                <p>62%</p>
              </div>
            </div>
          </div>
          <small class="text-muted"> Last 24 hours </small>
        </div>

        <div class="income">
          <span class="material-icons-sharp"> stacked_line_chart </span>
          <div class="middle">
            <div class="left">
              <h3>Total Income</h3>
              <h1>$10,864</h1>
            </div>
            <div class="progress">
              <svg>
                <circle cx="38" cy="38" r="36"></circle>
              </svg>
              <div class="number">
                <p>44%</p>
              </div>
            </div>
          </div>
          <small class="text-muted"> Last 24 hours </small>
        </div>
      </div>

      <div class="recent-orders">
        <h2>Recent Orders</h2>
        <table id="recent-orders--table">
          <thead>
            <tr>
              <th>Product Name</th>
              <th>Product Number</th>
              <th>Payment</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
        </table>
        <a href="#">Show All</a>
      </div>
@endsection

@section('right-panel')
        <div class="top">
          <button id="menu-btn">
            <span class="material-icons-sharp"> menu </span>
          </button>
          <div class="theme-toggler">
            <span class="material-icons-sharp active"> light_mode </span>
            <span class="material-icons-sharp"> dark_mode </span>
          </div>
          <div class="profile">
            <div class="info">
              <p>Hey, <b>Bruno</b></p>
              <small class="text-muted">Admin</small>
            </div>
            <div class="profile-photo">
              <img src="{{ asset('admin-dashboard/images/profile-1.jpg') }}" alt="Profile Picture" />
            </div>
          </div>
        </div>

        <div class="recent-updates">
          <h2>Recent Updates</h2>
        </div>

        <div class="sales-analytics">
          <h2>Sales Analytics</h2>
          <div id="analytics"></div>
          <div class="item add-product">
            <div>
              <span class="material-icons-sharp"> add </span>
              <h3>Add Product</h3>
            </div>
          </div>
        </div>
@endsection

