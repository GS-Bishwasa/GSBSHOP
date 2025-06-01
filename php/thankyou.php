<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Thank You!</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@700&display=swap" rel="stylesheet">

  <style>
    body {
      background-color: #f5f5f5;
      font-family: 'Ubuntu', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .thankyou-wrapper {
      text-align: center;
      animation: fadeInUp 1.5s ease-in-out;
    }

    .thankyou-wrapper h1 {
      font-size: 3rem;
      color: #28a745;
      margin-bottom: 20px;
    }

    .thankyou-wrapper i {
      font-size: 80px;
      color: #28a745;
      animation: pop 1.2s ease-out;
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(40px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes pop {
      0% { transform: scale(0); }
      60% { transform: scale(1.2); }
      100% { transform: scale(1); }
    }
  </style>

  <script>
    // Redirect after 4 seconds
    setTimeout(() => {
      window.location.href = "../my_order.php";
    }, 4000);
  </script>
</head>

<body>
  <div class="thankyou-wrapper">
    <i class="fas fa-check-circle"></i>
    <h1>Thank You for Your Purchase!</h1>
    <p class="text-muted">Redirecting to your orders...</p>
  </div>
</body>
</html>
