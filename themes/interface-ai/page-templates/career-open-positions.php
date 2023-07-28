<?php
/*
Template Name: Career Open Positions
*/
get_header();
global $post;
$acfDT = get_fields($post->ID);

//get jobs
// $curlJobs = curl_init();
// curl_setopt_array($curlJobs, array(
//   CURLOPT_URL => "https://boards-api.greenhouse.io/v1/boards/interfaceai/jobs",
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => "",
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 30,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => "GET",
//   CURLOPT_POSTFIELDS => "",
//   CURLOPT_HTTPHEADER => array(
//      "Content-Type: application/json",
//      "cache-control: no-cache"
//   ),
// ));

// $resJobs = curl_exec($curlJobs);
// $errJobs = curl_error($curlJobs);
// $jobs = json_decode($resJobs, true);

$jobBoard = 'interfaceai';
//get departments
$curlDeps = curl_init();
curl_setopt_array($curlDeps, array(
  CURLOPT_URL => "https://boards-api.greenhouse.io/v1/boards/". $jobBoard ."/departments",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "",
  CURLOPT_HTTPHEADER => array(
     "Content-Type: application/json",
     "cache-control: no-cache"
  ),
));

$resDeps = curl_exec($curlDeps);
$err = curl_error($curlDeps);
$deps = json_decode($resDeps, true);

?>
   <main>
        <section class="ie-section ie-section--press ie-section--open-positions">
            <div class="container" style="position:relative">
                <div class="ie-career__main-content">
                    <h1 class="ie-career__section-head"><?php the_title(); ?></h1>
                    <?php if(!empty($deps)){ ?>
                        <ul class="ie-career__departments-list" id="currentOpeningsTab" role="tablist">
                              <?php $i=1; foreach($deps['departments'] as $dep){ 
                                 if($dep['name'] != 'No Department'){ ?>
                                    <li>
                                       <button class="ie-career__departments-btn <?php echo ($i==1) ? 'active' : ''; ?>" id="dept-<?php echo $i; ?>-tab" data-bs-toggle="tab"
                                          data-bs-target="#dept-<?php echo $i; ?>" type="button" role="tab" aria-controls="dept-<?php echo $i; ?>"
                                          aria-selected="true"><?php echo $dep['name']; ?></button>
                                    </li>
                              <?php  $i++; } 
                              } ?>
                        </ul>

                        <div class="tab-content" id="currentOpeningsTabContent">
                              <?php $i=1; foreach($deps['departments'] as $dep){ 
                                 if($dep['name'] != 'No Department'){ ?>
                                    <div class="tab-pane fade <?php echo ($i==1) ? 'show active' : ''; ?>" id="dept-<?php echo $i; ?>" role="tabpanel" aria-labelledby="dept-<?php echo $i; ?>-tab">
                                    <?php if(!empty($dep['jobs'])){?>   
                                       <div class="ie-career__jobs-wrapper">
                                          <ul class="ie-career__jobs-list">
                                             <?php foreach($dep['jobs'] as $job){ ?>
                                                <li job-id="<?php echo $job['id']; ?>">
                                                   <div class="ie-career__job-card-head">
                                                      <div class="ie-career__job-card-head-left">
                                                            <h3><?php echo $job['title']; ?></h3>
                                                            <p><?php echo $job['location']['name']; ?></p>
                                                      </div>
                                                      <div class="ie-career__job-card-head-right">
                                                            <button class="ie-career__job-card-btn false" job-id="<?php echo $job['id']; ?>">View Description</button>
                                                            <a class="ie-career__job-card-btn" href="<?php echo $job['absolute_url']; ?>">Apply</a>
                                                      </div>
                                                   </div>
                                                   <div class="ie-career__job-description false"></div>
                                                </li>
                                             <?php } ?>
                                          </ul>
                                       </div>
                                       <?php }else{ ?>
                                          <div class="ie-career__no-jobs-wrapper">
                                             <h2>We're sorry</h2>
                                             <p>There are no current openings in this department, please check back later</p>
                                          </div>
                                       <?php } ?>
                                    </div>
                              <?php  $i++;} 
                           } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>
    </main>
    
<?php
get_footer();
?>
<script>
   var greenhouseAPI = "https://boards-api.greenhouse.io/v1/boards/<?php echo $jobBoard; ?>/jobs/";
   async function appendJobData(jobID) {
      const data = await $.getJSON(greenhouseAPI + jobID + '?callback?');
      var div = jQuery('.ie-career__jobs-list li[job-id='+ jobID +'] .ie-career__job-description');
      div.append(data.content);
      div.html(div.text());
   }
   jQuery(function($){
      $('button.ie-career__job-card-btn').click(function(){
         let el = $(this);
         let jobID = el.attr('job-id');
         console.log(el.closest('li').find('.ie-career__job-description').html() );
         if( el.closest('li').find('.ie-career__job-description').html() == ''){
            appendJobData(jobID);
         }
            
         if(el.hasClass('active')){
            el.removeClass('active');
            el.closest('li').find('.ie-career__job-description').removeClass('active');
         }else{
            $('button.ie-career__job-card-btn').removeClass('active');
            $('.ie-career__job-description').removeClass('active');
            el.addClass('active');
            el.closest('li').find('.ie-career__job-description').addClass('active');
         }
      });
   });
</script>