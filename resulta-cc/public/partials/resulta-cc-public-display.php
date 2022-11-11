<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php
if(get_option('rcc_show_graph')=='1'){
    ?>
    <!-- Graphical Representation-->
    <div class="container container-margin-top container-fluid">
        <div class="row">
            <div class="col-md-6">
                <label> Select Field for Graphical Representation
                    <select id="chart_field" class="custom-select custom-select-sm form-control form-control-sm" >
                        <?php 
                            $count_column = 1;
                            foreach($dataObj['results']['columns'] as $key => $value) { 
                        ?>
                        <option value="<?php echo $key; ?>" <?php if($count_column == (count($dataObj['results']['columns']))){ echo "selected";} ?> ><?php echo ucfirst($value); ?></option>
                        <?php 
                        $count_column++;
                        } 
                        ?>
                    
                    </select>
                </label>
            </div>
            <div class="col-md-6">
                <label> Select Chart Type
                    <select id="chart_type" class="custom-select custom-select-sm form-control form-control-sm" >
                        <option value="pie" selected>Pie Chart</option>
                        <option value="bar">Bar Chart</option>
                    
                    </select>
                </label>
            </div>
        </div>
        <div class="row container-margin-top">
            <div class="col-md-12">
                <div id="drawChart" style="height: 360px; width: 100%;">
                </div>
            </div>
            
        </div>
    </div>
    <?php } ?>	
    <div class="container margin70-top table-responsive">
        <div class="row margin30-bottom">
            <h1 class="text-center">NFL Teams Information</h1>
        </div>
        
    <table id="nfl_team_info_table" class="table table-striped table-bordered" >
    <thead style="background-color: <?php echo get_option('rcc_header_bg_color')?> !important;">
        <tr>
        <th scope="col">#</th>
        <?php 
        $column_name_array = array();
        foreach($dataObj['results']['columns'] as $key => $value) {
            $column_name_array[]= $key;	
        ?>
        <th scope="col"><?php echo ucfirst($dataObj['results']['columns'][$key]); ?></th>
        <?php } ?>
        
        </tr>
    </thead>
    <tbody>
        <?php
        $count=1;
        $teams_data_array      = array();
        foreach( $dataObj['results']['data']['team'] as $record ){
            $teams_data_array[] = $record;
            
            ?>
                <tr>
                <th scope="row"><?php echo $count;?></th>
                <?php foreach( $column_name_array as $key ){?>
                <td><?php echo $record[$key];?></td>
                <?php } ?>
                
                </tr>
            <?php
            $count++;
        }
        ?>
    </tbody>
    </table>
    </div>
    <script type="application/json" id="chart_values-data"><?php echo json_encode( $teams_data_array, JSON_UNESCAPED_SLASHES ) ?></script>
    <script type="application/json" id="chart_columns-data"><?php echo json_encode( $column_name_array, JSON_UNESCAPED_SLASHES ) ?></script>

