<div class="statistics">
    <!-- <p class="text-center m-0 p-3">
        <span class="alert alert-warning mr-2">Year: {{ $yearSelected ?? '2021' }}</span>
        <span class="alert alert-warning">Zodiac Sign: {{ optional($zodiacSignObj)->title ?? 'N/A' }}</span>
    </p> -->

    <div class="row">
        <div class="col-md-2">

        </div>
        <div class="col-md-8 text-center pt-2">
            <table class="table table-bordered alert alert-warning">
                <thead>
                    <tr>
                        <th colspan="2">
                            Best Month (Average Score)
                        </th>

                        <th colspan="2">
                            Best Zodiac Sign (Yearly Score)
                        </th>
                    </tr>

                    <tr>
                        <th>
                            Month Name
                        </th>
                        <th>
                            Month Average Score
                        </th>
                        <th>
                            Zodiac Sign Name
                        </th>
                        <th>
                            Zodiac Sign Yearly Score
                        </th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>
                            {{ isset($bestMonthByZS['bestMonth']) ? $bestMonthByZS['bestMonth'] : 'N/A'}}
                        </td>
                        <td>
                            {{ isset($bestMonthByZS['maxAverage']) ? number_format((float)$bestMonthByZS['maxAverage'], 2, '.', '') : 'N/A'}}
                        </td>
                        <td>
                            {{ isset($bestZSByYear['bestZS']) ? optional($bestZSByYear['bestZS'])->title : 'N/A'}}
                        </td>
                        <td>
                            {{ isset($bestZSByYear['maxYearlyScore']) ? $bestZSByYear['maxYearlyScore'] : 'N/A'}}
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

<div class="fullcalendar-loader">
</div>