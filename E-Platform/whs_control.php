<?php include_once('./whs_header.php'); ?>
<head>
    <style>
        .form-horizontal{
            display:block;
            width:50%;
            margin:0 auto;
        }
    </style>
</head>

<div class="accordion" id="accordionExample">
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Manage Order
            </button>
        </h2>
        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <?php include_once('./m_order.php');?>
            </div>
        </div>
    </div>
</div>