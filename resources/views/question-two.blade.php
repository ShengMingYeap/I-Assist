<!DOCTYPE html>

<head>
    <title>I Assist - Question Two</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('member-registered-date') }}">Question One</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('top-ten') }}">Question Two</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('calculate-referral') }}">Question Three</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('calculate-member-purchase') }}">Question Four</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('family-tree-chart') }}">Question Five</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h3>2. Top 10 members purchase in March 2024</h3>
        <br>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Member Code</th>
                        <th>Full Name</th>
                        <th>Total Amount Purchase</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($topPurchaseMembers as $member)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $member->MemberID }}</td>
                            <td>{{ $member->Name }}</td>
                            <td>RM {{ $member->purchase_sum_amount ?? 0 }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No members found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</body>
</html>
