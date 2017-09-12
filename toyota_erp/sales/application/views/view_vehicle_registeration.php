<div class="row">
	<div class="col-lg-12 col-md-12">		
		<?php 
                
                		
                echo $this->session->flashdata('notify');
                $number = 1;
                ?>
	</div>
</div><!-- /.row -->

<section class="panel panel-default">
    <header class="panel-heading">
        <div class="row">
            <div class="col-md-8 col-xs-3">                
                <?php
                                  echo anchor(
                                           site_url('index.php/vehicle_registeration/add'),
                                            'Vehical Registeration',
                                            'class="btn btn-success btn-sm" data-tooltip="tooltip" data-placement="top" title="Add new record"'
                                          );
                 ?>
                
            </div>
            <div class="col-md-4 col-xs-9">
                                           
                 
            </div>
        </div>
    </header>
    
    
    <div class="panel-body">
         
          <div id="searchform" class="feildwrap">
                    
                        <div class="btn-block-wrap datagrid" id="shwcompat">
                            <table id="allcomplaints" width="100%" border="0" cellpadding="1" cellspacing="0">
                                <thead>
              <tr>
                <th>S NO</th>
                
                    <th>Entry No</th>   
                
                    <th>Entry Date</th>
                
                    <th>Registeration No</th>   
                
                    <th>Registeration City</th>   
                
                    <th>Amount</th> 

                    <th>Action</th>  
                
              </tr>
            </thead>

            <tfoot>
                                <tr>
                                    <td colspan="13">
                                        <div id="paging">
                                            <ul>
                                                <?php echo $links ?>
                                            </ul>
                                        </div>
                                        </td>
                                </tr>
            </tfoot>
            
                                
            <tbody>
             
               <?php foreach ($vehicle_registeration as $val) : ?>
              <tr>
                <td><?php echo $number++;; ?> </td>
               
               <td><?php echo $val['entry_no']; ?></td>
               
               <td><?php echo $val['entry_date']; ?></td>
               
               <td><?php echo $val['registeration_no']; ?></td>
               
               <td><?php echo $val['registeration_city']; ?></td>
               
               <td><?php echo $val['amount']; ?></td>
               
               <td>    
                    
                <a href="<?=base_url()?>index.php/vehicle_registeration/edit/<?=$val['entry_no']?>"><button type="button">Edit</button></a>

                <a href="<?=base_url()?>index.php/vehicle_registeration/destroy/<?=$val['entry_no']?>"><button type="button">Delete</button></a>
                                 
              </td>
               
              </tr>     
               <?php endforeach; ?>
            </tbody>
                            </table>
                        </div>         
                        
                </div>
    </div>
    </div>
</section>