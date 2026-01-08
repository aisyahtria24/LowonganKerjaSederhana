<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation - Lowongan Kerja Sederhana</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="text-center mb-5">
                    <h1 class="display-4">Lowongan Kerja Sederhana</h1>
                    <p class="lead">Navigation Menu - All Pages</p>
                    <small class="text-muted">Click any link below to navigate to that page</small>
                </div>
            </div>
        </div>

        <!-- Public Pages -->
        <div class="row mb-5">
            <div class="col-12">
                <h3 class="text-primary mb-3"><i class="fas fa-globe me-2"></i>Public Pages</h3>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-home fa-2x text-primary mb-2"></i>
                                <h5 class="card-title">Home Page</h5>
                                <a href="/" class="btn btn-primary">Go to Home</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-briefcase fa-2x text-success mb-2"></i>
                                <h5 class="card-title">Job Listings</h5>
                                <a href="/guest/jobs" class="btn btn-success">View Jobs</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-sign-in-alt fa-2x text-info mb-2"></i>
                                <h5 class="card-title">Login</h5>
                                <a href="/login" class="btn btn-info">Login Page</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-user-plus fa-2x text-warning mb-2"></i>
                                <h5 class="card-title">Register</h5>
                                <a href="/register" class="btn btn-warning">Register Page</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-code fa-2x text-secondary mb-2"></i>
                                <h5 class="card-title">Test Page</h5>
                                <a href="/test" class="btn btn-secondary">Test Page</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Admin Pages -->
        <div class="row mb-5">
            <div class="col-12">
                <h3 class="text-danger mb-3"><i class="fas fa-crown me-2"></i>Admin Pages</h3>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-tachometer-alt fa-2x text-danger mb-2"></i>
                                <h6 class="card-title">Admin Dashboard</h6>
                                <a href="/admin/dashboard" class="btn btn-danger btn-sm">Dashboard</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-briefcase fa-2x text-danger mb-2"></i>
                                <h6 class="card-title">Manage Jobs</h6>
                                <a href="/admin/jobs" class="btn btn-danger btn-sm">Jobs</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-users fa-2x text-danger mb-2"></i>
                                <h6 class="card-title">Manage Applications</h6>
                                <a href="/admin/pelamar" class="btn btn-danger btn-sm">Applications</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-tags fa-2x text-danger mb-2"></i>
                                <h6 class="card-title">Categories</h6>
                                <a href="/admin/categories" class="btn btn-danger btn-sm">Categories</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Staff Pages -->
        <div class="row mb-5">
            <div class="col-12">
                <h3 class="text-success mb-3"><i class="fas fa-user-tie me-2"></i>Staff Pages</h3>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-tachometer-alt fa-2x text-success mb-2"></i>
                                <h6 class="card-title">Staff Dashboard</h6>
                                <a href="/staff/dashboard" class="btn btn-success btn-sm">Dashboard</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-briefcase fa-2x text-success mb-2"></i>
                                <h6 class="card-title">Manage Jobs</h6>
                                <a href="/staff/jobs" class="btn btn-success btn-sm">Jobs</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-users fa-2x text-success mb-2"></i>
                                <h6 class="card-title">View Applications</h6>
                                <a href="/staff/pelamar/1" class="btn btn-success btn-sm">Applications</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Guest/Applicant Pages -->
        <div class="row mb-5">
            <div class="col-12">
                <h3 class="text-info mb-3"><i class="fas fa-user me-2"></i>Guest/Applicant Pages</h3>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-briefcase fa-2x text-info mb-2"></i>
                                <h6 class="card-title">Job Listings</h6>
                                <a href="/guest/jobs" class="btn btn-info btn-sm">View Jobs</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-paper-plane fa-2x text-info mb-2"></i>
                                <h6 class="card-title">Apply for Job</h6>
                                <a href="/guest/apply" class="btn btn-info btn-sm">Apply</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="row">
            <div class="col-12">
                <div class="text-center">
                    <p class="text-muted mb-2">Server Status: <span class="badge bg-success">Running</span></p>
                    <p class="text-muted">Laravel Application - Lowongan Kerja Sederhana</p>
                    <a href="/" class="btn btn-outline-primary">Back to Home</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
