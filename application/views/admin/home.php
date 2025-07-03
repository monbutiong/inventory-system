<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
 


        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8"> 
                    <h6 class="page-title"> </h6>
                </div>
                <div class="col-md-4">
                     
                </div>
            </div>
        </div>

        
      </div>
      <div class="x_content">

        <div class="card">
            <div class="card-body"> 

				<div class="dashboard-welcome">
				  <div class="welcome-container">
				    <img class="logo-main" src="<?= base_url(); ?>assets/images/c_logo.png?22" alt="Company Logo">

				    <h1 class="welcome-text">Welcome to <?= company_name ?> <?= system_name ?>.</h1>

				    <div class="logo-grid">
				      <?php
				      $logos = [
				        'audi-logo.png', 'bentley-logo.png', 'bmw-logo.png',
				        'lamborghini-logo.png', 'land-rover-logo.png', 'maserati-logo.png',
				        'mercedes-benz-logo.png', 'porsche-logo.png', 'rolls-royce-logo.png',
				        'volkswagen-logo.png'
				      ];
				      foreach ($logos as $logo) {
				        echo '<img src="' . base_url('assets/logos/' . $logo) . '" alt="" class="brand-logo">';
				      }
				      ?>
				    </div>
				  </div>
				</div>
			</div>
				  </div>
				</div>
		</div>
				  </div>
				

<style>
.dashboard-welcome {
  padding: 60px 20px;
  background: #fff;
  color: white;
  text-align: center;
  animation: fadeIn 1.5s ease-in;
  min-height: 60vh;
}

.welcome-container {
  max-width: 900px;
  margin: auto;
  animation: slideInUp 1s ease-out;
}

.logo-main {
  height: 120px;
  margin-bottom: 30px;
  animation: bounceIn 1.2s;
}

.welcome-text {
  font-size: 28px;
  font-weight: bold;
  margin-bottom: 30px;
  background: linear-gradient(45deg, #f1c40f, #e67e22);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  animation: glow 2s infinite alternate;
}

.logo-grid {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 15px;
  margin-top: 20px;
}

.brand-logo {
  height: 80px;
  filter: drop-shadow(0 0 3px rgba(255, 255, 255, 0.2));
  transition: transform 0.3s ease;
}
.brand-logo:hover {
  transform: scale(1.05);
}

@keyframes fadeIn {
  from {opacity: 0;}
  to {opacity: 1;}
}

@keyframes slideInUp {
  from {transform: translateY(50px); opacity: 0;}
  to {transform: translateY(0); opacity: 1;}
}

@keyframes bounceIn {
  0%   { transform: scale(0.9); opacity: 0; }
  60%  { transform: scale(1.15); opacity: 1; }
  100% { transform: scale(1); }
}

@keyframes glow {
  from { text-shadow: 0 0 10px #f39c12, 0 0 20px #e67e22; }
  to   { text-shadow: 0 0 20px #f1c40f, 0 0 30px #f39c12; }
}

@media (max-width: 600px) {
  .brand-logo {
    height: 60px;
  }
  .welcome-text {
    font-size: 22px;
  }
}
</style>
