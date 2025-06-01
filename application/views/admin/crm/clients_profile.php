 

            <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Client Profile <small></small></h2>
                     
                    <div class="input-group-btn pull-right" style="padding-right: 80px;">
                            <a class="btn btn-sm btn-danger" href="<?php echo base_url('crm/clients');?>" >Go back</a>
                        </div>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-3 col-sm-3  profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img class="img-responsive avatar-view" src="<?php 
			              if(file_exists('./assets/images/clients/logo-'.$client->id.'.png') || 1){
			                echo base_url('assets/images/clients/logo-'.$client->id.'.png?'.time());
			                }else{
			                echo base_url('assets/images/blank.png'); }?>" alt="Avatar" title="Change the avatar">
                        </div>
                      </div>
                      <h3><?=$client->name?></h3>

                      <ul class="list-unstyled user_data">
                        <li><i class="fa fa-map-marker user-profile-icon"></i> <?=$client->address?>
                        </li>

                        <li>
                          <i class="fa fa-phone user-profile-icon"></i> <?=$client->phone?>
                        </li>
                        <?php if($client->website){?>
                        <li class="m-top-xs">
                          <i class="fa fa-external-link user-profile-icon"></i>
                          <a href="<?=$client->website?>" target="_blank"><?=$client->website?></a>
                        </li>
                    	<?php }?>
                      </ul>

                     <!--  <a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a> -->
                      <br />

                      <?php 
                      if($projects){
                      	foreach ($projects as $rs) { 
                      		$project_details[$rs->id] = $rs;
                      }}
                      
                      if(@$quotations){
                      	foreach ($quotations as $rs) {
                      		$proj[$rs->project_id] = $project_details[$rs->project_id];
                      	}
                      }
                      if(@$proj){
                      ?>
                      <!-- start skills -->
                      <h4>Projects</h4>
                      <ul class="list-unstyled user_data">
                      	<?php 
 
                      	
                      		foreach ($proj as $rs) { 
                      	?>
                        <li><a href="">
                          <p><?=$rs->name?></p>
                          <div class="progress progress_sm">
                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?=rand(10,80)?>"></div>
                          </div>
                        </li></a>
                        <?php }}?>
                      </ul>
                      <!-- end of skills -->

                    </div>
                    <div class="col-md-9 col-sm-9 ">

                     
                      

                      <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-bs-toggle="tab" aria-expanded="true">Recent Activity</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-bs-toggle="tab" aria-expanded="false">Progress</a>
                          </li>
                          <li role="documents" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-bs-toggle="tab" aria-expanded="false">Documents</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-bs-toggle="tab" aria-expanded="false">Profile</a>
                          </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane active " id="tab_content1" aria-labelledby="home-tab">

                            <!-- start recent activity -->
                            <ul class="messages">
                              <li>
                                <img src="<?php echo base_url();?>assets/uploaded_files/user/p2.png" class="avatar" alt="Avatar">
                                <div class="message_date">
                                  <h3 class="date text-info">24</h3>
                                  <p class="month">May</p>
                                </div>
                                <div class="message_wrapper">
                                  <h4 class="heading">Desmond Davison</h4>
                                  <blockquote class="message">Post-Presentation Follow-Up</blockquote>
                                  - Sent a follow-up email to the client with presentation materials.<br/>
                                  - Addressed any additional questions or concerns.<br/>
                                  - Explored next steps and future collaboration possibilities.
                                  <br />
                                  <p class="url">
                                    <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                    <a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
                                  </p>
                                </div>
                              </li>
                              <li>
                                <img src="<?php echo base_url();?>assets/uploaded_files/user/profile.png" class="avatar" alt="Avatar">
                                <div class="message_date">
                                  <h3 class="date text-error">21</h3>
                                  <p class="month">May</p>
                                </div>
                                <div class="message_wrapper">
                                  <h4 class="heading">Brian Michaels</h4>
                                  <blockquote class="message">Client Progress Presentation Meeting</blockquote>
                                  - Presented a comprehensive overview of the project's progress and results.<br/>
                                  - Shared data-driven insights and success stories.<br/>
                                  - Discussed the impact of the project on the client's business.<br/>
                                  - Explored potential follow-up projects.<br/>
                                  <br />
                                  <p class="url">
                                    <span class="fs1" aria-hidden="true" data-icon=""></span>
                                    <a href="#" data-original-title="">Download</a>
                                  </p>
                                </div>
                              </li>
                              <li>
                                <img src="<?php echo base_url();?>assets/uploaded_files/user/p2.png" class="avatar" alt="Avatar">
                                <div class="message_date">
                                  <h3 class="date text-info">24</h3>
                                  <p class="month">May</p>
                                </div>
                                <div class="message_wrapper">
                                  <h4 class="heading">Desmond Davison</h4>
                                  <blockquote class="message">Presentation Preparation </blockquote>

                                  - Prepared the final presentation summarizing the project's success.<br>
                                  - Created visuals, charts, and data analysis for the presentation.

                                  <br />
                                  <p class="url">
                                    <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                    <a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
                                  </p>
                                </div>
                              </li>
                              <li>
                                <img src="<?php echo base_url();?>assets/uploaded_files/user/profile.png" class="avatar" alt="Avatar">
                                <div class="message_date">
                                  <h3 class="date text-error">21</h3>
                                  <p class="month">May</p>
                                </div>
                                <div class="message_wrapper">
                                  <h4 class="heading">Brian Michaels</h4>
                                  <blockquote class="message">Client Feedback Meeting</blockquote>

                                  - Held a feedback meeting with the client.<br/>
                                  - Addressed client concerns and feedback.<br>
                                  - Discussed future strategies and potential improvements.<br/>
                                  - Updated the project timeline.

                                 
                                </div>
                              </li>

                            </ul>
                            <!-- end recent activity -->

                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                            <!-- start user projects -->
                            <table class="data table table-striped no-margin">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Project Name</th>
                                  <th>Client Company</th>
                                  <th class="hidden-phone">Hours Spent</th>
                                  <th>Contribution</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>1</td>
                                  <td>New Company Takeover Review</td>
                                  <td>Deveint Inc</td>
                                  <td class="hidden-phone">18</td>
                                  <td class="vertical-align-mid">
                                    <div class="progress">
                                      <div class="progress-bar progress-bar-success" data-transitiongoal="35"></div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>2</td>
                                  <td>New Partner Contracts Consultanci</td>
                                  <td>Deveint Inc</td>
                                  <td class="hidden-phone">13</td>
                                  <td class="vertical-align-mid">
                                    <div class="progress">
                                      <div class="progress-bar progress-bar-danger" data-transitiongoal="15"></div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>3</td>
                                  <td>Partners and Inverstors report</td>
                                  <td>Deveint Inc</td>
                                  <td class="hidden-phone">30</td>
                                  <td class="vertical-align-mid">
                                    <div class="progress">
                                      <div class="progress-bar progress-bar-success" data-transitiongoal="45"></div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td>4</td>
                                  <td>New Company Takeover Review</td>
                                  <td>Deveint Inc</td>
                                  <td class="hidden-phone">28</td>
                                  <td class="vertical-align-mid">
                                    <div class="progress">
                                      <div class="progress-bar progress-bar-success" data-transitiongoal="75"></div>
                                    </div>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                            <!-- end user projects -->

                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                            <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui
                              photo booth letterpress, commodo enim craft beer mlkshk </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
       