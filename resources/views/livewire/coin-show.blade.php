<div>
     <div class="container">
        <h2>{{ $coin['name'] }}</h2>
        <div class="row">
            <div class="col-md-7">
                <div class="card mb-4">
                    <div class="card-body">
                        @livewire('coin-chart', ['coin_name' => $coin['name'], 'values' => $values, 'years' => [$years]])
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card mb-4">
                    <div class="card-body">
                        {{-- filters START --}}
                        <form id="filterForm" method="get">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control"
                                        value="{{ $filters['start_date'] }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="end_date">End Date</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control"
                                        value="{{ $filters['end_date'] }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="frequency">Frequency</label>
                                    <select name="frequency" id="frequency" class="form-control">
                                        <option value="" {{ $filters['frequency'] === '' ? 'selected' : '' }}>
                                            Default
                                        </option>
                                        <option value="weekly"
                                            {{ $filters['frequency'] === 'weekly' ? 'selected' : '' }}>
                                            Weekly</option>
                                        <option value="monthly"
                                            {{ $filters['frequency'] === 'monthly' ? 'selected' : '' }}>
                                            Monthly</option>
                                        <option value="yearly"
                                            {{ $filters['frequency'] === 'yearly' ? 'selected' : '' }}>
                                            Yearly</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <button type="button" class="btn btn-danger" name="reset_filters">Reset
                                    Filters</button>
                            </div>
                        </form>
                        {{-- filters END --}}

                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="coin-details">
                            <h4 class="card-title">Cryptocurrency Details</h4>
                            <ul class="list-unstyled">
                                <li><strong>Symbol:</strong> {{ $coin['symbol'] }}</li>
                                <li><strong>Price (USD):</strong>
                                    ${{ number_format($coin['market_data']['current_price']['usd'], 2) }}</li>
                                <li><strong>Market Cap (USD):</strong>
                                    ${{ number_format($coin['market_data']['market_cap']['usd'], 2) }}</li>
                                <li><strong>24h Change:</strong>
                                    {{ $coin['market_data']['price_change_percentage_24h'] }}%</li>
                                <li><strong>Price Change (24h):</strong>
                                    ${{ number_format($coin['market_data']['price_change_24h'], 2) }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="description">
            <div class="card">
                <div class="card-body">
                    {!! $coin['description']['en'] !!}
                </div>
            </div>
        </div>
    </div>
</div>
