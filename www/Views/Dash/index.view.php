<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
    <div class="btn-toolbar mb-2 mb-md-0">

        <select id="periodButton" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1">
            <option value="byWeek">This week</option>
            <option value="byMonth">This month</option>
            <option value="byDay">Today</option>
        </select>
    </div>
</div>

<div class="row">
    <div>
        <canvas id="userChart" class="my-4 w-100" width="900" height="200" data-newUsers="<?= htmlspecialchars(json_encode($users)) ?>"></canvas>
    </div>
    <div>
        <canvas id="visitorChart" class="my-4 w-100" width="900" height="200" data-visitors="<?= htmlspecialchars(json_encode($views)) ?>"></canvas>
    </div>
</div>
