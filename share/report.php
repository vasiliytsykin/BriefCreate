<?php

$company = $data['company'];
$contactPerson = $data['contact'];
$contactSegments = explode(',', $contactPerson);
$email = $contactSegments[2];
$phone = $contactSegments[1];

?>

<h5 class="h5 report-h5">Бриф на разработку сайта</h5>
<h1 class="h1 report-h1"><?php echo $data['company']?></h1>

<div class="col-md-5">



    <div class="report-block">
        <h6 class="report-h6">Контакты</h6>
        <p class="report-p"><?php echo $data['contact']?></p>
    </div>

    <div class="report-block">
        <h6 class="report-h6">Сфера деятельности</h6>
        <p class="report-p"><?php echo $data['sphere']?></p>
    </div>

    <div class="report-block">
        <h6 class="report-h6">География деятельности</h6>
        <p class="report-p"><?php echo $data['geography']?></p>
    </div>

    <div class="contact-info">
        <p class="contact-p">По всем вопросам обращайтесь</br>
            по адресу <?php echo $email?>, </br>
            или по телефону  <?php echo $phone?>
        </p>
    </div>

    <h3 class="report-h3">Постоянная ссылка</h3>

    <div class="form-control brief-ref"><span class="ref">ссылка</span></div>

</div>


