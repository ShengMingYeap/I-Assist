<!DOCTYPE html>

<head>
    <title>I Assist - Question Five</title>
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
        <h3>5. Family Tree Chart</h3>
        <br>
        @if (count($familyTree) > 0)
        @php $i = 1; @endphp
        @forelse ($familyTree as $tree)
            <h3>Group {{ $loop->iteration }} - {{ $tree['name'] }}</h3>
            <p>Group Sales: RM {{ $tree['group_sales'] }}</p>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Date Join</th>
                            <th>Personal Sales</th>
                        </tr>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>{{ $tree['name'] }}</td>
                                <td>{{ \Carbon\Carbon::parse($tree['date_join'] )->format('d/m/Y') }}</td>
                                <td>{{ $tree['personal_sales'] }}</td>
                            </tr>
                            @if (!empty($tree['referral'])) 
                                @php $k = 2; @endphp
                                @foreach ($tree['referral'] as $ref)
                                    <tr>
                                        <td>{{ $k }}</td>
                                        <td>{{ $ref['Name'] }}</td>
                                        <td>{{ \Carbon\Carbon::parse($ref['DateJoin'] )->format('d/m/Y') }}</td>
                                        <td>{{ $ref['purchase_sum_amount'] }}</td>
                                    </tr>
                                @php $k++; @endphp
                                @endforeach
                            @endif
                        </tbody>
                    </thead>
                </table>
            </div>
            <br><br>
            @php $i++; @endphp
        @endforeach
        @endif 
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</body>
</html>
