<ul class="sidebar-menu">

    <li class="header">Filter List</li>
    <form action="capital/entries" method="POST">
        <div class="filter-group">
            <span>Facility</span>
            <select id="field-FacilityID" name="facility" class="form-control" onchange="this.form.submit()">
                <option value="">All</option>
                <?php foreach ($facilityList as $id => $name): ?>
                    <option value="<?php echo $id; ?>" <?php if ($facility == $id) echo 'selected'; ?>><?php echo $name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="filter-group">
            <span>Urgency</span>
            <select name="urgency" class="form-control" onchange="this.form.submit()">
                <option value="">All</option>
                <?php foreach ($urgencyList as $id => $name): ?>
                    <option value="<?php echo $id; ?>" <?php if ($urgency == $id) echo 'selected'; ?>><?php echo $name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="filter-group">
            <span>Building Components</span>
            <select name="component" class="form-control" onchange="this.form.submit()">
                <option value="">All</option>
                <?php foreach ($componentList as $id => $name): ?>
                    <option value="<?php echo $id; ?>" <?php if ($component == $id) echo 'selected'; ?>><?php echo $name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="filter-group">
            <span>BCSubType</span>
            <select name="subtypeId" class="form-control" onchange="this.form.submit()">
                <option value="">All</option>
                <?php foreach ($subtypeList as $id => $name): ?>
                    <option value="<?php echo $id; ?>" <?php if ($subtypeId == $id) echo 'selected'; ?>><?php echo $name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="filter-group">
            <span>BCSubSubType</span>
            <select name="subsubtypeId" class="form-control" onchange="this.form.submit()">
                <option value="">All</option>
                <?php foreach ($subsubtypeList as $id => $name): ?>
                    <option value="<?php echo $id; ?>" <?php if ($subsubtypeId == $id) echo 'selected'; ?>><?php echo $name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </form>

</ul>