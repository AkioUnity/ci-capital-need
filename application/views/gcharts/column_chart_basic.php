<h3><?php echo anchor('admin/capital/entries', 'Capital Need List'); ?></h3>

<?php

    echo $this->gcharts->ColumnChart('Finances')->outputInto('money_div');
    echo $this->gcharts->ColumnChart('Etc')->outputInto('etc_div');

    if($this->gcharts->hasErrors())
    {
        echo $this->gcharts->getErrors();
    }
?>
    <div class="row">
        <div id = "etc_div" class="col-sm-6" >
        </div>
        <div id = "money_div" class="col-sm-6"  >
        </div>
    </div>
