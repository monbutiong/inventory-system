<div class="nav-tabs-custom">
  <ul class="nav nav-tabs">
    <li class="active"><a><i class="fa fa-file text-info"></i>&nbsp;Email Testing</a></li>
  </ul>
  
  <div class="tab-content">
    <div class="active tab-pane" id="time_quick_gen">
      <div class="box box-default">

        <div class="box-body" id="for_generate_report">
         <form class="form-horizontal" method="post" target="_blank" action="<?php echo base_url()?>index/email" enctype="multipart/form-data">

            <div class="box box-success">
              <div class="panel panel-info">
                    <div class="col-md-12" id="fetch_all_result"><br>

                        <div class="col-md-12" id="main_action" style="padding-top: 30px;">

                            <div class="col-md-1"></div>
                            <div class="col-md-9">
                              
                              <div class="col-md-12">  
                                  <div class="col-md-4">
                                      <label class="pull-right">SMTP Host</label>
                                  </div>
                                  <div class="col-md-8">
                                      <input type="text" id="smtp_host" value='smtp.office365.com' name="smtp_host" class="form-control" placeholder="SMTP Host" value="mail.hrweb.ph" required>
                                  </div>
                              </div>

                               <div class="col-md-12" style="padding-top: 5px;">  
                                  <div class="col-md-4">
                                      <label class="pull-right">SMTP Port</label>
                                  </div>
                                  <div class="col-md-8">
                                      <input type="text" id="smtp_port" value='587' name="smtp_port" class="form-control" placeholder="SMTP Port"  value="465" required>
                                  </div>
                              </div>

                               <div class="col-md-12" style="padding-top: 5px;">  
                                  <div class="col-md-4">
                                      <label class="pull-right">Username</label>
                                  </div>
                                  <div class="col-md-8">
                                    
                                      <input type="email" value='hrwebqbsmanila@qiagen.com' id="username" name="username" class="form-control" value="unihris@hrweb.ph" placeholder="ex: sample@gmail.com" required>
                                  </div>
                              </div>

                               <div class="col-md-12" style="padding-top: 5px;">  
                                  <div class="col-md-4">
                                      <label class="pull-right">Password</label>
                                  </div>
                                  <div class="col-md-8">
                                      <input type="text" value='2fe0^aYY*^87I5' id="password" name="password" class="form-control" placeholder="Password" value="Sert@2020" required>
                                  </div>
                              </div>

                               <div class="col-md-12" style="padding-top: 5px;">  
                                  <div class="col-md-4">
                                      <label class="pull-right">Send Mail From</label>
                                  </div>
                                  <div class="col-md-8">
                                        <input type="text" value='hrwebqbsmanila@qiagen.com' id="send_from" name="send_from" class="form-control" placeholder="Send Email From" value="unihris@hrweb.ph" required>

                                  </div>
                              </div>

                                <div class="col-md-12" style="padding-top: 5px;">  
                                  <div class="col-md-4">
                                      <label class="pull-right">Send Mail To</label>
                                  </div>
                                  <div class="col-md-8">
                                    
                                      <input type="email" id="send_to" value='' name="send_to" class="form-control" placeholder="ex: sample@gmail.com" value="" required>
                                  </div>
                              </div>

                               <div class="col-md-12" style="padding-top: 5px;">  
                                  <div class="col-md-4">
                                      <label class="pull-right">Security Type</label>
                                  </div>
                                  <div class="col-md-8">
                                      <select class="form-control" id="security_type" name="security_type" required>
                                          <option value="tls" selected>tls</option>
                                          <option value="ssl">ssl</option>
                                      </select>
                                  </div>
                              </div>

                               <div class="col-md-12" style="padding-top: 5px;">  
                                  <div class="col-md-4">
                                      <label class="pull-right">Message</label>
                                  </div>
                                  <div class="col-md-8">
                                      <textarea class="form-control" rows="5" id="message" name="message" required></textarea>
                                  </div>
                              </div>


                              <div class="col-md-12" style="padding-top: 10px;">  
                                  <div class="col-md-4">
                                  </div>
                                  <div class="col-md-8">
                                     
                                      <button type="submit" class="col-md-12 btn btn-success">SEND EMAIL</button>
                                    
                                  </div>
                              </div>

                            </div>
                            <div class="col-md-2"></div>
                            
                        </div>


                    </div>
                    <div class="btn-group-vertical btn-block"> </div>   
              </div>             
            </div> 
</form>
          </div>

        </div>
    </div>
  </div>
</div>




 