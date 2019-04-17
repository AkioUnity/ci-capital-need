<h1><?php echo anchor('gchart_examples', 'Codeigniter gChart Examples'); ?> \ Advanced Column Chart</h1>
<?php
    echo $this->gcharts->ColumnChart('Finances')->outputInto('money_div');
    echo $this->gcharts->div();

    if($this->gcharts->hasErrors())
    {
        echo $this->gcharts->getErrors();
    }
?>
